<?php
/* =========================================
 * Enqueues parent theme stylesheet
 * ========================================= */

add_action( 'wp_enqueue_scripts', 'briddge_enqueue_child_theme_styles', 30 );
function briddge_enqueue_child_theme_styles() {
	wp_enqueue_style( 'briddge-child-theme-style', get_stylesheet_uri(), array(), null );
}
