<?php
class Briddge_Theme_Styles {
   
   	public $briddge_options;
	private $exists_fonts = array();
	public static $briddge_gf_array = array();
   
    function __construct() {
		$this->briddge_options = get_option( 'briddge_options' );
    }

	function briddge_get_option($field){
		$briddge_options = $this->briddge_options;
		return isset( $briddge_options[$field] ) && $briddge_options[$field] != '' ? $briddge_options[$field] : '';
	}
	
	function briddge_dimension_settings($field, $property = 'width'){
		$briddge_options = $this->briddge_options;
		$units = 'px'; $dimension = '';
		if( isset( $briddge_options[$field] ) ){
			$units = isset( $briddge_options[$field]['units'] ) ? $briddge_options[$field]['units'] : $units;
			$dimension = isset( $briddge_options[$field][$property] ) && $briddge_options[$field][$property] != '' ? absint( $briddge_options[$field][$property] ) . $units : '';
		}
		return $dimension;
	}

	function briddge_image_settings($field){
		$briddge_options = $this->briddge_options;
		$img_arr = array(
			'id' => null,
			'url' => null
		);
		$image = isset( $briddge_options[$field] ) && isset( $briddge_options[$field]['image'] ) ? $briddge_options[$field]['image'] : '';
		if( !empty( $image ) ){
			$img_arr['id'] = isset( $image['id'] ) ? $image['id'] : null;
			$img_arr['url'] = isset( $image['url'] ) ? $image['url'] : null;
		}
		return $img_arr;
	}
	
	function briddge_border_settings($field, $class_names = null){
		$briddge_options = $this->briddge_options;

		if( isset( $briddge_options[$field] ) ):

			$stat = false;
			$position = array( 'top', 'right', 'bottom', 'left' );
			foreach( $position as $key ){
				if( isset( $briddge_options[$field][$key] ) && $briddge_options[$field][$key] != NULL && !$stat ) $stat = true;
			}
		
			$boder_style = isset( $briddge_options[$field]['style'] ) && $briddge_options[$field]['style'] != '' ? $briddge_options[$field]['style'] : '';
			$border_color = isset( $briddge_options[$field]['color'] ) && $briddge_options[$field]['color'] != '' ? $briddge_options[$field]['color'] : '';

			if( $class_names && $stat ) echo $class_names . ' {';
			
			if( isset( $briddge_options[$field]['top'] ) && $briddge_options[$field]['top'] != NULL ):
				echo 'border-top-width: '. $briddge_options[$field]['top'] .'px;';
				if( $boder_style ) echo 'border-top-style: '. $boder_style .';';
				if( $border_color ) echo 'border-top-color: '. $border_color .';';
			endif;
			
			if( isset( $briddge_options[$field]['right'] ) && $briddge_options[$field]['right'] != NULL ):
				echo 'border-right-width: '. $briddge_options[$field]['right'] .'px;';
				if( $boder_style ) echo 'border-right-style: '. $boder_style .';';
				if( $border_color ) echo 'border-right-color: '. $border_color .';';
			endif;
			
			if( isset( $briddge_options[$field]['bottom'] ) && $briddge_options[$field]['bottom'] != NULL ):
				echo 'border-bottom-width: '. $briddge_options[$field]['bottom'] .'px;';
				if( $boder_style ) echo 'border-bottom-style: '. $boder_style .';';
				if( $border_color ) echo 'border-bottom-color: '. $border_color .';';
			endif;
			
			if( isset( $briddge_options[$field]['left'] ) && $briddge_options[$field]['left'] != NULL ):
				echo 'border-left-width: '. $briddge_options[$field]['left'] .'px;';
				if( $boder_style ) echo 'border-left-style: '. $boder_style .';';
				if( $border_color ) echo 'border-left-color: '. $border_color .';';
			endif;

			if( $class_names && $stat ) echo '}';
			
		endif;
	}
	
	function briddge_padding_settings($field, $class_names = null){
		$briddge_options = $this->briddge_options;
		$stat = false;
		$position = array( 'top', 'right', 'bottom', 'left' );
		foreach( $position as $key ){
			if( isset( $briddge_options[$field][$key] ) && $briddge_options[$field][$key] != NULL && !$stat ) $stat = true;
		}
		if( isset( $briddge_options[$field] ) ):
			if( $class_names && $stat ) echo $class_names . ' {';	
			echo isset( $briddge_options[$field]['top'] ) && $briddge_options[$field]['top'] != NULL ? 'padding-top: '. $briddge_options[$field]['top'] .'px;' : '';
			echo isset( $briddge_options[$field]['right'] ) && $briddge_options[$field]['right'] != NULL ? 'padding-right: '. $briddge_options[$field]['right'] .'px;' : '';
			echo isset( $briddge_options[$field]['bottom'] ) && $briddge_options[$field]['bottom'] != NULL ? 'padding-bottom: '. $briddge_options[$field]['bottom'] .'px;' : '';
			echo isset( $briddge_options[$field]['left'] ) && $briddge_options[$field]['left'] != NULL ? 'padding-left: '. $briddge_options[$field]['left'] .'px;' : '';
			if( $class_names && $stat ) echo '}';
		endif;
	}
	
	function briddge_margin_settings($field, $class_names = null){
		$briddge_options = $this->briddge_options;
		$stat = false;
		$position = array( 'top', 'right', 'bottom', 'left' );
		foreach( $position as $key ){
			if( isset( $briddge_options[$field][$key] ) && $briddge_options[$field][$key] != NULL && !$stat ) $stat = true;
		}
		if( isset( $briddge_options[$field] ) ):	
			if( $class_names && $stat ) echo $class_names . ' {';	
			echo isset( $briddge_options[$field]['top'] ) && $briddge_options[$field]['top'] != NULL ? 'margin-top: '. $briddge_options[$field]['top'] .'px;' : '';
			echo isset( $briddge_options[$field]['right'] ) && $briddge_options[$field]['right'] != NULL ? 'margin-right: '. $briddge_options[$field]['right'] .'px;' : '';
			echo isset( $briddge_options[$field]['bottom'] ) && $briddge_options[$field]['bottom'] != NULL ? 'margin-bottom: '. $briddge_options[$field]['bottom'] .'px;' : '';
			echo isset( $briddge_options[$field]['left'] ) && $briddge_options[$field]['left'] != NULL ? 'margin-left: '. $briddge_options[$field]['left'] .'px;' : '';
			if( $class_names && $stat ) echo '}';
		endif;
	}

	function briddge_color($field, $class_names = null){
		$briddge_options = $this->briddge_options;
		if( isset( $briddge_options[$field] ) && $briddge_options[$field] != '' ) {
			if( $class_names ) echo esc_attr( $class_names ) . '{';
			echo 'color: '. $briddge_options[$field] .';';
			if( $class_names ) echo '}';
		}
	}
	
	function briddge_link_color($field, $fun, $class_names = null){
		$briddge_options = $this->briddge_options;
		if( isset( $briddge_options[$field][$fun] ) && $briddge_options[$field][$fun] != '' ) {
			if( $class_names ) echo esc_attr( $class_names ) . '{';
			echo 'color: '. $briddge_options[$field][$fun] .';';
			if( $class_names ) echo '}';
		}
	}
	
	function briddge_button_color($field, $fun, $class_names = null){
		$briddge_options = $this->briddge_options;
		if( isset( $briddge_options[$field][$fun] ) && $briddge_options[$field][$fun] != '' ) {
			if( $class_names ) echo esc_attr( $class_names ) . '{';
				switch( $fun ){
					case "hfore":
					case "fore":
						echo 'color: '. $briddge_options[$field][$fun] .';';
					break;
					case "hbg":
					case "bg":
						echo 'background-color: '. $briddge_options[$field][$fun] .';';
					break;
					case "hborder":
					case "border":
						echo 'border-color: '. $briddge_options[$field][$fun] .';';
					break;
				}
			if( $class_names ) echo '}';
		}
	}
		
	function briddge_bg_settings($field, $class_names = null){
		$briddge_options = $this->briddge_options;
		if( isset( $briddge_options[$field] ) ):

			$stat = false;
			$keys = array( 'bg_color', 'bg_repeat', 'bg_position', 'bg_size', 'bg_attachment' );
			foreach( $keys as $key ){
				if( isset( $briddge_options[$field][$key] ) && !empty( $briddge_options[$field][$key] ) && !$stat ) $stat = true;
			}
			if( isset( $briddge_options[$field]['image']['url'] ) && !empty( $briddge_options[$field]['image']['url'] ) && !$stat ) $stat = true;

			if( $class_names && $stat ) echo esc_attr( $class_names ) . '{';
			echo '
			'. ( isset( $briddge_options[$field]['bg_color'] ) && !empty( $briddge_options[$field]['bg_color'] ) ?  'background-color: '. $briddge_options[$field]['bg_color'] .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['image']['url'] ) && !empty( $briddge_options[$field]['image']['url'] ) ?  'background-image: url('. $briddge_options[$field]['image']['url'] .');' : '' ) .'
			'. ( isset( $briddge_options[$field]['bg_repeat'] ) && !empty( $briddge_options[$field]['bg_repeat'] ) ?  'background-repeat: '. $briddge_options[$field]['bg_repeat'] .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['bg_position'] ) && !empty( $briddge_options[$field]['bg_position'] ) ?  'background-position: '. $briddge_options[$field]['bg_position'] .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['bg_size'] ) && !empty( $briddge_options[$field]['bg_size'] ) ?  'background-size: '. $briddge_options[$field]['bg_size'] .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['bg_attachment'] ) && !empty( $briddge_options[$field]['bg_attachment'] ) ?  'background-attachment: '. $briddge_options[$field]['bg_attachment'] .';' : '' ) .'
			';
			if( $class_names && $stat ) echo '}';
		endif;
	}
	
	function briddge_custom_font_face_create( $font_family, $font_slug, $cf_names ){	
		$upload_dir = wp_upload_dir();
		$f_type = array('eot', 'otf', 'svg', 'ttf', 'woff');		
		$font_path = $upload_dir['baseurl'] . '/custom-fonts/' . str_replace( "'", "", $font_family .'/'. $font_slug );
		echo ' @font-face { font-family: '. $font_family .';';
		echo " src: url('". esc_url( $font_path ) .".eot') format('embedded-opentype'), url('". esc_url( $font_path ) .".woff2') format('woff2'), url('". esc_url( $font_path ) .".woff') format('woff'), url('". esc_url( $font_path ) .".ttf')  format('truetype'), url('". esc_url( $font_path ) .".svg') format('svg');}";		
	}
	
	function briddge_custom_font_check($field){
		$briddge_options = $this->briddge_options;
		$cf_names = get_option( 'briddge_custom_fonts' );
		$font_family = isset( $briddge_options[$field]['font_family'] ) ? $briddge_options[$field]['font_family'] : '';
		$font_slug = $font_family ? sanitize_title( $font_family ) : '';
		if ( !empty( $cf_names ) && is_array( $cf_names ) && array_key_exists( $font_slug, $cf_names ) ){	
			if ( !empty( $cf_names ) && !in_array( $font_slug, $this->exists_fonts ) ){
				$this->briddge_custom_font_face_create( $font_family, $font_slug, $cf_names );
				array_push( $this->exists_fonts, $briddge_options[$field]['font-family'] );
				return 1;
			}
		}
		return 0;
	}
	
	function briddge_get_custom_google_font_frame( $font_family ){	
		$family = isset( $font_family['family'] ) ? $font_family['family'] : '';
		$weight = isset( $font_family['weight'] ) ? $font_family['weight'] : '';
		$subset = isset( $font_family['subset'] ) ? $font_family['subset'] : '';		
		if( !empty( $family ) ){
			if( isset( self::$briddge_gf_array[$family] ) ){
				array_push( self::$briddge_gf_array[$family]['weight'], $weight );
				array_push( self::$briddge_gf_array[$family]['subset'], $subset );
			}else{
				self::$briddge_gf_array[$family] = array( 'weight' => array( $weight ), 'subset' => array( $subset ) );
			}
		}
	}
	
	function briddge_typo_generate($field){
		$briddge_options = $this->briddge_options;
		$font_family = isset( $briddge_options[$field]['font_family'] ) ? $briddge_options[$field]['font_family'] : '';
		$standard_fonts = Briddge_Google_Fonts_Function::$_standard_fonts;
		if( !array_key_exists( $font_family, $standard_fonts ) ){			
			$font_weight = isset( $briddge_options[$field]['font_weight'] ) && $briddge_options[$field]['font_weight'] != '' ? $briddge_options[$field]['font_weight'] : '';
			$font_sub = isset( $briddge_options[$field]['font_sub'] ) && $briddge_options[$field]['font_sub'] != '' ? $briddge_options[$field]['font_sub'] : '';
			$gf_arr = array( 'family' => $font_family, 'weight' => $font_weight, 'subset' => $font_sub );	
			$this->briddge_get_custom_google_font_frame( $gf_arr );
		}
	}
	
	function briddge_typo_settings($field, $class_names = null){
		
		//Custom font check and google font generate
		$cf_stat = $this->briddge_custom_font_check($field);
		if( !$cf_stat ) $this->briddge_typo_generate($field);		
		$briddge_options = $this->briddge_options;
		if( isset( $briddge_options[$field] ) ):

			$stat = false;
			$keys = array( 'font_color', 'font_family', 'font_weight', 'font_style', 'font_size', 'line_height', 'letter_spacing', 'text_align', 'text_transform' );
			foreach( $keys as $key ){
				if( isset( $briddge_options[$field][$key] ) && !empty( $briddge_options[$field][$key] ) && !$stat ) $stat = true;
			}
			echo $class_names && $stat ? esc_attr( $class_names ) . '{' : '';
			
			$font_weight = isset( $briddge_options[$field]['font_weight'] ) ? $briddge_options[$field]['font_weight'] : '';
			$font_style = '';
			if( !empty( $font_weight ) && strpos( $font_weight, 'italic' ) ){
				$font_style = 'italic';
				$font_weight = str_replace( 'italic', '', $font_weight );
			}

			echo '
			'. ( isset( $briddge_options[$field]['font_color'] ) && $briddge_options[$field]['font_color'] != '' ?  'color: '. $briddge_options[$field]['font_color'] .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['font_family'] ) && $briddge_options[$field]['font_family'] != '' ?  'font-family: '. stripslashes_deep( $briddge_options[$field]['font_family'] ) .';' : '' ) .'
			'. ( $font_weight ?  'font-weight: '. $font_weight .';' : '' ) .'
			'. ( $font_style ?  'font-style: '. $font_style .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['font_size'] ) && $briddge_options[$field]['font_size'] != '' ?  'font-size: '. $briddge_options[$field]['font_size'] .'px;' : '' ) .'
			'. ( isset( $briddge_options[$field]['line_height'] ) && $briddge_options[$field]['line_height'] != '' ?  'line-height: '. $briddge_options[$field]['line_height'] .'px;' : '' ) .'
			'. ( isset( $briddge_options[$field]['letter_spacing'] ) && $briddge_options[$field]['letter_spacing'] != '' ?  'letter-spacing: '. $briddge_options[$field]['letter_spacing'] .'px;' : '' ) .'
			'. ( isset( $briddge_options[$field]['text_align'] ) && $briddge_options[$field]['text_align'] != '' ?  'text-align: '. $briddge_options[$field]['text_align'] .';' : '' ) .'
			'. ( isset( $briddge_options[$field]['text_transform'] ) && $briddge_options[$field]['text_transform'] != '' ?  'text-transform: '. $briddge_options[$field]['text_transform'] .';' : '' ) .'
			';
		endif;
		echo $class_names && $stat ? '}' : '';
	}
	
	function briddge_hex2rgba($color, $opacity = 1) {
	 
		$default = '';
		//Return default if no color provided
		if(empty($color))
			  return $default; 
		//Sanitize $color if "#" is provided 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
			//Check if color has 6 or 3 characters and get values
			if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}
			//Convert hexadec to rgb
			$rgb =  array_map('hexdec', $hex);
	 
			//Check if opacity is set(rgba or rgb)
			if( $opacity == 'none' ){
				$output = implode(",",$rgb);
			}elseif( $opacity ){
				if(abs($opacity) > 1)
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			}else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
			//Return rgb(a) color string
			return $output;
	}

}