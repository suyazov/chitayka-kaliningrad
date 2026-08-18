<?php
/**
 * Тема «Читай-ка»: настройка, ассеты, обработка заявок.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CHITAYKA_VERSION', '0.1.0' );

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		register_nav_menus( array( 'primary' => __( 'Основное меню', 'chitayka' ) ) );
	}
);

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'chitayka-style', get_stylesheet_uri(), array(), CHITAYKA_VERSION );
		wp_enqueue_style( 'chitayka-main', get_template_directory_uri() . '/assets/css/main.css', array( 'chitayka-style' ), CHITAYKA_VERSION );
		wp_enqueue_script( 'chitayka-main', get_template_directory_uri() . '/assets/js/main.js', array(), CHITAYKA_VERSION, true );
	}
);

require get_template_directory() . '/inc/lead-form.php';
