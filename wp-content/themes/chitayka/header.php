<?php
/**
 * Начало HTML-документа.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/hero-illustration-v2.webp' ); ?>" as="image" type="image/webp" fetchpriority="high">
	<?php wp_head(); ?>
</head>
<body <?php body_class( is_front_page() ? 'home-page' : '' ); ?>>
<?php wp_body_open(); ?>
