<?php
/**
 * Тема «Читай-ка»: ассеты, редактируемые данные и заявки.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CHITAYKA_VERSION', '1.2.0' );

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'style', 'script', 'gallery', 'caption' ) );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		$theme_uri = get_template_directory_uri();
		wp_enqueue_style( 'chitayka-fonts', 'https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400&display=swap', array(), null );
		wp_enqueue_style( 'chitayka-main', $theme_uri . '/assets/main.css', array( 'chitayka-fonts' ), CHITAYKA_VERSION );
		if ( is_page( 'politika-konfidencialnosti' ) ) {
			wp_enqueue_style( 'chitayka-politika', $theme_uri . '/assets/politika.css', array( 'chitayka-main' ), CHITAYKA_VERSION );
		}
		if ( is_page( 'svedeniya-ob-obrazovatelnoj-organizacii' ) ) {
			wp_enqueue_style( 'chitayka-svedeniya', $theme_uri . '/assets/svedeniya.css', array( 'chitayka-main' ), CHITAYKA_VERSION );
		}
		wp_enqueue_script( 'chitayka-main', $theme_uri . '/assets/main.js', array(), CHITAYKA_VERSION, true );
	}
);

/**
 * Фирменная иконка сайта, пока в WordPress не выбрана другая Site Icon.
 */
function chitayka_favicon_links() {
	if ( has_site_icon() ) {
		return;
	}

	$assets_uri = trailingslashit( get_template_directory_uri() ) . 'assets/';
	$version    = CHITAYKA_VERSION;
	echo '<link rel="icon" href="' . esc_url( add_query_arg( 'ver', $version, $assets_uri . 'favicon.ico' ) ) . '" sizes="any">' . "\n";
	echo '<link rel="icon" href="' . esc_url( add_query_arg( 'ver', $version, $assets_uri . 'favicon-512.png' ) ) . '" type="image/png">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( add_query_arg( 'ver', $version, $assets_uri . 'apple-touch-icon.png' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'chitayka_favicon_links', 1 );
add_action( 'admin_head', 'chitayka_favicon_links', 1 );
add_action( 'login_head', 'chitayka_favicon_links', 1 );

/**
 * Возвращает настройку темы с безопасным запасным значением.
 *
 * @param string $name    Имя настройки.
 * @param string $default Значение по умолчанию.
 * @return string
 */
function chitayka_option( $name, $default = '' ) {
	$value = get_theme_mod( 'chitayka_' . $name, $default );
	return is_string( $value ) ? $value : $default;
}

/**
 * URL фотографии галереи: медиатека либо bundled asset.
 *
 * @param int $number Номер фотографии 1–14.
 * @return string
 */
function chitayka_gallery_image( $number ) {
	$number   = max( 1, min( 14, absint( $number ) ) );
	$fallback = get_template_directory_uri() . '/assets/gallery/photo-' . str_pad( (string) $number, 2, '0', STR_PAD_LEFT ) . '.webp';
	$value = chitayka_option( 'gallery_' . $number, $fallback );
	return '' !== $value ? $value : $fallback;
}

/**
 * Выводит подготовленную HTML-разметку внутренней страницы.
 *
 * @param string $filename Имя файла внутри темы.
 */
function chitayka_render_content_file( $filename ) {
	$html = file_get_contents( get_template_directory() . '/' . basename( $filename ) );
	if ( false === $html ) {
		return;
	}

	$home_uri   = trailingslashit( home_url( '/' ) );
	$phone      = chitayka_option( 'phone', '+7 911 497-33-04' );
	$phone_uri  = preg_replace( '/[^0-9+]/', '', $phone );
	$email      = chitayka_option( 'email', 'clubchitayka@mail.ru' );
	$address    = chitayka_option( 'address', 'Калининград, ул. Аксакова 131' );
	$vk_url     = chitayka_option( 'vk_url', 'https://vk.ru/clubchitayka39' );
	$requisites = chitayka_option( 'lead_requisites', 'ИП Бурмистрова Полина Сергеевна · ИНН 246519367524 · ОГРНИП 325246800146312' );

	$replacements = array(
		'../assets/' => esc_url( trailingslashit( get_template_directory_uri() ) . 'assets/' ),
		'href="/"' => 'href="' . esc_url( $home_uri ) . '"',
		'href="/#' => 'href="' . esc_url( $home_uri ) . '#',
		'href="/svedeniya-ob-obrazovatelnoj-organizacii/"' => 'href="' . esc_url( $home_uri . 'svedeniya-ob-obrazovatelnoj-organizacii/' ) . '"',
		'href="/politika-konfidencialnosti/"' => 'href="' . esc_url( $home_uri . 'politika-konfidencialnosti/' ) . '"',
		'{{phone}}' => esc_html( $phone ),
		'{{phone_uri}}' => esc_attr( $phone_uri ),
		'{{email}}' => esc_html( $email ),
		'{{address}}' => esc_html( $address ),
		'{{vk_url}}' => esc_url( $vk_url ),
		'{{requisites}}' => esc_html( $requisites ),
	);

	echo strtr( $html, $replacements ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- dynamic tokens are escaped above.
}

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/admin-content.php';
require get_template_directory() . '/inc/lead-form.php';
