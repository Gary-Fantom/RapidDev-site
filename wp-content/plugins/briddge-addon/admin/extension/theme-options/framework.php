<?php 
class Briddge_Options {
	
	private static $_instance = null;
	
	public static $opt_name;
	
	public static $tab_list = '';
	
	public static $tab_content = '';
	
	public static $parent_tab_count = 1;
	
	public static $tab_count = 1;
	
	public static $briddge_options = array();
	
	public function __construct() {}
		
	public static function briddge_theme_option_strings( $key ){
		$string_array = array(
			'enabled' => esc_html__( 'Enabled', 'briddge-addon' ),
			'disabled' => esc_html__( 'Disabled', 'briddge-addon' ),
			'left' => esc_html__( 'Left', 'briddge-addon' ),
			'center' => esc_html__( 'Center', 'briddge-addon' ),
			'right' => esc_html__( 'Right', 'briddge-addon' ),
			'normal' => esc_html__( 'Normal', 'briddge-addon' ),
			'sticky' => esc_html__( 'Sticky', 'briddge-addon' )	
		);
		return isset( $string_array[$key] ) ? $string_array[$key] : '';
	}
	
	public static function briddge_set_section( $settings ){
		$tab_item_class = ''; //self::$parent_tab_count <= 1 ? ' active' : '';
		self::$tab_list .= '<li class="tablinks'. esc_attr( $tab_item_class ) .'" data-id="'. esc_attr( $settings['id'] ) .'"><span class="tab-title">'. esc_html( $settings['title'] ) .'</span>';
		self::$tab_list .= '<ul class="tablinks-sub-list">';
		self::$parent_tab_count++;
	}
	
	public static function briddge_set_sub_section( $settings ){
		$tab_item_class = ''; //self::$tab_count <= 1 ? ' active' : '';
		self::$tab_list .= '<li class="tablinks'. esc_attr( $tab_item_class ) .'" data-id="'. esc_attr( $settings['id'] ) .'"><span class="tab-title">'. esc_html( $settings['title'] ) .'</span></li>';
		$tab_class = ' tab-hide'; //self::$tab_count != 1 ? ' tab-hide' : '';
		self::$tab_content .= '<div id="'. esc_attr( $settings['id'] ) .'" class="tabcontent'. esc_attr( $tab_class ) .'">'. self::briddge_set_field( $settings['id'], $settings['fields'] ) .'</div>';
		self::$tab_count++;
	}
	
	public static function briddge_set_end_section( $settings ){
		self::$tab_list .= '</ul></li>';
	}
	
	public static function briddge_set_field( $id, $fields ){
	
		$briddge_options = self::$briddge_options;
	
		$field_element = '';
		$field_title = '';
		$field_out = '';
		foreach( $fields as $config ){
		
			$description = isset( $config['desc'] ) ? $config['desc'] : '';
			ob_start();
			switch( $config['type'] ){
				case "text":
					self::build_text_field( $config );
				break;
				case "number":
					self::build_number_field( $config );
				break;
				case "textarea":
					self::build_textarea_field( $config );
				break;
				case "select":
					self::build_select_field( $config );
				break;
				case "color":
					self::build_color_field( $config );
				break;	
				case "image":
					self::build_image_field( $config );
				break;
				case "background":
					self::build_background_field( $config );
				break;
				case "border":
					self::build_border_field( $config );
				break;
				case "dimension":
					self::build_dimension_field( $config );
				break;
				case "link":
					self::build_link_color_field( $config );
				break;
				case "btn_color":
					self::build_button_color_field( $config );
				break;
				case "multicheck":
					self::build_multi_check_field( $config );
				break;
				case "radioimage":
					self::build_radio_image_field( $config );
				break;
				case "sidebars":
					self::build_sidebars_field( $config );
				break;
				case "pages":
					self::build_pages_field( $config );
				break;
				case "toggle":
					self::build_toggle_switch_field( $config );
				break;
				case "hw":
					self::build_height_weight_field( $config );
				break;
				case "fonts":
					self::build_google_fonts_field( $config );
				break;
				case "dragdrop":
					self::build_drag_drop_field( $config );
				break;
				case "export":
					self::build_export_field( $config );
				break;
				case "import":
					self::build_import_field( $config );
				break;
				case "label":
					self::build_label_field( $config );
				break;
			}
			$field_out .= ob_get_clean();
			
		}
	
		return $field_out;
	}
	
	public static function build_label_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
				
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
		$seperator = isset( $config['seperator'] ) ? $config['seperator'] : '';
		
	?>
		<div class="briddge-control label-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( !empty( $seperator ) && ( $seperator == 'before' || $seperator == 'both' ) ): ?><span class="field-seperator seperator-before"></span><?php endif; ?>
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			<?php if( !empty( $seperator ) && ( $seperator == 'after' || $seperator == 'both' ) ): ?><span class="field-seperator seperator-after"></span><?php endif; ?>
		</div>
	<?php
	}
	
	public static function build_text_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			<input type="text" class="briddge-customizer-text-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>]" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]" value="<?php echo esc_attr( $saved_val ); ?>">
		</div>
	<?php
	}

	public static function build_number_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			<input type="number" class="briddge-customizer-text-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>]" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]" value="<?php echo esc_attr( $saved_val ); ?>">
		</div>
	<?php
	}
	
	public static function build_textarea_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			<textarea class="briddge-customizer-textarea-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>]" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]"><?php echo esc_textarea( $saved_val ); ?></textarea>
		</div>
	<?php
	}
	
	public static function build_select_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$choices = isset( $config['choices'] ) ? $config['choices'] : '';
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-field-type="select" data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			<select class="briddge-customizer-select-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]">
			<?php 
				if( !empty( $choices ) ){
					foreach( $choices as $key => $value ){
						echo '<option value="'. esc_attr( $key ) .'" '. selected( $saved_val, $key ) .'>'. esc_html( $value ) .'</option>';
					}
				}
			?>
			</select>
		</div>
	<?php
	}
	
	public static function build_color_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		$default_color =  isset( $config['default'] ) ? $config['default'] : '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		$alpha = isset( $config['alpha'] ) ? $config['alpha'] : false;
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			<div class="color-control-wrap">
				<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $saved_val ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]" data-alpha-enabled="<?php echo esc_attr( $alpha ); ?>" />
			</div><!-- .alpha-wrap -->
		</div>
	<?php
	}
	
	public static function build_image_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$briddge_media = $briddge_media_id = $briddge_media_url = '';
		$briddge_media = isset( $saved_val['image'] ) ? $saved_val['image'] : '';				
		if( !empty( $briddge_media ) && is_array( $briddge_media ) ){
			$briddge_media_id = isset( $briddge_media['id'] ) ? $briddge_media['id'] : '';
			if ( wp_attachment_is_image( $briddge_media_id ) ) {
				$briddge_media_url = isset( $briddge_media['url'] ) ? wp_get_attachment_url( $briddge_media_id ) : '';
			}
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
			
			<div class="briddge-customizer-image-btn-wrap">
				<div class="briddge-image-upload-field">
					<input type="hidden" class="briddge-img-id" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][image][id]" value="<?php echo esc_attr( $briddge_media_id ); ?>" />
					<input type="hidden" class="briddge-img-url" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][image][url]" value="<?php echo esc_attr( $briddge_media_url ); ?>" />						
					<div class="img-btn-controls">
						<input type="button" class="wp-background-field bg-upload-image-button" value="<?php esc_html_e( 'Upload Image', 'briddge-addon' ); ?>" />
						<input type="button" class="bg-remove-image-button" value="<?php esc_html_e( 'Remove Image', 'briddge-addon' ); ?>" />
					</div>
					<div class="img-place">
						<?php
							if( !empty( $briddge_media_url ) ) :
								$media_alt = $briddge_media_id ? get_post_meta( $briddge_media_id, '_wp_attachment_image_alt', true ) : '';
						?>
							<img src="<?php echo esc_url( $briddge_media_url ); ?>" alt="<?php echo esc_attr( $media_alt ); ?>" class="briddge-bg-img">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_background_field( $config ){
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$bg_ele = $saved_val; 
		$bg_decond = $bg_repeat = $bg_size = $bg_attachment = $bg_position = $bg_media = $bg_color = $bg_transparent = '';
		$bg_media_id = $bg_media_url = '';
		if( $bg_ele ){
			$bg_decond = $bg_ele;
			if( is_array( $bg_decond ) && !empty( $bg_decond ) ){
				$bg_repeat = isset( $bg_decond['bg_repeat'] ) ? $bg_decond['bg_repeat'] : '';
				$bg_size = isset( $bg_decond['bg_size'] ) ? $bg_decond['bg_size'] : '';
				$bg_attachment = isset( $bg_decond['bg_attachment'] ) ? $bg_decond['bg_attachment'] : '';
				$bg_position = isset( $bg_decond['bg_position'] ) ? $bg_decond['bg_position'] : '';
				$bg_media = isset( $bg_decond['image'] ) ? $bg_decond['image'] : '';
				
				if( !empty( $bg_media ) && is_array( $bg_media ) ){
					$bg_media_id = isset( $bg_media['id'] ) ? $bg_media['id'] : '';
					if ( wp_attachment_is_image( $bg_media_id ) ) {
						$bg_media_url = isset( $bg_media['url'] ) ? $bg_media['url'] : '';
					}
				}
				
				$bg_color = isset( $bg_decond['bg_color'] ) ? $bg_decond['bg_color'] : '';
				$bg_transparent = isset( $bg_decond['bg_transparent'] ) ? $bg_decond['bg_transparent'] : '';
			}
		}
		
		$bg_repeat_arr = array(
			'no-repeat' => esc_html__( 'No Repeat', 'briddge-addon' ),
			'repeat' => esc_html__( 'Repeat All', 'briddge-addon' ),
			'repeat-x' => esc_html__( 'Repeat Horizontally', 'briddge-addon' ),
			'repeat-y' => esc_html__( 'Repeat Vertically', 'briddge-addon' ),
			'inherit' => esc_html__( 'Inherit', 'briddge-addon' )
		);
		
		$bg_size_arr = array(
			'inherit' => esc_html__( 'Inherit', 'briddge-addon' ),
			'cover' => esc_html__( 'Cover', 'briddge-addon' ),
			'contain' => esc_html__( 'Contain', 'briddge-addon' )
		);
		
		$bg_attachment_arr = array(
			'fixed' => esc_html__( 'Fixed', 'briddge-addon' ),
			'scroll' => esc_html__( 'Scroll', 'briddge-addon' ),
			'inherit' => esc_html__( 'Inherit', 'briddge-addon' )
		);
		
		$bg_position_arr = array(
			'left top' => esc_html__( 'Left Top', 'briddge-addon' ),
			'left center' => esc_html__( 'Left center', 'briddge-addon' ),
			'left bottom' => esc_html__( 'Left Bottom', 'briddge-addon' ),
			'center top' => esc_html__( 'Center Top', 'briddge-addon' ),
			'center center' => esc_html__( 'Center Center', 'briddge-addon' ),
			'center bottom' => esc_html__( 'Center Bottom', 'briddge-addon' ),
			'right top' => esc_html__( 'Right Top', 'briddge-addon' ),
			'right center' => esc_html__( 'Right center', 'briddge-addon' ),
			'right bottom' => esc_html__( 'Right Bottom', 'briddge-addon' )
		);
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="wp-backgrounds-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="wp-backgrounds-inner" data-img="<?php echo esc_url( $bg_media_url ); ?>" data-transparent="<?php if( $bg_transparent ) echo esc_attr( 'transparent' ); ?>" data-repeat="<?php echo esc_url( $bg_repeat ); ?>" data-color="<?php echo esc_attr( $bg_color ); ?>" data-attachment="<?php echo esc_attr( $bg_attachment ); ?>" data-size="<?php echo esc_attr( $bg_size ); ?>" data-position="<?php echo esc_attr( $bg_position ); ?>">
				
					<div class="wp-backgrounds-fields">
					
						<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $bg_color ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bg_color]" data-alpha-enabled="true" />
					
						<select class="wp-background-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bg_repeat]">
							<option value=""><?php esc_html_e( 'Background Repeat', 'briddge-addon' ); ?></option>
						<?php
							foreach( $bg_repeat_arr as $key => $bg_repeat_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_repeat == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_repeat_attr ) .'</option>';
							}
						?>
						</select>
						
						<select class="wp-background-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bg_size]">
							<option value=""><?php esc_html_e( 'Background Size', 'briddge-addon' ); ?></option>
						<?php
							foreach( $bg_size_arr as $key => $bg_size_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_size == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_size_attr ) .'</option>';
							}
						?>
						</select>
						
						<select class="wp-background-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bg_attachment]">
							<option value=""><?php esc_html_e( 'Background Attachment', 'briddge-addon' ); ?></option>
						<?php
							foreach( $bg_attachment_arr as $key => $bg_attachment_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_attachment == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_attachment_attr ) .'</option>';
							}
						?>
						</select>
						
						<select class="wp-background-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bg_position]">
							<option value=""><?php esc_html_e( 'Background Position', 'briddge-addon' ); ?></option>
						<?php
							foreach( $bg_position_arr as $key => $bg_position_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_position == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_position_attr ) .'</option>';
							}
						?>
						</select>
						
						<div class="briddge-image-upload-field">
							<input type="hidden" class="briddge-img-id" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][image][id]" value="<?php echo esc_attr( $bg_media_id ); ?>" />
							<input type="hidden" class="briddge-img-url" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][image][url]" value="<?php echo esc_attr( $bg_media_url ); ?>" />						
							<div class="img-btn-controls">
								<input type="button" class="wp-background-field bg-upload-image-button" value="<?php esc_html_e( 'Upload Image', 'briddge-addon' ); ?>" />
								<input type="button" class="bg-remove-image-button" value="<?php esc_html_e( 'Remove Image', 'briddge-addon' ); ?>" />
							</div>
							<div class="img-place">
								<?php
									if( !empty( $bg_media_url ) ) :
										$media_alt = $bg_media_id ? get_post_meta( $bg_media_id, '_wp_attachment_image_alt', true ) : '';
								?>
									<img src="<?php echo esc_url( $bg_media_url ); ?>" alt="<?php echo esc_attr( $media_alt ); ?>" class="briddge-bg-img">
								<?php endif; ?>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_border_field( $config ){
		
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$brdr_decond = $saved_val; 
		$left = $right = $top = $bottom = $style = $color = '';
		
		if( is_array( $brdr_decond ) && !empty( $brdr_decond ) ){
			$left = $brdr_decond['left'];
			$right = $brdr_decond['right'];
			$top = $brdr_decond['top'];
			$bottom = $brdr_decond['bottom'];
			$style = $brdr_decond['style'];
			$color = $brdr_decond['color'];
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="border-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="border-inner">	
					
					<ul class="wp-border-list">
						<li>
							<input type="number" class="wp-border-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][top]" value="<?php echo esc_attr( $top ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Top', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-border-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][right]" value="<?php echo esc_attr( $right ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Right', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-border-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bottom]" value="<?php echo esc_attr( $bottom ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Bottom', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-border-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][left]" value="<?php echo esc_attr( $left ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Left', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<select class="wp-border-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][style]">
								<option value="none"<?php if( $style == 'none' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'None', 'briddge-addon' ); ?></option>
								<option value="solid"<?php if( $style == 'solid' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Solid', 'briddge-addon' ); ?></option>
								<option value="dashed"<?php if( $style == 'dashed' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Dashed', 'briddge-addon' ); ?></option>
								<option value="dotted"<?php if( $style == 'dotted' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Dotted', 'briddge-addon' ); ?></option>
								<option value="double"<?php if( $style == 'double' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Double', 'briddge-addon' ); ?></option>							
							</select>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][color]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
						</li>
					</ul>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_dimension_field( $config ){
		
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$dim_decond = $saved_val; 
		$left = $right = $top = $bottom = '';
		
		if( is_array( $dim_decond ) && !empty( $dim_decond ) ){
			$top = $dim_decond['top'];
			$right = $dim_decond['right'];
			$bottom = $dim_decond['bottom'];
			$left = $dim_decond['left'];
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="dimensions-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="dimensions-inner">

					<ul class="wp-dimensions-list">
						<li>
							<input type="number" class="wp-dimensions-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][top]" value="<?php echo esc_attr( $top ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Top', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-dimensions-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][right]" value="<?php echo esc_attr( $right ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Right', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-dimensions-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bottom]" value="<?php echo esc_attr( $bottom ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Bottom', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-dimensions-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][left]" value="<?php echo esc_attr( $left ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Left', 'briddge-addon' ) ?></span>
						</li>
					</ul>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_google_fonts_field( $config ){
		
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$alpha = isset( $config['alpha'] ) ? $config['alpha'] : false;
		
		$fonts_ele = $saved_val;
		$fonts_decond = $font_family = $font_weight = $font_sub = $text_align = $text_transform = $font_size = $line_height = $letter_spacing = $font_color = '';
		if( $fonts_ele ){
			$fonts_decond = $fonts_ele;
			if( is_array( $fonts_decond ) && !empty( $fonts_decond ) ){
				$font_family = isset( $fonts_decond['font_family'] ) ? $fonts_decond['font_family'] : '';
				$font_weight = isset( $fonts_decond['font_weight'] ) ? $fonts_decond['font_weight'] : '';
				$font_sub = isset( $fonts_decond['font_sub'] ) ? $fonts_decond['font_sub'] : '';
				$text_align = isset( $fonts_decond['text_align'] ) ? $fonts_decond['text_align'] : '';
				$text_transform = isset( $fonts_decond['text_transform'] ) ? $fonts_decond['text_transform'] : '';
				$font_size = isset( $fonts_decond['font_size'] ) ? $fonts_decond['font_size'] : '';
				$line_height = isset( $fonts_decond['line_height'] ) ? $fonts_decond['line_height'] : '';
				$letter_spacing = isset( $fonts_decond['letter_spacing'] ) ? $fonts_decond['letter_spacing'] : '';
				$font_color = isset( $fonts_decond['font_color'] ) ? $fonts_decond['font_color'] : '';
			}
		}	
				
		$font_family_arr = Briddge_Google_Fonts_Function::$_standard_fonts;
		
		$text_align_arr = array(
			'inherit' => esc_html__( 'Inherit', 'briddge-addon' ),
			'left' => esc_html__( 'Left', 'briddge-addon' ),
			'right' => esc_html__( 'Right', 'briddge-addon' ),
			'center' => esc_html__( 'Center', 'briddge-addon' ),
			'justify' => esc_html__( 'Justify', 'briddge-addon' ),
			'initial' => esc_html__( 'Initial', 'briddge-addon' )
		);
		
		$text_trans_arr = array(
			'capitalize' => esc_html__( 'Capitalize', 'briddge-addon' ),
			'inherit' => esc_html__( 'Inherit', 'briddge-addon' ),
			'initial' => esc_html__( 'Initial', 'briddge-addon' ),
			'lowercase' => esc_html__( 'Lower Case', 'briddge-addon' ),
			'uppercase' => esc_html__( 'Upper Case', 'briddge-addon' ),
			'none' => esc_html__( 'None', 'briddge-addon' ),
			'unset' => esc_html__( 'Unset', 'briddge-addon' )
		);
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="wp-fonts-wrap">
			
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="wp-fonts-inner">
										 
					<div class="wp-fonts-fields">
						<ul class="wp-fonts-fields-list">
							<li>
								<span><?php esc_html_e( 'Font Family', 'briddge-addon' );?></span>
								<select class="wp-font-field wp-font-family-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][font_family]" data-val="<?php echo esc_attr( $font_family ); ?>">
								
								<?php
								$cf_names = get_option( 'briddge_custom_fonts' );
								if( !empty( $cf_names ) && is_array( $cf_names ) ){
								?>
									<option value="" class="bold-font"><?php esc_html_e( 'Custom Fonts', 'briddge-addon' ); ?></option>
								<?php
									foreach( $cf_names as $key => $font_name ){
										echo '<option value="'. esc_attr( $font_name ) .'" '. ( $font_family == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $font_name ) .'</option>';
									}
								}
								?>
								
									<option value="" class="bold-font"><?php esc_html_e( 'Standard Fonts', 'briddge-addon' ); ?></option>
								<?php
									foreach( $font_family_arr as $key => $font_family_attr ){
										echo '<option value="'. esc_attr( $key ) .'" '. ( $font_family == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $font_family_attr ) .'</option>';
									}
								?>
									<option value="google-fonts" class="bold-font"><?php esc_html_e( 'Google Fonts', 'briddge-addon' ); ?></option>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Font Weight &amp; Style', 'briddge-addon' ); ?></span>
								<select class="wp-font-field wp-font-weight-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][font_weight]" data-val="<?php echo esc_attr( $font_weight ); ?>">
									<option value=""><?php esc_html_e( 'Font Weight &amp; Style', 'briddge-addon' ); ?></option>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Font Subsets', 'briddge-addon' ); ?></span>
								<select class="wp-font-field wp-font-sub-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][font_sub]" data-val="<?php echo esc_attr( $font_sub ); ?>">
									<option value=""><?php esc_html_e( 'Font Subsets', 'briddge-addon' ); ?></option>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Text Align', 'briddge-addon' ); ?></span>
								<select class="wp-font-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][text_align]">
									<option value=""><?php esc_html_e( 'Text Align', 'briddge-addon' ); ?></option>
								<?php
									foreach( $text_align_arr as $key => $text_align_attr ){
										echo '<option value="'. esc_attr( $key ) .'" '. ( $text_align == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $text_align_attr ) .'</option>';
									}
								?>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Text Transform', 'briddge-addon' ); ?></span>
								<select class="wp-font-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][text_transform]">
									<option value=""><?php esc_html_e( 'Text Transform', 'briddge-addon' ); ?></option>
								<?php
									foreach( $text_trans_arr as $key => $text_trans_attr ){
										echo '<option value="'. esc_attr( $key ) .'" '. ( $text_transform == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $text_trans_attr ) .'</option>';
									}
								?>
								</select>
							</li>
							<li>	
								<span><?php esc_html_e( 'Font Size', 'briddge-addon' ); ?></span>						
								<input type="number" step="1" min="0" class="wp-font-field wp-font-size-field" value="<?php echo esc_attr( $font_size ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][font_size]" />
								<span class="wp-font-abs-units"><?php esc_html_e( 'px', 'briddge-addon' ); ?></span>		
							</li>
							<li>
								<span><?php esc_html_e( 'Line Height', 'briddge-addon' ); ?></span>
								<input type="number" step="1" min="-100" class="wp-font-field wp-font-line-height-field" value="<?php echo esc_attr( $line_height ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][line_height]" />
								<span class="wp-font-abs-units"><?php esc_html_e( 'px', 'briddge-addon' ); ?></span>
							</li>
							<li>
								<span><?php esc_html_e( 'Letter Spacing', 'briddge-addon' ); ?></span>
								<input type="number" step="1" min="-100" class="wp-font-field wp-font-letter-spacing-field" value="<?php echo esc_attr( $letter_spacing ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][letter_spacing]" />
								<span class="wp-font-abs-units"><?php esc_html_e( 'px', 'briddge-addon' ); ?></span>
							</li>
							<li>
								<span><?php esc_html_e( 'Font Color', 'briddge-addon' ); ?></span>
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $font_color ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][font_color]" data-alpha-enabled="<?php echo esc_attr( $alpha ); ?>" />
							</li>
						</ul>
					</div>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_button_color_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
				
		$lc_ele = $saved_val; 
		$lc_decond = $color_fore = $color_bg = $color_border = '';
		$color_hfore = $color_hbg = $color_hborder = '';
		if( $lc_ele ){
			$lc_decond = $lc_ele;
			if( is_array( $lc_decond ) && !empty( $lc_decond ) ){
				$color_fore = $lc_decond['fore'];
				$color_bg = $lc_decond['bg'];
				$color_border = $lc_decond['border'];
				$color_hfore = $lc_decond['hfore'];
				$color_hbg = $lc_decond['hbg'];
				$color_hborder = $lc_decond['hborder'];
			}
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="link-colors-wrap">
			
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="link-colors-inner">
					<ul class="link-colors-list">
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_fore ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][fore]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Fore Color', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_bg ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][bg]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Bg Color', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_border ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][border]" data-alpha-enabled="true" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Border Color', 'briddge-addon' ) ?></span>
						</li>
					</ul>
					<ul class="link-colors-list">
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_hfore ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][hfore]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover Fore Color', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_hbg ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][hbg]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover Bg Color', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_hborder ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][hborder]" data-alpha-enabled="true" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover Border Color', 'briddge-addon' ) ?></span>
						</li>
					</ul>					
				</div>			
			</div>
		</div>
	<?php
	}
	
	public static function build_link_color_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
				
		$lc_ele = $saved_val; 
		$lc_decond = $regular = $hover = $active = '';
		if( $lc_ele ){
			$lc_decond = $lc_ele;
			if( is_array( $lc_decond ) && !empty( $lc_decond ) ){
				$regular = $lc_decond['regular'];
				$hover = $lc_decond['hover'];
				$active = $lc_decond['active'];
			}
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="link-colors-wrap">
			
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="link-colors-inner">
					<ul class="link-colors-list">
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $regular ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][regular]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Regular', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $hover ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][hover]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover', 'briddge-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $active ); ?>" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][active]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Active', 'briddge-addon' ) ?></span>
						</li>
					</ul>					
				</div>			
			</div>
		</div>
	<?php
	}
	
	public static function build_multi_check_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$mc_ele = $saved_val; 
		$mc_items = isset( $config['items'] ) ? $config['items'] : '';;
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="multi-check-wrap">
				
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="multi-check-inner">
					<ul class="wp-multi-check-list">
					<?php
						if( $mc_items ){
							foreach( $mc_items as $key => $value ){
								$checked = !empty( $mc_ele ) && is_array( $mc_ele ) && in_array( $key, $mc_ele ) ? " checked" : "";
								echo '<li><input type="checkbox" name="briddge_options['. esc_attr( $field_id ) .'][]" value="'. esc_attr( $key ) .'" '. esc_attr( $checked ) .' /><label>'. esc_html( $value ) .'</label></li>';
							}
						}
					?>
					</ul>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_radio_image_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$ri_ele = $saved_val; 
		$ri_items = isset( $config['items'] ) ? $config['items'] : '';;
		$classes = isset( $config['cols'] ) && !empty( $config['cols'] ) ? ' image-col-'. $config['cols'] : ' image-col-3';
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" data-field-type="radio-image" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="radio-image-wrap<?php echo esc_attr( $classes ); ?>">
				
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="radio-image-inner">
					<ul class="wp-radio-image-list">
					<?php
						if( $ri_items ){
							foreach( $ri_items as $key => $img ){
								$checked = !empty( $ri_ele ) && $key == $ri_ele ? " checked" : "";
								echo '<li><input type="radio" name="briddge_options['. esc_attr( $field_id ) .']" value="'. esc_attr( $key ) .'" '. esc_attr( $checked ) .' /><span class="wp-radio-image-field"><img alt="'. esc_attr( $key ) .'" src="'. esc_url( $img['url'] ) .'" /></span><span class="wp-color-info">'. esc_html( $img['title'] ) .'</span></li>';
							}
						}
					?>
					</ul>					
				</div>
				<input type="hidden" class="briddge-control-hidden-val" value="<?php echo esc_attr( $ri_ele ); ?>" />
			</div>
		</div>
	<?php
	}
	
	public static function build_sidebars_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="dropdown-sidebars-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="dropdown-sidebars-inner">
					<select class="wp-dropdown-sidebars-list briddge-customizer-select-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>]" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]">
						<option value=""><?php esc_html_e( 'None', 'briddge-addon' ); ?></option>
					<?php
						$sidebars = $GLOBALS['wp_registered_sidebars'];
						if( $sidebars ){
							foreach( $sidebars as $sidebar ){
								echo '<option value="'. esc_attr( $sidebar['id'] ) .'" '. selected( $saved_val, $sidebar['id'] ) .'>'. esc_html( $sidebar['name'] ) .'</option>';
							}
						}
					?>
					</select>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_pages_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = stripslashes( $briddge_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="dropdown-pages-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="dropdown-pages-inner">
					<select class="wp-dropdown-pages-list briddge-customizer-page-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>]" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]">
						<option value=""><?php esc_html_e( 'None', 'briddge-addon' ); ?></option>
					<?php
						$pages = get_pages();
						if( $pages ){
							foreach( $pages as $page ){
								echo '<option value="'. esc_attr( $page->ID ) .'" '. selected( $saved_val, $page->ID ) .'>'. esc_html( $page->post_title ) .'</option>';
							}
						}
					?>
					</select>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_toggle_switch_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id] == 1 ? true : false;
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : 0;
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : 0;
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-field-type="checkbox" data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="checkbox_switch">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="briddge-switch">
					<input type="checkbox" class="onoffswitch-checkbox" <?php checked( $saved_val ); ?>>
					<span class="slider round"></span>
				</div>
				<input type="hidden" class="briddge-control-hidden-val" name="briddge_options[<?php echo esc_attr( $field_id ); ?>]" value="<?php echo esc_attr( $saved_val ); ?>">
			</div>
		</div>
	<?php
	}
	
	public static function build_height_weight_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		
		$only_dimension = isset( $config['only_dimension'] ) ? $config['only_dimension'] : 'both';
		
		$saved_val = '';
		if( isset( $briddge_options[$field_id] ) ){
			$saved_val = $briddge_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$hw_ele = $saved_val; 
		$dim_decond = $width = $height = '';
		if( $hw_ele ){
			$dim_decond = $hw_ele;
		}
		
		if( is_array( $dim_decond ) && !empty( $dim_decond ) ){
			$width = isset( $dim_decond['width'] ) ? $dim_decond['width'] : '';
			$height = isset( $dim_decond['height'] ) ? $dim_decond['height'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">

			<div class="width-height-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="width-height-inner">
				
					<div class="briddge-customizer-ajax-hid-wrap" data-key="<?php echo esc_attr( $field_id ); ?>">
						<?php if( $only_dimension == 'both' || $only_dimension == 'width' ) : ?>
							<input type="text" class="width-height-hid-text" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>][width]"  value="<?php echo esc_attr( $width ); ?>">
						<?php endif; ?>
						<?php if( $only_dimension == 'both' || $only_dimension == 'height' ) : ?>
							<input type="text" class="width-height-hid-text" data-key="<?php echo esc_attr( $field_id ); ?>" id="briddge_options[<?php echo esc_attr( $field_id ); ?>][height]" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][height]" value="<?php echo esc_attr( $height ); ?>">
						<?php endif; ?>
					</div>

					<ul class="wp-width-height-list">
						<?php if( $only_dimension == 'both' || $only_dimension == 'width' ) : ?>
							<li>
								<input type="number" class="wp-wh-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][width]" value="<?php echo esc_attr( $width ); ?>">
								<span class="wp-wh-info"><?php esc_html_e( 'Width', 'briddge-addon' ) ?></span>
							</li>
						<?php endif; ?>
						<?php if( $only_dimension == 'both' || $only_dimension == 'height' ) : ?>
						<li>
							<input type="number" class="wp-wh-field" name="briddge_options[<?php echo esc_attr( $field_id ); ?>][height]" value="<?php echo esc_attr( $height ); ?>">
							<span class="wp-wh-info"><?php esc_html_e( 'Height', 'briddge-addon' ) ?></span>
						</li>
						<?php endif; ?>
					</ul>					
				</div>
			</div>
			
		</div>
	<?php
	}
	
	public static function check_drag_drop_field_values( $dd_fields, $dd_default ){
		
		if( empty( $dd_fields ) ) return $dd_default;
				
		$dd_default_new = array(); $dd_fields_recreate = array();
		foreach( $dd_default as $key => $value ){
			if( !isset( $dd_fields[$key] ) ){
				$dd_fields_recreate[$key] = array();
			}else{
				$dd_fields_recreate[$key] = $dd_fields[$key];
			}
			foreach( $value as $field_key => $field_value ) $dd_default_new[$field_key] = $field_value;
		}
		
		$dd_fields_new = array();
		foreach( $dd_fields_recreate as $key => $value ){
			foreach( $value as $field_key => $field_value ) $dd_fields_new[$field_key] = $field_value;
		}
		
		$result = array_diff_assoc( $dd_default_new, $dd_fields_new ); 

		if( !empty( $result ) ){
			if( isset( $dd_fields_recreate['disabled'] ) ){
				foreach( $result as $key => $value ) $dd_fields_recreate['disabled'][$key] = $value;
			}
		}
		
		return $dd_fields_recreate;
	}
	
	public static function briddge_drag_drop_formation( $field_id, $part, $post_items, $html = false, $icons_only = false ) {
		if( $html ) $t_briddge_options = get_option( 'briddge_options' );
		$output = '<ul class="briddge-dd-items ui-sortable" data-part="'. esc_attr( $part ) .'">';
		if( !empty( $post_items ) ){
			foreach( $post_items as $key => $value ){
				$html_val = $value;
				if( $icons_only ){
					$html_val = '<i class="'. $value .'"></i>';
				}elseif( $html ){
					$custom_val = isset( $t_briddge_options[$field_id]['url'][$key] ) ? $t_briddge_options[$field_id]['url'][$key] : '';
					$html_val = '<i class="'. $value .'"></i>';
					$html_val .= '<div class="drag-drop-custom-value"><input type="text" name="briddge_options['. esc_attr( $field_id ) .'][url]['. esc_attr( $key ) .']" value="'. $custom_val .'" placeholder="'. esc_html__( 'Enter url', 'briddge-addon' ) .'" /></div>';					
				}else{
					$html_val = esc_attr( $value );
				}
				$output .= '<li data-id="'. esc_attr( $key ) .'" data-val="'. esc_attr( $key ) .'">'. $html_val .'<input type="hidden" class="dd-input" name="briddge_options['. esc_attr( $field_id ) .']['. esc_attr( $part ) .']['. esc_attr( $key ) .']" value="'. esc_attr( $value ) .'" /></li>';
			}
		}
		$output .= '</ul>';
		return $output;
	}
	
	public static function build_drag_drop_field( $config ){ 
		$briddge_options = self::$briddge_options;
		$field_id = $config['id'];
		$dd_parts = isset( $config['default'] ) ? $config['default'] : '';
		
		$dd_fields = '';
		if( isset( $briddge_options[$field_id] ) && !empty( $briddge_options[$field_id] ) ){
			$dd_fields = $briddge_options[$field_id];
		}else{
			$dd_fields = $dd_parts;
		}
		
		$dd_fields = self::check_drag_drop_field_values( $dd_fields, $config['default'] );
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' briddge-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="briddge-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="wp-drag-drop-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="wp-drag-drop-inner">
					<div class="wp-drag-drop-fields">
					<?php
						$part_array = $dd_fields;
						$t_part_array = array();
						$html = isset( $config['html'] ) ? $config['html'] : false;
						$icons_only = isset( $config['icons_only'] ) ? $config['icons_only'] : false;
						
						if( !empty( $part_array ) && is_array( $part_array ) ){
							foreach( $part_array as $key => $value ){
								$t_part_array[$key] = !empty( $dd_fields[$key] ) ? self::briddge_drag_drop_formation( $field_id, $key, $dd_fields[$key], $html, $icons_only ) : '<ul class="briddge-dd-items ui-sortable" data-part="'. esc_attr( $key ) .'"></ul>';
							}
				
							echo '<div class="meta-drag-drop-multi-field">';
							foreach( $t_part_array as $key => $value ){
								echo '<h4>'. esc_html( self::briddge_theme_option_strings( $key ) ) .'</h4>';
								echo ''. $value;
							}						
							echo '</div>';
						}
					?>
					</div>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_export_field( $config ){ 
	?>
		<div class="briddge-control">
			<div class="customize-exports-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="customize-exports-inner">
					<a href="#" class="button button-large button-primary btn-lg-button" id="customize-export-custom-btn" target="_blank"><?php esc_html_e( 'Export', 'briddge-addon' ); ?></a>
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_import_field( $config ){ 
	?>
		<div class="briddge-control">
			<div class="customize-imports-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="customize-imports-inner">
					<textarea class="customize-import-value-box" id="customize-import-value-box" rows="10"></textarea>
				</div>
				<a href="#" class="button button-large button-primary btn-lg-button" id="customize-import-custom-btn" target="_blank"><?php esc_html_e( 'Import', 'briddge-addon' ); ?></a>
			</div>
		</div>
	<?php
	}
		
	public static function briddge_put_section(){
		echo self::$tab_list;
	}
	
	public static function briddge_put_field(){
		echo self::$tab_content;
	}
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
}
Briddge_Options::instance();