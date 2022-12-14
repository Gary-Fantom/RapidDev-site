<?php
/**
 * The Class.
 */
class briddge_meta_box {

    private static $_instance = null;
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );

        add_action( 'admin_enqueue_scripts', array( $this, 'briddge_post_options_admin_scripts' ) );
    }

    public function briddge_post_options_admin_scripts(){
        wp_register_style( 'briddge-theme-options', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/css/theme-options.css', array(), '1.0', 'all' );			
        wp_register_style( 'briddge_theme_options_css', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/css/theme-options.css' );
        wp_register_script( 'wp-color-picker-alpha', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/js/wp-color-picker-alpha.min.js', array( 'jquery', 'wp-color-picker' ), '3.0.0' );
        wp_register_script( 'briddge_theme_options_js', BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/js/theme-options.js' );
    }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'post', 'page' );
 
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'briddge_metabox',
                esc_html__( 'Briddge Options', 'textdomain' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'advanced',
                'high'
            );
        }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
 
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if ( ! isset( $_POST['briddge_metabox_security'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['briddge_metabox_security'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'briddge_metabox_nonce_*&%$' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        //if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        /*} else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }*/
 
        /* OK, it's safe for us to save the data now. */
 
        // Sanitize the user input.
        $post_data = $_POST['briddge_options'];
 
        // Update the meta field.
        update_post_meta( $post_id, 'briddge_post_meta', $post_data );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        wp_enqueue_style( 'briddge-theme-options' );
        wp_enqueue_media();
        wp_enqueue_style( 'briddge_theme_options_css' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker-alpha' );
        wp_enqueue_script( 'briddge_theme_options_js' );
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'briddge_metabox_nonce_*&%$', 'briddge_metabox_security' );
        
        /*
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, 'briddge_post_meta_value', true );
 
        // Display the form, using the current value.
        ?>
        <label for="myplugin_new_field">
            <?php _e( 'Description for this field', 'textdomain' ); ?>
        </label>
        <input type="text" id="myplugin_new_field" name="briddge_post_meta_value" value="<?php echo esc_attr( $value ); ?>" size="25" />
        <?php
        */

        if( !class_exists( 'Briddge_Options' ) ) require_once( BRIDDGE_ADDON_DIR . 'admin/extension/theme-options/framework.php' );
        require_once( BRIDDGE_ADDON_DIR . 'admin/extension/metabox/meta-config.php' );

        ?>
        <div class="briddge-settings-wrap">
        <div class="briddge-inner-wrap">
        <div class="briddge-admin-content-wrap">
                <?php wp_nonce_field( 'briddge_theme_options*&^&*$', 'save_briddge_theme_options' ); ?>
                <div class="briddge-tab">
                    <div class="briddge-tab-list">
                        <ul class="tablinks-list">
                            <?php Briddge_Options::briddge_put_section(); ?>
                        </ul>
                    </div><!-- .briddge-tab-list -->
                    
                    <?php Briddge_Options::briddge_put_field(); ?>
                    
                </div><!-- .briddge-tab -->							
        </div><!-- .briddge-admin-content-wrap -->
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

}
briddge_meta_box::get_instance();