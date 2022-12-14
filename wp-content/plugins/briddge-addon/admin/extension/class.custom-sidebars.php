<?php 

class Briddge_Custom_Sidebars {
	
	private static $_instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'briddge_addon_admin_menu' ) );	
		add_action( 'wp_ajax_briddge-custom-sidebar-export', array( $this, 'briddge_custom_sidebar_export' ) );
	}
	
	public static function briddge_addon_admin_menu(){
		add_submenu_page( 
			'briddge-welcome', 
			esc_html__( 'Custom Sidebars', 'briddge-addon' ),
			esc_html__( 'Custom Sidebars', 'briddge-addon' ), 
			'manage_options', 
			'briddge-sidebars', 
			array( 'Briddge_Custom_Sidebars', 'briddge_sidebar_admin_page' )
		);
	}
	
	public static function briddge_sidebar_admin_page(){
		$briddge_theme = wp_get_theme();
	?>
		<div class="briddge-settings-wrap">
			<div class="briddge-header-bar">
				<div class="briddge-header-left">
					<div class="briddge-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="briddge-logo">
					</div><!-- .briddge-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Briddge Custom Sidebars', 'briddge-addon' ); ?><span class="briddge-version"><?php echo esc_attr( $briddge_theme->get( 'Version' ) ); ?></span></h2>
				</div><!-- .briddge-header-left -->
				<div class="briddge-header-right">
					<a href="<?php echo esc_url( 'https://wordpress.zozothemes.com/briddge/' ); ?>" class="button briddge-btn"><?php esc_html_e( 'Live Demo', 'briddge-addon' ); ?></a>
				</div><!-- .briddge-header-right -->
			</div><!-- .briddge-header-bar -->
			
			<div class="briddge-settings-tabs briddge-custom-sidebar-wrap">
				<div id="briddge-general" class="briddge-settings-tab active">
					<div class="container">
						<div class="row">
							<div class="col-4">
								<div class="media admin-box">
									<div class="admin-box-icon mr-3">
										<span class="dashicons dashicons-welcome-widgets-menus"></span>								
									</div>
									<div class="media-body admin-box-info">
										<h3 class="admin-box-title"><?php esc_html_e( 'Add New Sidebar', 'briddge-addon' ); ?></h3>
										<div class="admin-box-content">
											<?php esc_html_e( 'You can add new custom sidebar here. Also we give you option to remove or delete custom sidebars.', 'briddge-addon' ); ?>
										</div>
										<?php
											$sidebars = '';
											$sidebar_opt_name = 'briddge_custom_sidebars';
											$sidebars = get_option( $sidebar_opt_name );
											
											if ( isset( $_POST['briddge_custom_sidebar_nonce'] ) && wp_verify_nonce( $_POST['briddge_custom_sidebar_nonce'], 'briddge-()@)(*^#@!' ) 
											) {
												if( isset( $_POST['briddge_sidebar_name'] ) && !empty( $_POST['briddge_sidebar_name'] ) ){
													
													$sidebar_name = $_POST['briddge_sidebar_name'];
													$sidebar_slug = sanitize_title( $sidebar_name );
													
													if( !empty( $sidebars ) ){
														$sidebars[$sidebar_slug] = $sidebar_name;
													}else{
														$sidebars = array( $sidebar_slug => $sidebar_name );
													}	
													update_option( 'briddge_custom_sidebars', $sidebars );
												}
											}
											
											if ( isset( $_POST['briddge_custom_sidebar_remove_nonce'] ) && wp_verify_nonce( $_POST['briddge_custom_sidebar_remove_nonce'], 'briddge-()I*^*^%@!' ) 
											) {
												$remove_sidebar = isset( $_POST['briddge_sidebar_remove_name'] ) && !empty( $_POST['briddge_sidebar_remove_name'] ) ? $_POST['briddge_sidebar_remove_name'] : '';
												unset( $sidebars[$remove_sidebar] );
												update_option( 'briddge_custom_sidebars', $sidebars );
												$sidebars = get_option( $sidebar_opt_name );
											}
											
										?>
										<form action="" method="post" enctype="multipart/form-data">
											<?php wp_nonce_field( 'briddge-()@)(*^#@!', 'briddge_custom_sidebar_nonce' ); ?>
											<input type="input" name="briddge_sidebar_name" class="custom-sidebar-name" value="" />
										</form>
										<a href="#" class="briddge-btn btn-default custom-sidebar-create"><?php esc_html_e( 'Add', 'briddge-addon' ); ?></a>
									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="admin-box">
									<h3 class="admin-box-title sidebar-title"><?php esc_html_e( 'Custom Sidebars', 'briddge-addon' ); ?></h3>
									<?php if( !empty( $sidebars ) ): ?>
									<form action="" method="post" enctype="multipart/form-data">
									<?php wp_nonce_field( 'briddge-()I*^*^%@!', 'briddge_custom_sidebar_remove_nonce' ); ?>
									<input type="hidden" name="briddge_sidebar_remove_name" id="briddge-sidebar-remove-name" value="" />									
									<table class="briddge-admin-table briddge-custom-sidebar-table">
										<thead>
											<tr>
												<td><?php esc_html_e( 'Name', 'briddge-addon' ); ?></td>
												<td><?php esc_html_e( 'Slug', 'briddge-addon' ); ?></td>
												<td><?php esc_html_e( 'Delete', 'briddge-addon' ); ?></td>
											</tr>
										</thead>
										<tbody>
										<?php
											foreach( $sidebars as $sidebar_slug => $sidebar_name ){
											?>
												<tr>
													<td><?php echo esc_html( $sidebar_name ); ?></td>
													<td><?php echo esc_html( $sidebar_slug ); ?></td>
													<td class="text-center"><a href="#" data-sidebar="<?php echo esc_attr( $sidebar_slug ); ?>" class="briddge-sidebar-remove"><span class="dashicons dashicons-trash"></span></a></td>
												</tr>
											<?php
											}
										?>
										</tbody>
									</table>
									</form>
									<a href="#" class="briddge-btn btn-default custom-sidebar-export"><?php esc_html_e( 'Export as JSON', 'briddge-addon' ); ?></a>
									<?php else: ?>
										<p><?php esc_html_e( 'Sorry! No custom sidebars available.', 'briddge-addon' ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<?php
	}
		
	public static function rmdir_recurse($path) {
		$path = rtrim($path, '/').'/';
		$handle = opendir($path);
		while(false !== ($file = readdir($handle))) {
			if($file != '.' and $file != '..' ) {
				$fullpath = $path.$file;
				if(is_dir($fullpath)) self::rmdir_recurse($fullpath); else unlink($fullpath);
			}
		}
		closedir($handle);
		rmdir($path);
	}	
	
	public static function briddge_custom_sidebar_export(){
		$nonce = $_POST['nonce'];  
		if ( ! wp_verify_nonce( $nonce, 'briddge-()@)(*^#@!' ) )
			wp_die ( esc_html__( 'F***', 'briddge-addon' ) );
		
		$sidebars = get_option( 'briddge_custom_sidebars' );
		if( !empty( $sidebars ) ){
			//wp_send_json( $sidebars );
			echo json_encode( $sidebars );
		}else{
			echo '';
		}	
		wp_die();
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Briddge_Custom_Sidebars::get_instance();