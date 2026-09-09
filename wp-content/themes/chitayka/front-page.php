<?php
/**
 * Главная страница. Разметка хранится отдельно, значения подставляются из Customizer.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$html = file_get_contents( get_template_directory() . '/home.html' );
if ( false === $html ) {
	echo '<main class="site-main"><div class="container"><p>Не удалось загрузить шаблон главной страницы.</p></div></main>';
	get_footer();
	return;
}

$section_ids = array(
	'hero'         => 'top',
	'directions'   => 'directions',
	'journey'      => 'first-visit',
	'programs'     => 'programs',
	'prodlenka'    => 'prodlenka',
	'advantages'   => 'advantages',
	'gallery'      => 'gallery',
	'achievements' => 'achievements',
	'prices'       => 'prices',
	'lead'         => 'lead-form',
);
foreach ( $section_ids as $section_key => $section_id ) {
	if ( chitayka_is_home_section_enabled( $section_key ) ) {
		continue;
	}
	$pattern = '#\s*<section\b(?=[^>]*\bid="' . preg_quote( $section_id, '#' ) . '")[^>]*>.*?</section>\s*#s';
	$html    = preg_replace( $pattern, '', $html, 1 );
}

$asset_uri  = trailingslashit( get_template_directory_uri() ) . 'assets/';
$home_uri   = trailingslashit( home_url( '/' ) );
$phone      = chitayka_option( 'phone', '+7 911 497-33-04' );
$phone_uri  = preg_replace( '/[^0-9+]/', '', $phone );
$email      = chitayka_option( 'email', 'clubchitayka@mail.ru' );
$address    = chitayka_option( 'address', 'Калининград, ул. Аксакова 131' );
$vk_url     = chitayka_option( 'vk_url', 'https://vk.ru/clubchitayka39' );
$requisites = chitayka_option( 'lead_requisites', 'ИП Бурмистрова Полина Сергеевна · ИНН 246519367524 · ОГРНИП 325246800146312' );

$replacements = array(
	'assets/' => esc_url( $asset_uri ),
	'href="/svedeniya-ob-obrazovatelnoj-organizacii/"' => 'href="' . esc_url( $home_uri . 'svedeniya-ob-obrazovatelnoj-organizacii/' ) . '"',
	'href="/politika-konfidencialnosti/"' => 'href="' . esc_url( $home_uri . 'politika-konfidencialnosti/' ) . '"',
	'{{phone}}'      => esc_html( $phone ),
	'{{phone_uri}}'  => esc_attr( $phone_uri ),
	'{{email}}'      => esc_html( $email ),
	'{{address}}'    => esc_html( $address ),
	'{{vk_url}}'     => esc_url( $vk_url ),
	'{{requisites}}' => esc_html( $requisites ),
);

foreach ( chitayka_flat_content_fields() as $key => $field ) {
	if ( 'image' === ( isset( $field['type'] ) ? $field['type'] : '' ) ) {
		continue;
	}
	$replacements[ '{{' . $key . '}}' ] = esc_html( chitayka_option( $key, $field['default'] ) );
}

$price_defaults = array(
	'school' => '6 900 ₽', 'reading' => '6 900 ₽', 'development' => '6 900 ₽',
	'english' => '5 600 ₽', 'calligraphy' => '5 600 ₽', 'art' => '3 900 ₽',
	'neuro' => '1 650 ₽', 'extended_am' => '18 500 ₽', 'extended_pm' => '21 800 ₽',
	'optimal' => '12 000 ₽', 'homework' => '9 900 ₽', 'one_day' => '2 000 ₽',
	'events' => '500 ₽', 'wall' => '500 ₽',
);

foreach ( $price_defaults as $key => $default ) {
	$replacements[ '{{price_' . $key . '}}' ] = esc_html( chitayka_option( 'price_' . $key, $default ) );
}

for ( $index = 1; $index <= 14; $index++ ) {
	$replacements[ '{{gallery_' . $index . '}}' ] = esc_url( chitayka_gallery_image( $index ) );
}

$lead_status = isset( $_GET['lead'] ) ? sanitize_key( wp_unslash( $_GET['lead'] ) ) : '';
$lead_notice = '';
if ( 'ok' === $lead_status ) {
	$lead_notice = '<p class="lead__notice lead__notice--ok">Спасибо! Заявка отправлена. Мы свяжемся с вами.</p>';
} elseif ( 'error' === $lead_status ) {
	$lead_notice = '<p class="lead__notice lead__notice--error">Не удалось отправить заявку. Проверьте данные или позвоните нам.</p>';
}

$replacements['{{form_action}}'] = esc_url( admin_url( 'admin-post.php' ) );
$replacements['{{form_nonce}}']  = wp_nonce_field( 'chitayka_lead', 'chitayka_nonce', true, false );
$replacements['{{lead_notice}}'] = $lead_notice;

echo strtr( $html, $replacements ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- dynamic tokens are escaped above.

get_footer();
