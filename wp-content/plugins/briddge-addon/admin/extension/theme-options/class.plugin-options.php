<?php

/**
 * Briddge Theme Options
 * @since 1.0.0
 */
final class Briddge_Plugin_Options { //briddge_admin_menu_out
	
	private static $_instance = null;
	
	public function __construct() {	
		add_action( 'admin_menu', array( $this, 'briddge_addon_options_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'briddge_framework_admin_scripts' ) );
		$this->init();

		//import
		add_action( 'wp_ajax_bridddge-theme-option-import', array( $this, 'briddge_redux_themeopt_import' ) );

		//export
		add_action('wp_ajax_briddge-theme-options-export', array( $this, 'briddge_theme_options_export' ) );
		
	}
	
	public static function briddge_addon_options_menu(){
		add_submenu_page( 
			'briddge-welcome', 
			esc_html__( 'Theme Options', 'briddge-addon' ),
			esc_html__( 'Theme Options', 'briddge-addon' ), 
			'manage_options', 
			'briddge-options', 
			array( 'Briddge_Plugin_Options', 'briddge_options_admin_page' )
		);
	}
	
	public static function briddge_framework_admin_scripts(){
		if( isset( $_GET['page'] ) && $_GET['page'] == 'briddge-options' ){
			wp_enqueue_style( 'font-awesome', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/css/font-awesome.min.css', array(), '4.7.0', 'all' );			
			wp_enqueue_style( 'bootstrap-icons', BRIDDGE_URI . '/assets/css/bootstrap-icons.css', array(), '1.9.1', 'all' );
			
			wp_enqueue_media();
			wp_enqueue_style( 'briddge_theme_options_css', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/css/theme-options.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker-alpha', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/js/wp-color-picker-alpha.min.js', array( 'jquery', 'wp-color-picker' ), '3.0.0' );
			wp_enqueue_script( 'briddge_theme_options_js', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/js/theme-options.js', array( 'jquery' ), '1.0', true );

			wp_localize_script( 'briddge_theme_options_js', 'briddge_ajax_object',
				array(
					'import_nonce' => wp_create_nonce( 'briddge-import-*&^F&' ),
					'export_nonce' => wp_create_nonce( 'briddge-export-&^%$)' ),
				)
			);

			require_once BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/googlefonts.php';
			$google_fonts = Briddge_Google_Fonts_Function::$_google_fonts;
			$google_fonts_arr = json_decode( $google_fonts, true );
			
			$extra_gf = array(
				"Spartan" => array(
					"variants" => array(
						array( "id" => "400", "name" => "Thin 100" ),
						array( "id" => "400", "name" => "Extra-light 200" ),
						array( "id" => "400", "name" => "Light 300" ),
						array( "id" => "400", "name" => "Regular 400" ),
						array( "id" => "400", "name" => "Medium 500" ),
						array( "id" => "400", "name" => "Semi-bold 600" ),
						array( "id" => "400", "name" => "Bold 700" ),
						array( "id" => "400", "name" => "Extra-bold 800" ),
						array( "id" => "400", "name" => "Black 900" )
					)
				)
			);
			if( is_array( $extra_gf ) && !empty( $extra_gf ) ){
				foreach( $extra_gf as $font => $details ) $google_fonts_arr[$font] = $details;
			}
			
			$google_fonts = json_encode( $google_fonts_arr );
			$google_fonts_vars = array(
				'google_fonts' => $google_fonts,
				'standard_font_variants' => Briddge_Google_Fonts_Function::$_standard_font_variants,
				'font_variants_default' => esc_html__( 'Font Weight &amp; Style', 'briddge-addon' ),
				'font_sub_default' => esc_html__( 'Font Subsets', 'briddge-addon' )
			);
			wp_localize_script( 'briddge_theme_options_js', 'google_fonts_vars', $google_fonts_vars );
			
		}
	}
	
	public function init() {
		require_once( BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/framework.php' );
		Briddge_Options::$opt_name = 'briddge_options';
	}
	
	public static function briddge_check_zhf(){
		/**
		 * Detect plugin. For frontend only.
		 */
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		// check zozo header footer actived
		if ( is_plugin_active( 'zozo-header-footer/zozo-header-footer.php' ) ) { ?>
			<div class="briddge-header-bar zhf-bar">
				<div class="briddge-header-left">
					<div class="briddge-admin-logo-inline">
						<img src="<?php echo esc_url( ZOZO_HF_CORE_URL . '/assets/images/zozo-logo.png' ); ?>" alt="zozo-logo">
					</div><!-- .briddge-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Zozo Header Footer Builder', 'briddge-addon' ); ?></h2>
				</div><!-- .briddge-header-left -->
				<div class="briddge-header-right">
					<p><strong><?php esc_html_e( 'You can make custom header through this elementor builder here', 'briddge-addon' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span> </strong></p>
					<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=zozo-hf' ) ); ?>" class="button briddge-btn"><?php esc_html_e( 'Goto Settings', 'briddge-addon' ); ?></a>
				</div><!-- .briddge-header-right -->
			</div><!-- .briddge-header-bar -->
		<?php
		} 
	}
		
	public static function briddge_options_admin_page(){	
		$briddge_theme = wp_get_theme(); ?>	
		<form method="post" action="#" enctype="multipart/form-data" id="briddge-plugin-form-wrapper">
			<div class="briddge-settings-wrap">
			
				<div class="briddge-header-bar">
					<div class="briddge-header-left">
						<div class="briddge-admin-logo-inline">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="briddge-logo">
						</div><!-- .briddge-admin-logo-inline -->
						<h2 class="title"><?php esc_html_e( 'Briddge Options', 'briddge-addon' ); ?><span class="briddge-version"><?php echo esc_attr( $briddge_theme->get( 'Version' ) ); ?></span></h2>
					</div><!-- .briddge-header-left -->
					<div class="briddge-header-right">
						<button type="submit" class="button briddge-btn"><?php esc_html_e( 'Save Settings', 'briddge-addon' ); ?></button>
					</div><!-- .briddge-header-right -->
				</div><!-- .briddge-header-bar -->				
				
				<?php
					// check zhf installed
					self::briddge_check_zhf();				
				?>
				
				<div class="briddge-inner-wrap">
						
					<?php
						
						if ( isset( $_POST['save_briddge_theme_options'] ) && wp_verify_nonce( $_POST['save_briddge_theme_options'], 'briddge_theme_options*&^&*$' ) ) {
							update_option( 'briddge_options', $_POST['briddge_options'] );
							require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/theme-options-css.php' );
						}
						
						//Get updated theme option
						Briddge_Options::$briddge_options = get_option('briddge_options');
						
						if( class_exists( 'Classic_Elementor_Addon' ) ){
							add_action( 'briddge_custom_template_options', function(){
								require_once BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/cea-config.php';
							});
						}
						
						//Theme config
						require_once BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/config.php';
						
					?>
					
					<div class="briddge-admin-content-wrap">
						<?php wp_nonce_field( 'briddge_theme_options*&^&*$', 'save_briddge_theme_options' ); ?>
						<div class="briddge-tab">
							<div class="briddge-tab-list">
								<ul class="tablinks-list">
									<?php Briddge_Options::briddge_put_section(); ?>
								</ul>
							</div><!-- .briddge-tab-list -->
							<div class="briddge-tab-contents">
								<?php Briddge_Options::briddge_put_field(); ?>
							</div><!-- .briddge-tab-contents -->
						</div><!-- .briddge-tab -->							
					</div><!-- .briddge-admin-content-wrap -->					
				</div><!-- .briddge-inner-wrap -->
			</div><!-- .briddge-settings-wrap -->
		</form>	
	<?php
	}

	public static function briddge_theme_options_export(){
		$nonce = $_POST['nonce'];	
		if ( ! wp_verify_nonce( $nonce, 'briddge-export-&^%$)' ) )
			die ( esc_html__( 'Busted!', 'briddge-addon' ) );
		
		$briddge_options = get_option( 'briddge_options');
		$briddge_options = is_array( $briddge_options ) ? array_map( 'stripslashes_deep', $briddge_options ) : stripslashes( $briddge_options );
		echo json_encode( $briddge_options );
		
		exit;
	}

	public static function briddge_redux_themeopt_import(){
		$nonce = $_POST['nonce'];		  
		if ( ! wp_verify_nonce( $nonce, 'briddge-import-*&^F&' ) )
			die ( esc_html__( 'Busted', 'briddge-addon' ) );
		
		$json_data = isset( $_POST['json_data'] ) ? stripslashes( urldecode( $_POST['json_data'] ) ) : '';
		$theme_opt_arr = json_decode( $json_data, true );
		if( !empty( $theme_opt_arr ) ){
			update_option( 'briddge_options', $theme_opt_arr );
		}
		
		wp_die('success');
	}
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}

Briddge_Plugin_Options::instance();