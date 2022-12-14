<?php 
/*
	Plugin Name: Briddge Addon
	Plugin URI: https://zozothemes.com/
	Description: This is addon for Briddge theme.
	Version: 1.0.1
	Author: zozothemes
	Author URI: https://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// check theme 
$cur_theme = wp_get_theme();	
$token = get_option( 'verified_token' );
if( $cur_theme->get( 'Name' ) != 'Briddge' && $cur_theme->get( 'Name' ) != 'Briddge Child' ){
	return;
}
// check token
if( empty( $token ) ) return;

define( 'BRIDDGE_ADDON_DIR', plugin_dir_path( __FILE__ ) );
define( 'BRIDDGE_ADDON_URL', plugin_dir_url( __FILE__ ) );

/*
* Intialize and Sets up the plugin
*/
class Briddge_Addon {
	
	private static $_instance = null;
		
	/**
	* Sets up needed actions/filters for the plug-in to initialize.
	* @since 1.0.0
	* @access public
	* @return void
	*/
	public function __construct() {

		//$this->briddge_template_direct();

		// Get option
		$this->briddge_get_option_class();

		//Briddge addon setup page
		add_action('plugins_loaded', array( $this, 'briddge_elementor_addon_setup') );
		
		//Briddge addon shortcodes
		if( is_admin() ) add_action( 'init', array( $this, 'init_addons' ), 20 );
		
		add_action( 'init', array( $this, 'init_front_addons' ), 10 );

		//Create cuatom sidebars
		add_action( 'widgets_init', array( $this, 'briddge_sidebar_registration' ), 1 );
		
		//Connect all widgets
		$this->briddge_register_widgets();
		
		//Call all widgets
		add_action( 'widgets_init', array( $this, 'briddge_init_widgets' ), 1 );
		
		//WP actions
		$this->briddge_wp_action_setup();		

		//Custom functions
		$this->briddge_custom_functions_setup();
		
		//WP admin tool bar menu
		add_action( 'admin_bar_menu', array( $this, 'briddge_add_toolbar_items' ), 100 );
		
	}
	
	/**
	* Installs translation text domain and checks if Elementor is installed
	* @since 1.0.0
	* @access public
	* @return void
	*/
	public function briddge_elementor_addon_setup() {
		//Load text domain
		$this->load_domain();
	}
	
	/**
	 * Load plugin translated strings using text domain
	 * @since 2.6.8
	 * @access public
	 * @return void
	 */
	public function load_domain() {
		load_plugin_textdomain( 'briddge-addon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	public function briddge_template_direct(){
		/**
		* Maintenance or coming soon mode
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'maintenance/maintenance.php' );
	}

	public function briddge_get_option_class(){
		/**
		* Gte Theme options class
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'inc/class.theme-options.php' );

		/**
		* Maintenance or coming soon mode
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'maintenance/maintenance.php' );
	}
	
	
	/**
	* Load required file for addons integration
	* @return void
	*/
	public function init_addons() {
		
		/**
		* Plugin options class
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/class.plugin-options.php' );

		/**
		* Post/Page options class
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/metabox/class.meta-box.php' );
		
		/**
		* Custom sidebar class
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/class.custom-sidebars.php' );
		
		/**
		* Custom fonts class
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/class.custom-fonts.php' );
		
		/**
		* Demo importer class
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/demo-importer/class.demo-importer.php' );

		$menu_type = Briddge_Theme_Option::briddge_options('menu-type');
		if( $menu_type == 'mega' ){
			require_once ( BRIDDGE_ADDON_DIR . 'admin/extension/mega-menu/custom_menu.php' );
		}
				
	}

	public function init_front_addons(){
		$menu_type = Briddge_Theme_Option::briddge_options('menu-type');
		if( $menu_type == 'mega' ){
			require_once ( BRIDDGE_ADDON_DIR . 'inc/class.mega-menu.php' );
		}
	}
	
	public function briddge_wp_action_setup(){
		
		/**
		* Wp actions
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'inc/wp-actions.php' );
		
	}

	public function briddge_sidebar_registration(){
		/**
		* Wp actions
		*/
		require_once ( BRIDDGE_ADDON_DIR . 'inc/class.widgets-register.php' );		
	}

	public function briddge_register_widgets(){
		foreach ( glob( BRIDDGE_ADDON_DIR . "widgets/*.php" ) as $filename) {
			include $filename;
		}
	}
	
	public function briddge_init_widgets(){
		//Call all widgets
		register_widget( 'briddge_about_widget' );
		register_widget( 'briddge_author_widget' );
		register_widget( 'briddge_contact_infos_widget' );
		register_widget( 'briddge_latest_post_widget' );
		register_widget( 'briddge_mailchimp_widget' );
		register_widget( 'briddge_popular_post_widget' );
		register_widget( 'briddge_social_widget' );
		register_widget( 'briddge_advance_tab_post_widget' );
	}

	public function briddge_custom_functions_setup(){

		require_once ( BRIDDGE_ADDON_DIR . 'inc/class.custom-functions.php' );	
		
		/**
		 * Detect plugin. For frontend only.
		 */
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		//Woo function
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			require_once ( BRIDDGE_ADDON_DIR . 'inc/woo-functions.php' );	
		}
		
	}
	
	public function briddge_add_toolbar_items($admin_bar){
		$admin_bar->add_menu( array(
			'id'    => 'briddge-options',
			'title' => 'Briddge Options',
			'href'  => admin_url( 'admin.php?page=briddge-options' ),
			'meta'  => array(
				'title' => esc_html__( 'Briddge Options', 'briddge-addon' ),            
			),
		));
	}
	
	/**
	 * Creates and returns an instance of the class
	 * @since 2.6.8
	 * @access public
	 * return object
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Briddge_Addon::get_instance();