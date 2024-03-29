<?php 

/*
 * CEA Custom Post Types Class
 */

class CEACPT { 
	
	public $cea_options;
	public $cea_shortcodes;
	public $cpt_slug;
	public $cpt_category_slug;
	public $cpt_tag_slug;
	
	public $cpt_array;
	
	private static $_instance = null;
	
	function __construct(){
		$this->cea_options = get_option( 'cea_options' );
		$this->cpt_array =  array( 'portfolio' => esc_html__( 'Portfolio', 'cea' ), 'team' => esc_html__( 'Team', 'cea' ), 'testimonial' => esc_html__( 'Testimonial', 'cea' ), 'event' => esc_html__( 'Events', 'cea' ), 'service' => esc_html__( 'Services', 'cea' ) );
		
		//register post types
		$this->ceaCPTReadyRegister();
		
	}
	
	public function ceaGetThemeOpt( $field ){
		$cea_options = $this->cea_options;
		return isset( $cea_options[$field] ) && $cea_options[$field] != '' ? $cea_options[$field] : '';
	}
	
	public function ceaCPTReadyRegister(){
		$cpt_opts = array();
		$cpt_all = $this->cpt_array;
	
		$cea_shortcodes = get_option( 'cea_shortcodes' );
		if( !empty( $cea_shortcodes ) ){
			if( isset( $cea_shortcodes['portfolio'] ) ) array_push( $cpt_opts, 'portfolio' );
			if( isset( $cea_shortcodes['team'] ) ) array_push( $cpt_opts, 'team' );
			if( isset( $cea_shortcodes['event'] ) ) array_push( $cpt_opts, 'event' );
			if( isset( $cea_shortcodes['service'] ) ) array_push( $cpt_opts, 'service' );
			if( isset( $cea_shortcodes['testimonial'] ) ) array_push( $cpt_opts, 'testimonial' );
		}
		//$cpt_opts = array( 'portfolio', 'team', 'event', 'service', 'testimonial' );
		
		$cat_needs = array( 'portfolio' );
		$tag_needs = array();
	
		if( !empty( $cpt_opts ) ){
			foreach( $cpt_opts as $cpt ){
				
				if( !isset( $cpt_all[$cpt] ) ) continue;
				
				// CPT Register
				$cpt_args = $this->ceaCPTRegister( $cpt_all[$cpt], $cpt );
				if( ! post_type_exists('cea-'.$cpt) ) {
					register_post_type( 'cea-'.$cpt, $cpt_args );
				}
				
				if( in_array( $cpt, $cat_needs ) ){
					// CPT Category Register
					$cpt_category_args = $this->ceaCPTCategoryRegister( $cpt_all[$cpt], $cpt );
					if( ! taxonomy_exists( $cpt.'-categories' ) ) {
						register_taxonomy( $cpt.'-categories', 'cea-'.$cpt, $cpt_category_args );
					}
				}
				if( in_array( $cpt, $tag_needs ) ){
					// CPT Tag Register
					$cpt_tag_args = $this->ceaCPTTagRegister( $cpt_all[$cpt], $cpt );
					if( ! taxonomy_exists( $cpt.'-tags' ) ) {
						register_taxonomy( $cpt.'-tags', 'cea-'.$cpt, $cpt_tag_args );
					}
				} //  if tax needs
	
			}
		}// if !empty $cpt_opts 
	}
	
	public function ceaCPTRegister( $cpt, $cpt_slug ){
		
		$cpt_labels = $this->ceaCPTLabels( $cpt );
		$cpt_theme_slug = $this->ceaGetThemeOpt( 'cpt-'. $cpt_slug .'-slug' );
		$has_arch = $cpt_slug == 'portfolio' ? true : false;
		$cpt_args = array(
			'labels' 				=> $cpt_labels,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true,
			'show_in_menu'       	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> array( 'with_front' => false, 'slug' => $cpt_theme_slug ),
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'has_archive' 			=> $has_arch,
			'exclude_from_search' 	=> true,
			'supports' 				=> array( 'title', 'thumbnail', 'excerpt', 'editor' )
		);
		
		return $cpt_args;
	}
	
	public function ceaCPTCategoryRegister( $cpt, $cpt_slug ){
		$cpt_labels = $this->ceaCPTCategoryLabels( $cpt );
		$cpt_theme_cat_slug = $this->ceaGetThemeOpt( 'cpt-'. $cpt_slug .'-category-slug' );
		
		$cpt_category_args = array(
			'hierarchical'      	=> true,
			'labels'            	=> $cpt_labels,
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'show_in_nav_menus' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'with_front' => false, 'slug' => $cpt_theme_cat_slug ),
		);	
		
		return $cpt_category_args;	
	}
	
	public function ceaCPTTagRegister( $cpt, $cpt_slug ){
		
		$cpt_labels = $this->ceaCPTTagLabels( $cpt );
		$cpt_theme_tag_slug = $this->ceaGetThemeOpt( 'cpt-'. $cpt_slug .'-tag-slug' );
		
		$cpt_tag_args = array(
			'hierarchical'      	=> true,
			'labels'            	=> $cpt_labels,
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'show_in_nav_menus' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'with_front' => false, 'slug' => $cpt_theme_tag_slug ),
		);	
		
		return $cpt_tag_args;
	}
	
	public function ceaCPTLabels( $cpt_name ){
		$cpt_labels = array(
			'name' 					=> sprintf( esc_html__( '%1$s', 'cea' ), $cpt_name ),
			'singular_name' 		=> sprintf( esc_html__( '%1$s', 'cea' ), $cpt_name ),
			'add_new' 				=> esc_html__( 'Add New', 'cea' ),
			'add_new_item' 			=> sprintf( esc_html__( 'Add New %1$s', 'cea' ), $cpt_name ),
			'edit_item' 			=> sprintf( esc_html__( 'Edit %1$s', 'cea' ), $cpt_name ),
			'new_item' 				=> sprintf( esc_html__( 'New %1$s', 'cea' ), $cpt_name ),
			'all_items' 			=> sprintf( esc_html__( '%1$s', 'cea' ), $cpt_name ),
			'view_item' 			=> sprintf( esc_html__( 'View %1$s', 'cea' ), $cpt_name ),
			'search_items' 			=> sprintf( esc_html__( 'Search %1$s', 'cea' ), $cpt_name ),
			'not_found' 			=> sprintf( esc_html__( 'No %1$s found', 'cea' ), $cpt_name ),
			'not_found_in_trash' 	=> sprintf( esc_html__( 'No %1$s found in Trash', 'cea' ), $cpt_name ),
			'parent_item_colon' 	=> ''
		);
		
		return $cpt_labels;
	}
	
	public function ceaCPTCategoryLabels( $cpt_name ){
		$cpt_category_labels = array(
			'name'              	=> sprintf( esc_html__( '%1$s Categories', 'cea' ), $cpt_name ),
			'singular_name'     	=> esc_html__( 'Category', 'cea' ),
			'search_items'      	=> esc_html__( 'Search Categories', 'cea' ),
			'all_items'         	=> esc_html__( 'All Categories', 'cea' ),
			'parent_item'       	=> esc_html__( 'Parent Category', 'cea' ),
			'parent_item_colon' 	=> esc_html__( 'Parent Category:', 'cea' ),
			'edit_item'         	=> esc_html__( 'Edit Category', 'cea' ),
			'update_item'       	=> esc_html__( 'Update Category', 'cea' ),
			'add_new_item'      	=> esc_html__( 'Add New Category', 'cea' ),
			'new_item_name'     	=> esc_html__( 'New Category Name', 'cea' ),
			'menu_name'         	=> esc_html__( 'Categories', 'cea' ),
		);

		return $cpt_category_labels;
	}
	
	public function ceaCPTTagLabels( $cpt_name ){
		$cpt_tags_labels = array(
			'name'              	=> sprintf( esc_html__( '%1$s Tags', 'cea' ), $cpt_name ),
			'singular_name'     	=> esc_html__( 'Tag', 'cea' ),
			'search_items'      	=> esc_html__( 'Search Tags', 'cea' ),
			'all_items'         	=> esc_html__( 'All Tags', 'cea' ),
			'parent_item'       	=> esc_html__( 'Parent Tag', 'cea' ),
			'parent_item_colon' 	=> esc_html__( 'Parent Tag:', 'cea' ),
			'edit_item'         	=> esc_html__( 'Edit Tag', 'cea' ),
			'update_item'       	=> esc_html__( 'Update Tag', 'cea' ),
			'add_new_item'      	=> esc_html__( 'Add New Tag', 'cea' ),
			'new_item_name'     	=> esc_html__( 'New Tag Name', 'cea' ),
			'menu_name'         	=> esc_html__( 'Tags', 'cea' ),
		);
		
		return $cpt_tags_labels;
	}
	
	/**
	 * Creates and returns an instance of the class
	 * @since 1.0
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
CEACPT::get_instance();