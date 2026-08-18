<?php
/**
 * Шапка темы.
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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'К содержимому', 'chitayka' ); ?></a>
<header class="site-header">
	<div class="container site-header__inner">
		<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>
		<button class="site-header__toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
			<?php esc_html_e( 'Меню', 'chitayka' ); ?>
		</button>
		<nav class="site-header__nav" aria-label="<?php esc_attr_e( 'Основное меню', 'chitayka' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
</header>
<main id="main" class="site-main">
