<?php
/**
 * Форма заявки: обработка через admin-post.php.
 * nonce, honeypot, sanitization, согласие на ПДн, wp_mail на admin_email.
 * Заявки в БД не хранятся.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Допустимые варианты CTA.
 *
 * @return array<string,string>
 */
function chitayka_cta_options() {
	return array(
		'diagnostika' => __( 'Бесплатная диагностика', 'chitayka' ),
		'zanyatie'    => __( 'Пробное занятие', 'chitayka' ),
		'den'         => __( 'Пробный день', 'chitayka' ),
	);
}

/**
 * Обработчик admin-post.php.
 */
function chitayka_handle_lead() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = preg_replace( '/#.*$/', '', $back );
	$back = remove_query_arg( 'lead', $back );

	$redirect = function ( $status ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'lead', $status, $back ) . '#lead-form' );
		exit;
	};
	$fail = function () use ( $redirect ) {
		$redirect( 'error' );
	};

	// Nonce.
	if ( ! isset( $_POST['chitayka_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['chitayka_nonce'] ) ), 'chitayka_lead' ) ) {
		$fail();
	}

	// Honeypot: заполнено — это бот, молча «успешно» завершаем.
	if ( ! empty( $_POST['lead_website'] ) ) {
		$redirect( 'ok' );
	}

	// Согласие на обработку ПДн.
	if ( empty( $_POST['lead_consent'] ) ) {
		$fail();
	}

	$name  = isset( $_POST['lead_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_name'] ) ) : '';
	$phone = isset( $_POST['lead_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_phone'] ) ) : '';
	$cta   = isset( $_POST['lead_cta'] ) ? sanitize_key( wp_unslash( $_POST['lead_cta'] ) ) : '';

	$options = chitayka_cta_options();
	if ( '' === $name || '' === $phone || ! isset( $options[ $cta ] ) ) {
		$fail();
	}

	$subject = sprintf(
		/* translators: %s — тип заявки (CTA). */
		__( 'Заявка с сайта: %s', 'chitayka' ),
		$options[ $cta ]
	);
	$message = sprintf(
		"CTA: %s\nИмя: %s\nТелефон: %s\nСтраница: %s\nВремя: %s\n",
		$options[ $cta ],
		$name,
		$phone,
		esc_url_raw( $back ),
		current_time( 'mysql' )
	);

	$sent = wp_mail( get_option( 'admin_email' ), $subject, $message );

	$redirect( $sent ? 'ok' : 'error' );
}

add_action( 'admin_post_chitayka_lead', 'chitayka_handle_lead' );
add_action( 'admin_post_nopriv_chitayka_lead', 'chitayka_handle_lead' );
