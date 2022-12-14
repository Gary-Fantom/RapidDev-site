<?php 

class Briddge_Custom_Fonts {
	
	private static $_instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'briddge_addon_admin_menu' ) );		
	}
	
	public static function briddge_addon_admin_menu(){
		add_submenu_page( 
			'briddge-welcome', 
			esc_html__( 'Custom Fonts', 'briddge-addon' ),
			esc_html__( 'Custom Fonts', 'briddge-addon' ), 
			'manage_options', 
			'briddge-fonts', 
			array( 'Briddge_Custom_Fonts', 'briddge_fonts_admin_page' )
		);
	}
	
	public static function briddge_fonts_admin_page(){
		$briddge_theme = wp_get_theme();
	?>
		<div class="briddge-settings-wrap">
			<div class="briddge-header-bar">
				<div class="briddge-header-left">
					<div class="briddge-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="briddge-logo">
					</div><!-- .briddge-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Briddge Custom Fonts', 'briddge-addon' ); ?><span class="briddge-version"><?php echo esc_attr( $briddge_theme->get( 'Version' ) ); ?></span></h2>
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
										<h3 class="admin-box-title"><?php esc_html_e( 'Add Custom Fonts', 'briddge-addon' ); ?></h3>
										<div class="admin-box-content">
											<?php esc_html_e( 'You can add custom fonts here. Also we give you option to remove or delete custom fonts.', 'briddge-addon' ); ?>
										</div>	
										<form action="" method="post" enctype="multipart/form-data">
											<?php wp_nonce_field( 'briddge-)(&(*@#*%@*', 'briddge_custom_font_nonce' ); ?>
											<input type="file" name="briddge_custom_fonts" id="briddge-custom-fonts" class="briddge-custom-fonts" />
										</form>
										<a href="#" class="briddge-btn btn-default briddge-custom-fonts-upload"><?php esc_html_e( 'Upload Font', 'briddge-addon' ); ?></a>
										<ol class="admin-instruction-list">
											<li><?php esc_html_e( 'Notes: Custom fonts should be in this following format. .eot, .otf, .svg, .ttf, .wof', 'briddge-addon' ) ?></li>
											<li><?php esc_html_e( 'Font folder name only show as font name in theme option. So make folder name and font name are should be the same but font name like slug type.', 'briddge-addon' ) ?></li>
											<li><?php printf( '%1$s <strong>%2$s</strong> %3$s <strong>%4$s</strong>', esc_html__( 'Eg: Font folder name is -', 'briddge-addon' ), esc_html__( 'Wonder Land', 'briddge-addon' ), esc_html__( ' font name like', 'briddge-addon' ), esc_html__( ' wonder-land.eot, wonder-land.otf ...', 'briddge-addon' ) ); ?></li>
										</ol>
									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="admin-box">
									<h3 class="admin-box-title font-title"><?php esc_html_e( 'Custom Fonts', 'briddge-addon' ); ?></h3>
									<?php
										//delete_option( 'briddge_custom_fonts' );
										if ( isset( $_POST['briddge_custom_font_nonce'] ) && wp_verify_nonce( $_POST['briddge_custom_font_nonce'], 'briddge-)(&(*@#*%@*' ) ) {
											Briddge_Custom_Fonts::briddge_upload_font();
										}
										
										if ( isset( $_POST['briddge_custom_font_remove_nonce'] ) && wp_verify_nonce( $_POST['briddge_custom_font_remove_nonce'], 'briddge-(*&^&%^%@!' ) 
										) {
											Briddge_Custom_Fonts::briddge_font_delete();
										}
										
										$custom_fonts = get_option( 'briddge_custom_fonts' );
									?>
									<?php if( !empty( $custom_fonts ) ): ?>
									<form action="" method="post" enctype="multipart/form-data">
									<?php wp_nonce_field( 'briddge-(*&^&%^%@!', 'briddge_custom_font_remove_nonce' ); ?>
									<input type="hidden" name="briddge_font_remove_name" id="briddge-font-remove-name" value="" />									
									<table class="briddge-admin-table briddge-custom-font-table">
										<thead>
											<tr>
												<td><?php esc_html_e( 'Font Name', 'briddge-addon' ); ?></td>
												<td><?php esc_html_e( 'CSS', 'briddge-addon' ); ?></td>
												<td><?php esc_html_e( 'Delete', 'briddge-addon' ); ?></td>
											</tr>
										</thead>
										<tbody>
										<?php
											foreach( $custom_fonts as $font_slug => $font_name ){
											?>
												<tr>
													<td><?php echo esc_html( $font_name ); ?></td>
													<td>font-family: '<?php echo esc_html( $font_name ); ?>';</td>
													<td class="text-center"><a href="#" data-font="<?php echo esc_attr( $font_slug ); ?>" class="briddge-font-remove"><span class="dashicons dashicons-trash"></span></a></td>
												</tr>
											<?php
											}
										?>
										</tbody>
									</table>
									</form>
									<?php else: ?>
									<p><?php esc_html_e( 'Sorry! No custom fonts available.', 'briddge-addon' ); ?></p>
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
	
	public static function briddge_upload_font(){
		if ( isset( $_FILES['briddge_custom_fonts'] ) ) {
			// The nonce was valid and the user has the capabilities, it is safe to continue.
			
			$accepted_types = array( 'application/x-zip-compressed', 'application/zip', 'application/octet-stream', 'application/x-7z', 'application/x-7z-compressed');
			$file_type = $_FILES['briddge_custom_fonts']['type'];
			
			if( in_array( $file_type, $accepted_types ) ){
				// These files need to be included as dependencies when on the front end.
				
				require_once( ABSPATH . 'wp-admin/includes/image.php' ); 
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				
				// Let WordPress handle the upload.
				//delete_option( 'briddge_custom_fonts' );
				// Remember, 'pharmy_image_upload' is the name of our file input in our form above.
				$font_name = pathinfo($_FILES['briddge_custom_fonts']['name'], PATHINFO_FILENAME);
				$font_slug = sanitize_title( $font_name );
				if ( get_option( 'briddge_custom_fonts' ) ) {
					$custom_fonts_names = get_option( 'briddge_custom_fonts' ); 
					$custom_fonts_names = array_merge( $custom_fonts_names, array( $font_slug => $font_name ) );
				}else{
					$custom_fonts_names = array( $font_slug => $font_name );
				}
				WP_Filesystem();
				$destination = wp_upload_dir();
				$destination_path = $destination['basedir'] . '/custom-fonts/';
				$unzipfile = unzip_file( $_FILES['briddge_custom_fonts']['tmp_name'], $destination_path);
				
				update_option( 'briddge_custom_fonts', $custom_fonts_names );				
			}else{
				echo esc_html__( 'Invalid File Type', 'briddge-addon' );
			}
		}
	}
	
	public static function briddge_font_delete(){			
		$font_id = esc_attr( $_POST['briddge_font_remove_name'] );		
		$destination = wp_upload_dir();
		$custom_fonts = get_option( 'briddge_custom_fonts' );		
		if ( array_key_exists( $font_id, $custom_fonts ) ){
			$font_name = $custom_fonts[$font_id];
			$destination_path = $destination['basedir'] . '/custom-fonts/' . $font_name;	
			unset($custom_fonts[$font_id]);
			update_option( 'briddge_custom_fonts', $custom_fonts );
			self::rmdir_recurse( $destination_path );
		}
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
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Briddge_Custom_Fonts::get_instance();