<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Pricing Table
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
 
class CEA_Elementor_Pricing_Table_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Pricing Table widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceapricingtable";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Pricing Table widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Pricing Table", "cea" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Pricing Table widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-column3";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Pricing Table widget belongs to.
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
	 * Register Pricing Table widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//Pricing Table Section
		$this->start_controls_section(
			"pt_section",
			[
				"label"	=> esc_html__( "Pricing Table", "cea" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "General pricing table options.", "cea" ),
			]
		);		
		$this->add_control(
			"pricing_items",
			[
				"label"				=> "Pricing Table Items",
				"description"		=> esc_html__( "This is settings for pricing table custom layout. here you can set your own layout. Drag and drop needed pricing items to Enabled part.", "cea" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					'Enabled' => array( 
						'title'		=> esc_html__( 'Title', 'cea' ),
						'price'		=> esc_html__( 'Price Info', 'cea' ),
						'features'	=> esc_html__( 'Features List', 'cea' ),
						'btn'		=> esc_html__( 'Button', 'cea' )			
					),
					'disabled' => array(
						'image'		=> esc_html__( 'Image', 'cea' ),
						'video'		=> esc_html__( 'Video', 'cea' ),
						'icon'		=> esc_html__( 'Icon', 'cea' ),
						'content'	=> esc_html__( 'Content', 'cea' )
					)
				]
			]
		);
		$this->add_control(
			"price_before",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Price Before Text", "cea" ),
				"description"	=> esc_html__( "This is before text field for price.", "cea" ),
				"default"		=> esc_html__( "Free member", "cea" )
			]
		);
		$this->add_control(
			"price",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Price", "cea" ),
				"description"	=> esc_html__( "This is field for price.", "cea" ),
				"default"		=> "$100"
			]
		);
		$this->add_control(
			"price_after",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Price After Text", "cea" ),
				"description"	=> esc_html__( "This is after text field for price.", "cea" ),
				"default"		=> esc_html__( "per year", "cea" )
			]
		);
		$this->add_control(
			"title_stat",
			[
				"label" 		=> esc_html__( "Active/Inactive", "cea" ),
				"description"	=> esc_html__( "This is option for set title status active or inactive.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "yes"
			]
		);
		
		$repeater = new Repeater();
		$repeater->add_control(
			"title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Pricing Feature", "cea" ),
				"description"	=> esc_html__( "Pricing Features Name", "cea" ),
				"default" 		=> esc_html__( "Feature", "cea" )
			]
		);
		$this->add_control(
			"pricing_titles",
			[
				"label"			=> esc_html__( "Price Features List", "cea" ),
				"description"	=> esc_html__( "This is options for price features list.", "cea" ),
				"type"			=> Controls_Manager::REPEATER,
				"fields"		=> $repeater->get_controls(),
				"default"		=> [
					[
						"title" 		=> esc_html__( "Feature", "cea" ),
						"title_stat"	=> "yes"
					]
				],
				"title_field"	=> "{{{ title }}}",
			]
		);
		$this->end_controls_section();
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Layouts options available here.", "cea" ),
			]
		);
		$this->add_control(
			"pricing_layout",
			[
				"label"			=> esc_html__( "Pricing Table Layout", "cea" ),
				"description"	=> esc_html__( "Here you can choose the pricing table layout.", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "classic",
				"options"		=> [
					"default"	=> esc_html__( "Default", "cea" ),
					"classic"	=> esc_html__( "Classic", "cea" ),
					"modern"	=> esc_html__( "Modern", "cea" )
				]
			]
		);
		$this->add_responsive_control(
			'alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
		//Title Section
		$this->start_controls_section(
			"title_section",
			[
				"label"			=> esc_html__( "Title", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Title options available here.", "cea" )
			]
		);
		$this->add_control(
			"title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Pricing Title", "cea" ),
				"description"	=> esc_html__( "Input pricing table title here.", "cea" ),
				"default" 		=>  esc_html__( "Pricing Title", "cea" )
			]
		);		
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Title Heading Tag", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h5",
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
					'{{WRAPPER}} .pricing-table-wrapper .pricing-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();		
		
		//Icon Section
		$this->start_controls_section(
			"icon_section",
			[
				"label"			=> esc_html__( "Icons", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Icons options available here.", "cea" ),
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'cea' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
			]
		);
		$this->add_control(
			'icon_view',
			[
				'label' => esc_html__( 'View', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'cea' ),
					'stacked' => esc_html__( 'Stacked', 'cea' ),
					'framed' => esc_html__( 'Framed', 'cea' ),
				],
				'default' => 'default',
				'prefix_class' => 'cea-view-',
			]
		);
		$this->add_control(
			'icon_shape',
			[
				'label' => esc_html__( 'Shape', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'cea' ),
					'square' => esc_html__( 'Square', 'cea' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
				],
				'prefix_class' => 'cea-shape-',
			]
		);
		$this->end_controls_section();
		
		// Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"			=> esc_html__( "Image", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Pricing image options available here.", "cea" ),
			]
		);
		$this->add_control(
			"image",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => esc_html__( "Image", "cea" ),
				"description"	=> esc_html__( "Choose pricing image.", "cea" ),
				"dynamic" => [
					"active" => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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

		// Button
		$this->start_controls_section(
			"button_section",
			[
				"label"			=> esc_html__( "Button", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Button options available here.", "cea" ),
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
		$this->end_controls_section();	
		
		// Video Section
		$this->start_controls_section(
			"video_section",
			[
				"label"			=> esc_html__( "Video", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Pricing video options available here.", "cea" ),
			]
		);
		$this->add_control(
			"pricing_video",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Pricing Video", "cea" ),
				"description"	=> esc_html__( "Choose pricing video. This url maybe youtube or vimeo video. Example https://www.youtube.com/embed/qAHRvrrfGC4", "cea" ),
				"default"		=> ""
			]
		);
		$this->end_controls_section();
		
		// Content Section
		$this->start_controls_section(
			"content_section",
			[
				"label"			=> esc_html__( "Content", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Pricing content options available here.", "cea" ),
			]
		);
		$this->add_control(
			"pricing_content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Pricing Content", "cea" ),
				"description"	=> esc_html__( "This is option for pricing content.", "cea" ),
				"default" 		=> ""
			]
		);
		$this->end_controls_section();
		
		//Ribbon Section
		$this->start_controls_section(
			"ribbon_section",
			[
				"label"			=> esc_html__( "Ribbon", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Ribbon options available here.", "cea" ),
			]
		);
		$this->add_control(
			"ribbon_opt",
			[
				"label" 		=> esc_html__( "Ribbon Option", "cea" ),
				"description"	=> esc_html__( "This is option for pricing table ribbon. If you enable this option, then it's showing ribbon settings i.e color, text, etc.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"ribbon_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Ribbon Text", "cea" ),
				"description"	=> esc_html__( "This is option for ribbon text field for price.", "cea" ),
				"default"		=> "",
				"condition" 	=> [
					"ribbon_opt" 	=> "yes"
				]
			]
		);
		$this->add_control(
			"ribbon_position",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Choose Ribbon Position", "cea" ),
				"description"	=> esc_html__( "Choose ribbon position for change pricing table ribbon layout.", "cea" ),
				"default"		=> "top-left",
				"options"		=> [
					"top-left"		=> esc_html__( "Top Left", "cea" ),
					"top-right"		=> esc_html__( "Top Right", "cea" ),
					"bottom-left"	=> esc_html__( "Bottom Left", "cea" ),
					"bottom-right"	=> esc_html__( "Bottom Right", "cea" )
				],
				"condition" 	=> [
					"ribbon_opt" 	=> "yes"
				]
			]
		);
		$this->end_controls_section();
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'pricing_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'pricing_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'general_styles' );
			$this->start_controls_tab(
				'general_normal',
				[
					'label' => esc_html__( 'Normal', 'cea' ),
				]
			);
			$this->add_control(
				'font_color',
				[
					'label' => esc_html__( 'Font Color', 'cea' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'bg_color',
				[
					'label' => esc_html__( 'Background Color', 'cea' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
					[
						'name' => 'pricing_box_border',
						'label' => esc_html__( 'Border', 'cea' ),
						'selector' => '{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper'
					]
			);
			$this->add_control(
				'pricing_box_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'cea' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'pricing_box_border_border!' => '',
					],
				]
			);
			$this->add_control(
				"shadow_opt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on pricing box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"pricing_box_shadow",
				[
					"label" 		=> esc_html__( "Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on pricing box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_opt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper .pricing-inner-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{pricing_box_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"pricing_box_shadow_pos",
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
				'general_hover',
				[
					'label' => esc_html__( 'Hover', 'cea' ),
				]
			);
			$this->add_control(
				'font_hcolor',
				[
					'label' => esc_html__( 'Font Color', 'cea' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-inner-wrapper' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'bg_hcolor',
				[
					'label' => esc_html__( 'Background Color', 'cea' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-inner-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_hopt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on pricing box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"pricing_hbox_shadow",
				[
					"label" 		=> esc_html__( "Hover Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on pricing box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_hopt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-inner-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{pricing_hbox_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"pricing_hbox_shadow_pos",
				[
					'label' =>  esc_html__( "Box Shadow Position", "cea" ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						' ' => esc_html__( "Outline", "cea" ),
						'inset' => esc_html__( "Inset", "cea" ),
					],
					'condition' => [
						'shadow_hopt' => 'yes',
					],
					'default' => ' ',
					'render_type' => 'ui',
				]
			);
			$this->end_controls_tab();	
		$this->end_controls_tabs();	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'pricing_general_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper'
			]
		);		
		$this->end_controls_section();		
		
		// Style Pricing Section		
		$this->start_controls_section(
			'section_style_pricing',
			[
				'label' => __( 'Pricing Header', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'pricing_header_styles' );
		$this->start_controls_tab(
			'pricing_header_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'pricing_header_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-table-info' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'pricing_header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-table-info' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_header_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'pricing_header_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-table-info' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'pricing_header_bg_hcolor',
			[
				'label' => esc_html__( 'Hover Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-table-info' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_control(
			'pricing_header_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-table-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'pricing_header_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-table-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Header Typo', 'cea' ),
				'name' 			=> 'pricing_header_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper .pricing-table-info'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Price Typo', 'cea' ),
				'name' 			=> 'price_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper .pricing-table-info .price-text > span'
			]
		);
		$this->add_responsive_control(
			'heading_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-table-info' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pricing-table-wrapper .pricing-table-info' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Features Section		
		$this->start_controls_section(
			'section_style_features',
			[
				'label' => __( 'Pricing Features', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'pricing_features_styles' );
		$this->start_controls_tab(
			'pricing_feature_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'features_list_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-features-list' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_bg',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-features-list' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_feature_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'features_list_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-features-list' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_hbg',
			[
				'label' => esc_html__( 'Hover Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-features-list' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_control(
			'features_list_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'features_list_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-features-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'features_list_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper .pricing-features-list'
			]
		);
		$this->add_responsive_control(
			'list_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-features-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pricing-table-wrapper .pricing-features-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
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
			'title_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			"title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the font color.", "cea" ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-title, {{WRAPPER}} .pricing-table-wrapper .pricing-title > a' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			"title_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Hover Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the font color.", "cea" ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-title, {{WRAPPER}} .pricing-table-wrapper:hover .pricing-title > a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_spacing',
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
					'{{WRAPPER}} .pricing-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'pricing_title_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper .pricing-title'
			]
		);	
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
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pricing-icon svg' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .pricing-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked .pricing-icon' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .pricing-icon' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);

		$this->add_control(
			'icon_primary_hcolor',
			[
				'label' => esc_html__( 'Primary Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .pricing-icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'icon_secondary_hcolor',
			[
				'label' => esc_html__( 'Secondary Hover Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed:hover .pricing-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked:hover .pricing-icon' => 'background-color: {{VALUE}};'
				],
			]
		);		
		$this->add_control(
			'icon_border_hcolor',
			[
				'label' => esc_html__( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed:hover .pricing-icon' => 'border-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}.cea-view-stacked .pricing-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.cea-view-framed .pricing-icon' => 'padding: {{SIZE}}{{UNIT}};'
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
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'icon_rotate',
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
					'{{WRAPPER}} .pricing-icon i, {{WRAPPER}} .pricing-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
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
					'{{WRAPPER}} .pricing-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pricing-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);
		$this->add_control(
			'icon_animation',
			[
				'label' => esc_html__( 'Icon Animation', 'cea' ),
				'type' => Controls_Manager::ANIMATION,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-icon.cea-elementor-animation' => 'animation-name: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();
		
		// Style Image Section		
		$this->start_controls_section(
			'section_style_pricing_image',
			[
				'label' => __( 'Image', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'pricing_image_styles' );
		$this->start_controls_tab(
			'pricing_img_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'pricing_img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-image > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_img_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'pricing_img_bg_hcolor',
			[
				'label' => esc_html__( 'Hover Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-image > img' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();			
			
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
					'{{WRAPPER}} .pricing-image > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .pricing-image' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
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
					'{{WRAPPER}} .pricing-image' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;'
				],
			]
		);		
		$this->add_control(
			'pricing_img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-image > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'pricing_img_border',
					'label' => esc_html__( 'Border', 'cea' ),
					'selector' => '{{WRAPPER}} .pricing-image > img'
				]
		);
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Button', 'cea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .cea-button',
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
					'{{WRAPPER}} .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
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
					'{{WRAPPER}} .cea-button' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-button:hover svg, {{WRAPPER}} .cea-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'cea' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .cea-button',
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
					'{{WRAPPER}} .cea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cea-button',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'button_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .cea-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pricing-table-wrapper .cea-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper .cea-button'
			]
		);
		$this->end_controls_section();	
		
		// Style Image Section		
		$this->start_controls_section(
			'section_style_video',
			[
				'label' => __( 'Pricing Video', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'pricing_video_styles' );
		$this->start_controls_tab(
			'pricing_video_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'video_list_bg',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-video' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_video_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'video_list_hbg',
			[
				'label' => esc_html__( 'Hover Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-video' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_control(
			'video_list_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'video_list_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-video' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'video_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-video' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pricing-table-wrapper .pricing-video' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'pricing_content_styles' );
		$this->start_controls_tab(
			'pricing_content_normal',
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
					'{{WRAPPER}} .pricing-table-wrapper .pricing-content' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_bg',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .pricing-content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pricing_content_hover',
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
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-content' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_hbg',
			[
				'label' => esc_html__( 'Hover Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper:hover .pricing-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_responsive_control(
			'desc_spacing',
			[
				'label' => esc_html__( 'Description Spacing', 'cea' ),
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
					'{{WRAPPER}} .pricing-table-wrapper .pricing-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .pricing-table-wrapper .pricing-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .pricing-table-wrapper .pricing-content'
			]
		);	
		$this->end_controls_section();
			
	}
	
	/**
	 * Render Pricing Table widget output on the frontend.
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

		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';	
		$class .= isset( $pricing_layout ) ? ' pricing-style-' . $pricing_layout : '';
		?>
		
		<div class="elementor-widget-container pricing-table-wrapper<?php echo esc_attr( $class ); ?>" >
		
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
	 * Render Pricing Table widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		//Define Variables
		$default_items = array( 
			'title'		=> esc_html__( 'Title', 'cea' ),
			'price'		=> esc_html__( 'Price Info', 'cea' ),
			'features'	=> esc_html__( 'Features List', 'cea' ),
			'btn'		=> esc_html__( 'Button', 'cea' )			
		);
		$elemetns = isset( $pricing_items ) && !empty( $pricing_items ) ? json_decode( $pricing_items, true ) : array( 'Enabled' => $default_items );
	
		if( isset( $elemetns['Enabled'] ) ) :
			
			/*
			if( isset( $ribbon_opt ) && $ribbon_opt == 'yes' ) :
				$ribbon_class = isset( $ribbon_position ) ? ' ' . $ribbon_position : '';
				$ribbon_text = isset( $ribbon_text ) && $ribbon_text != '' ? $ribbon_text : '';
				echo '<div class="corner-ribbon'. esc_attr( $ribbon_class ) .'">'. esc_html( $ribbon_text ) .'</div>';
			endif;
			*/
			
			echo '<div class="pricing-inner-wrapper">';
			
				foreach( $elemetns['Enabled'] as $element => $value ){
					switch( $element ){
						
						case "title":
							if( isset( $title ) && $title != '' ) : 
								$title_head = isset( $title_head ) && $title_head != '' ? $title_head : 'h3';
								echo '<div class="pricing-table-head">';
									echo '<'. esc_attr( $title_head ) .' class="pricing-title">' . esc_html( $title ) . '</'. esc_attr( $title_head ) .'>';
								echo '</div><!-- .pricing-table-head -->';
							endif;						
						break;
						
						case "icon":
							if( isset( $elemetns['Enabled']['icon'] ) ){
								echo '<div class="pricing-icon-wrap">';
									$this->add_render_attribute( 'icon-wrapper', 'class', 'pricing-icon' );
									if ( ! empty( $settings['icon_animation'] ) ) {
										$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-elementor-animation' );
									}
									if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
										// add old default
										$settings['icon'] = 'ti-heart';
									}
									if ( ! empty( $settings['icon'] ) ) {
										$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
										$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
									}		
									$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
									$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
									if( $settings['selected_icon'] ){
										echo '<div '. $this->get_render_attribute_string( 'icon-wrapper' ) .'>';
											if ( $is_new || $migrated ) :
												Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
											else : ?>
												<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
											<?php endif; 
										echo '</div>';
									}
									unset( $elemetns['Enabled']['icon'] );
								echo '</div>';
							}
						break;
						
						case "price":
							echo '<div class="pricing-table-info">';
								if( isset( $price_before ) && $price_before != '' ):
									echo '<div class="price-before">';
										echo '<span>' . esc_html( $price_before ) . '</span>';
									echo '</div><!-- .price-before -->';
								endif;
								
								if( isset( $price ) && $price != '' ):
									echo '<div class="price-text">';
										echo '<span>' . esc_html( $price ) . '</span>';
									echo '</div><!-- .price-text -->';
								endif;
								
								if( isset( $price_after ) && $price_after != '' ):
									echo '<div class="price-after">';
										echo '<span>' . esc_html( $price_after ) . '</span>';
									echo '</div><!-- .price-after -->';
								endif;
							echo '</div><!-- .pricing-table-info -->';
						break;
						
						case "features":
							$prc_fetrs =  isset( $pricing_titles ) ? $pricing_titles : ''; // $prc_fetrs is pricing features
							if( $prc_fetrs ):
								echo '<div class="pricing-table-body">';
									echo '<ul class="pricing-features-list list-group">';
									foreach( $prc_fetrs as $feature ) {
										$status = isset( $feature['title_stat'] ) && $feature['title_stat'] != 'yes' ? ' feature-inactive' : '';
										$p_title = isset( $feature['title'] ) ? $feature['title'] : '';
										echo '<li class="list-group-item'. esc_attr( $status ) .'">'. esc_html( $p_title ) . '</li>';
									}
									echo '</ul>';
								echo '</div><!-- .pricing-table-body -->';
							endif;
						break;
						
						case "image":
							$img_class = $image_html = '';
							if ( ! empty( $settings['image']['url'] ) ) {
								$this->image_class = 'image_class';
								$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
								$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
								$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
								$this->add_render_attribute( 'image_class', 'class', 'img-fluid' );
								$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] );

								if ( $settings['hover_animation'] ) {
									$this->add_render_attribute( 'image_class', 'class', 'elementor-animation-' . $settings['hover_animation'] );
									
								}
								$fbox_image = Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'thumbnail', 'image', $this );
								echo '<figure class="pricing-image">' . $fbox_image . '</figure>';
							}
						break;
						
						case "video":
							if( isset( $pricing_video ) && !empty( $pricing_video ) ) :
									echo '<div class="pricing-video">';
										echo do_shortcode( '[videoframe url="'. esc_url( $pricing_video ).'" width="100%" height="100%" params="byline=0&portrait=0&badge=0" /]' );
									echo '</div><!-- .pricing-video -->';
							endif;
						break;
						
						case "btn":
							$this->add_render_attribute( 'button-wrapper', 'class', 'pricing-table-foot' );
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
							//if ( $settings['button_hover_animation'] ) {
								//$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
							//}
							?>
							<div <?php echo $this->get_render_attribute_string( 'button-wrapper' ); ?>>
								<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
									<?php $this->button_render_text(); ?>
								</a>
							</div>
						<?php
						break;
						
						case "content":
							if( isset( $pricing_content ) && $pricing_content != '' ):
								echo '<div class="pricing-content">';
									echo esc_textarea( $pricing_content ); 
								echo '</div><!-- .pricing-content -->';
							endif;
						break;

					}
				} // foreach end
				
			echo '</div><!-- .pricing-inner-wrapper -->';			
			
		endif;
	}
	
	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function button_render_text() {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

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
			<?php if ( ! empty( $settings['button_icon'] ) && ! empty( $settings['button_icon']['value'] ) ) : ?>
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