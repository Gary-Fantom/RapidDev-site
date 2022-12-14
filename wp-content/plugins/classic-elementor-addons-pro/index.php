<?php 
/*
	Plugin Name: Classic Addons for Elementor
	Plugin URI: http://zozothemes.com/
	Description: Classic addons plugin have 20+ massive widgets for Elementor page builder.
	Version: 1.0
	Author: zozothemes
	Author URI: http://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CEA_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CEA_CORE_URL', plugin_dir_url( __FILE__ ) );

if( ! class_exists('Classic_Elementor_Addon') ) {
	
	/*
	* Intialize and Sets up the plugin
	*/
	class Classic_Elementor_Addon {
			
		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

		/**
		 * Minimum PHP Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const MINIMUM_PHP_VERSION = '5.0';
        
		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Classic_Elementor_Addon The single instance of the class.
		 */
		private static $_instance = null;
		
        /**
        * Sets up needed actions/filters for the plug-in to initialize.
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function __construct() {
			
			// Check elementor status
			add_action( 'plugins_loaded', array( $this, 'cea_plugins_loaded' ) );
		
        }
		
		public function cea_plugins_loaded(){
			
			if( ! $this->is_compatible() ) return false;
			
			//Classic elementor addon shortcodes
            add_action( 'init', array( $this, 'init_addons' ), 20 );
						
			// Elementor init
			add_action('elementor/init', [ $this, 'add_hooks' ]);			
			
			$this->cea_ajax_calls();
			
			//Load text domain
            $this->load_domain();
			
		}
				
		public function is_compatible(){			
			
			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return false;
			}
			
			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return false;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return false;
			}
			
			return true;
			
		}
		
		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'cea' ),
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'cea' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'cea' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cea' ),
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'cea' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'cea' ) . '</strong>',
				 self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
				/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cea' ),
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'cea' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'cea' ) . '</strong>',
				 self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}
		
		public function add_hooks(){			
			// Custom css settings
			require_once ( CEA_CORE_DIR . 'inc/class.cea-pro-module.php' );			
		}
		
		public function cea_ajax_calls(){
			// CEA ajax calls
			require_once ( CEA_CORE_DIR . 'inc/class.cea-ajax-calls.php' );
		}
		
        /**
         * Load plugin translated strings using text domain
         * @since 2.6.8
         * @access public
         * @return void
         */
        public function load_domain() {
			load_plugin_textdomain('cea', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
        }
		
        
        /**
        * Load required file for addons integration
        * @return void
        */
        public function init_addons() {			
			require_once ( CEA_CORE_DIR . 'inc/cea-addon.php' );
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
    
    }
}

//Create/Call Classic Elementor Addon
Classic_Elementor_Addon::get_instance();

//Save Action Hook
register_activation_hook( __FILE__, 'classic_elementor_addon_plugin_activate' );
function classic_elementor_addon_plugin_activate(){
	require_once ( CEA_CORE_DIR . 'inc/cea-addon-styles.php' );
}