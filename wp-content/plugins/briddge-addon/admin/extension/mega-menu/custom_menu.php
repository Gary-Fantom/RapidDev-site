<?php

class briddge_custom_menu {
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	 
	private $mega_fields;
	 
	function __construct() {
		// load the plugin translation files
		
		add_action( 'admin_enqueue_scripts', array( $this, 'briddge_menu_enqueue_scripts' ) );
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'briddge_add_custom_nav_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'briddge_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'briddge_edit_walker'), 10, 2 );
		
	} // end constructor
	
	
	/**
	 * Register Megamenu stylesheets and scripts		
	 */
	function briddge_menu_enqueue_scripts( $hook ) {
		// style/scripts
		if ( 'nav-menus.php' == $hook ) {
			wp_enqueue_style( 'magnific-popup', BRIDDGE_ADDON_URL . 'admin/extension/mega-menu/css/magnific-popup.css', '1.1.0');
			wp_enqueue_style( 'briddge-megamenu', BRIDDGE_ADDON_URL . 'admin/extension/mega-menu/css/megamenu.css', '1.0');
			wp_enqueue_style( 'themify-icons', BRIDDGE_ADDON_URL . 'assets/css/themify-icons.css', '1.0');
			wp_enqueue_script( 'magnific-popup', BRIDDGE_ADDON_URL . 'admin/extension/mega-menu/js/jquery.magnific-popup.min.js' , array( 'jquery' ), '1.1.0', true );
			wp_enqueue_script( 'briddge-megamenu', BRIDDGE_ADDON_URL . 'admin/extension/mega-menu/js/megamenu.js' , array( 'jquery' ), '1.0', true );

			$menu_icons = $this->briddge_menu_ti_icons();
			
			wp_localize_script( 'briddge-megamenu', 'briddge_object', array( 'icons' => $menu_icons ) );

			do_action( 'briddge_connect_fonts_css_menu_page' );

			add_action( 'admin_footer', array( $this, 'admin_footer_custom' ), 10 );
		}
	}

	public function admin_footer_custom(){
	?>
	<form id="briddge-general-settings-form" class="mfp-hide white-popup-block">
		<h1><?php esc_html_e( 'Briddge General Menu Item Settings', 'briddge-addon' ); ?></h1>
		<fieldset>			
			<p class="briddge-menu-icon-wrap">
				<label><?php esc_html_e( 'Choose Menu Item Icon', 'briddge-addon' ); ?></label>
				<select class="briddge-menu-icons">
					<option value=""><?php esc_html_e( 'None', 'briddge-addon' ); ?></option>
				</select>
			</p>
			<p class="briddge-megamenu-wrap">
				<label><?php esc_html_e( 'Enable Megamenu', 'briddge-addon' ); ?> <input type="checkbox" class="briddge-megamenu-option"></label>
			</p>
			<p class="briddge-megamenu-col-wrap">
				<label><?php esc_html_e( 'Megamenu Column', 'briddge-addon' ); ?></label>
				<select class="briddge-megamenu-col">
					<option value="12"><?php esc_html_e( '1/1', 'briddge-addon' ); ?></option>
					<option value="6"><?php esc_html_e( '1/2', 'briddge-addon' ); ?></option>
					<option value="4"><?php esc_html_e( '1/3', 'briddge-addon' ); ?></option>
					<option value="3"><?php esc_html_e( '1/4', 'briddge-addon' ); ?></option>
					<option value="2"><?php esc_html_e( '1/6', 'briddge-addon' ); ?></option>
				</select>
			</p>
			<p class="briddge-megamenu-widget-wrap">
				<label><?php esc_html_e( 'Megamenu Item Widget', 'briddge-addon' ); ?></label>
				<select class="briddge-megamenu-widget">
					<option value=""><?php esc_html_e( 'Choose Widget', 'briddge-addon' ); ?></option>
					<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
							<option value="<?php echo ucwords( $sidebar['id'] ); ?>">
							<?php echo ucwords( $sidebar['name'] ); ?>
							</option>
					<?php } ?>
				</select>
			</p>
		</fieldset>
	</form>
	<?php
	}

	public function briddge_menu_ti_icons(){
		$pattern = '/\.(ti-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$icon_css_path = BRIDDGE_ADDON_URL . 'assets/css/themify-icons.css';  
			
		$response = wp_remote_get( $icon_css_path );
		if( is_array($response) ) {
			$file = $response['body']; // use the content
		}
		preg_match_all($pattern, $file, $str, PREG_SET_ORDER);
		return $str;
	}
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function briddge_add_custom_nav_fields( $menu_item ) {
	
		$menu_item->briddgemenu = get_post_meta( $menu_item->ID, '_menu_item_briddgemenu', true );	
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function briddge_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
		$opt_value = isset( $_REQUEST['menu-item-briddgemenu'][$menu_item_db_id] ) ? $_REQUEST['menu-item-briddgemenu'][$menu_item_db_id] : '' ;
		update_post_meta( $menu_item_db_id, '_menu_item_briddgemenu', $opt_value );
    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function briddge_edit_walker($walker,$menu_id) {
	
	    require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/mega-menu/class-walker-nav-menu-edit.php' );
		return 'Briddge_Walker_Nav_Menu_Edit';
	    
	}
	
}
$briddge_cm = new briddge_custom_menu();