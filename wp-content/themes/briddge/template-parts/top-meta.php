<?php
/**
 * Top Meta
 */

$top_meta_opt = briddge_wp_elements::briddge_options('single-top-meta-enable');
if( $top_meta_opt ):
	briddge_wp_elements::briddge_get_post_meta( briddge_wp_elements::$template, 'top' );
endif;