<?php
/**
 * Bottom Meta
 */

$bottom_meta_opt = briddge_wp_elements::briddge_options('single-bottom-meta-enable');
if( $bottom_meta_opt ):
	briddge_wp_elements::briddge_get_post_meta( briddge_wp_elements::$template, 'bottom' );
endif;