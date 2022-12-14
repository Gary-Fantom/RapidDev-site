 <?php

/**
 * Briddge Theme Options CSS
 */

require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/class.options-style.php' );
$briddge_styles = new Briddge_Theme_Styles;

ob_start();

echo "\n/* Briddge Theme Options CSS */";

echo "\n/* General Styles */\n";

//site width
$site_width = $briddge_styles->briddge_dimension_settings( 'site-width', 'width' );
if( $site_width ){
	echo '@media (min-width: 1400px){
		.container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
			max-width: '. esc_attr( $site_width ) .';
		}
	}';
}

//primary color
$primary_color = $briddge_styles->briddge_get_option( 'primary-color' );
if( $primary_color ){
	echo '.primary-color, .theme-color, a:focus, a:hover, a:active {
		color: '. esc_attr( $primary_color ) .';
	}';
	echo '.primary-bg, .theme-bg {
		background-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.calendar_wrap th, tfoot td, ul.nav.wp-menu > li > a:before,.elementor-widget-container.feature-box-wrapper.feature-box-classic:after,  ul[id^="nv-primary-navigation"] li.button.button-primary > a, .menu li.button.button-primary > a, span.animate-bubble-box:after, span.animate-bubble-box:before, .owl-dots button.owl-dot, .team-style-classic-pro .team-social-wrap ul.social-icons > li > a,
.header-navbar.navbar .wp-menu li > ul.sub-menu li a:before,.pagination-single-inner > h6 > a span.arrow, ::selection,.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
		background-color: '. esc_attr( $primary_color ) .';
	}';
	echo '.theme-color-bg, .icon-theme-color-bg, .flip-box-wrapper:hover .icon-theme-hcolor-bg, .contact-info-style-classic-pro .contact-info-title, .contact-info-wrapper.contact-info-style-classic:before, .testimonial-wrapper.testimonial-style-modern .testimonial-inner:after, .isotope-filter ul.nav li.active a:after, .isotope-filter ul.nav li a:after, .blog-wrapper.blog-style-modern .blog-inner .top-meta .post-category, .blog-wrapper .post-overlay-items .post-date a, .event-style-classic .top-meta .post-date, .blog-layouts-wrapper .post-overlay-items .post-date a, .portfolio-content-wrap .portfolio-title h3, .custom-post-nav  a,
	.service-style-classic .entry-title:after,.service-style-classic .entry-title:before,.team-style-default .team-inner .post-overlay-items > .team-social-wrap > ul,
.team-style-default .team-inner:hover .post-overlay-items > .team-social-wrap,.back-to-top:after,
.portfolio-style-classic .post-thumb.post-overlay-active:after, .elementor-widget-container.feature-box-wrapper.feature-box-classic:after, h2.we-stand__top-title, aside.footer-widget-2 h5:after,.content-widgets-wrapper .widget_categories ul li a:before, .content-widgets-wrapper .widget_archive ul li a:before {
		background-color: '. esc_attr( $primary_color ) .' !important;
	}';
	echo '.testimonial-style-list .testimonial-inner:after,
.single-cea-team span.team-designation,.team-details-icon,ul.nav.post-meta > li span,
.comment-metadata time, .comments-wrap span:before, .comment-body .reply a.comment-reply-link, p.wp-block-tag-cloud a.tag-cloud-link,.blog .briddge-masonry .post-meta .post-more a, .widget.widget_nav_menu li a:before, .briddge-masonry > article .top-meta-wrap a, h2.entry-title a:hover {
		color: '. esc_attr( $primary_color ) .';
	}';
	echo 'blockquote,
.wp-block-quote.is-large, .wp-block-quote.is-style-large, .wp-block-quote.is-style-large:not(.is-style-plain),.wp-block-quote.has-text-align-right, .wp-block-quote {
		border-color: '. esc_attr( $primary_color ) .';
	}';	
	
}

//secondary color
$secondary_color = $briddge_styles->briddge_get_option( 'secondary-color' );
if( $secondary_color ){
	echo '.secondary-color {
		color: '. esc_attr( $secondary_color ) .';
	}';
	echo '.secondary-bg {
		background-color: '. esc_attr( $secondary_color ) .';
	}';
	echo '.full-search-wrapper .search-form .input-group .btn:hover,
.close:hover,.team-style-classic-pro .team-social-wrap ul.social-icons > li > a:hover,
header a.btn.btn-primary:hover, .search-form .input-group .btn:hover, .full-search-wrapper {
		background-color: '. esc_attr( $secondary_color ) .';
	}';
	echo '.custom-post-nav a:hover {
		background-color: '. esc_attr( $secondary_color ) .' !important;
	}';	
}


echo '.briddge-page-header::before {
     background-image: url('. esc_url( get_template_directory_uri() . '/assets/images/inner-bannerwave.png' ) .'); 
	 
}';

//body background if boxed
$briddge_styles->briddge_bg_settings( 'site-bg', 'body' );

//button color keys -> fore, bg, border, hfore, hbg, hborder
echo '.btn, button, .post-category a, .back-to-top,.header-navbar a.btn.btn-primary, .widget_search .search-form .input-group .btn,button.wp-block-search__button,.btn.bordered:hover,.close,
button.wp-block-search__button,ul.nav.pagination.post-pagination > li > span,.comment-respond input[type="submit"],.wp-block-button__link,input[type="submit"],nav.post-nav-links .post-page-numbers,.button.button-primary, input[type=button], input[type="submit"], header .mini-cart-dropdown ul.cart-dropdown-menu > li.mini-view-cart a {';
	$briddge_styles->briddge_button_color( 'button-color', 'fore' );
	$briddge_styles->briddge_button_color( 'button-color', 'bg' );
	$briddge_styles->briddge_button_color( 'button-color', 'border' );
echo '}';
echo '.btn:hover, button:hover, .post-category a:hover, .back-to-top:hover, .header-navbar a.btn.btn-primary:hover, .widget_search .search-form .input-group .btn:hover, button.wp-block-search__button:hover, .btn:focus, button:focus, .post-category a:focus, .back-to-top:focus,.header-navbar a.btn.btn-primary:focus, .widget_search .search-form .input-group .btn:focus, button.wp-block-search__button:focus, .btn:active, button:active, .post-category a:active, .back-to-top:active,.header-navbar a.btn.btn-primary:active, .widget_search .search-form .input-group .btn:active, button.wp-block-search__button:active,.contact-form-wrapper input.wpcf7-form-control.wpcf7-submit:hover, input[type="submit"]:hover, header .mini-cart-dropdown ul.cart-dropdown-menu > li.mini-view-cart a:hover,nav.post-nav-links .post-page-numbers:hover, .wp-block-button__link:hover,.wp-block-button.is-style-outline a.wp-block-button__link:hover, .pagination-single-inner > h6 > a span.arrow:hover, nav.post-nav-links .post-page-numbers.current,ul.nav.pagination.post-pagination > li > a:hover {';
	$briddge_styles->briddge_button_color( 'button-color', 'hfore' );
	$briddge_styles->briddge_button_color( 'button-color', 'hbg' ) ;
	$briddge_styles->briddge_button_color( 'button-color', 'hborder' );
echo '}';

//site link color
$briddge_styles->briddge_link_color( 'link-color', 'regular', '.header-topbar a' );
$briddge_styles->briddge_link_color( 'link-color', 'hover', '.header-topbar a:hover' );
$briddge_styles->briddge_link_color( 'link-color', 'active', '.header-topbar a:active, .header-topbar a:focus' );

//site padding
$briddge_styles->briddge_padding_settings( 'site-padding', '.briddge-content-wrap' );

//mobile header style
$mobilebar_from = $briddge_styles->briddge_get_option( 'mobilebar-responsive' );
$mobilebar_from = $mobilebar_from ? absint( $mobilebar_from ) : 767;
echo '@media only screen and ( max-width: '. esc_attr( $mobilebar_from ) .'px ) {';
	echo '.header-mobilebar { display: flex; }';
	echo '.site-header { display: none; }';
echo '}';
echo '@media only screen and ( min-width: '. esc_attr( $mobilebar_from + 1 ) .'px ) {';
	echo '.site-header { display: block; }';
	echo '.header-mobilebar { display: none; }';
echo '}';

//page loader
$page_loader = $briddge_styles->briddge_image_settings('page_loader');
if( isset( $page_loader['url'] ) && !empty( $page_loader['url'] ) ){
	echo '.page-loader { background-image: url('. esc_url( $page_loader['url']  ) .'); }';
}

//body typo styles
$briddge_styles->briddge_typo_settings( 'content-typography', 'body' );

//lead typo styles
$briddge_styles->briddge_typo_settings( 'lead-typography', '.lead' );

//h1 typo styles
$briddge_styles->briddge_typo_settings( 'h1-typography', 'h1, .h1' );

//h2 typo styles
$briddge_styles->briddge_typo_settings( 'h2-typography', 'h2, .h2' );

//h3 typo styles
$briddge_styles->briddge_typo_settings( 'h3-typography', 'h3, .h3' );

//h4 typo styles
$briddge_styles->briddge_typo_settings( 'h4-typography', 'h4, .h4' );

//h5 typo styles
$briddge_styles->briddge_typo_settings( 'h5-typography', 'h5, .h5' );

//h6 typo styles
$briddge_styles->briddge_typo_settings( 'h6-typography', 'h6, .h6' );

//header typo styles & link color
$briddge_styles->briddge_typo_settings( 'header-typography', '.site-header' );
$briddge_styles->briddge_link_color( 'header-links-color', 'regular', '.site-header a' );
$briddge_styles->briddge_link_color( 'header-links-color', 'hover', '.site-header a:hover' );
$briddge_styles->briddge_link_color( 'header-links-color', 'active', '.site-header a:active' );
$briddge_styles->briddge_bg_settings( 'header-background', '.site-header' );
$briddge_styles->briddge_padding_settings( 'header-padding', '.site-header' );
$briddge_styles->briddge_margin_settings( 'header-margin', '.site-header' );
$briddge_styles->briddge_border_settings( 'header-border', '.site-header' );

//dropdown style
$briddge_styles->briddge_bg_settings( 'dropdown-background', '.primary-menu .menu-item-has-children ul.sub-menu' );
$briddge_styles->briddge_link_color( 'dropdown-links-color', 'regular', '.primary-menu .menu-item-has-children ul.sub-menu li a' );
$briddge_styles->briddge_link_color( 'dropdown-links-color', 'hover', '.primary-menu .menu-item-has-children ul.sub-menu li a:hover' );
$briddge_styles->briddge_link_color( 'dropdown-links-color', 'active', '.primary-menu .menu-item-has-children ul.sub-menu li a:active, .primary-menu-wrapper li  ul.sub-menu li.current-menu-item  a' );



//dropdown on sticky style
$briddge_styles->briddge_bg_settings( 'dropdown-sticky-background', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li' );
$briddge_styles->briddge_link_color( 'dropdown-sticky-links-color', 'regular', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li a' );
$briddge_styles->briddge_link_color( 'dropdown-sticky-links-color', 'hover', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li a:hover' );
$briddge_styles->briddge_link_color( 'dropdown-sticky-links-color', 'active', '.sticky-head.header-sticky .primary-menu .menu-item-has-children ul.sub-menu li a:active' );

//header topbar typo styles
$briddge_styles->briddge_typo_settings( 'header-topbar-typography', '.header-topbar' );

//header topbar styles & link color
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

//header logobar typo styles
$briddge_styles->briddge_typo_settings( 'header-logobar-typography', '.header-logobar' );

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

//header navbar typo styles
$briddge_styles->briddge_typo_settings( 'header-navbar-typography', '.header-navbar' );

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
$briddge_styles->briddge_link_color( 'header-navbar-links-color', 'active', '.header-navbar a:active, .primary-menu-wrapper li.current-menu-parent.current_page_parent > a' );

//navbar on sticky style
$briddge_styles->briddge_bg_settings( 'header-navbar-sticky-background', '.sticky-head.header-sticky .header-navbar' );
$briddge_styles->briddge_link_color( 'header-navbar-sticky-links-color', 'regular', '.sticky-head.header-sticky .header-navbar a' );
$briddge_styles->briddge_link_color( 'header-navbar-sticky-links-color', 'hover', '.sticky-head.header-sticky .header-navbar a:hover' );
$briddge_styles->briddge_link_color( 'header-navbar-sticky-links-color', 'active', '.sticky-head.header-sticky .header-navbar a:active,.sticky-head.header-sticky .primary-menu-wrapper li.current-menu-parent.current_page_parent > a' );

//logo styles
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


//blog page title settings
$briddge_styles->briddge_color( 'blog-title-color', '.blog .page-title-wrap .page-title, .blog .page-title-wrap .breadcrumb li' );
$briddge_styles->briddge_color( 'blog-title-desc-color', '.blog .page-title-wrap .page-subtitle' );
$briddge_styles->briddge_link_color( 'blog-title-link-color', 'regular', '.blog .page-title-wrap .breadcrumb a' );
$briddge_styles->briddge_link_color( 'blog-title-link-color', 'hover', '.blog .page-title-wrap .breadcrumb a:hover' );
$briddge_styles->briddge_link_color( 'blog-title-link-color', 'active', '.blog .page-title-wrap .breadcrumb a:active' );
$briddge_styles->briddge_bg_settings( 'blog-title-bg', '.blog .briddge-page-header' );
$briddge_styles->briddge_padding_settings( 'blog-title-padding', '.blog .page-title-wrap' );

//archive page title settings
$briddge_styles->briddge_color( 'archive-title-color', '.archive .page-title-wrap .page-title, .archive .page-title-wrap .breadcrumb li, .search .page-title-wrap .page-title, .search .page-title-wrap .breadcrumb li' );
$briddge_styles->briddge_color( 'archive-title-desc-color', '.archive .page-title-wrap .page-subtitle, .search .page-title-wrap .page-subtitle' );
$briddge_styles->briddge_link_color( 'archive-title-link-color', 'regular', '.archive .page-title-wrap .breadcrumb a, .search .page-title-wrap .breadcrumb a' );
$briddge_styles->briddge_link_color( 'archive-title-link-color', 'hover', '.archive .page-title-wrap .breadcrumb a:hover, .search .page-title-wrap .breadcrumb a:hover' );
$briddge_styles->briddge_link_color( 'archive-title-link-color', 'active', '.archive .page-title-wrap .breadcrumb a:active, .search .page-title-wrap .breadcrumb a:active' );
$briddge_styles->briddge_bg_settings( 'archive-title-bg', '.archive .briddge-page-header, .search .briddge-page-header' );
$briddge_styles->briddge_padding_settings( 'archive-title-padding', '.archive .page-title-wrap, .search .page-title-wrap' );

//single post page title settings
$briddge_styles->briddge_color( 'single-title-color', '.single .page-title-wrap .page-title, .single .page-title-wrap .breadcrumb li' );
$briddge_styles->briddge_color( 'single-title-desc-color', '.single .page-title-wrap .page-subtitle' );
$briddge_styles->briddge_link_color( 'single-title-link-color', 'regular', '.single .page-title-wrap .breadcrumb a' );
$briddge_styles->briddge_link_color( 'single-title-link-color', 'hover', '.single .page-title-wrap .breadcrumb a:hover' );
$briddge_styles->briddge_link_color( 'single-title-link-color', 'active', '.single .page-title-wrap .breadcrumb a:active' );
$briddge_styles->briddge_bg_settings( 'single-title-bg', '.single .briddge-page-header' );
$briddge_styles->briddge_padding_settings( 'single-title-padding', '.single .page-title-wrap' );

//page title settings
$briddge_styles->briddge_color( 'page-title-color', '.page .page-title-wrap .page-title, .page .page-title-wrap .breadcrumb li, .error404 .page-title-wrap .page-title, .error404 .page-title-wrap .breadcrumb li' );
$briddge_styles->briddge_color( 'page-title-desc-color', '.page .page-title-wrap .page-subtitle, .error404 .page-title-wrap .page-subtitle' );
$briddge_styles->briddge_link_color( 'page-title-link-color', 'regular', '.page .page-title-wrap .breadcrumb a, .error404 .page-title-wrap .breadcrumb a' );
$briddge_styles->briddge_link_color( 'page-title-link-color', 'hover', '.page .page-title-wrap .breadcrumb a:hover, .error404 .page-title-wrap .breadcrumb a:hover' );
$briddge_styles->briddge_link_color( 'page-title-link-color', 'active', '.page .page-title-wrap .breadcrumb a:active, .error404 .page-title-wrap .breadcrumb a:active' );
$briddge_styles->briddge_bg_settings( 'page-title-bg', '.page .briddge-page-header, .error404 .briddge-page-header' );
$briddge_styles->briddge_padding_settings( 'page-title-padding', '.page .page-title-wrap, .error404 .page-title-wrap' );

//footer styles and link color
$briddge_styles->briddge_typo_settings( 'footer-typography', '.site-footer' );
$briddge_styles->briddge_bg_settings( 'footer-background', '.site-footer' );
$briddge_styles->briddge_padding_settings( 'footer-padding', '.site-footer' );
$briddge_styles->briddge_margin_settings( 'footer-margin', '.site-footer' );
$briddge_styles->briddge_border_settings( 'footer-border', '.site-footer' );
$briddge_styles->briddge_link_color( 'footer-links-color', 'regular', '.site-footer a' );
$briddge_styles->briddge_link_color( 'footer-links-color', 'hover', '.site-footer a:hover' );
$briddge_styles->briddge_link_color( 'footer-links-color', 'active', '.site-footer a:active' );

//footer top styles and link color
$briddge_styles->briddge_typo_settings( 'insta-footer-typography', '.insta-footer-wrap' );
$briddge_styles->briddge_bg_settings( 'insta-footer-background', '.insta-footer-wrap' );
$briddge_styles->briddge_padding_settings( 'insta-footer-padding', '.insta-footer-wrap' );
$briddge_styles->briddge_margin_settings( 'insta-footer-margin', '.insta-footer-wrap' );
$briddge_styles->briddge_border_settings( 'insta-footer-border', '.insta-footer-wrap' );
$briddge_styles->briddge_link_color( 'insta-footer-links-color', 'regular', '.insta-footer-wrap a' );
$briddge_styles->briddge_link_color( 'insta-footer-links-color', 'hover', '.insta-footer-wrap a:hover' );
$briddge_styles->briddge_link_color( 'insta-footer-links-color', 'active', '.insta-footer-wrap a:active' );

//footer widgets part styles and link color
$briddge_styles->briddge_typo_settings( 'footer-widgets-typography', '.footer-widgets-wrap' );
$briddge_styles->briddge_bg_settings( 'footer-widgets-background', '.footer-widgets-wrap' );
$briddge_styles->briddge_padding_settings( 'footer-widgets-padding', '.footer-widgets-wrap' );
$briddge_styles->briddge_margin_settings( 'footer-widgets-margin', '.footer-widgets-wrap' );
$briddge_styles->briddge_border_settings( 'footer-widgets-border', '.footer-widgets-wrap' );
$briddge_styles->briddge_link_color( 'footer-widgets-links-color', 'regular', '.footer-widgets-wrap a' );
$briddge_styles->briddge_link_color( 'footer-widgets-links-color', 'hover', '.footer-widgets-wrap a:hover' );
$briddge_styles->briddge_link_color( 'footer-widgets-links-color', 'active', '.footer-widgets-wrap a:active' );

//footer bottom styles and link color
$briddge_styles->briddge_typo_settings( 'copyright-section-typography', '.footer-bottom-wrap' );
$briddge_styles->briddge_bg_settings( 'copyright-section-background', '.footer-bottom-wrap' );
$briddge_styles->briddge_padding_settings( 'copyright-section-padding', '.footer-bottom-wrap' );
$briddge_styles->briddge_margin_settings( 'copyright-section-margin', '.footer-bottom-wrap' );
$briddge_styles->briddge_border_settings( 'copyright-section-border', '.footer-bottom-wrap' );
$briddge_styles->briddge_link_color( 'copyright-section-links-color', 'regular', '.footer-bottom-wrap a' );
$briddge_styles->briddge_link_color( 'copyright-section-links-color', 'hover', '.footer-bottom-wrap a:hover' );
$briddge_styles->briddge_link_color( 'copyright-section-links-color', 'active', '.footer-bottom-wrap a:active' );

//secondary bar styles
if( $primary_color && $secondary_color ){
	echo '.secondary-bar-wrapper { background: linear-gradient(90deg, '. esc_attr( $primary_color ) .' 0%, '. esc_attr( $secondary_color ) .' 100%); }';
	
	
	echo '.page-load-initiate .page-loader:before, .page-load-end .page-loader:before, .page-load-initiate .page-loader:after, .page-load-end .page-loader:after { 
		background: linear-gradient(90deg, '. esc_attr( $primary_color ) .' 0%, '. esc_attr( $secondary_color ) .' 100%);
		background: -webkit-gradient(linear, left top, right top, from('. esc_attr( $secondary_color ) .'), to('. esc_attr( $primary_color ) .'));
		background: -webkit-linear-gradient(left, '. esc_attr( $secondary_color ) .' 0%, '. esc_attr( $primary_color ) .' 100%);
		background: -o-linear-gradient(left, '. esc_attr( $secondary_color ) .' 0%, '. esc_attr( $primary_color ) .' 100%);
		background: linear-gradient(to right, '. esc_attr( $secondary_color ) .' 0%, '. esc_attr( $primary_color ) .' 100%);
	}';
}
$secondary_sidebar_width = $briddge_styles->briddge_dimension_settings( 'secondary-sidebar-width', 'width' );
if( $secondary_sidebar_width ){
	echo '.secondary-bar-inner {
		width: '. esc_attr( $secondary_sidebar_width ) .';
	}';
	echo '.secondary-bar-wrapper.from-left .secondary-bar-inner {
		left: -'. esc_attr( $secondary_sidebar_width ) .';
	}';
	echo '.secondary-bar-wrapper.from-right .secondary-bar-inner {
		right: -'. esc_attr( $secondary_sidebar_width ) .';
	}';
}

//End style

$styles = ob_get_clean();

$gf_arr = Briddge_Theme_Styles::$briddge_gf_array;
update_option( 'briddge_google_fonts_list', $gf_arr );
update_option( 'briddge_custom_styles', wp_slash( $styles ) );