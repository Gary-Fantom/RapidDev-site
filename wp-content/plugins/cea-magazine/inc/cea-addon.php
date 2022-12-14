<?php 

namespace Elementor;

/**
 * CEA Magazine Extension Class
 *
 * @since 1.0.0
 */
final class CEA_Magazine_Extension {

	private static $_instance = null;
	
	private static $shortcodes_list = array();
	 
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		
		//Call Classic Elementor Addons Shortcode and Scripts
		$this->init();
		
		//Shortcode enable/disable option hook
		add_action( 'cea_pt_shortcodes_enable', array( $this, 'cea_magazine_shortcodes_widgets' ), 30 );

	}

	public function init() {
		
		//Call elementor custom addons
		$this->cea_set_shortcodes();

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

	}
	
	public static function cea_magazine_shortcodes_widgets(){
	?>
		<div class="row">
			<div class="col-12">
				<div class="admin-box cea-main-box text-center">
					<h3><?php esc_html_e( 'Enable/Disable CEA Magazine widget here.', 'cea-post-types' ); ?></h3>
				</div><!-- .admin-box -->
			</div><!-- .col -->
		</div><!-- .row -->
	<?php		
		
		$shortcode_stat = self::$shortcodes_list;
		$cea_shortcodes = get_option('cea_shortcodes');
		$row = 1;
		foreach( $shortcode_stat as $key => $value ){
		
			$shortcode_name = str_replace( "-", "_", $key );
			if( !empty( $cea_shortcodes ) ){
				if( isset( $cea_shortcodes[$shortcode_name] ) ){
					$saved_val = 'on';
				}else{
					$saved_val = 'off';
				}
			}
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
	}
	
	public function cea_set_shortcodes(){
	
		$shortcode_stat = array(		
			'magazine'	=> esc_html__( 'CEA Post Magazine Widget', 'cea-post-types' )				
		);
				
		self::$shortcodes_list = $shortcode_stat;
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		$cea_shortcodes = get_option('cea_shortcodes');	
		$shortcode_name = 'magazine';
		
		if( !empty( $cea_shortcodes ) ){
			if( isset( $cea_shortcodes[$shortcode_name] ) ){
				$saved_val = true;
			}else{
				$saved_val = false;
			}
		}else{
			$saved_val = false;
		}
		
		if( $saved_val ){
			
			require_once( CEA_MGZN_CORE_DIR . 'widgets/blog-layouts.php' );
			Plugin::instance()->widgets_manager->register_widget_type( new CEA_Elementor_Blog_Layouts_Widget() );
			
		}
		
	}

}
CEA_Magazine_Extension::instance();