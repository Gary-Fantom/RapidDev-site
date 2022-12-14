<?php 
add_action( 'admin_menu', 'cea_admin_menu' );
function cea_admin_menu() {
	add_menu_page( 
		esc_html__( 'Classic Addons', 'cea' ),
		esc_html__( 'Classic Addons', 'cea' ),
		'manage_options',
		'classic-addons', 
		'classic_elementor_addon_admin_page',
		CEA_CORE_URL . '/assets/images/logo.png',
		6
	);
	add_submenu_page( 
		'classic-addons', 
		esc_html__( 'Plugin Options', 'cea' ),
		esc_html__( 'Plugin Options', 'cea' ), 
		'manage_options', 
		'classic-addons-widgets', 
		'classic_elementor_options_admin_page'
	);
}

function cea_change_admin_menu_name(){
	global $submenu;
	if(isset($submenu['classic-addons'])){
		$submenu['classic-addons'][0][0] = esc_html__( 'Addon Settings', 'cea' );
	}
}
add_action( 'admin_menu', 'cea_change_admin_menu_name');   

function classic_elementor_addons_shortcodes(){
	$shortcode_stat = array(
		'animated-text' 	=> esc_html__( 'Animated Text', 'cea' ),
		'button' 			=> esc_html__( 'Button', 'cea' ),
		'circle-progress'	=> esc_html__( 'Circle Progress', 'cea' ),
		'contact-form' 		=> esc_html__( 'Contact Form', 'cea' ),
		'contact-info' 		=> esc_html__( 'Contact Info', 'cea' ),
		'content-carousel' 	=> esc_html__( 'Content Carousel', 'cea' ),
		'counter' 			=> esc_html__( 'Counter', 'cea' ),
		'day-counter' 		=> esc_html__( 'Day Counter', 'cea' ),
		'feature-box' 		=> esc_html__( 'Feature Box', 'cea' ),
		'flip-box' 			=> esc_html__( 'Flip Box', 'cea' ),
		'google-map' 		=> esc_html__( 'Google Map', 'cea' ),
		'icon' 				=> esc_html__( 'Icon', 'cea' ),
		'icon-list' 		=> esc_html__( 'Icon List', 'cea' ),
		'image-grid' 		=> esc_html__( 'Image Grid', 'cea' ),
		'modal-popup' 		=> esc_html__( 'Modal Popup', 'cea' ),
		'pricing-table' 	=> esc_html__( 'Pricing Table', 'cea' ),
		'section-title' 	=> esc_html__( 'Section Title', 'cea' ),
		'social-links' 		=> esc_html__( 'Social Links', 'cea' ),
		'timeline' 			=> esc_html__( 'Timeline', 'cea' ),
		'timeline-slide' 	=> esc_html__( 'Timeline Slide', 'cea' ),
		'chart' 			=> esc_html__( 'Chart', 'cea' ),
		'popup-anything'	=> esc_html__( 'Popup Anything', 'cea' ),
		'popover'			=> esc_html__( 'Popover', 'cea' ),
		'recent-popular' 	=> esc_html__( 'Recent/Popular Post', 'cea' ),
		'tab' 				=> esc_html__( 'Tab', 'cea' ),
		'accordion'			=> esc_html__( 'Accordion', 'cea' ),
		'offcanvas' 		=> esc_html__( 'Offcanvas', 'cea' ),
		'switcher-content' 	=> esc_html__( 'Switcher Content', 'cea' ),
		'data-table' 		=> esc_html__( 'Data Table', 'cea' ),
		'posts'				=> esc_html__( 'Posts', 'cea' ),
		'toggle-content' 	=> esc_html__( 'Toggle Content', 'cea' ),
		'mailchimp' 		=> esc_html__( 'Mailchimp', 'cea' ),
		'image-before-after' => esc_html__( 'Image Before After', 'cea' ),
	);
	
	return $shortcode_stat;
}

$cea_shortcodes = get_option('cea_shortcodes');
if( empty( $cea_shortcodes ) ) classic_elementor_addons_settings_detault();
function classic_elementor_addons_settings_detault(){
	$cea_shortcodes = empty( $cea_shortcodes ) ? get_option('cea_shortcodes') : $cea_shortcodes;
	if( empty( $cea_shortcodes ) ){
		$shortcode_stat = classic_elementor_addons_shortcodes();
		$cea_shortcodes = array();
		foreach( $shortcode_stat as $key => $value ){
			$shortcode_name = str_replace( "-", "_", $key );
			$cea_shortcodes[$shortcode_name] = 'on';
		}
		update_option( 'cea_shortcodes', $cea_shortcodes );
	}
} 

$cea_options = get_option('cea_options'); 
if( empty( $cea_options ) ) classic_elementor_addons_options_detault();
function classic_elementor_addons_options_detault(){
	$cea_detault_options = '{ "cpt-gmap-api": "" }';
	$cea_detault_options = json_decode( $cea_detault_options, true );
	update_option( 'cea_options', $cea_detault_options );
}

function classic_elementor_addon_admin_page(){
	
	require_once ( CEA_CORE_DIR . 'admin/class.zozo-api.php' );
	$cea_api = new Zozothemes_API;
	$response = $cea_api->get_response();
	if( is_wp_error( $response ) ) $response = '';
	
	$plugin_data = get_plugin_data( CEA_CORE_DIR . 'index.php' );
	$version = isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : '0';
	
	?>
	<form method="post" action="#" enctype="multipart/form-data" id="cea-plugin-form-wrapper">
	<div class="cea-settings-wrap">
		<div class="cea-header-bar">
			<div class="cea-header-left">
				<div class="cea-admin-logo-inline">
					<img src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/logo.png' ); ?>" alt="cea-logo">
				</div><!-- .cea-admin-logo-inline -->
				<h2 class="title"><?php esc_html_e( 'Classic Elementor Addon', 'cea' ); ?><span class="cea-version"><?php echo esc_attr( $version ); ?></span></h2>
			</div><!-- .cea-header-left -->
			<div class="cea-header-right">
				<button type="submit" class="button cea-plugin-submit cea-btn"><?php esc_html_e( 'Save settings', 'cea' ); ?></button>
			</div><!-- .cea-header-right -->
		</div><!-- .cea-header-bar -->
		
		<div class="cea-settings-tabs">
			<ul class="cea-tabs">
				<li><a href="#cea-general" class="active"><span><?php esc_html_e( 'General', 'cea' ); ?></span></a></li>
				<li><a href="#cea-widgets"><span><?php esc_html_e( 'Widgets', 'cea' ); ?></span></a></li>
				<!-- <li><a href="#cea-premium"><span><?php esc_html_e( 'Go Premium', 'cea' ); ?></span></a></li> -->
			</ul>
			<div id="cea-general" class="cea-settings-tab cea-elements-list active">
				<div class="container">
					<div class="row">
						<div class="col-8">
							<div class="row">
								<div class="col-6 mb-4">
									<div class="banner-img-wrap">
										<img class="cea-preview-img img-fluid" src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/banner.png' ); ?>" alt="essential-addons-for-elementor-featured">
									</div>
								</div><!-- .col -->
								<div class="col-6 mb-4">
									<div class="media admin-box">
										<div class="admin-box-icon mr-3">
											<span class="dashicons dashicons-admin-generic"></span>								
										</div>
										<div class="media-body admin-box-info">
											<h3 class="admin-box-title"><?php esc_html_e( 'Requirements', 'cea' ); ?></h3>
											<div class="admin-box-content">
											<?php
												$php_version = phpversion();
												$php_version_class = version_compare( $php_version, '5.4.7', '>=') ? ' success' : ' warning';
												$wp_version = get_bloginfo('version');
												$wp_version_class = version_compare( $wp_version, '4.5', '>=') ? ' success' : ' warning';
											?>
												<table class="cea-admin-table">
													<thead>
														<tr>
															<td><?php esc_html_e( 'Core', 'cea' ); ?></td>
															<td><?php esc_html_e( 'Required', 'cea' ); ?></td>
															<td><?php esc_html_e( 'Status', 'cea' ); ?></td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php esc_html_e( 'PHP', 'cea' ); ?></td>
															<td>5.4.7</td>
															<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $php_version_class ); ?>"></span></td>
														</tr>
														<tr>
															<td><?php esc_html_e( 'WordPress', 'cea' ); ?></td>
															<td>4.5</td>
															<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $wp_version_class ); ?>"></span></td>
														</tr>
													</tbody>
												</table>
											</div>
											<a href="https://1.envato.market/x67a5" class="cea-btn btn-default"><?php esc_html_e( 'Go Here', 'cea' ); ?></a>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-6 mb-4">
									<div class="media admin-box">
										<div class="admin-box-icon mr-3">
											<span class="dashicons dashicons-media-document"></span>								
										</div>
										<div class="media-body admin-box-info">
											<h3 class="admin-box-title"><?php esc_html_e( 'Documention', 'cea' ); ?></h3>
											<div class="admin-box-content">
												<?php esc_html_e( 'Get started by spending some time with the documentation to get familiar with Classic Elementor Addons. Build awesome websites for you or your clients with ease.', 'cea' ); ?>
											</div>
											<a href="https://docs.zozothemes.com/cea/" class="cea-btn btn-default"><?php esc_html_e( 'Go Here', 'cea' ); ?></a>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-6">
									<div class="media admin-box">
										<div class="admin-box-icon mr-3">
											<span class="dashicons dashicons-admin-users"></span>								
										</div>
										<div class="media-body admin-box-info">
											<h3 class="admin-box-title"><?php esc_html_e( 'Need Help?', 'cea' ); ?></h3>
											<div class="admin-box-content">
												<?php esc_html_e( 'Stuck with something? Get help from the community on WordPress.org Forum initiate a live chat at Classic Elementor Addons website and get support.', 'cea' ); ?>
											</div>
											<a href="https://zozothemes.ticksy.com/" class="cea-btn btn-default"><?php esc_html_e( 'Get Support', 'cea' ); ?></a>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-12">								
									<div class="admin-box-slide-wrap text-center">	
										<?php										
											if( !empty( $response ) && isset( $response['banner'] ) ) {
												foreach( $response['banner'] as $key => $banner ){
													echo '<a href="'. esc_url( $banner['link'] ) .'" target="_blank"><img src="'. esc_url( $banner['img'] ) .'" alt="'. esc_url( $banner['alt'] ) .'"></a>';
												}
											}
										?>
									</div>
								</div><!-- .col -->
							</div><!-- .row -->
						</div><!-- .col -->
						<div class="col-4">
							<div class="admin-box">
								<div class="admin-box-info">
									<h3 class="admin-box-title"><?php esc_html_e( 'Live Updates', 'cea' ); ?></h3>
									<div class="admin-box-pro text-center">
										<a class="cea-btn btn-default abs-right" href="#"><?php esc_html_e( 'Go Pro', 'cea' ); ?></a>
									</div>									
									<div class="admin-box-list">
										<div class="full-logo-wrap"><img src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/logo.png' ); ?>" alt="cea-logo"></div>
										<ul class="cea-news-events">
										<?php										
										if( !empty( $response ) && isset( $response['list'] ) ) {
											foreach( $response['list'] as $feature ){
												echo '<li>'. esc_html( $feature ) .'</li>';
											}
										}
										?>
										</ul>
									</div>
									<h3 class="admin-box-title my-4"><?php esc_html_e( 'Supported Themes', 'cea' ); ?></h3>
									<div class="admin-box-slide-wrap">
									<?php										
										if( !empty( $response ) && isset( $response['products'] ) ) {
											echo '<div class="owl-carousel">';
											foreach( $response['products'] as $key => $product ){
												echo '<a href="'. esc_url( $product['link'] ) .'" target="_blank"><img src="'. esc_url( $product['img'] ) .'" alt="'. esc_url( $product['alt'] ) .'"></a>';
											}
											echo '</div>';
										}
									?>
									</div>
								</div>
							</div>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .cea-settings-tab -->
			<div id="cea-widgets" class="cea-settings-tab cea-elements-list">
				<?php 
					wp_nonce_field( 'cea_plugin_shortcodes_options', 'save_cea_shortcodes_options' ); 
					$shortcode_stat = classic_elementor_addons_shortcodes();						
					if ( isset( $_POST['save_cea_shortcodes_options'] ) && wp_verify_nonce( $_POST['save_cea_shortcodes_options'], 'cea_plugin_shortcodes_options' ) ) {
						update_option( 'cea_shortcodes', $_POST['cea_shortcodes'] );
					}
					$cea_shortcodes = get_option('cea_shortcodes');
				?>
				<div class="container">
				
					<div class="row">
						<div class="col-12">
							<div class="admin-box cea-main-box text-center">
								<h3><?php esc_html_e( 'Enable/Disable all the widget here.', 'cea' ); ?></h3>
								<a href="#" class="cea-trigger-all-shortcodes"><?php esc_html_e( 'Check/Uncheck All', 'cea' ); ?></a>
							</div><!-- .admin-box -->
						</div><!-- .col -->
					</div><!-- .row -->
					
					<?php			
											
						$row = 1;
						foreach( $shortcode_stat as $key => $value ){
						
							$shortcode_name = str_replace( "-", "_", $key );
							if( !empty( $cea_shortcodes ) ){
								if( isset( $cea_shortcodes[$shortcode_name] ) ){
									$saved_val = 'on';
								}else{
									$saved_val = 'off';
								}
							}/*else{
								$saved_val = 'on';
							}*/
							$checked_stat = $saved_val == 'on' ? 'checked="checked"' : '';
						
							if( $row % 4 == 1 ) echo '<div class="row">';
							
								echo '
								<div class="col-3">
									<div class="element-group admin-box">
										<div class="element-group-inner">
											<h3>'. esc_html( $value ) .'</h3>
											<label class="switch">
												<input class="switch-checkbox" type="checkbox" name="cea_shortcodes['. esc_attr( $shortcode_name ) .']" '. $checked_stat .'>
												<span class="slider round"></span>
											</label>
										</div><!-- .element-group-inner -->
									</div><!-- .element-group -->
								</div><!-- .col -->';
											
							if( $row % 4 == 0 ) echo '</div><!-- .row -->';
							$row++;
						}
						
						if( $row % 4 != 1 ) echo '</div><!-- .cea-row unexpceted close -->';
					?>

					<?php
					/*
					 * Action Hooks - hook_name - priority
					 */
					do_action( 'cea_pt_shortcodes_enable' );
					?>
					
				</div> <!-- .cea-shortcodes-container -->
			</div> <!-- .cea-settings-tab -->
			<div id="cea-premium" class="cea-settings-tab cea-elements-list">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="admin-box text-center">
								<div class="admin-box-info">
									<h3 class="admin-box-title"><?php esc_html_e( 'Classic Addons Pro', 'cea' ); ?></h3>
									<div class="admin-box-content">
										<p><?php esc_html_e( 'Get started by spending some time with the documentation to get familiar with Classic Elementor Addons.', 'cea' ); ?></p>
										<p><?php esc_html_e( 'Build awesome websites for you or your clients with ease.', 'cea' ); ?></p>
									</div>
									<a href="#" class="cea-btn btn-default"><?php esc_html_e( 'Go Pro', 'cea' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- .cea-settings-tab -->
		</div><!-- .cea-settings-tabs -->
		
	</div><!-- .cea-settings-wrap -->
	<?php
}

function classic_elementor_options_admin_page(){
	
	$plugin_data = get_plugin_data( CEA_CORE_DIR . 'index.php' );
	$version = isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : '0';
	
	?>
	
	<form method="post" action="#" enctype="multipart/form-data" id="cea-form-wrapper">
	<div class="cea-settings-wrap">	
		<div class="cea-header-bar">
			<div class="cea-header-left">
				<div class="cea-admin-logo-inline">
					<img src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/logo.png' ); ?>" alt="cea-logo">
				</div><!-- .cea-admin-logo-inline -->
				<h2 class="title"><?php esc_html_e( 'Classic Elementor Addon', 'cea' ); ?><span class="cea-version"><?php echo esc_attr( $version ); ?></span></h2>
			</div><!-- .cea-header-left -->
			<div class="cea-header-right">
				<button type="submit" class="button cea-plugin-submit cea-btn"><?php esc_html_e( 'Save settings', 'cea' ); ?></button>
			</div><!-- .cea-header-right -->
		</div><!-- .cea-header-bar -->		
		<?php			
			if ( isset( $_POST['save_cea_plugin_options'] ) && wp_verify_nonce( $_POST['save_cea_plugin_options'], 'cea_plugin_options' ) ) {
				update_option( 'cea_options', $_POST['cea_options'] );
				require_once ( CEA_CORE_DIR . 'inc/cea-addon-styles.php' );
			}
			require_once ( CEA_CORE_DIR . 'admin/cea-options.php' );
			ceaPluginOptions::$opt_name = 'cea_options';
			ceaPluginOptions::$cea_options = $cea_options = get_option('cea_options');			
			require_once ( CEA_CORE_DIR . 'admin/cea-config.php' );			
		?>		
		<div class="cea-admin-content-wrap">			
			<?php wp_nonce_field( 'cea_plugin_options', 'save_cea_plugin_options' ); ?>
			<div class="cea-tab">
				<div class="cea-tab-list">
					<ul class="tablinks-list">
						<?php ceaPluginOptions::ceaPutSection(); ?>
					</ul>
				</div><!-- .cea-tab-list -->
				
				<?php ceaPluginOptions::ceaPutFields(); ?>
				
			</div><!-- .cea-tab -->
		</div><!-- .cea-admin-content-wrap -->
		 <script>
			jQuery(document).ready(function($){
			$('.wp-color').each(function(){
				$(this).wpColorPicker();
				});
			});
        </script>		
	</div><!-- .cea-admin-wrap -->
	</form>
	<?php
}

add_action( 'admin_enqueue_scripts', 'cea_framework_admin_scripts' );
function cea_framework_admin_scripts(){
if( isset( $_GET['page'] ) && ( $_GET['page'] == 'classic-addons' || $_GET['page'] == 'classic-addons-widgets' ) ){
		wp_enqueue_style( 'cea-admin', CEA_CORE_URL . '/admin/assets/css/cea-admin-page.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'cea-owl-admin', CEA_CORE_URL . '/assets/css/owl.carousel.min.css', array(), '2.3.4', 'all' );
		wp_enqueue_script( 'cea-owl-admin', CEA_CORE_URL . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
	}
	wp_enqueue_script( 'cea-framework-admin', CEA_CORE_URL . 'admin/assets/js/cea-admin-script.js', array( 'jquery' ), '1.0', true );
}