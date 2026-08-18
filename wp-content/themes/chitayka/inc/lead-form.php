<?php
/**
 * Форма заявки: рендер + обработка через admin-post.php.
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
 * Рендер формы заявки.
 *
 * @param string $cta Ключ CTA по умолчанию.
 */
function chitayka_render_lead_form( $cta = 'diagnostika' ) {
	$options = chitayka_cta_options();
	if ( ! isset( $options[ $cta ] ) ) {
		$cta = 'diagnostika';
	}
	$status = isset( $_GET['lead'] ) ? sanitize_key( wp_unslash( $_GET['lead'] ) ) : '';
	?>
	<form class="lead-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="chitayka_lead">
		<?php wp_nonce_field( 'chitayka_lead', 'chitayka_nonce' ); ?>

		<?php if ( 'ok' === $status ) : ?>
			<p class="lead-form__notice lead-form__notice--ok"><?php esc_html_e( 'Заявка отправлена. Мы свяжемся с вами.', 'chitayka' ); ?></p>
		<?php elseif ( 'error' === $status ) : ?>
			<p class="lead-form__notice lead-form__notice--error"><?php esc_html_e( 'Не удалось отправить заявку. Проверьте поля и попробуйте ещё раз.', 'chitayka' ); ?></p>
		<?php endif; ?>

		<p class="lead-form__field">
			<label for="lead-name"><?php esc_html_e( 'Ваше имя', 'chitayka' ); ?></label>
			<input type="text" id="lead-name" name="lead_name" required maxlength="100">
		</p>
		<p class="lead-form__field">
			<label for="lead-phone"><?php esc_html_e( 'Телефон', 'chitayka' ); ?></label>
			<input type="tel" id="lead-phone" name="lead_phone" required maxlength="30">
		</p>
		<p class="lead-form__field">
			<label for="lead-cta"><?php esc_html_e( 'Что вас интересует', 'chitayka' ); ?></label>
			<select id="lead-cta" name="lead_cta">
				<?php foreach ( $options as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $cta, $key ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<!-- Honeypot: скрытое поле, люди его не заполняют -->
		<p class="lead-form__hp" aria-hidden="true">
			<label for="lead-website"><?php esc_html_e( 'Не заполняйте это поле', 'chitayka' ); ?></label>
			<input type="text" id="lead-website" name="lead_website" tabindex="-1" autocomplete="off">
		</p>

		<p class="lead-form__consent">
			<label>
				<input type="checkbox" name="lead_consent" value="1" required>
				<?php esc_html_e( 'Согласен(на) на обработку персональных данных', 'chitayka' ); ?>
			</label>
		</p>

		<p class="lead-form__submit">
			<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Отправить заявку', 'chitayka' ); ?></button>
		</p>
	</form>
	<?php
}

/**
 * Обработчик admin-post.php.
 */
function chitayka_handle_lead() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'lead', $back );

	$fail = function () use ( $back ) {
		wp_safe_redirect( add_query_arg( 'lead', 'error', $back ) );
		exit;
	};

	// Nonce.
	if ( ! isset( $_POST['chitayka_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['chitayka_nonce'] ) ), 'chitayka_lead' ) ) {
		$fail();
	}

	// Honeypot: заполнено — это бот, молча «успешно» завершаем.
	if ( ! empty( $_POST['lead_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) );
		exit;
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

	wp_safe_redirect( add_query_arg( 'lead', $sent ? 'ok' : 'error', $back ) );
	exit;
}

add_action( 'admin_post_chitayka_lead', 'chitayka_handle_lead' );
add_action( 'admin_post_nopriv_chitayka_lead', 'chitayka_handle_lead' );
