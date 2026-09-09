<?php
/**
 * Политика обработки персональных данных.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
chitayka_render_content_file( 'politika.html' );
get_footer();
