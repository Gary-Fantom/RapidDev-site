<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;

/**
 * Classic Elementor Addon Posts Widget
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Posts_Widget extends Widget_Base {
	
	private $excerpt_len;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Posts widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaposts";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Posts widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Posts", "cea" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Posts widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-cta-center";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Posts widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "classic-elements" ];
	}
	
	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'owl-carousel', 'imagesloaded', 'infinite-scroll', 'isotope', 'cea-custom-front' ];
	}
	
	public function get_style_depends() {
		return [ 'owl-carousel' ];
	}

	/**
	 * Register Posts widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
			
		//get authors
		$authors = Cea_Post_Helper::cea_get_authors();
		
		//get categories
		$categories = Cea_Post_Helper::cea_get_categories();
		
		//get tags
		$tags = Cea_Post_Helper::cea_get_tags();
		
		//get post titles
		$post_titles = Cea_Post_Helper::cea_get_post_titles();
		
		//orderby options
		$order_by = Cea_Post_Helper::cea_get_post_orderby_options();
		
		//Query Section
		$this->start_controls_section(
			"query_section",
			[
				"label"	=> esc_html__( "Query", "cea" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Posts query options.", "cea" ),
			]
		);
		
		$this->add_control(
			'include_author',
			[
				'label' 		=> esc_html__( 'Author', 'cea' ),
				"description"	=> esc_html__( "This is filter author posts.", "cea" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $authors,
				'default' 		=> '',
			]
		);
		
		$this->add_control(
			'include_cats',
			[
				'label' 		=> esc_html__( 'Categories', 'cea' ),
				"description"	=> esc_html__( "This is filter categories. Enter and select which categories you want. If you don't want top filter, then leave this empty.", "cea" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $categories,
				'default' 		=> ''
			]
		);
		$this->add_control(
			'exclude_cats',
			[
				'label' 		=> esc_html__( 'Exclude Categories', 'cea' ),
				"description"	=> esc_html__( "Here you can mention unwanted categories", "cea" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $categories,
				'default' 		=> ''
			]
		);
		$this->add_control(
			'include_tags',
			[
				'label' 		=> esc_html__( 'Tags', 'cea' ),
				"description"	=> esc_html__( "This is filter tags. Enter and select which tags you want.", "cea" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $tags,
				'default' 		=> ''
			]
		);
		$this->add_control(
			'include_posts',
			[
				'label' 		=> esc_html__( 'Include', 'cea' ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $post_titles,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'exclude_posts',
			[
				'label' 		=> esc_html__( 'Exclude', 'cea' ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $post_titles,
				'default' 		=> '',
			]
		);
		$this->add_control(
			"post_per_page",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Post Per Page", "cea" ),
				"description"	=> esc_html__( "Here you can define post limits per page. Example 10", "cea" ),
				"default" 		=> "10",
				"placeholder"	=> "10"
			]
		);
		$this->add_control(
			'orderby',
			[
				'label' 		=> esc_html__( 'Order By', 'cea' ),
				'type' 			=> Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' 		=> $order_by,
				'default' 		=> 'none',
			]
		);
		$this->add_control(
			'order',
			[
				'label' 		=> esc_html__( 'Order', 'cea' ),
				'type' 			=> Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
				'default' 		=> 'desc',
			]
		);		
		$this->end_controls_section();
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Post layout options here available.", "cea" ),
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'cea' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'cea' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'cea' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'cea' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blog-wrapper .blog-inner' => 'text-align: {{VALUE}};',
				],
			]
		);		
		$this->add_control(
			"excerpt_length",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Excerpt Length", "cea" ),
				"description"	=> esc_html__( "Here you can define post excerpt length. Example 10", "cea" ),
				"default" 		=> "15"
			]
		);
		$this->add_control(
			"blog_layout",
			[
				"label"			=> esc_html__( "Post Layout", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"		=> esc_html__( "Default", "cea" ),
					"classic"		=> esc_html__( "Classic", "cea" ),
					"modern"		=> esc_html__( "Modern", "cea" ),
					"classic-pro"		=> esc_html__( "Classic Pro", "cea" ),
					"list"	=> esc_html__( "List", "cea" ),
				]
			]
		);
		$this->add_control(
			"blog_cols",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Post Columns", "cea" ),
				"description"	=> esc_html__( "This is option for blog columns.", "cea" ),
				"default"		=> "6",
				"options"		=> [
					"3"			=> esc_html__( "4 Columns", "cea" ),
					"4"			=> esc_html__( "3 Columns", "cea" ),
					"6"			=> esc_html__( "2 Columns", "cea" ),
					"12"		=> esc_html__( "1 Column", "cea" )
				]
			]
		);
		$this->add_control(
			"more_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Read More Text", "cea" ),
				"description"	=> esc_html__( "Here you can enter read more text instead of default text.", "cea" ),
				"default" 		=> esc_html__( "Read More", "cea" )
			]
		);		
		$this->add_control(
			"blog_masonry",
			[
				"label" 		=> esc_html__( "Post Masonry", "cea" ),
				"description"	=> esc_html__( "This is option for blog masonry or normal.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"blog_gutter",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Post Masonry Gutter", "cea" ),
				"description"	=> esc_html__( "Here you can mention blog masonry gutter size. Example 30", "cea" ),
				"default" 		=> "10",
				"condition" 	=> [
					"blog_masonry" 		=> "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"lazy_load",
			[
				"label"			=> esc_html__( "Lazy Load", "cea" ),
				"description"	=> esc_html__( "Enabel lazy load option for load isotope grids lazy with animation.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"blog_masonry" => "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"isotope_filter",
			[
				"label"			=> esc_html__( "Isotope Filter", "cea" ),
				"description"	=> esc_html__( "Enabel to show blog filter by category.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"blog_masonry" => "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"filter_all",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Filter All Text", "cea" ),
				"description"	=> esc_html__( "Here you can mention blog's first filter text.", "cea" ),
				"default" 		=> esc_html__( "All", "cea" ),
				"condition" 	=> [
					"isotope_filter" 		=> "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"masonry_layout",
			[
				"label"			=> esc_html__( "Masonry Layout", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "masonry",
				"options"		=> [
					"masonry"		=> esc_html__( "Masonry", "cea" ),
					"fitRows"		=> esc_html__( "Fit Rows", "cea" )
				],
				"condition" 	=> [
					"blog_masonry" => "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"blog_infinite",
			[
				"label"			=> esc_html__( "Post Masonry Infinite", "cea" ),
				"description"	=> esc_html__( "This is option for blog masonry infinite scroll.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"blog_masonry" => "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"loading_msg",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Infinite Loading Message", "cea" ),
				"description"	=> esc_html__( "Here you can mention infinite loading post message.", "cea" ),
				"default" 		=> esc_html__( "Loading posts..", "cea" ),
				"condition" 	=> [
					"blog_infinite" 		=> "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"loading_end",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Infinite Ending Message", "cea" ),
				"description"	=> esc_html__( "Here you can mention infinite loading ending message.", "cea" ),
				"default" 		=> esc_html__( "No more post.", "cea" ),
				"condition" 	=> [
					"blog_infinite" 		=> "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			'loading_img',
			[
				'label' => esc_html__( 'Infinite Loader Image URL', 'cea' ),
				"description"	=> esc_html__( "Here you can choose infinite loader image.", "cea" ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				"condition" 	=> [
					"blog_infinite" 		=> "yes",
					"blog_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"blog_pagination",
			[
				"label" 		=> esc_html__( "Post Pagination", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"blog_masonry" 		=> "no"
				]
			]
		);
		$this->add_control(
			"variation",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Post Variation", "cea" ),
				"description"	=> esc_html__( "This is option for blog variatoin either dark or light.", "cea" ),
				"default"		=> "light",
				"options"		=> [
					"light"			=> esc_html__( "Light", "cea" ),
					"dark"			=> esc_html__( "Dark", "cea" )
				]
			]
		);
		$this->add_control(
			"post_items",
			[
				"label"				=> "Post Items",
				"description"		=> esc_html__( "This is settings for blog custom layout. here you can set your own layout. Drag and drop needed blog items to Enabled part.", "cea" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					"Enabled" 		=> [ 
						"thumb"			=> esc_html__( "Feature Image", "cea" ),
						"title"			=> esc_html__( "Title", "cea" ),
						"excerpt"		=> esc_html__( "Excerpt", "cea" )
					],
					"disabled"		=> [
						"top-meta"		=> esc_html__( "Top Meta", "cea" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea" ),
						"category"		=> esc_html__( "Category", "cea" ),
						"author"		=> esc_html__( "Author", "cea" )
					]
				]
			]
		);
		$this->add_control(
			"post_overlay_items_opt",
			[
				"label" 		=> esc_html__( "Post Overlay Items Options", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"post_overlay_items",
			[
				"label"			=> "Post Overlay Items",
				"description"	=> esc_html__( "This is settings for blog shortcode post overlay items.", "cea" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Enabled", "cea" ) => [],
					esc_html__( "disabled", "cea" ) => [
						'category'	=> esc_html__( 'Category', 'cea' ),
						'author'	=> esc_html__( 'Author', 'cea' ),
						'more'	=> esc_html__( 'Read More', 'cea' ),
						'date'	=> esc_html__( 'Date', 'cea' ),
						'comment'	=> esc_html__( 'Comment', 'cea' ),
						'title'	=> esc_html__( 'Title', 'cea' ),
						"top-meta"		=> esc_html__( "Top Meta", "cea" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea" )
					]
				],
				"condition" 	=> [
					"post_overlay_items_opt" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"top_meta",
			[
				"label"			=> "Post Top Meta",
				"description"	=> esc_html__( "This is settings for blog shortcode post top meta.", "cea" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea" ) => [],
					esc_html__( "Right", "cea" ) => [],
					esc_html__( "disabled", "cea" ) => [
						'category'	=> esc_html__( 'Category', 'cea' ),
						'author'	=> esc_html__( 'Author', 'cea' ),
						'more'	=> esc_html__( 'Read More', 'cea' ),
						'date'	=> esc_html__( 'Date', 'cea' ),
						'comment'	=> esc_html__( 'Comment', 'cea' )
					]
				]
			]
		);
		$this->add_control(
			"bottom_meta",
			[
				"label"			=> "Post Bottom Meta",
				"description"	=> esc_html__( "This is settings for blog shortcode post bottom meta.", "cea" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea" ) => [],
					esc_html__( "Right", "cea" ) => [],
					esc_html__( "disabled", "cea" ) => [
						'category'	=> esc_html__( 'Category', 'cea' ),
						'author'	=> esc_html__( 'Author', 'cea' ),
						'more'	=> esc_html__( 'Read More', 'cea' ),
						'date'	=> esc_html__( 'Date', 'cea' ),
						'comment'	=> esc_html__( 'Comment', 'cea' )
					]
				]
			]
		);
		$this->end_controls_section();
		
		//Title Section
		$this->start_controls_section(
			"title_section",
			[
				"label"			=> esc_html__( "Title", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Title options here available.", "cea" ),
			]
		);
		$this->add_control(
			"post_heading",
			[
				"label"			=> esc_html__( "Post Heading Tag", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h3",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "cea" ),
					"h2"		=> esc_html__( "h2", "cea" ),
					"h3"		=> esc_html__( "h3", "cea" ),
					"h4"		=> esc_html__( "h4", "cea" ),
					"h5"		=> esc_html__( "h5", "cea" ),
					"h6"		=> esc_html__( "h6", "cea" ),
				]
			]
		);		
		$this->end_controls_section();
		
		//Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"			=> esc_html__( "Image", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Image options here available.", "cea" ),
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->end_controls_section();
		
		//Slide Section
		$this->start_controls_section(
			"slide_section",
			[
				"label"			=> esc_html__( "Slide", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Posts slide options here available.", "cea" ),
			]
		);
		$this->add_control(
			"slide_opt",
			[
				"label" 		=> esc_html__( "Slide Option", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider option.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Slide Items", "cea" ),
				"description"	=> esc_html__( "This is option for blog slide items shown on large devices.", "cea" ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_tab",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Tab", "cea" ),
				"description"	=> esc_html__( "This is option for blog slide items shown on tab.", "cea" ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_mobile",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Mobile", "cea" ),
				"description"	=> esc_html__( "This is option for blog slide items shown on mobile.", "cea" ),
				"default" 		=> "1",
			]
		);
		$this->add_control(
			"slide_item_autoplay",
			[
				"label" 		=> esc_html__( "Auto Play", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider auto play.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item_loop",
			[
				"label" 		=> esc_html__( "Loop", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider loop.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_center",
			[
				"label" 		=> esc_html__( "Items Center", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider center, for this option must active loop and minimum items 2.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_nav",
			[
				"label" 		=> esc_html__( "Navigation", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider navigation.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_dots",
			[
				"label" 		=> esc_html__( "Pagination", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider pagination.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_margin",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Margin", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider margin space.", "cea" ),
				"default" 		=> "",
			]
		);
		$this->add_control(
			"slide_duration",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Duration", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider duration.", "cea" ),
				"default" 		=> "5000",
			]
		);
		$this->add_control(
			"slide_smart_speed",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Smart Speed", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider smart speed.", "cea" ),
				"default" 		=> "250",
			]
		);
		$this->add_control(
			"slide_slideby",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Slideby", "cea" ),
				"description"	=> esc_html__( "This is option for blog slider scroll by.", "cea" ),
				"default" 		=> "1",
			]
		);
		$this->end_controls_section();
		
		// Link Section
		$this->start_controls_section(
			'section_link',
			[
				'label' => esc_html__( 'Links', 'cea' ),
				'tab'   => Controls_Manager::TAB,
			]
		);
		$this->add_control(
			'image_link',
			[
				'label' => esc_html__( 'Image', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"image_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"image_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'title_link',
			[
				'label' => esc_html__( 'Title', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"title_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"title_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'more_link',
			[
				'label' => esc_html__( 'Read More', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"more_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"more_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();
		
		// Style Post Section
		$this->start_controls_section(
			'section_style_post',
			[
				'label' => esc_html__( 'Post Grid', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->start_controls_tabs( 'tabs_post_style' );
		$this->start_controls_tab(
			'tab_post_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'post_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_shadow',
				'selector' => '{{WRAPPER}} .blog-inner',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_post_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'post_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_hshadow',
				'selector' => '{{WRAPPER}} .blog-inner:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'post_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blog-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"title_text_trans",
			[
				"label"			=> esc_html__( "Title Transform", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set title text-transform property.", "cea" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea" )
				],
				'selectors' => [
					'{{WRAPPER}} .post-title-head .post-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title-head .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_scale',
			[
				'label' => esc_html__( 'Scale', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'transform: scale({{SIZE}});'
				],
			]
		);	
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);		
		$this->add_control(
			'title_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner:hover .post-title-head .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_hscale',
			[
				'label' => esc_html__( 'Scale', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blog-inner:hover .post-title-head' => 'transform: scale({{SIZE}});'
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .post-title-head'
			]
		);		
		$this->end_controls_section();
		
		// Style Link Section
		$this->start_controls_section(
			'section_style_link',
			[
				'label' => esc_html__( 'Links', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'post_links',
			[
				'label' => esc_html__( 'Default Post Links', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_link_style' );
		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);		
		$this->add_control(
			'link_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_tmetalinks',
			[
				'label' => esc_html__( 'Top Meta Links', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_tmetalink_style' );
		$this->start_controls_tab(
			'tab_tmetalink_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'tmetalink_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .top-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tmetalink_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);		
		$this->add_control(
			'tmetalink_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .top-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_bmetalinks',
			[
				'label' => esc_html__( 'Bottom Meta Links', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_bmetalink_style' );
		$this->start_controls_tab(
			'tab_bmetalink_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'bmetalink_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bottom-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_bmetalink_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);		
		$this->add_control(
			'bmetalink_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bottom-meta a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-inner:hover .bottom-meta a' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_ometalinks',
			[
				'label' => esc_html__( 'Overlay Links', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_ometalink_style' );
		$this->start_controls_tab(
			'tab_ometalink_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'ometalink_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_ometalink_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);		
		$this->add_control(
			'ometalink_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"img_style",
			[
				"label"			=> esc_html__( "Image Style", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Choose image style.", "cea" ),
				"default"		=> "squared",
				"options"		=> [
					"squared"			=> esc_html__( "Squared", "cea" ),
					"rounded"			=> esc_html__( "Rounded", "cea" ),
					"rounded-circle"	=> esc_html__( "Circled", "cea" )
				]
			]
		);
		$this->add_control(
			"resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea" ),
				"description"	=> esc_html__( "Enable resize option.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Size', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'condition' => [
					'resize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumb > a > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);	
		$this->add_control(
			'img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-thumb > a > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .post-thumb > a > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'img_border',
					'label' => esc_html__( 'Border', 'cea' ),
					'selector' => '{{WRAPPER}} .post-thumb > a > img'
				]
		);
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Read More Button', 'cea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .read-more',
			]
		);
		$this->add_control(
			"btn_text_trans",
			[
				"label"			=> esc_html__( "Transform", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set read more button text-transform property.", "cea" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea" )
				],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );		
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read-more:hover, {{WRAPPER}} .read-more:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .read-more:hover svg, {{WRAPPER}} .read-more:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read-more:hover, {{WRAPPER}} .read-more:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read-more:hover, {{WRAPPER}} .read-more:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .read-more',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .read-more',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .read-more'
			]
		);
		$this->end_controls_section();	
		
		// Style Meta Section
		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => esc_html__( 'Meta', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_control(
			'top_meta_style',
			[
				'label' => esc_html__( 'Top Meta', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'topmeta_typography',
				'selector' 		=> '{{WRAPPER}} .top-meta'
			]
		);	
		$this->add_responsive_control(
			'topmeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bottom_meta_style',
			[
				'label' => esc_html__( 'Bottom Meta', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'bottommeta_typography',
				'selector' 		=> '{{WRAPPER}} .bottom-meta'
			]
		);	
		$this->add_responsive_control(
			'bottommeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->start_controls_tabs( 'tabs_content_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'content_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-inner:hover .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .post-excerpt'
			]
		);	
		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Overlay Section
		$this->start_controls_section(
			'section_style_overlay',
			[
				'label' => esc_html__( 'Overlay', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'ovelay_typography',
				'selector' 		=> '{{WRAPPER}} .post-overlay-items'
			]
		);	
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_position_top',
			[
				'label' => esc_html__( 'Position Top', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items' => 'position: absolute; top: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'overlay_position_left',
			[
				'label' => esc_html__( 'Position Left', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items' => 'left: {{SIZE}}%;',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_overlay_style' );
		$this->start_controls_tab(
			'tab_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'overlay_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-thumb.post-overlay-active:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'overlay_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-thumb.post-overlay-active:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();	

	}

	/**
	 * Render Posts widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	 
	public function render_content() {
		/**
		 * Before widget render content.
		 *
		 * Fires before Elementor widget is being rendered.
		 *
		 * @since 1.0.0
		 *
		 * @param Widget_Base $this The current widget.
		 */
		do_action( 'elementor/widget/before_render_content', $this );
	
		ob_start();
	
		$skin = $this->get_current_skin();
		if ( $skin ) {
			$skin->set_parent( $this );
			$skin->render();
		} else {
			$this->render();
		}
	
		$widget_content = ob_get_clean();
		
		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$blog_layout = isset( $blog_layout ) && $blog_layout != '' ? $blog_layout : 'default';
		$slide_opt = isset( $slide_opt ) && $slide_opt == 'yes' ? true : false;
		$blog_masonry = isset( $blog_masonry ) && $blog_masonry == 'yes' ? true : false;
		
		$class_names = isset( $blog_layout ) ? ' blog-style-' . $blog_layout : ' blog-style-1';
		$class_names .= isset( $variation ) ? ' blog-' . $variation : '';
		
		if( !$blog_masonry && !$slide_opt ){
			$class_names .= ' blog-normal-model';
		}elseif( $slide_opt ) {
			$class_names .= ' blog-slide-model';
		}elseif( $blog_masonry ){
			$class_names .= ' blog-isotope-model';
		}
			
		?>
		
		<div class="elementor-widget-container blog-wrapper<?php echo esc_attr( $class_names ); ?>">
		
			<?php
			/**
			 * Render widget content.
			 *
			 * Filters the widget content before it's rendered.
			 *
			 * @since 1.0.0
			 *
			 * @param string      $widget_content The content of the widget.
			 * @param Widget_Base $this           The widget.
			 */
			$widget_content = apply_filters( 'elementor/widget/render_content', $widget_content, $this );
	
			echo $widget_content; // XSS ok.
			?>
			
		</div>
		<?php
	}

	/**
	 * Render Posts widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		extract( $settings );
		$output = '';

		//Defined Variable
		$post_per_page = isset( $post_per_page ) && $post_per_page != '' ? $post_per_page : '';
		$excerpt_length = isset( $excerpt_length ) && $excerpt_length != '' ? $excerpt_length : 10;
		$this->excerpt_len = $excerpt_length;
		
		$post_type = isset( $post_type ) ? $post_type : '';
		$include_cats = isset( $include_cats ) ? $include_cats : '';
		$exclude_cats = isset( $exclude_cats ) ? $exclude_cats : '';
		$include_tags = isset( $include_tags ) ? $include_tags : '';
		$include_author = isset( $include_author ) ? $include_author : '';
		$include_posts = isset( $include_posts ) ? $include_posts : '';
		$exclude_posts = isset( $exclude_posts ) ? $exclude_posts : '';
		$orderby = isset( $orderby ) ? $orderby : '';
		$order = isset( $order ) ? $order : '';
		
		$more_text = isset( $more_text ) && $more_text != '' ? $more_text : '';
		$blog_pagination = isset( $blog_pagination ) && $blog_pagination == 'yes' ? true : false;
		$blog_masonry = isset( $blog_masonry ) && $blog_masonry == 'yes' ? true : false;
		$masonry_layout = isset( $masonry_layout ) && $masonry_layout != '' ? $masonry_layout : 'masonry';
		$blog_infinite = isset( $blog_infinite ) && $blog_infinite == 'yes' ? true : false;
		$blog_gutter = isset( $blog_gutter ) && $blog_gutter != '' ? $blog_gutter : 20;
		$slide_opt = isset( $slide_opt ) && $slide_opt == 'yes' ? true : false;
		$lazy_load = isset( $lazy_load ) && $lazy_load == 'yes' ? true : false;
		$isotope_filter = isset( $isotope_filter ) && $isotope_filter == 'yes' ? true : false;
		$filter_all = isset( $filter_all ) && $filter_all != '' ? $filter_all : esc_html__( "All", "cea" );
		$post_heading = isset( $post_heading ) && $post_heading != '' ? $post_heading : 'h3';
		
		if( $slide_opt ){
			$gal_atts = array(
				'data-loop="'. ( isset( $slide_item_loop ) && $slide_item_loop == 'yes' ? 1 : 0 ) .'"',
				'data-margin="'. ( isset( $slide_margin ) && $slide_margin != '' ? absint( $slide_margin ) : 0 ) .'"',
				'data-center="'. ( isset( $slide_center ) && $slide_center == 'yes' ? 1 : 0 ) .'"',
				'data-nav="'. ( isset( $slide_nav ) && $slide_nav == 'yes' ? 1 : 0 ) .'"',
				'data-dots="'. ( isset( $slide_dots ) && $slide_dots == 'yes' ? 1 : 0 ) .'"',
				'data-autoplay="'. ( isset( $slide_item_autoplay ) && $slide_item_autoplay == 'yes' ? 1 : 0 ) .'"',
				'data-items="'. ( isset( $slide_item ) && $slide_item != '' ? absint( $slide_item ) : 1 ) .'"',
				'data-items-tab="'. ( isset( $slide_item_tab ) && $slide_item_tab != '' ? absint( $slide_item_tab ) : 1 ) .'"',
				'data-items-mob="'. ( isset( $slide_item_mobile ) && $slide_item_mobile != '' ? absint( $slide_item_mobile ) : 1 ) .'"',
				'data-duration="'. ( isset( $slide_duration ) && $slide_duration != '' ? absint( $slide_duration ) : 5000 ) .'"',
				'data-smartspeed="'. ( isset( $slide_smart_speed ) && $slide_smart_speed != '' ? absint( $slide_smart_speed ) : 250 ) .'"',
				'data-scrollby="'. ( isset( $slide_slideby ) && $slide_slideby != '' ? absint( $slide_slideby ) : 1 ) .'"',
				'data-autoheight="0"',
			);
			$data_atts = implode( " ", $gal_atts );
		}

		$thumb_size = $settings[ 'thumbnail_size' ];
		$image_sizes = get_intermediate_image_sizes();
		
		$this->add_render_attribute( 'image-link', 'class', 'post-image-link' );
		if( isset( $image_target ) && $image_target == 'yes' ) $this->add_render_attribute( 'image-link', 'target', '_blank' );
		if( isset( $image_nofollow ) && $image_nofollow == 'yes' ) $this->add_render_attribute( 'image-link', 'rel', 'nofollow' );
		
		$this->add_render_attribute( 'title-link', 'class', 'post-title' );
		if( isset( $title_target ) && $title_target == 'yes' ) $this->add_render_attribute( 'title-link', 'target', '_blank' );
		if( isset( $title_nofollow ) && $title_nofollow == 'yes' ) $this->add_render_attribute( 'title-link', 'rel', 'nofollow' );
		
		$this->add_render_attribute( 'more-link', 'class', 'read-more elementor-button' );
		if( isset( $more_target ) && $more_target == 'yes' ) $this->add_render_attribute( 'more-link', 'target', '_blank' );
		if( isset( $more_nofollow ) && $more_nofollow == 'yes' ) $this->add_render_attribute( 'more-link', 'rel', 'nofollow' );

		$default_items = array( 
			"thumb"			=> esc_html__( "Feature Image", "cea" ),
			"title"			=> esc_html__( "Title", "cea" ),
			"excerpt"		=> esc_html__( "Excerpt", "cea" )
		);
		$elemetns = isset( $post_items ) && !empty( $post_items ) ? json_decode( $post_items, true ) : array( 'Enabled' => $default_items );
		$overlay_opt = isset( $post_overlay_items_opt ) && $post_overlay_items_opt == 'yes' ? true : false;
		$overlay_items = isset( $post_overlay_items ) && !empty( $post_overlay_items ) ? json_decode( $post_overlay_items, true ) : array( 'Enabled' => '' );
		$top_meta = isset( $top_meta ) && $top_meta != '' ? $top_meta : array( 'Enabled' => '' );
		$bottom_meta = isset( $bottom_meta ) && $bottom_meta != '' ? $bottom_meta : array( 'Enabled' => '' );

		$cols = isset( $blog_cols ) ? $blog_cols : 12;
		$col_class = "col-lg-". absint( $cols );
		$col_class .= " " . ( $cols == 3 ? "col-md-6" : "col-md-". absint( $cols ) );
		
		$list_layout = isset( $blog_layout ) && $blog_layout == 'list' ? 1 : 0;
				
		$filter_catoutput = '';
		if( $isotope_filter && !empty( $include_cats ) ){
			foreach( $include_cats as $index => $cat ){
				if( term_exists( absint( $cat ), 'category' ) ){
					$cat_term = get_term_by( 'id', absint( $cat ), 'category' );	
					if( isset( $cat_term->term_id ) ){
						$filter_catoutput .=  '<li><a href="#" class="isotope-filter-item" data-filter=".filter-cat-'. esc_attr( $cat ) .'">'. esc_html( $cat_term->name ) .'</a></li>';	
					}
				}
			}
		}
		
		//Query Start
		global $wp_query;
		$paged = 1;
		if( get_query_var('paged') ){
			$paged = get_query_var('paged');
		}elseif( get_query_var('page') ){
			$paged = get_query_var('page');
		}
		
		$ppp = $post_per_page != '' ? $post_per_page : 2;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $ppp ),
			'paged' => $paged,
			'ignore_sticky_posts' => 1			
		);
		
		//Include Author
		if( !empty( $include_author ) ){
			$args['author__in'] = $include_author;
		}
		
		//Include Category
		if( !empty( $include_cats ) ){
			$args['category__in'] = $include_cats;
		}
		
		//Exclude Category
		if( !empty( $exclude_cats ) ){
			$args['category__not_in'] = $exclude_cats;
		}
		
		//Include Tags
		if( !empty( $include_tags ) ){
			$args['tag__in'] = $include_tags;
		}
		
		//Include Posts
		if( !empty( $include_posts ) ){
			$args['post__in'] = $include_posts;
		}
		
		//Exclude Posts
		if( !empty( $exclude_posts ) ){
			$args['post__not_in'] = $exclude_posts;
		}
		
		//Order by
		if( !empty( $orderby ) ){
			$args['orderby'] = $orderby;
		}
		
		//Order
		if( !empty( $order ) ){
			$args['order'] = $order;
		}
		
		$query = new \WP_Query( $args );
			
		if ( $query->have_posts() ) {

			add_filter( 'excerpt_more', 'cea_excerpt_more', 99 );
			add_filter( 'excerpt_length', array( $this, 'cea_excerpt_length' ), 99 );
			
			if( $isotope_filter && $filter_catoutput != '' ){
				echo '<div class="isotope-filter">';
					echo '<ul class="nav m-auto d-block">' .
						( $filter_all != '' ? '<li class="active"><a href="#" class="isotope-filter-item" data-filter="">'. esc_html( $filter_all ) .'</a></li>' : '' ) .
						$filter_catoutput;
					echo '</ul>';
				echo '</div>';
			}
		
			$row_stat = 0;
		
			if( $slide_opt ) {
				echo '<div class="cea-carousel owl-carousel" '. ( $data_atts ) .'>';	
				$col_class = 'owl-carousel-item';
			}elseif( $blog_masonry ){
			
				$loading_msg = isset( $loading_msg ) && $loading_msg != '' ? $loading_msg : esc_html__( 'Loading..', 'cea' );
				$loading_end = isset( $loading_end ) && $loading_end != '' ? $loading_end : esc_html__( 'No more posts..', 'cea' );
				$loading_img = isset( $loading_img ) && $loading_img != '' ? $loading_img['url'] : CEA_CORE_URL . 'assets/images/infinite-loader.gif';
			
				$isotope_class = ' isotope-col-'. esc_attr( 12 / absint( $cols ) );
				echo '<div class="isotope'. esc_attr( $isotope_class ) .'" data-cols="'. esc_attr( 12 / absint( $cols ) ) .'" data-gutter="'. esc_attr( $blog_gutter ) .'" data-layout="'. esc_attr( $masonry_layout ) .'" data-infinite="'. esc_attr( $blog_infinite ) .'" data-lazyload="'. esc_attr( $lazy_load ) .'" data-loadmsg="'. esc_attr( $loading_msg ) .'" data-loadend="'. esc_attr( $loading_end ) .'" data-loadimg="'. esc_attr( $loading_img ) .'">';
				$col_class = 'isotope-item';
				$col_class .= $lazy_load ? ' cea-animate' : '';
			}
			
			// Posts items array
			$blog_array = array(
				'cols' => $cols,
				'post_heading' => $post_heading,
				'overlay_opt' => $overlay_opt,
				'overlay_items' => $overlay_items,
				'more_text' => $more_text,
				'top_meta' => $top_meta,
				'bottom_meta' => $bottom_meta,				
				'thumb_size' => $thumb_size,
				'image_sizes' => $image_sizes
			);
			
			if( $list_layout || $blog_layout == 'classic-pro' ){
				if(	isset( $elemetns['Enabled']['thumb'] ) ) unset( $elemetns['Enabled']['thumb'] );
			}			
		
			// Start the Loop
			while ( $query->have_posts() ) : $query->the_post();
				
				$post_id = get_the_ID();
				$blog_array['post_id'] = $post_id;
				
				$cat_class = '';
				if( !$blog_masonry && !$slide_opt ){
					if( $row_stat == 0 ) :
						echo '<div class="row">';
					endif;
				}elseif( $blog_masonry && $isotope_filter && $filter_catoutput != '' ){
					$terms = get_the_terms( $post_id, 'category' );
					if ( $terms && ! is_wp_error( $terms ) ) :
						foreach ( $terms as $term ) {
							$cat_class .= ' filter-cat-' . $term->term_id;
						}
					endif;
				}
				
				echo '<div class="'. esc_attr( $col_class . $cat_class ) .'">';
					echo '<div class="blog-inner">';
						
						if( $list_layout ){
							echo '<div class="media">';
								echo $this->cea_blog_shortcode_elements('thumb', $blog_array, $settings);
								echo '<div class="media-body">';
						}elseif( $blog_layout == 'classic-pro' ){
							echo $this->cea_blog_shortcode_elements('thumb', $blog_array, $settings);
							echo '<div class="post-details-outer">';
						}

						if( isset( $elemetns['Enabled'] ) ) :
							foreach( $elemetns['Enabled'] as $element => $value ){
								echo $this->cea_blog_shortcode_elements( $element, $blog_array, $settings);
							}
						endif;
						
						if( $list_layout ){
								echo '</div><!-- .media -->';
							echo '</div><!-- .media-body -->';
						}elseif( $blog_layout == 'classic-pro' ){
							echo '</div><!-- .post-details-outer -->';
						}
					echo '</div><!-- .blog-inner -->';
				echo '</div><!-- .col / .owl-carousel-item / .isotope -->';
				
				if( !$blog_masonry && !$slide_opt ){
					$row_stat++;
					if( $row_stat == ( 12/ $cols ) ) :
						echo '</div><!-- .row -->';
						$row_stat = 0;
					endif;
				}
				
			endwhile;
			
			if( !$blog_masonry && !$slide_opt ){
				if( $row_stat != 0 ){
					echo '</div><!-- .row -->'; // Unexpected row close
				}
			}elseif( $slide_opt ) {
				echo '</div><!-- .owl-carousel -->';
			}elseif( $blog_masonry ){
				echo '</div><!-- .isotope -->';
			}
			
			if( !$slide_opt && ( $blog_infinite || $blog_pagination ) ):
				echo $blog_infinite ? '<div class="infinite-load">' : '';
					require_once CEA_CORE_DIR . '/inc/cea-class.php';
					$cea_ele = new CEAPostElements;
					echo $cea_ele->ceaWpBootstrapPagination( $args, $query->max_num_pages, false );
				echo $blog_infinite ? '</div><!-- infinite-load -->' : '';
			endif;				
			
		}// query exists
		
		// use reset postdata to restore orginal query
		wp_reset_postdata();		

	}
	
	function cea_blog_shortcode_elements( $element, $opts = array(), $settings = null ){
		$output = '';
		switch( $element ){
		
			case "title":
				$head = isset( $opts['post_heading'] ) ? $opts['post_heading'] : 'h3';
				$output .= '<div class="entry-title">';
					$output .= '<'. esc_attr( $head ) .' class="post-title-head"><a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'title-link' ) .'>'. esc_html( get_the_title() ) .'</a></'. esc_attr( $head ) .'>';
				$output .= '</div><!-- .entry-title -->';		
			break;
			
			case "thumb":
				if ( has_post_thumbnail() ) {
					
					$overlay_opt = isset( $opts['overlay_opt'] ) && $opts['overlay_opt'] == 'yes' ? true : false;
					$thumb_wrap_class = $overlay_opt ? ' post-overlay-active' : '';
					
					$output .= '<div class="post-thumb'. esc_attr( $thumb_wrap_class ) .'">';
						$img_id = get_post_thumbnail_id( get_the_ID() );
						$size = $opts['thumb_size'];
						$image_sizes = $opts['image_sizes'];
						$this->add_render_attribute( 'image_class', 'class', 'img-fluid' );		
						$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] );
						
						if( in_array( $size, $image_sizes ) ){
							$this->add_render_attribute( 'image_class', 'class', "attachment-$size size-$size" );
							$img_attr = $this->get_render_attributes( 'image_class' );
							$img_attr['class'] = implode( " ", $img_attr['class'] );
							$output .= '<a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'image-link' ) .'>';
								$output .= wp_get_attachment_image( $img_id, $size, false, $img_attr );
							$output .= '</a>';
						}else{
							$image_src = Group_Control_Image_Size::get_attachment_image_src( $img_id, 'thumbnail', $settings );
							if ( ! empty( $image_src ) ) {
								$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
								$output .= '<a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'image-link' ) .'>';
								$output .= sprintf( '<img src="%s" title="%s" alt="%s" %s />', esc_attr( $image_src ), esc_attr( get_the_title( $img_id ) ), esc_attr( $img_alt ), $this->get_render_attribute_string( 'image_class' ) );
								$output .= '</a>';
							}
						}						
						
						if( $overlay_opt ){
							$post_overlay_items = isset( $opts['overlay_items'] ) ? $opts['overlay_items'] : array( 'Enabled' => '' );
							$output .= '<div class="post-overlay-items">';
								foreach( $post_overlay_items['Enabled'] as $element => $value ){
									$output .= $this->cea_blog_shortcode_elements( $element, $opts );
								}
							$output .= '</div>';

						}													
					$output .= '</div><!-- .post-thumb -->';
				}
			break;
			
			case "category":
				$categories = get_the_category(); 
				if ( ! empty( $categories ) ){
					$coutput = '<div class="post-category">';
						$coutput .= '<span class="before-icon fa fa-folder-o"></span>';
						foreach ( $categories as $category ) {
							$coutput .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>,';
						}
						$output .= rtrim( $coutput, ',' );
					$output .= '</div>';
				}
			break;
			
			case "author":
				$output .= '<div class="post-author">';
					$output .= '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) .'">';
						$output .= '<span class="author-img">'. get_avatar( get_the_author_meta('email'), '30', null, null, array( 'class' => 'rounded-circle' ) ) .'</span>';
						$output .= '<span class="author-name">'. get_the_author() .'</span>';
					$output .= '</a>';
				$output .= '</div>';
			break;
			
			case "date":
				$archive_year  = get_the_time('Y');
				$archive_month = get_the_time('m'); 
				$archive_day   = get_the_time('d');
				$output = '<div class="post-date"><a href="'. esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) .'" ><i class="icon icon-calendar"></i> '. get_the_time( get_option( 'date_format' ) ) .'</a></div>';
			break;
			
			case "more":
				$read_more_text = isset( $opts['more_text'] ) ? $opts['more_text'] : esc_html__( 'Read more', 'cea' );
				$output = '<div class="post-more"><a href="'. esc_url( get_permalink( get_the_ID() ) ) . '" '. $this->get_render_attribute_string( 'more-link' ) .'>'. esc_html( $read_more_text ) .'</a></div>';
			break;
			
			case "comment":
				$comments_count = wp_count_comments(get_the_ID());
				$output = '<div class="post-comment"><a href="'. esc_url( get_comments_link( get_the_ID() ) ) .'" rel="bookmark" class="comments-count"><i class="fa fa-comment-o"></i> '. esc_html( $comments_count->total_comments ) .'</a></div>';
			break;
			
			case "excerpt":
				$output = '';
				$output .= '<div class="post-excerpt">';
					ob_start();
					the_excerpt();
					$excerpt_cont = ob_get_clean();
					$output .= $excerpt_cont;
				$output .= '</div><!-- .post-excerpt -->';	
			break;		
			
			case "top-meta":
				$output = '';
				$top_meta = $opts['top_meta'];
				$elemetns = isset( $top_meta ) ? json_decode( $top_meta, true ) : array( 'Left' => '' );
				$output .= '<div class="top-meta clearfix">';
				foreach( $elemetns as $ele_key => $ele_part ){
					if( isset( $ele_part ) && !empty( $ele_part ) && $ele_key != 'disabled' ) :
						$part_class = $ele_key == 'Left' || $ele_key == 'Right' ? ' meta-' . strtolower( $ele_key ) : '';
						$output .= '<ul class="nav top-meta-list'. esc_attr( $part_class ) .'">';
							foreach($ele_part as $element => $value ){
								$blog_array = array( 'more_text' => $opts['more_text'] );
								$output .= '<li>'. $this->cea_blog_shortcode_elements( $element, $blog_array ) .'</li>';
							}
						$output .= '</ul>';
					endif;
				}
				$output .= '</div>';
			break;
			
			case "bottom-meta":
				$output = '';
				$bottom_meta = $opts['bottom_meta'];
				$elemetns = isset( $bottom_meta ) ? json_decode( $bottom_meta, true ) : array( 'Left' => '' );
				$output .= '<div class="bottom-meta clearfix">';
				foreach( $elemetns as $ele_key => $ele_part ){
					if( isset( $ele_part ) && !empty( $ele_part ) && $ele_key != 'disabled' ) :
						$part_class = $ele_key == 'Left' || $ele_key == 'Right' ? ' meta-' . strtolower( $ele_key ) : '';
						$output .= '<ul class="nav bottom-meta-list'. esc_attr( $part_class ) .'">';
							foreach($ele_part as $element => $value ){
								$blog_array = array( 'more_text' => $opts['more_text'] );
								$output .= '<li>'. $this->cea_blog_shortcode_elements( $element, $blog_array ) .'</li>';
							}
						$output .= '</ul>';
					endif;
				}
				$output .= '</div>';
			break;
		}
		return $output; 
	}
	
	function cea_excerpt_length( $length ) {
		return $this->excerpt_len;
	}

}