<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Flip Box
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

class CEA_Elementor_Flip_Box_Widget extends Widget_Base {

	private $_settings;
	public $image_class;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Flip box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaflipbox";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Flip box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Flip Box", "cea" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Flip box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-agenda";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Flip box widget belongs to.
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
	 * Register Flip box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", "cea" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default flip box options.", "cea" ),
			]
		);
		$this->add_control(
			"flip_style",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Flip Box Hover Styles", "cea" ),
				"description"	=> esc_html__( "This is option for hover animation style flip box.", "cea" ),
				"default"		=> "imghvr-fade",
				"options"		=> [
					"imghvr-fade" => esc_html__( "Fade", "cea" ),
					"imghvr-push-up" => esc_html__( "Push Up", "cea" ), 
					"imghvr-push-down" => esc_html__( "Push Down", "cea" ), 
					"imghvr-push-left" => esc_html__( "Push Left", "cea" ), 
					"imghvr-push-right" => esc_html__( "Push Right", "cea" ), 
					"imghvr-slide-up" => esc_html__( "Slide Up", "cea" ), 
					"imghvr-slide-down" => esc_html__( "Slide Down", "cea" ), 
					"imghvr-slide-left" => esc_html__( "Slide Left", "cea" ), 
					"imghvr-slide-right" => esc_html__( "Slide Right", "cea" ), 
					"imghvr-reveal-up" => esc_html__( "Reveal Up", "cea" ), 
					"imghvr-reveal-down" => esc_html__( "Reveal Down", "cea" ), 
					"imghvr-reveal-left" => esc_html__( "Reveal Left", "cea" ), 
					"imghvr-reveal-right" => esc_html__( "Reveal Right", "cea" ), 
					"imghvr-hinge-up" => esc_html__( "Hinge Up", "cea" ), 
					"imghvr-hinge-down" => esc_html__( "Hinge Down", "cea" ), 
					"imghvr-hinge-left" => esc_html__( "Hinge Left", "cea" ), 
					"imghvr-hinge-right" => esc_html__( "Hinge Right", "cea" ), 
					"imghvr-flip-horiz" => esc_html__( "Flip Horizontal", "cea" ), 
					"imghvr-flip-vert" => esc_html__( "Flip Vertical", "cea" ), 
					"imghvr-flip-diag-1" => esc_html__( "Diagonal 1", "cea" ), 
					"imghvr-flip-diag-2" => esc_html__( "Diagonal 2", "cea" ), 
					"imghvr-flip-3d-horz" => esc_html__( "Flip 3D Horizontal", "cea" ),
					"imghvr-flip-3d-vert" => esc_html__( "Flip 3D Vertical", "cea" ), 
					"imghvr-shutter-out-horiz" => esc_html__( "Shutter Out Horizontal", "cea" ), 
					"imghvr-shutter-out-vert" => esc_html__( "Shutter Out Vertical", "cea" ), 
					"imghvr-shutter-out-diag-1" => esc_html__( "Shutter Out Diagonal 1", "cea" ), 
					"imghvr-shutter-out-diag-2" => esc_html__( "Shutter Out Diagonal 2", "cea" ), 
					"imghvr-shutter-in-horiz" => esc_html__( "Shutter In Horizontal", "cea" ), 
					"imghvr-shutter-in-vert" => esc_html__( "Shutter In Vertical", "cea" ), 
					"imghvr-shutter-in-out-horiz" => esc_html__( "Shutter In Out Horizontal", "cea" ), 
					"imghvr-shutter-in-out-vert" => esc_html__( "Shutter In Out Vertical", "cea" ), 
					"imghvr-shutter-in-out-diag-1" => esc_html__( "Shutter In Out Diagonal 1", "cea" ), 
					"imghvr-shutter-in-out-diag-2" => esc_html__( "Shutter In Out Diagonal 2", "cea" ), 
					"imghvr-fold-up" => esc_html__( "Fold Up", "cea" ), 
					"imghvr-fold-down" => esc_html__( "Fold Down", "cea" ), 
					"imghvr-fold-left" => esc_html__( "Fold Left", "cea" ), 
					"imghvr-fold-right" => esc_html__( "Fold Right", "cea" ), 
					"imghvr-zoom-in" => esc_html__( "Zoom In", "cea" ), 
					"imghvr-zoom-out" => esc_html__( "Zoom Out", "cea" ), 
					"imghvr-zoom-out-up" => esc_html__( "Zoom Out Up", "cea" ), 
					"imghvr-zoom-out-down" => esc_html__( "Zoom Out Down", "cea" ), 
					"imghvr-zoom-out-left" => esc_html__( "Zoom Out Left", "cea" ), 
					"imghvr-zoom-out-right" => esc_html__( "Zoom Out Right", "cea" ), 
					"imghvr-zoom-out-flip-horiz" => esc_html__( "Zoom Out Flip Horizontal", "cea" ), 
					"imghvr-zoom-out-flip-vert" => esc_html__( "Zoom Out Flip Vertical", "cea" ), 
					"imghvr-blur" => esc_html__( "Blur", "cea" )
				]
			]
		);
		$this->add_control(
			"redirect",
			[
				"label" 		=> esc_html__( "Flip Box Redirect", "cea" ),
				"description"	=> esc_html__( "This is option for when click the flip box redirect to some link.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'cea' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'condition' 	=> [
					'redirect' 		=> 'yes'
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'cea' )
			]
		);
		$this->end_controls_section();
		
		// Flipbox Layout
		$this->start_controls_section(
			'section_flipbox_layout',
			[
				'label' => esc_html__( 'Layout', 'cea' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs( 'flipbox_layout' );
		$this->start_controls_tab(
			'flipbox_layout_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			"flip_primary_items",
			[
				"label"				=> "Primary Box Items",
				"description"		=> esc_html__( "This is settings for primary box custom layout. here you can set your own layout. Drag and drop needed flip items to enabled part.", "cea" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					'Enabled' => array( 
						'icon'	=> esc_html__( 'Icon', 'cea' ),
						'title'	=> esc_html__( 'Title', 'cea' ),
						'content'	=> esc_html__( 'Content', 'cea' )					
					),
					'disabled' => array(
						'btn'	=> esc_html__( 'Button', 'cea' ),
						'image'	=> esc_html__( 'Image', 'cea' )
					)
				]
			]
		);
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'flipbox_layout_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			"flip_secondary_items",
			[
				"label"				=> "Secondary Box Items",
				"description"		=> esc_html__( "This is settings for primary box custom layout. here you can set your own layout. Drag and drop needed flip items to enabled part.", "cea" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					'Enabled' => array( 
						'icon'	=> esc_html__( 'Icon', 'cea' ),
						'title'	=> esc_html__( 'Title', 'cea' ),
						'content'	=> esc_html__( 'Content', 'cea' )					
					),
					'disabled' => array(
						'btn'	=> esc_html__( 'Button', 'cea' ),
						'image'	=> esc_html__( 'Image', 'cea' )
					)
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		//Flipbox Title
		$this->start_controls_section(
			'section_flipbox_title',
			[
				'label' => esc_html__( 'Title', 'cea' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs( 'flipbox_title' );
		$this->start_controls_tab(
			'flipbox_title_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			"primary_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Primary Title", "cea" ),
				"default"		=> esc_html__( 'Front Title', 'cea' ),
			]
		);
		$this->add_control(
			"primary_title_head",
			[
				"label"			=> esc_html__( "Primary Title Tag", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h3",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "cea" ),
					"h2"		=> esc_html__( "h2", "cea" ),
					"h3"		=> esc_html__( "h3", "cea" ),
					"h4"		=> esc_html__( "h4", "cea" ),
					"h5"		=> esc_html__( "h5", "cea" ),
					"h6"		=> esc_html__( "h6", "cea" ),
					"p"			=> esc_html__( "p", "cea" ),
					"span"		=> esc_html__( "span", "cea" ),
					"div"		=> esc_html__( "div", "cea" ),
					"i"			=> esc_html__( "i", "cea" )
				]
			]
		);
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'flipbox_title_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			"secondary_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Secondary Title", "cea" ),
				"default"		=> esc_html__( 'Back Title', 'cea' ),
			]
		);
		$this->add_control(
			"secondary_title_head",
			[
				"label"			=> esc_html__( "Secondary Title Tag", "cea" ),
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
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		//Flipbox Icon
		$this->start_controls_section(
			'section_flipbox_icon',
			[
				'label' => esc_html__( 'Icon', 'cea' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs( 'flipbox_icon' );
		$this->start_controls_tab(
			'flipbox_icon_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			'primary_icon',
			[
				'label' => esc_html__( 'Primary Icon', 'cea' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
			]
		);
		$this->add_control(
			'primary_icon_view',
			[
				'label' => esc_html__( 'Primary Icon View', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'cea' ),
					'stacked' => esc_html__( 'Stacked', 'cea' ),
					'framed' => esc_html__( 'Framed', 'cea' ),
				],
				'default' => 'default',
				'prefix_class' => 'cea-primary-icon-view-',
			]
		);
		$this->add_control(
			'primary_icon_shape',
			[
				'label' => esc_html__( 'Primary Icon Shape', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'cea' ),
					'square' => esc_html__( 'Square', 'cea' ),
				],
				'default' => 'circle',
				'condition' => [
					'primary_icon_view!' => 'default',
				],
				'prefix_class' => 'cea-primary-icon-shape-',
			]
		);
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'flipbox_icon_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			'secondary_icon',
			[
				'label' => esc_html__( 'Secondary Icon', 'cea' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
			]
		);
		$this->add_control(
			'secondary_icon_view',
			[
				'label' => esc_html__( 'Secondary Icon View', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'cea' ),
					'stacked' => esc_html__( 'Stacked', 'cea' ),
					'framed' => esc_html__( 'Framed', 'cea' ),
				],
				'default' => 'default',
				'prefix_class' => 'cea-secondary-icon-view-',
			]
		);
		$this->add_control(
			'secondary_icon_shape',
			[
				'label' => esc_html__( 'Secondary Icon Shape', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'cea' ),
					'square' => esc_html__( 'Square', 'cea' ),
				],
				'default' => 'circle',
				'condition' => [
					'secondary_icon_view!' => 'default',
				],
				'prefix_class' => 'cea-secondary-icon-shape-',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		//Flipbox Button
		$this->start_controls_section(
			'section_flipbox_button',
			[
				'label' => esc_html__( 'Button', 'cea' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs( 'flipbox_button' );
		$this->start_controls_tab(
			'flipbox_button_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			'button_type',
			[
				'label' => esc_html__( 'Type', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'cea' ),
					'info' => esc_html__( 'Info', 'cea' ),
					'success' => esc_html__( 'Success', 'cea' ),
					'warning' => esc_html__( 'Warning', 'cea' ),
					'danger' => esc_html__( 'Danger', 'cea' ),
				],
				'prefix_class' => 'elementor-button-',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'cea' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Click here', 'cea' ),
				'placeholder' => esc_html__( 'Click here', 'cea' ),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'cea' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'cea' ),
				'default' => [
					'url' => '#',
				],
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
				'prefix_class' => 'cea-btn%s-align-',
				'default' => '',
			]
		);
		$this->add_control(
			'button_size',
			[
				'label' => esc_html__( 'Size', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
			'xs' => __( 'Extra Small', 'elementor' ),
			'sm' => __( 'Small', 'elementor' ),
			'md' => __( 'Medium', 'elementor' ),
			'lg' => __( 'Large', 'elementor' ),
			'xl' => __( 'Extra Large', 'elementor' ),
		],//self::get_button_sizes(),
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'cea' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);
		$this->add_control(
			'button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'cea' ),
					'right' => esc_html__( 'After', 'cea' ),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);
		$this->add_control(
			'button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button .cea-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-button .cea-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_view',
			[
				'label' => esc_html__( 'View', 'cea' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__( 'Button ID', 'cea' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'cea' ),
				'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'cea' ),
				'separator' => 'before',

			]
		);		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'flipbox_button_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			'button_back_type',
			[
				'label' => esc_html__( 'Type', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'cea' ),
					'info' => esc_html__( 'Info', 'cea' ),
					'success' => esc_html__( 'Success', 'cea' ),
					'warning' => esc_html__( 'Warning', 'cea' ),
					'danger' => esc_html__( 'Danger', 'cea' ),
				],
				'prefix_class' => 'elementor-button-',
			]
		);
		$this->add_control(
			'button_back_text',
			[
				'label' => esc_html__( 'Text', 'cea' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Click here', 'cea' ),
				'placeholder' => esc_html__( 'Click here', 'cea' ),
			]
		);
		$this->add_control(
			'button_back_link',
			[
				'label' => esc_html__( 'Link', 'cea' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'cea' ),
				'default' => [
					'url' => '#',
				],
			]
		);
		$this->add_responsive_control(
			'button_back_align',
			[
				'label' => esc_html__( 'Alignment', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
				'prefix_class' => 'cea-btn%s-align-',
				'default' => '',
			]
		);
		$this->add_control(
			'button_back_size',
			[
			'label' => esc_html__( 'Size', 'cea' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'sm',
			'options' => [
				'xs' => __( 'Extra Small', 'elementor' ),
				'sm' => __( 'Small', 'elementor' ),
				'md' => __( 'Medium', 'elementor' ),
				'lg' => __( 'Large', 'elementor' ),
				'xl' => __( 'Extra Large', 'elementor' ),
			],//self::get_button_sizes(),
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'button_back_icon',
			[
				'label' => esc_html__( 'Icon', 'cea' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);
		$this->add_control(
			'button_back_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'cea' ),
					'right' => esc_html__( 'After', 'cea' ),
				],
				'condition' => [
					'button_back_icon[value]!' => '',
				],
			]
		);
		$this->add_control(
			'button_back_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button .cea-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-button .cea-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_back_view',
			[
				'label' => esc_html__( 'View', 'cea' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->add_control(
			'button_back_css_id',
			[
				'label' => esc_html__( 'Button ID', 'cea' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'cea' ),
				'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'cea' ),
				'separator' => 'before',

			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();	
		
		//Flipbox Image
		$this->start_controls_section(
			'section_flipbox_image',
			[
				'label' => esc_html__( 'Image', 'cea' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs( 'flipbox_image' );
		$this->start_controls_tab(
			'flipbox_image_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			"primary_image",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => __( "Primary Image", "cea" ),
				"description"	=> esc_html__( "Choose primary image.", "cea" ),
				"dynamic" => [
					"active" => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);		
		$this->add_control(
			"primary_img_style",
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
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'primary_thumbnail',
				'default' => 'thumbnail',
				'separator' => 'none',
			]
		);
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'flipbox_image_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			"secondary_image",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => __( "Secondary Image", "cea" ),
				"description"	=> esc_html__( "Choose secondary image.", "cea" ),
				"dynamic" => [
					"active" => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);	
		$this->add_control(
			"secondary_img_style",
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
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'secondary_thumbnail',
				'default' => 'thumbnail',
				'separator' => 'none',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		//Flipbox Content
		$this->start_controls_section(
			'section_flipbox_content',
			[
				'label' => esc_html__( 'Content', 'cea' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs( 'flipbox_content' );
		$this->start_controls_tab(
			'flipbox_content_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);	
		$this->add_control(
			"primary_content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Primary Content", "cea" ),
				"description"	=> esc_html__( "You can give the flip box primary content here.", "cea" ),
				"default" 		=> esc_html__( "Flip box primary content.", "cea" ),
			]
		);		
		$this->end_controls_tab();		
		$this->start_controls_tab(
			'flipbox_content_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);		
		$this->add_control(
			"secondary_content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Secondary Content", "cea" ),
				"description"	=> esc_html__( "You can give the flip box secondary content here.", "cea" ),
				"default" 		=> esc_html__( "Flip box secondary content.", "cea" ),
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Flip Box
		$this->start_controls_section(
			'section_style_flip',
			[
				'label' => esc_html__( 'Flip Box', 'cea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'flipbox_height',
			[
				'label' => esc_html__( 'Height', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 300,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 600,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'flipbox_padding',
			[
				'label' => esc_html__( 'Flip Box Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-front, {{WRAPPER}} .flip-box-wrapper .flip-back ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'flipbox_typography',
				'selector' 		=> '{{WRAPPER}} .flip-box-wrapper'
			]
		);
		$this->add_responsive_control(
			'flipbox_text_align',
			[
				'label' => __( 'Alignment', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'cea' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cea' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'cea' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'cea' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( 'flipbox_general_styles' );
		$this->start_controls_tab(
			'front_general_style',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'front_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .flip-box-inner .flip-front' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			"shadow_opt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
				"description"	=> esc_html__( "This is option for enable box shadow on flip box front.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"flip_box_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", "cea" ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"box_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", "cea" ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", "cea" ),
					'inset' => esc_html__( "Inset", "cea" ),
				],
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_general_style',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			'back_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .flip-box-inner .flip-back' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			"hshadow_opt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
				"description"	=> esc_html__( "This is option for enable box shadow on flip box back.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"hover_box_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", "cea" ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'hshadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{hover_box_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"hover_box_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", "cea" ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", "cea" ),
					'inset' => esc_html__( "Inset", "cea" ),
				],
				'condition' => [
					'hshadow_opt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->end_controls_section();
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'title_colors' );
		$this->start_controls_tab(
			'front_title_settings',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			"front_title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the front title color.", "cea" ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-title' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			'front_title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'front_title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'cea' ),
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
					'{{WRAPPER}} .flip-front .flip-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'front_title_typography',
				'selector' 		=> '{{WRAPPER}} .flip-front .flip-box-title'
			]
		);	
		$this->end_controls_tab();
		$this->start_controls_tab(
			'back_title_settings',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			"back_title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the font color.", "cea" ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'back_title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'back_title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'cea' ),
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
					'{{WRAPPER}} .flip-back .flip-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'back_title_typography',
				'selector' 		=> '{{WRAPPER}} .flip-back .flip-box-title'
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'cea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'icon_colors' );
		$this->start_controls_tab(
			'icon_colors_primary',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			'front_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'primary_icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.cea-primary-icon-view-default) .flip-front .flip-box-icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'front_icon_fore_color',
			[
				'label' => esc_html__( 'Fore Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flip-front .flip-box-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}}.cea-primary-icon-view-framed .flip-front .flip-box-icon' => 'border-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'front_icon_size',
			[
				'label' => esc_html__( 'Size', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'front_icon_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}:not(.cea-primary-icon-view-default) .flip-front .flip-box-icon' => 'padding: {{SIZE}}{{UNIT}};'
				],
				'defailt' => [
					'unit' => 'px',
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'primary_icon_view!' => 'default',
				],
			]
		);
		$this->add_responsive_control(
			'front_icon_rotate',
			[
				'label' => esc_html__( 'Rotate', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
			'front_icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'primary_icon_view' => 'framed',
				],
			]
		);
		$this->add_control(
			'front_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flip-front .flip-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'secondary_icon_shape' => 'circle',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_colors_secondary',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			'back_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'secondary_icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.cea-secondary-icon-view-default) .flip-back .flip-box-icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'back_icon_fore_color',
			[
				'label' => esc_html__( 'Fore Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .flip-back .flip-box-icon svg' => 'fill: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'back_icon_size',
			[
				'label' => esc_html__( 'Size', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'back_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}:not(.cea-primary-icon-view-default) .flip-back .flip-box-icon' => 'padding: {{SIZE}}{{UNIT}};'
				],
				'defailt' => [
					'unit' => 'px',
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'secondary_icon_view!' => 'default',
				],
			]
		);
		$this->add_responsive_control(
			'back_icon_rotate',
			[
				'label' => esc_html__( 'Rotate', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_control(
			'back_icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'secondary_icon_view' => 'framed',
				],
			]
		);
		$this->add_control(
			'back_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flip-back .flip-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'secondary_icon_shape' => 'circle',
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
				'label' => __( 'Image', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'fbox_image_styles' );
		$this->start_controls_tab(
			'front_img_settings',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			"front_img_resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea" ),
				"description"	=> esc_html__( "Enable resize option.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'front_img_size',
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
					'front_img_resize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-box-image > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-box-image' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_control(
			'front_img_bg',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-box-image > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'front_img_spacing',
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
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-box-image' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'front_img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-box-image > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'front_img_border',
					'label' => esc_html__( 'Border', 'cea' ),
					'selector' => '{{WRAPPER}} .flip-box-wrapper .flip-front .flip-box-image > img'
				]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_img_settings',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			"back_img_resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea" ),
				"description"	=> esc_html__( "Enable resize option.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'back_img_size',
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
					'back_img_resize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-box-image > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-box-image' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_control(
			'back_img_bg',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-box-image > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'back_img_spacing',
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
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-box-image' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'back_img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-box-image > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'back_img_border',
					'label' => esc_html__( 'Border', 'cea' ),
					'selector' => '{{WRAPPER}} .flip-box-wrapper .flip-back .flip-box-image > img'
				]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->end_controls_section();
		
		//Style Button Section
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'cea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'flipbox_button_styles' );
		$this->start_controls_tab(
			'flipbox_front_button_style',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			'flipbox_front_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flip-front .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'flipbox_front_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .flip-front .cea-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flipbox_front_button_',
				'selector' => '{{WRAPPER}} .flip-front .cea-button',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'flipbox_front_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flip-front .cea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'flipbox_front_button_box_shadow',
				'selector' => '{{WRAPPER}} .flip-front .cea-button',
			]
		);
		$this->add_responsive_control(
			'flipbox_front_button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flip-front .cea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'flipbox_front_button_spacing',
			[
				'label' => esc_html__( 'Button Spacing', 'cea' ),
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
					'{{WRAPPER}} .flip-front .cea-button' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'front_button_typography',
				'selector' 		=> '{{WRAPPER}} .flip-front .cea-button'
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'flipbox_back_button_style',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			'flipbox_back_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flip-back .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'flipbox_back_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .flip-back .cea-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'flipbox_back_button_',
				'selector' => '{{WRAPPER}} .flip-back .cea-button',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'flipbox_back_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flip-back .cea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'flipbox_back_button_box_shadow',
				'selector' => '{{WRAPPER}} .flip-back .cea-button',
			]
		);
		$this->add_responsive_control(
			'flipbox_back_button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flip-back .cea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'flipbox_back_button_spacing',
			[
				'label' => esc_html__( 'Button Spacing', 'cea' ),
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
					'{{WRAPPER}} .flip-back .cea-button' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'back_button_typography',
				'selector' 		=> '{{WRAPPER}} .flip-back .cea-button'
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();	
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'front_content_styles' );
		$this->start_controls_tab(
			'front_content_settings',
			[
				'label' => esc_html__( 'Front', 'cea' ),
			]
		);
		$this->add_control(
			'front_content_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-content' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'front_content_spacing',
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
					'{{WRAPPER}} .flip-box-wrapper .flip-front .flip-content' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'back_content_settings',
			[
				'label' => esc_html__( 'Back', 'cea' ),
			]
		);
		$this->add_control(
			'back_content_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-content' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'back_content_spacing',
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
					'{{WRAPPER}} .flip-box-wrapper .flip-back .flip-content' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);		
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->end_controls_section();
	
	}
	
	/**
	 * Render Flip Box widget output on the frontend.
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
		
		$this->add_render_attribute( 'flip-box-container', 'class', 'elementor-widget-container flip-box-wrapper' );
		?>
		<div <?php echo ''. $this->get_render_attribute_string( 'flip-box-container' ); ?>>
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
	 * Render Flip Box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$this->_settings = $settings;		
		
		$redirect = isset( $settings['redirect'] ) && $settings['redirect'] == 'yes' ? true : false;
		
		//Layout Section
		$default_items = array( 
			'icon'	=> esc_html__( 'Icon', 'cea' ),
			'title'	=> esc_html__( 'Title', 'cea' ),
			'content'	=> esc_html__( 'Content', 'cea' )
		);
		
		$p_elemetns = isset( $settings['flip_primary_items'] ) && !empty( $settings['flip_primary_items'] ) ? json_decode( $settings['flip_primary_items'], true ) : array( 'Enabled' => $default_items );
		$s_elemetns = isset( $settings['flip_secondary_items'] ) && !empty( $settings['flip_secondary_items'] ) ? json_decode( $settings['flip_secondary_items'], true ) : array( 'Enabled' => $default_items );
		
		$this->add_render_attribute( 'flip-box-inner', 'class', 'flip-box-inner' );
		$this->add_render_attribute( 'flip-box-inner', 'class', $settings['flip_style'] );
		
		if ( $redirect && !empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'flip-link-wrapper', $settings['link'] );
			echo '<a '. $this->get_render_attribute_string( 'flip-link-wrapper' ) .'>';
		}
		
		echo '<div '. $this->get_render_attribute_string( 'flip-box-inner' ) .'>';
			$part = 'primary';
			echo '<div class="flip-front">';
				echo '<div class="flip-front-inner">';
					if( isset( $p_elemetns['Enabled'] ) && !empty( $p_elemetns['Enabled'] ) ) :
						foreach( $p_elemetns['Enabled'] as $element => $value ){
							$this->cea_flipbox_shortcode_elements( $element, $part );
						}
					endif;
				echo '</div><!-- .flip-front-inner -->';
			echo '</div><!-- .flip-front -->';
			$part = 'secondary';
			echo '<div class="flip-back">';
				echo '<div class="flip-back-inner">';
					if( isset( $s_elemetns['Enabled'] ) && !empty( $s_elemetns['Enabled'] ) ) :
						foreach( $s_elemetns['Enabled'] as $element => $value ){
							$this->cea_flipbox_shortcode_elements( $element, $part );
						}
					endif;
				echo '</div><!-- .flip-back-inner -->';
			echo '</div><!-- .flip-back -->';
		echo '</div><!-- .flip-inner -->';
		
		if ( $redirect && !empty( $settings['link']['url'] ) ) {
			echo '</a><!-- .flip link close -->';
		}

	}
	
	function cea_flipbox_shortcode_elements( $element, $part = 'primary' ){
		
		$settings = $this->_settings;
		
		switch( $element ){
		
			case "title":
				$title = $settings[$part.'_title'];
				$title_head = !empty( $settings[$part.'_title_head'] ) ? $settings[$part.'_title_head'] : 'h3';
				if( $title ){
					echo '<'. esc_attr( $title_head ) .' class="flip-box-title">'. esc_html( $title) .'</'. esc_attr( $title_head ) .'>';
				}
			break;
			
			case "icon":
				$this->add_render_attribute( $part.'-icon-wrapper', 'class', 'flip-box-icon' );
				if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
					// add old default
					$settings['icon'] = 'ti-heart';
				}
				if ( ! empty( $settings['icon'] ) ) {
					$this->add_render_attribute(  $part.'-icon', 'class', $settings['icon'] );
					$this->add_render_attribute(  $part.'-icon', 'aria-hidden', 'true' );
				}		
				$migrated = isset( $settings['__fa4_migrated'][$part.'_icon'] );
				$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
				echo '<div '. $this->get_render_attribute_string( $part.'-icon-wrapper' ) .'>';
					if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings[$part.'_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string(  $part.'-icon' ); ?>></i>
					<?php endif; 
				echo '</div>';
			break;
			
			case "image":
				$this->image_class = $part.'_image_class';
				$this->add_render_attribute( $part.'-flip-box-image', 'class', 'flip-box-image' );				
				if ( ! empty( $settings[$part.'_image']['url'] ) ) {
					$this->add_render_attribute( $part.'_image', 'src', $settings[$part.'_image']['url'] );
					$this->add_render_attribute( $part.'_image', 'alt', Control_Media::get_image_alt( $settings[$part.'_image'] ) );
					$this->add_render_attribute( $part.'_image', 'title', Control_Media::get_image_title( $settings[$part.'_image'] ) );
					$this->add_render_attribute( $part.'_image_class', 'class', 'img-fluid' );
					$this->add_render_attribute( $part.'_image_class', 'class', $settings[$part.'_img_style'] );
					$flip_image = Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, $part.'_thumbnail', $part.'_image', $this );
					echo '<div '. $this->get_render_attribute_string( $part.'-flip-box-image' ) .'>'. $flip_image .'</div>';
				}				
			break;
			
			case "btn":
				if( $part == 'secondary' ){
					$this->add_render_attribute( 'button-back-wrapper', 'class', 'cea-button-wrapper' );
					if ( ! empty( $settings['button_back_link']['url'] ) ) {
						$this->add_link_attributes( 'button_back', $settings['button_back_link'] );
						$this->add_render_attribute( 'button_back', 'class', 'cea-button-link' );
					}
					$this->add_render_attribute( 'button_back', 'class', 'elementor-button cea-button' );
					if ( ! empty( $settings['button_css_id'] ) ) {
						$this->add_render_attribute( 'button_back', 'id', $settings['button_css_id'] );
					}
					if ( ! empty( $settings['button_size'] ) ) {
						$this->add_render_attribute( 'button_back', 'class', 'elementor-size-' . $settings['button_size'] );
					}
					if ( $settings['button_hover_animation'] ) {
						$this->add_render_attribute( 'button_back', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
					}
					?>
					<div <?php echo $this->get_render_attribute_string( 'button-back-wrapper' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'button_back' ); ?>>
							<?php $this->button_render_text( $part ); ?>
						</a>
					</div>
					<?php
				}else{
					$this->add_render_attribute( 'button-wrapper', 'class', 'cea-button-wrapper' );
					if ( ! empty( $settings['button_link']['url'] ) ) {
						$this->add_link_attributes( 'button', $settings['button_link'] );
						$this->add_render_attribute( 'button', 'class', 'cea-button-link' );
					}
					$this->add_render_attribute( 'button', 'class', 'elementor-button cea-button' );
					if ( ! empty( $settings['button_css_id'] ) ) {
						$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
					}
					if ( ! empty( $settings['button_size'] ) ) {
						$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
					}
					if ( $settings['button_hover_animation'] ) {
						$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
					}
					?>
					<div <?php echo $this->get_render_attribute_string( 'button-wrapper' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
							<?php $this->button_render_text(); ?>
						</a>
					</div>
					<?php
				}
			break;
			
			case "content":
				if( !empty( $settings[$part.'_content'] ) ) echo '<div class="flip-content">'. $settings[$part.'_content'] .'</div>';
			break;
		
		}
	}
	
	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function button_render_text( $part = 'primary' ) {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if( $part == 'secondary' ){
			if ( ! $is_new && empty( $settings['button_back_icon_align'] ) ) {
				// @todo: remove when deprecated
				// added as bc in 2.6
				//old default
				$settings['button_back_icon_align'] = $this->get_settings( 'button_back_icon_align' );
			}

			$this->add_render_attribute( [
				'back-content-wrapper' => [
					'class' => 'cea-button-content-wrapper',
				],
				'back-icon-align' => [
					'class' => [
						'cea-button-icon',
						'cea-align-icon-' . $settings['button_back_icon_align'],
					],
				],
				'back-text' => [
					'class' => 'cea-button-text',
				],
			] );

			$this->add_inline_editing_attributes( 'back_text', 'none' );
			?>
			<span <?php echo $this->get_render_attribute_string( 'back-content-wrapper' ); ?>>
				<?php if ( ! empty( $settings['button_back_icon'] ) || ! empty( $settings['button_back_icon']['value'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'back-icon-align' ); ?>>
					<?php if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['button_back_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i class="<?php echo esc_attr( $settings['button_back_icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<span <?php echo $this->get_render_attribute_string( 'back-text' ); ?>><?php echo $settings['button_back_text']; ?></span>
			</span>
			<?php
		}else{

			if ( ! $is_new && empty( $settings['button_icon_align'] ) ) {
				// @todo: remove when deprecated
				// added as bc in 2.6
				//old default
				$settings['button_icon_align'] = $this->get_settings( 'button_icon_align' );
			}

			$this->add_render_attribute( [
				'content-wrapper' => [
					'class' => 'cea-button-content-wrapper',
				],
				'icon-align' => [
					'class' => [
						'cea-button-icon',
						'cea-align-icon-' . $settings['button_icon_align'],
					],
				],
				'text' => [
					'class' => 'cea-button-text',
				],
			] );

			$this->add_inline_editing_attributes( 'text', 'none' );
			?>
			<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
				<?php if ( ! empty( $settings['button_icon'] ) || ! empty( $settings['button_icon']['value'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
					<?php if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				</span>
				<?php endif; ?>
				<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['button_text']; ?></span>
			</span>
			<?php
		}
	}
	
}