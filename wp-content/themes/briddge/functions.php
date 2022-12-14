<?php
/**
 * Briddge functions and definitions
 */
 
define('BRIDDGE_DIR', get_template_directory() );
define('BRIDDGE_URI', get_template_directory_uri() );

function briddge_theme_support() {
	
	/* Text domain */
	load_theme_textdomain( 'briddge', BRIDDGE_DIR . '/languages' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1140;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );
	
	update_option( 'large_size_w', 1170 );
	update_option( 'large_size_h', 694 );
	update_option( 'large_crop', 1 );
	update_option( 'medium_size_w', 768 );
	update_option( 'medium_size_h', 456 );
	update_option( 'medium_crop', 1 );
	update_option( 'thumbnail_size_w', 80 );
	update_option( 'thumbnail_size_h', 80 );
	update_option( 'thumbnail_crop', 1 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	load_theme_textdomain( 'briddge' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'style-editor.css' );

	// Editor color palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Dark Gray', 'briddge' ),
				'slug'  => 'dark-gray',
				'color' => '#111',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'briddge' ),
				'slug'  => 'light-gray',
				'color' => '#767676',
			),
			array(
				'name'  => esc_html__( 'White', 'briddge' ),
				'slug'  => 'white',
				'color' => '#FFF',
			),
		)
	);

	// Add support for responsive embedded content.
	//add_theme_support( 'responsive-embeds' );

}

add_action( 'after_setup_theme', 'briddge_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php'; 

//Elements
require get_template_directory() . '/classes/class.briddge-wp-elements.php';
//Framework
require get_template_directory() . '/classes/class.briddge-wp-framework.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-briddge-walker-comment.php';

if ( is_admin() ) {
	require_once ( BRIDDGE_DIR . '/admin/class.admin-settings.php');
}

if( !class_exists('Briddge_Theme_Option') ){
	require_once ( BRIDDGE_DIR . '/inc/theme-default.php');
}

/**
 * Register and Enqueue Scripts.
 */
function briddge_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl-carousel.min.css', array(), '1.8.0', 'all' );
	wp_enqueue_style( 'bootstrap-5', BRIDDGE_URI . '/assets/css/bootstrap.min.css', array(), '5.0.2' );
	wp_enqueue_style( 'bootstrap-icons', BRIDDGE_URI . '/assets/css/bootstrap-icons.css', false, '1.9.1' );
	
	wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), '1.0.1', 'all' );
	wp_enqueue_style( 'briddge-style', get_template_directory_uri() . '/style.css', array(), $theme_version );
	wp_style_add_data( 'briddge-style', 'rtl', 'replace' );

	if( !class_exists('Briddge_Theme_Option') ){
		wp_enqueue_style( 'briddge-google-fonts', briddge_theme_default_fonts_url(), array(), null, 'all' );
		wp_enqueue_style( 'briddge-custom', BRIDDGE_URI . '/assets/css/theme-custom-default.css', array(), '1.0' );
	}else{
		$custom_css = '';
		$custom_style = get_option( 'briddge_custom_styles' );
		if( class_exists( 'Briddge_Theme_Option' ) ){
			if( $custom_style ){
				$custom_css .= Briddge_Theme_Option::briddge_minify_css( $custom_style );
			}else{
				$custom_css = apply_filters( 'briddge_trigger_to_save_custom_styles', $custom_css );
			}
			if( is_singular() ){
				$post_id = get_the_ID();
				$post_styles = get_post_meta( $post_id, 'briddge_post_custom_styles', true );
				if( $post_styles ){
					$custom_css .= $post_styles; //Briddge_Theme_Option::briddge_minify_css( $post_styles );
				}
			}
		}
		if( $custom_css ) wp_add_inline_style( 'briddge-style', stripslashes_deep( $custom_css ) );
	}

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.8.0', false );
	wp_enqueue_script( 'briddge-js', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), $theme_version, false );
	wp_script_add_data( 'briddge-js', 'async', true );

	$briddge_js_args = array(
		'ajax_url' => esc_url( admin_url('admin-ajax.php') ),
		'add_to_cart' => wp_create_nonce('briddge-add-to-cart(*$#'),
		'remove_from_cart' => wp_create_nonce('briddge-remove-from-cart(*$#'),
		'cart_update_pbm' => esc_html__('Cart Update Problem.', 'briddge'),
		'wishlist_remove' => wp_create_nonce('briddge-wishlist-{}@@%^@'),
		'product_view' => wp_create_nonce('briddge-product-view-@%^&#'),
		'mc_nounce' => wp_create_nonce( 'briddge-mailchimp' ), 
		'must_fill' => esc_html__( 'Must Fill Required Details.', 'briddge' ),
		'valid_email' => esc_html__( 'Enter Valid Email ID.', 'briddge' ),
	);
	$briddge_js_args = apply_filters( 'briddge_wp_localize_args', $briddge_js_args );
	wp_localize_script('briddge-js', 'briddge_ajax_var', $briddge_js_args );


}
add_action( 'wp_enqueue_scripts', 'briddge_register_scripts' );

/**
 * Enqueue supplemental block editor styles.
 */
function briddge_editor_customizer_styles() {
	if( !class_exists('Briddge_Options') ){
		require_once ( BRIDDGE_DIR . '/inc/theme-default.php');
		wp_enqueue_style( 'briddge-customizer-google-fonts', briddge_theme_default_fonts_url(), array(), null, 'all' );
	}
	wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), '1.0.1', 'all' );
	wp_enqueue_style( 'briddge-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.0', 'all' );	
	if( class_exists('Briddge_Options') ){
		ob_start();
		require_once ( BRIDDGE_ADDON_DIR . '/admin/extension/theme-options/theme-editor-css.php');
		$custom_styles = ob_get_clean();
		wp_add_inline_style( 'briddge-editor-customizer-styles', $custom_styles );
		add_action( 'admin_head', function(){ briddge_wp_actions::briddge_google_fonts_con(); }, 10 );
	}
}
add_action( 'enqueue_block_editor_assets', 'briddge_editor_customizer_styles' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function briddge_menus() {

	$locations = array(
		'primary'  => __( 'Primary Menu', 'briddge' ),
		'mobile'   => __( 'Mobile Menu', 'briddge' ),
		'top-menu'  => __( 'Top Menu', 'briddge' ),
		'footer'   => __( 'Footer Menu', 'briddge' )
	);

	register_nav_menus( $locations );
}
add_action( 'init', 'briddge_menus' );

/**
 * Register widget areas.
 */
function briddge_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h3 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h3>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Right Sidebar
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Right Sidebar', 'briddge' ),
				'id'          => 'right-sidebar',
				'description' => esc_html__( 'Widgets in this area will be displayed in the right side column in the content area.', 'briddge' ),
			)
		)
	);
	
	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #1', 'briddge' ),
				'id'          => 'footer-1',
				'description' => esc_html__( 'Widgets in this area will be displayed in the first column in the footer.', 'briddge' ),
			)
		)
	);

	// Footer #2
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #2', 'briddge' ),
				'id'          => 'footer-2',
				'description' => esc_html__( 'Widgets in this area will be displayed in the second column in the footer.', 'briddge' ),
			)
		)
	);

	// Footer #3
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #3', 'briddge' ),
				'id'          => 'footer-3',
				'description' => esc_html__( 'Widgets in this area will be displayed in the third column in the footer.', 'briddge' ),
			)
		)
	);
	
	// Footer #4
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #4', 'briddge' ),
				'id'          => 'footer-4',
				'description' => esc_html__( 'Widgets in this area will be displayed in the third column in the footer.', 'briddge' ),
			)
		)
	);

}

add_action( 'widgets_init', 'briddge_sidebar_registration' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 *
 * @return string $html
 */
function briddge_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}
add_filter( 'the_content_more_link', 'briddge_read_more_tag' );

//Excerpt more
add_filter( 'excerpt_more', function($length) {
    return '..';
} );

// Add the custom columns to the book post type:
add_filter( 'manage_posts_columns', 'briddge_set_custom_edit_columns' );
add_filter( 'manage_pages_columns', 'briddge_set_custom_edit_columns' );
function briddge_set_custom_edit_columns( $columns ) {
	unset( $columns['author'] );
    $columns['views'] = __( 'Views', 'briddge' );
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_posts_custom_column' , 'briddge_custom_post_column', 10, 2 );
add_action( 'manage_pages_custom_column' , 'briddge_custom_post_column', 10, 2 );
function briddge_custom_post_column( $column, $post_id ) {
	switch ( $column ) {
		case 'views' :
			echo get_post_meta( $post_id , 'briddge_post_views_count' , true ); 
		break;
    }
}

// Briddge Mobile Header
add_action( 'briddge_header_before', 'briddge_mobile_header', 10 );
function briddge_mobile_header(){
	get_template_part( 'template-parts/mobile', 'header' );
}

// Briddge Header
add_action( 'briddge_header', 'briddge_desktop_header', 10 );
function briddge_desktop_header(){
	get_template_part( 'template-parts/site', 'header' );
}

// Header slider action 
add_action( 'briddge_header_after', 'briddge_header_slider', 10 );
function briddge_header_slider(){	
	$page_options = briddge_wp_elements::$briddge_page_options;	
	if( !empty( $page_options ) && is_array( $page_options ) ):
		if( isset( $page_options['header-slider'] ) && !empty( $page_options['header-slider'] ) ){
			echo '<div class="briddge-slider-wrapper">';
				echo do_shortcode( $page_options['header-slider'] );
			echo '</div> <!-- .briddge-slider-wrapper -->';
		}
	endif;
}

add_action( 'briddge_footer', 'briddge_site_footer', 10 );
function briddge_site_footer(){
	get_template_part( 'template-parts/site', 'footer' );
}

//Default exceprt length
if( !class_exists( 'Briddge_Addon' ) ){
	add_filter( 'excerpt_length', 'briddge_default_excerpt_length', 10 );
	function briddge_default_excerpt_length( $length ){
		$briddge_options = get_option( 'briddge_options' );
		if( isset( $briddge_options['blog-post-excerpt-length'] ) && !empty( $briddge_options['blog-post-excerpt-length'] ) ) {
			return absint( $briddge_options['blog-post-excerpt-length'] );
		}
		return $length;
	}
}
