<?php
/**
 * Server-side delivery of website leads to ALFACRM v2 API.
 *
 * Long-lived credentials are read from wp-config.php constants or environment
 * variables and must never be committed with the theme.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Read an ALFACRM setting from a constant first and the environment second.
 *
 * @param string $name Setting name.
 * @param mixed  $default Default value.
 * @return mixed
 */
function chitayka_alfacrm_setting( $name, $default = '' ) {
	if ( defined( $name ) ) {
		return constant( $name );
	}

	$value = getenv( $name );
	return false === $value ? $default : $value;
}

/**
 * Return validated integration configuration.
 *
 * The source and status identifiers are optional: ALFACRM can create a lead
 * without them, and they may be added after the client's funnel is confirmed.
 *
 * @return array<string,mixed>|WP_Error
 */
function chitayka_alfacrm_config() {
	$host = strtolower( trim( (string) chitayka_alfacrm_setting( 'CHITAYKA_ALFACRM_HOST' ) ) );
	$host = preg_replace( '#^https?://#', '', $host );
	$host = rtrim( $host, '/' );

	$config = array(
		'host'           => $host,
		'email'          => sanitize_email( (string) chitayka_alfacrm_setting( 'CHITAYKA_ALFACRM_EMAIL' ) ),
		'api_key'        => trim( (string) chitayka_alfacrm_setting( 'CHITAYKA_ALFACRM_API_KEY' ) ),
		'branch_id'      => absint( chitayka_alfacrm_setting( 'CHITAYKA_ALFACRM_BRANCH_ID', 0 ) ),
		'lead_source_id' => absint( chitayka_alfacrm_setting( 'CHITAYKA_ALFACRM_LEAD_SOURCE_ID', 0 ) ),
		'lead_status_id' => absint( chitayka_alfacrm_setting( 'CHITAYKA_ALFACRM_LEAD_STATUS_ID', 0 ) ),
	);

	if ( ! preg_match( '/^[a-z0-9.-]+$/', $config['host'] ) || ! is_email( $config['email'] ) || '' === $config['api_key'] || 0 === $config['branch_id'] ) {
		return new WP_Error( 'alfacrm_not_configured', __( 'ALFACRM integration is not configured.', 'chitayka' ) );
	}

	return $config;
}

/**
 * Decode a successful JSON response or return a non-sensitive error.
 *
 * @param array|WP_Error $response WordPress HTTP response.
 * @param int[]          $success_codes Accepted HTTP status codes.
 * @return array<string,mixed>|WP_Error
 */
function chitayka_alfacrm_decode_response( $response, $success_codes = array( 200 ) ) {
	if ( is_wp_error( $response ) ) {
		return new WP_Error( 'alfacrm_network_error', __( 'ALFACRM is unavailable.', 'chitayka' ) );
	}

	$status = (int) wp_remote_retrieve_response_code( $response );
	$body   = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( ! in_array( $status, $success_codes, true ) ) {
		return new WP_Error(
			'alfacrm_http_' . $status,
			__( 'ALFACRM rejected the request.', 'chitayka' ),
			array( 'status' => $status )
		);
	}

	if ( ! is_array( $body ) ) {
		return new WP_Error( 'alfacrm_invalid_json', __( 'ALFACRM returned an invalid response.', 'chitayka' ) );
	}

	return $body;
}

/**
 * Get a temporary ALFACRM token (valid for one hour).
 *
 * @param array<string,mixed> $config Integration configuration.
 * @param bool                $force_refresh Ignore the cached token.
 * @return string|WP_Error
 */
function chitayka_alfacrm_token( $config, $force_refresh = false ) {
	$cache_key = 'chitayka_alfacrm_' . md5( $config['host'] . '|' . $config['email'] );

	if ( ! $force_refresh ) {
		$cached = get_transient( $cache_key );
		if ( is_string( $cached ) && '' !== $cached ) {
			return $cached;
		}
	}

	delete_transient( $cache_key );
	$response = wp_safe_remote_post(
		'https://' . $config['host'] . '/v2api/auth/login',
		array(
			'headers'     => array(
				'Accept'       => 'application/json',
				'Content-Type' => 'application/json',
			),
			'body'        => wp_json_encode(
				array(
					'email'   => $config['email'],
					'api_key' => $config['api_key'],
				)
			),
			'timeout'     => 8,
			'redirection' => 0,
		)
	);
	$decoded  = chitayka_alfacrm_decode_response( $response );

	if ( is_wp_error( $decoded ) ) {
		return $decoded;
	}

	$token = isset( $decoded['token'] ) ? trim( (string) $decoded['token'] ) : '';
	if ( '' === $token ) {
		return new WP_Error( 'alfacrm_missing_token', __( 'ALFACRM did not return a token.', 'chitayka' ) );
	}

	// ALFACRM tokens live for 3600 seconds. Keep a five-minute safety margin.
	set_transient( $cache_key, $token, 55 * MINUTE_IN_SECONDS );

	return $token;
}

/**
 * Normalize a Russian phone number for ALFACRM.
 *
 * @param string $phone Submitted phone.
 * @return string
 */
function chitayka_alfacrm_phone( $phone ) {
	$digits = preg_replace( '/\D+/', '', $phone );
	if ( 11 === strlen( $digits ) && '8' === $digits[0] ) {
		$digits = '7' . substr( $digits, 1 );
	} elseif ( 10 === strlen( $digits ) ) {
		$digits = '7' . $digits;
	}

	return '' !== $digits ? '+' . $digits : $phone;
}

/**
 * Create a lead in ALFACRM.
 *
 * @param string $name Submitted name.
 * @param string $phone Submitted phone.
 * @param string $cta_label Human-readable request type.
 * @param string $page_url Source page URL.
 * @return array<string,mixed>|WP_Error
 */
function chitayka_alfacrm_create_lead( $name, $phone, $cta_label, $page_url ) {
	$config = chitayka_alfacrm_config();
	if ( is_wp_error( $config ) ) {
		return $config;
	}

	$limited_name = function_exists( 'mb_substr' ) ? mb_substr( $name, 0, 50 ) : substr( $name, 0, 50 );
	$payload      = array(
		'name'       => $limited_name,
		'legal_type' => 1,
		'is_study'   => 0,
		'branch_ids' => array( $config['branch_id'] ),
		'phone'      => array( chitayka_alfacrm_phone( $phone ) ),
		'note'       => sprintf(
			"Заявка с сайта chitayka39.ru\nИнтерес: %s\nСтраница: %s\nВремя: %s",
			$cta_label,
			esc_url_raw( $page_url ),
			current_time( 'mysql' )
		),
	);

	if ( $config['lead_source_id'] > 0 ) {
		$payload['lead_source_id'] = $config['lead_source_id'];
	}
	if ( $config['lead_status_id'] > 0 ) {
		$payload['lead_status_ids'] = array( $config['lead_status_id'] );
	}

	for ( $attempt = 0; $attempt < 2; $attempt++ ) {
		$token = chitayka_alfacrm_token( $config, 1 === $attempt );
		if ( is_wp_error( $token ) ) {
			return $token;
		}

		$response = wp_safe_remote_post(
			'https://' . $config['host'] . '/v2api/' . $config['branch_id'] . '/customer/create',
			array(
				'headers'     => array(
					'Accept'           => 'application/json',
					'Content-Type'     => 'application/json',
					'X-ALFACRM-TOKEN' => $token,
				),
				'body'        => wp_json_encode( $payload ),
				'timeout'     => 8,
				'redirection' => 0,
			)
		);
		$status   = is_wp_error( $response ) ? 0 : (int) wp_remote_retrieve_response_code( $response );

		if ( 401 === $status && 0 === $attempt ) {
			continue;
		}

		return chitayka_alfacrm_decode_response( $response, array( 200, 201 ) );
	}

	return new WP_Error( 'alfacrm_unauthorized', __( 'ALFACRM authorization failed.', 'chitayka' ) );
}
