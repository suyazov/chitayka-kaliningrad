<?php
/**
 * Сведения об образовательной организации.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
chitayka_render_content_file( 'svedeniya.html' );
get_footer();
