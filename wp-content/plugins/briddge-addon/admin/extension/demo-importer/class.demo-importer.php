<?php 

class Briddge_Demo_Importer {
	
	private static $_instance = null;
	
	public static $ins_demo_stat;
	
	public static $ins_demo_id;

	public function __construct() {
		
		$this->set_installed_demo_details();
		
		add_action( 'admin_menu', array( $this, 'briddge_addon_admin_menu' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'briddge_enqueue_admin_script' ) );
		
	}
	
	public static function briddge_addon_admin_menu(){
		add_submenu_page( 
			'briddge-welcome', 
			esc_html__( 'Demo Importer', 'briddge-addon' ),
			esc_html__( 'Demo Importer', 'briddge-addon' ), 
			'manage_options', 
			'briddge-importer', 
			array( 'Briddge_Demo_Importer', 'briddge_demo_import_admin_page' )
		);
	}
	
	private function set_installed_demo_details(){
		self::$ins_demo_stat = get_theme_mod( 'briddge_demo_installed' );
		self::$ins_demo_id = get_theme_mod( 'briddge_installed_demo_id' );
	}
	
	public function briddge_enqueue_admin_script(){
		
		if( isset( $_GET['page'] ) && $_GET['page'] == 'briddge-importer' ){
		
			wp_enqueue_style( 'briddge-confirm', BRIDDGE_ADDON_URL . 'admin/extension/demo-importer/assets/css/jquery-confirm.min.css' );
			wp_enqueue_script( 'briddge-confirm', BRIDDGE_ADDON_URL . 'admin/extension/demo-importer/assets/js/jquery-confirm.min.js', array( 'jquery' ), '1.0', true ); 
			
			wp_enqueue_script( 'briddge-import-scripts', BRIDDGE_ADDON_URL . 'admin/extension/demo-importer/assets/js/demo-import.js', array( 'jquery' ), '1.7.5', true ); 
			
			//Import Localize Script
			$demo_import_args = array(
				'admin_ajax_url' => esc_url( admin_url('admin-ajax.php') ),
				'nonce' => wp_create_nonce('briddge-options-import'),		
				'proceed' => esc_html__('Proceed', 'briddge'),
				'cancel' => esc_html__('Cancel', 'briddge'),
				'process' => esc_html__( 'Processing', 'briddge-addon' ),
				'uninstalling' => esc_html__('Uninstalling...', 'briddge'),
				'uninstalled' => esc_html__('Uninstalled.', 'briddge'),
				'unins_pbm' => esc_html__('Uninstall Problem!.', 'briddge'),
				'downloading' => esc_html__('Demo import process running...', 'briddge'), 
				'briddge_import_url' => admin_url( 'admin.php?page=briddge-importer' ),
				'regenerate_thumbnails_url' => admin_url( 'plugin-install.php?tab=plugin-information&plugin=regenerate-thumbnails' )				
			);
			$demo_import_args = apply_filters( 'briddge_demo_import_args', $demo_import_args );
			wp_localize_script( 'briddge-import-scripts', 'briddge_admin_ajax_var', $demo_import_args );
		}
		
	}
	
	public static function briddge_demo_div_generater( $demo_array ){
		
		$ins_demo_stat = self::$ins_demo_stat;
		$ins_demo_id = self::$ins_demo_id;
		
		$demo_class = '';
		if( $ins_demo_stat == 1 ){
			if( $ins_demo_id == $demo_array['demo_id'] ){
				$demo_class .= ' demo-actived';
			}else{
				$demo_class .= ' demo-inactive';
			}
		}else{
			$demo_class .= ' demo-active';
		}
	
		$revslider = isset( $demo_array['revslider'] ) && $demo_array['revslider'] != '' ? $demo_array['revslider'] : '';
		$media_parts = isset( $demo_array['media_parts'] ) && $demo_array['media_parts'] != '' ? $demo_array['media_parts'] : '';
		
		?>
		
		
		<div class="admin-box demo-wrap">
			<div class="install-plugin-wrap theme zozothemes-demo-item<?php echo esc_attr( $demo_class ); ?>">
				<div class="install-plugin-inner">
				
					<div class="zozo-demo-import-loader zozo-preview-<?php echo esc_attr( $demo_array['demo_id'] ); ?>"><i class="dashicons dashicons-admin-generic"></i></div>
					
					<div class="installation-progress">
						<span class="progress-text"></span>
						<div class="progress">
							<div class="progress-bar" style="width:0%"></div>
						</div>
					</div>
				
					<div class="theme-screenshot zozotheme-screenshot">
						<a href="<?php echo esc_url( $demo_array['demo_url'] ); ?>" target="_blank"><img src="<?php echo esc_url( BRIDDGE_ADDON_URL . 'admin/extension/demo-importer/assets/images/demo/' . $demo_array['demo_img'] ); ?>" class="demo-img" /></a>
					</div>
					<div class="install-plugin-right">
						<div class="install-plugin-right-inner">
							<h3 class="theme-name" id="<?php echo esc_attr( $demo_array['demo_id'] ); ?>"><?php echo esc_attr( $demo_array['demo_name'] ); ?></h3>
							
							<a href="#" class="theme-demo-install-custom"><?php esc_html_e( "Custom Choice", "briddge" ); ?></a>
							
							<div class="theme-demo-install-parts" id="<?php echo esc_attr( 'demo-install-parts-'. $demo_array['demo_id'] ); ?>">
							
								<div class="demo-install-instructions">
									<ul class="install-instructions">
										<li><strong><?php esc_html_e( "General", "briddge" ); ?></strong></li>
										<li><?php esc_html_e( 'Choose "Media" -> All the media\'s are ready to be import.', "briddge" ); ?></li>
										<li><?php esc_html_e( 'Choose "Theme Options" -> Theme options are ready to be import.', "briddge" ); ?></li>
										<li><?php esc_html_e( 'Choose "Widgets" -> Custom sidebars and widgets are ready to be import.', "briddge" ); ?></li>
										<?php if( $revslider ) : ?>
										<li><?php esc_html_e( 'Choose "Revolution Sliders" -> Revolution slides are ready to be import.', "briddge" ); ?></li>
										<?php endif; ?>
										<li><?php esc_html_e( 'Choose "All Posts" -> Posts, menus, custom post types are ready to be import.', "briddge" ); ?></li>
										<li><p class="lead"><strong>*</strong><?php esc_html_e( 'If you check "All Posts" and Uncheck any of page, then menu will not imported.', "briddge" ); ?></p></li>
										
										<li><strong><?php esc_html_e( "Pages", "briddge" ); ?></strong></li>
										<li><?php esc_html_e( 'Choose pages which you want to show on your site. If you choose all the pages and check "All Post" menu will be import. If any one will not check even page or All posts, then menu will not import.', "briddge" ); ?></li>
									</ul>
								</div>
							
								<div class="zozo-col-3">
									<h5><?php esc_html_e( "General", "briddge" ); ?></h5>
									<?php
									if( isset( $demo_array['general'] )	 ){
										echo '<ul class="general-install-parts-list">';
										foreach( $demo_array['general'] as $key => $value ){
											echo '<li><input type="checkbox" value="'. esc_attr( $key ) .'" data-text="'. esc_attr( $value ) .'" /> '. esc_html( $value ) .'</li>';
										}
										echo '</ul>';
									}						
									?>
								</div><!-- .zozo-col-3 -->
								<div class="zozo-col-3">
									<h5><?php esc_html_e( "Pages", "briddge" ); ?></h5>
									<?php
									if( isset( $demo_array['pages'] )	 ){
										echo '<ul class="page-install-parts-list">';
										foreach( $demo_array['pages'] as $key => $value ){
											echo '<li><input type="checkbox" value="'. esc_attr( $key ) .'" data-text="'. esc_attr( $value ) .'" /> '. esc_html( $value ) .'</li>';
										}
										echo '</ul>';
									}						
									?>
								</div><!-- .zozo-col-3 -->
								<a href="#" class="theme-demo-install-checkall"><?php esc_html_e( "Check/Uncheck All", "briddge" ); ?></a>
								<p><?php esc_html_e( "Leave empty/uncheck all to full install.", "briddge" ); ?></p>
							</div><!-- .theme-demo-install-parts -->
							<div class="theme-actions theme-buttons">
								<a class="button button-primary button-install-demo" data-demo-id="<?php echo esc_attr( $demo_array['demo_id'] ); ?>" data-revslider="<?php echo esc_attr( $revslider ); ?>" data-media="<?php echo esc_attr( $media_parts ); ?>" href="#">
								<?php esc_html_e( "Import", "briddge" ); ?>
								</a>
								<a class="button button-primary button-uninstall-demo" data-demo-id="<?php echo esc_attr( $demo_array['demo_id'] ); ?>" href="#">
								<?php esc_html_e( "Uninstall", "briddge" ); ?>
								</a>
								<a class="button button-primary" target="_blank" href="<?php echo esc_url( $demo_array['demo_url'] ); ?>">
								<?php esc_html_e( "Preview", "briddge" ); ?>
								</a>
							</div>
							
						</div><!-- .install-plugin-right-inner -->
					</div><!-- .install-plugin-right -->
				</div>
			</div><!-- .admin-box -->
		<?php
	}
	
	public static function briddge_demo_import_admin_page(){
		$briddge_theme = wp_get_theme();
	?>
		<div class="briddge-settings-wrap">
		
			<?php wp_nonce_field( 'briddge_demo_import_*&^^$#(*', 'briddge_demo_import_nonce' ); ?>
		
			<div class="briddge-header-bar">
				<div class="briddge-header-left">
					<div class="briddge-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="briddge-logo">
					</div><!-- .briddge-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Briddge Demo Importer', 'briddge-addon' ); ?></h2>
				</div><!-- .briddge-header-left -->
				<div class="briddge-header-right">
					<a href="<?php echo esc_url( 'https://wordpress.zozothemes.com/briddge/' ); ?>" class="button briddge-btn"><?php esc_html_e( 'Live Demo', 'briddge-addon' ); ?></a>
				</div><!-- .briddge-header-right -->
			</div><!-- .briddge-header-bar -->
			
			<div class="briddge-settings-tabs briddge-demo-import-wrap">
				<div id="briddge-general" class="briddge-settings-tab active">
					<div class="container">
						<div class="row">
							<div class="col-6">							
							<?php
								
								//Demo Classic
								$demo_array = array(
									'demo_id' 	=> 'demo',
									'demo_name' => esc_html__( 'Briddge Main Demo', 'briddge-addon' ),
									'demo_img'	=> 'demo-1.jpg',
									'demo_url'	=> 'http://wordpress.zozothemes.com/briddge/',
									'revslider'	=> '1',
									'media_parts'	=> '21',
									'general'	=> array(
										'media' 		=> esc_html__( "Media", "briddge" ),
										'theme-options' => esc_html__( "Theme Options", "briddge" ),
										'widgets' 		=> esc_html__( "Widgets", "briddge" ),
										'revslider' 	=> esc_html__( "Revolution Sliders", "briddge" ),
										'post' 			=> esc_html__( "All Posts", "briddge" )
									),
									'pages'=> array(
										'1'		=> esc_html__( "home", "briddge" ),
										'2'	=> esc_html__( "Contact", "briddge" ),						
										'3'	=> esc_html__( "about us", "briddge" ),
										'4'	=> esc_html__( "About  Us", "briddge" ),
										'5'	=> esc_html__( "Pricing", "briddge" ),
										'6'	=> esc_html__( "Frequently asked question", "briddge" ),
										'7'	=> esc_html__( "Our Team", "briddge" ),
										'8'	=> esc_html__( "Blog", "briddge" ),
										'9'	=> esc_html__( "Blog Grid", "briddge" ),
										'10'	=> esc_html__( "Blog List", "briddge" ),
										'11' 	=> esc_html__( "Services 2", "briddge" ),
										'12'		=> esc_html__( "Testimonials", "briddge" ),
										'13' 	=> esc_html__( "Portfolio", "briddge" ),
										'14' 	=> esc_html__( "Career", "briddge" ),
										'15'		=> esc_html__( "Portfolio No Gutter", "briddge" ),
										'16' 	=> esc_html__( "Portfolio Slider", "briddge" ),
										'17'		=> esc_html__( "Coming Soon", "briddge" ),
										'18' 	=> esc_html__( "Home 3", "briddge" ),
										'19' 	=> esc_html__( "Home 2", "briddge" ),
										'20'	=> esc_html__( "Landing Page", "briddge" ),						
										'21'	=> esc_html__( "Home", "briddge" ),
										'22'	=> esc_html__( "Who We Are", "briddge" ),
										'23'	=> esc_html__( "2 Columns", "briddge" ),
										'24'	=> esc_html__( "2 Columns + Sidebar", "briddge" )	,
										'25'	=> esc_html__( "3 Columns", "briddge" )	,
										'26'	=> esc_html__( "4 Columns Fullwidth", "briddge" )	,
										'27'	=> esc_html__( "Sample Page", "briddge" )	,
										'28'	=> esc_html__( "Shop", "briddge" )	,
										'29'	=> esc_html__( "Cart", "briddge" )	,
										'30'	=> esc_html__( "Checkout", "briddge" )	,
										'31'	=> esc_html__( "My account", "briddge" )	,
										'32'	=> esc_html__( "Services 3", "briddge" ) ,
										'33'	=> esc_html__( "Refund and Returns Policy", "briddge" )	,
										'34'	=> esc_html__( "Portfolio 2 Columns", "briddge" )	,
										'35'	=> esc_html__( "Portfolio 3 Columns", "briddge" )	,
										'36'	=> esc_html__( "PPortfolio 4 Columns Wide", "briddge" )	,
										'37'	=> esc_html__( "Portfolio Masonry", "briddge" )	,
										'38'	=> esc_html__( "Portfolio Masonry Classic", "briddge" )	,
										'39'	=> esc_html__( "Portfolio Masonry Modern", "briddge" )	,
										'40'	=> esc_html__( "PPortfolio Masonry Classic Pro", "briddge" )	,
										'41'	=> esc_html__( "Privacy Policy", "briddge" )	,
										'42'	=> esc_html__( "Sample Page", "briddge" )	,
										'43'	=> esc_html__( "Shop", "briddge" )	,
										'44'	=> esc_html__( "Cart", "briddge" )	,
										'45'	=> esc_html__( "Checkout", "briddge" )	,
										'46'	=> esc_html__( "My account", "briddge" )											
									)
									
								);
								self::briddge_demo_div_generater( $demo_array );								
							?>
							
								<div class="theme-requirements" data-requirements="<?php 
									printf( '<h2>%1$s</h2> <p>%2$s</p> <h3>%3$s</h3> <ol><li>%4$s</li></ol>', 
										esc_html__( 'WARNING:', 'briddge-addon' ), 
										esc_html__( 'Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.', 'briddge-addon' ),
										esc_html__( 'DEMO REQUIREMENTS:', 'briddge-addon' ),
										esc_html__( 'Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.', 'briddge-addon' )
									);
								?>">
								</div>							
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<?php
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Briddge_Demo_Importer::get_instance();

/* Demo Import AJAX */
if( ! function_exists('briddge_demo_import_fun') ) {
    function briddge_demo_import_fun() {
		
		if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'briddge_demo_import_*&^^$#(*' ) ) {
			echo "!security issue";
			wp_die(); 
		}
		
		$process = isset( $_POST['process'] ) ? $_POST['process'] : '';
		
		if( $process ){
			
			include BRIDDGE_ADDON_DIR . 'admin/extension/demo-importer/zozo-importer.php';
			
			if( $process == 'permission' ){
				briddgeZozoImporterModule::briddge_check_file_access_permission();
			}elseif( $process == 'general_download' ){
				briddgeZozoImporterModule::briddge_general_file_ajax();
			}elseif( $process == 'xml_download' ){
				briddgeZozoImporterModule::briddge_xml_file_ajax();
			}elseif( $process == 'general_install' ){
				briddgeZozoImporterModule::briddge_general_file_install_ajax();
			}elseif( $process == 'xml_install' ){
				briddgeZozoImporterModule::briddge_xml_file_install_ajax();
			}elseif( $process == 'final' ){
				briddgeZozoImporterModule::briddge_import_set_default_settings();
			}elseif( $process == 'uninstall' ){
				briddgeZozoImporterModule::briddge_uninstall_demo();
			}
			
		}
		
		wp_die();
		
    }
    add_action('wp_ajax_briddge_demo_import', 'briddge_demo_import_fun');
}