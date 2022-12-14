 <?php

/**
 * Briddge Post Options CSS
 */

require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/class.options-style.php' );
$briddge_styles = new Briddge_Theme_Styles;

$post_id = get_the_ID();
$briddge_options = $_POST['briddge_options'];//get_post_meta( $post_id, 'briddge_options', true );
$briddge_styles->briddge_options = $briddge_options;

ob_start();

echo "\n/* Briddge Post Options Styles */";
$briddge_styles->briddge_padding_settings( 'content-padding', '.briddge-content-wrap' );

$briddge_styles->briddge_bg_settings( 'page-title-bg', 'body .briddge-page-header' );

//logo styles
$logo_chk = $briddge_styles->briddge_get_option('logo-chk');
if( $logo_chk == 'custom' ){
	$site_logo_width = $briddge_styles->briddge_get_option('site-logo-width');
	if( !empty( $site_logo_width ) && isset( $site_logo_width['width'] ) && !empty( $site_logo_width['width'] ) ){
		echo 'img.site-logo { max-width: '. esc_attr( $site_logo_width['width'] ) .'px; }';
	}
	$sticky_logo_width = $briddge_styles->briddge_get_option('sticky-logo-width');
	if( !empty( $sticky_logo_width ) && isset( $sticky_logo_width['width'] ) && !empty( $sticky_logo_width['width'] ) ){
		echo 'img.sticky-logo { max-width: '. esc_attr( $sticky_logo_width['width'] ) .'px; }';
	}
	$mobile_logo_width = $briddge_styles->briddge_get_option('mobile-logo-width');
	if( !empty( $mobile_logo_width ) && isset( $mobile_logo_width['width'] ) && !empty( $mobile_logo_width['width'] ) ){
		echo 'img.mobile-logo { max-width: '. esc_attr( $mobile_logo_width['width'] ) .'px; }';
	}
}

//header styles
$header_style_chk = $briddge_styles->briddge_get_option('header-style-chk');
if( $header_style_chk == 'custom' ){
	$briddge_styles->briddge_link_color( 'header-links-color', 'regular', '.site-header a' );
	$briddge_styles->briddge_link_color( 'header-links-color', 'hover', '.site-header a:hover' );
	$briddge_styles->briddge_link_color( 'header-links-color', 'active', '.site-header a:active' );
	$briddge_styles->briddge_bg_settings( 'header-background', '.site-header' );
	$briddge_styles->briddge_padding_settings( 'header-padding', '.site-header' );
	$briddge_styles->briddge_margin_settings( 'header-margin', '.site-header' );
	$briddge_styles->briddge_border_settings( 'header-border', '.site-header' );
}

//header topbar styles & link color
$topbar_style_chk = $briddge_styles->briddge_get_option('header-topbar-style-chk');
if( $topbar_style_chk == 'custom' ){
	$topbar_height = $briddge_styles->briddge_get_option('header-topbar-height');
	if( !empty( $topbar_height ) && isset( $topbar_height['height'] ) && !empty( $topbar_height['height'] ) ){
		echo '.header-topbar {';
			echo 'line-height: '. esc_attr( $topbar_height['height'] ) .'px;';
		echo '}';
	}
	
	$topbar_sticky_height = $briddge_styles->briddge_get_option('header-topbar-sticky-height');
	if( !empty( $topbar_sticky_height ) && isset( $topbar_sticky_height['height'] ) && !empty( $topbar_sticky_height['height'] ) ){
		echo '.header-sticky .header-topbar {';
			echo 'line-height: '. esc_attr( $topbar_sticky_height['height'] ) .'px;';
		echo '}';
	}
	
	$briddge_styles->briddge_bg_settings( 'header-topbar-background', '.header-topbar' );
	$briddge_styles->briddge_padding_settings( 'header-topbar-padding', '.header-topbar' );
	$briddge_styles->briddge_margin_settings( 'header-topbar-margin', '.header-topbar' );
	$briddge_styles->briddge_border_settings( 'header-topbar-border', '.header-topbar' );
	$briddge_styles->briddge_link_color( 'header-topbar-links-color', 'regular', '.header-topbar a' );
	$briddge_styles->briddge_link_color( 'header-topbar-links-color', 'hover', '.header-topbar a:hover' );
	$briddge_styles->briddge_link_color( 'header-topbar-links-color', 'active', '.header-topbar a:active' );

	//topbar on sticky style
	$briddge_styles->briddge_bg_settings( 'header-topbar-sticky-background', '.sticky-head.header-sticky .header-topbar' );
	$briddge_styles->briddge_link_color( 'header-topbar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-topbar a' );
	$briddge_styles->briddge_link_color( 'header-topbar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-topbar a:hover' );
	$briddge_styles->briddge_link_color( 'header-topbar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-topbar a:active' );
}

$logobar_style_chk = $briddge_styles->briddge_get_option('header-logobar-style-chk');
if( $logobar_style_chk == 'custom' ){
	//header logobar styles & link color
	$logobar_height = $briddge_styles->briddge_get_option('header-logobar-height');
	if( !empty( $logobar_height ) && isset( $logobar_height['height'] ) && !empty( $logobar_height['height'] ) ){
		echo '.header-logobar {';
			echo 'line-height: '. esc_attr( $logobar_height['height'] ) .'px;';
		echo '}';
	}
	
	$logobar_sticky_height = $briddge_styles->briddge_get_option('header-logobar-sticky-height');
	if( !empty( $logobar_sticky_height ) && isset( $logobar_sticky_height['height'] ) && !empty( $logobar_sticky_height['height'] ) ){
		echo '.header-sticky .header-logobar {';
			echo 'line-height: '. esc_attr( $logobar_sticky_height['height'] ) .'px;';
		echo '}';
	}
	
	$briddge_styles->briddge_bg_settings( 'header-logobar-background', '.header-logobar' );
	$briddge_styles->briddge_padding_settings( 'header-logobar-padding', '.header-logobar' );
	$briddge_styles->briddge_margin_settings( 'header-logobar-margin', '.header-logobar' );
	$briddge_styles->briddge_border_settings( 'header-logobar-border', '.header-logobar' ); 
	$briddge_styles->briddge_link_color( 'header-logobar-links-color', 'regular', '.header-logobar a' );
	$briddge_styles->briddge_link_color( 'header-logobar-links-color', 'hover', '.header-logobar a:hover' );
	$briddge_styles->briddge_link_color( 'header-logobar-links-color', 'active', '.header-logobar a:active' );

	//logobar on sticky style
	$briddge_styles->briddge_bg_settings( 'header-logobar-sticky-background', '.sticky-head.header-sticky .header-logobar' );
	$briddge_styles->briddge_link_color( 'header-logobar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-logobar a' );
	$briddge_styles->briddge_link_color( 'header-logobar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-logobar a:hover' );
	$briddge_styles->briddge_link_color( 'header-logobar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-logobar a:active' );
}

$navbar_style_chk = $briddge_styles->briddge_get_option('header-navbar-style-chk');
if( $navbar_style_chk == 'custom' ){
	//header navbar styles & link color
	$navbar_height = $briddge_styles->briddge_get_option('header-navbar-height');
	if( !empty( $navbar_height ) && isset( $navbar_height['height'] ) && !empty( $navbar_height['height'] ) ){
		echo '.header-navbar {';
			echo 'line-height: '. esc_attr( $navbar_height['height'] ) .'px;';
		echo '}';
	}
	
	$navbar_sticky_height = $briddge_styles->briddge_get_option('header-navbar-sticky-height');
	if( !empty( $navbar_sticky_height ) && isset( $navbar_sticky_height['height'] ) && !empty( $navbar_sticky_height['height'] ) ){
		echo '.header-sticky .header-navbar {';
			echo 'line-height: '. esc_attr( $navbar_sticky_height['height'] ) .'px;';
		echo '}';
	}
	
	$briddge_styles->briddge_bg_settings( 'header-navbar-background', '.header-navbar' );
	$briddge_styles->briddge_padding_settings( 'header-navbar-padding', '.header-navbar' );
	$briddge_styles->briddge_margin_settings( 'header-navbar-margin', '.header-navbar' );
	$briddge_styles->briddge_border_settings( 'header-navbar-border', '.header-navbar' );
	$briddge_styles->briddge_link_color( 'header-navbar-links-color', 'regular', '.header-navbar a' );
	$briddge_styles->briddge_link_color( 'header-navbar-links-color', 'hover', '.header-navbar a:hover' );
	$briddge_styles->briddge_link_color( 'header-navbar-links-color', 'active', '.header-navbar a:active' );

	//navbar on sticky style
	$briddge_styles->briddge_bg_settings( 'header-navbar-sticky-background', '.sticky-head.header-sticky .header-navbar' );
	$briddge_styles->briddge_link_color( 'header-navbar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-navbar a' );
	$briddge_styles->briddge_link_color( 'header-navbar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-navbar a:hover' );
	$briddge_styles->briddge_link_color( 'header-navbar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-navbar a:active' );

}

//Style end

$styles = ob_get_clean();
update_post_meta( $post_id, 'briddge_post_custom_styles', wp_slash( $styles ) );