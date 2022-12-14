<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Content Carousel
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Content_Carousel_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Blog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "contentcarousel";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Content Carousel", "cea" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-slider-alt";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Content Carousel widget belongs to.
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
		return [ 'owl-carousel', 'cea-custom-front'  ];
	}

		
	/**
	 * Register Content Carousel widget controls. 
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
				"description"	=> esc_html__( "Default blog options.", "cea" ),
			]
		);
		$this->add_control(
			"title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Title", "cea" ),
				"description"	=> esc_html__( "Here you put the circle progress title.", "cea" ),
				"default" 		=> ""
			]
		);
		$this->add_control(
			"title_tag",
			[
				"label"			=> esc_html__( "Title Tag", "cea" ),
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
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Circle progress layout options here available.", "cea" ),
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
					'{{WRAPPER}} .cea-carousel .owl-slide-item' => 'text-align: {{VALUE}};',
				],
			]
		);			
		$this->add_control(
			"layout",
			[
				"label"			=> esc_html__( "Carousel Style Layout", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"	=> esc_html__( "Default", "cea" ),
					"classic"	=> esc_html__( "Classic", "cea" ),
					"modern"	=> esc_html__( "Modern", "cea" ),
					"list"		=> esc_html__( "List", "cea" ),
				]
			]
		);
		$this->end_controls_section();

		//Content Section
		$this->start_controls_section(
			"content_section",
			[
				"label"			=> esc_html__( "Content", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Content carousel inner shortcodes.", "cea" ),
			]
		);
		
		$repeater = new Repeater();
		$repeater->add_control(
			"inner_content",
			[
				"type"			=> Controls_Manager::WYSIWYG,
				"label"			=> esc_html__( "Inner Content", "cea" ),
				"description"	=> esc_html__( "This is option to set content carousel inner content.", "cea" ),
				"default" 		=> "",
			]
		);		
		$this->add_control(
			'inner_contents',
			[
				'label' 		=> __( 'Inner Contents', 'elementor' ),
				'type' 			=>  Controls_Manager::REPEATER,
				'fields'		=> $repeater->get_controls(),
				'default'		=> [
					[
						'inner_content' => __( 'Click edit button to change this text. You can place here shortcodes.', 'elementor' ),
					]
				]
			]
		);
		$this->end_controls_section();
		
		//Slide Section
		$this->start_controls_section(
			"slide_section",
			[
				"label"			=> esc_html__( "Slide", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Content slide options here available.", "cea" ),
			]
		);
		$this->add_control(
			"slide_opt",
			[
				"label" 		=> esc_html__( "Slide Option", "cea" ),
				"description"	=> esc_html__( "This is option for content slider option.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Slide Items", "cea" ),
				"description"	=> esc_html__( "This is option for content slide items shown on large devices.", "cea" ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_tab",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Tab", "cea" ),
				"description"	=> esc_html__( "This is option for content slide items shown on tab.", "cea" ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_mobile",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Mobile", "cea" ),
				"description"	=> esc_html__( "This is option for content slide items shown on mobile.", "cea" ),
				"default" 		=> "1",
			]
		);
		$this->add_control(
			"slide_item_autoplay",
			[
				"label" 		=> esc_html__( "Auto Play", "cea" ),
				"description"	=> esc_html__( "This is option for content slider auto play.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item_loop",
			[
				"label" 		=> esc_html__( "Loop", "cea" ),
				"description"	=> esc_html__( "This is option for content slider loop.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_center",
			[
				"label" 		=> esc_html__( "Items Center", "cea" ),
				"description"	=> esc_html__( "This is option for content slider center, for this option must active loop and minimum items 2.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_nav",
			[
				"label" 		=> esc_html__( "Navigation", "cea" ),
				"description"	=> esc_html__( "This is option for content slider navigation.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_dots",
			[
				"label" 		=> esc_html__( "Pagination", "cea" ),
				"description"	=> esc_html__( "This is option for content slider pagination.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_margin",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Margin", "cea" ),
				"description"	=> esc_html__( "This is option for content slider margin space.", "cea" ),
				"default" 		=> "",
			]
		);
		$this->add_control(
			"slide_duration",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Duration", "cea" ),
				"description"	=> esc_html__( "This is option for content slider duration.", "cea" ),
				"default" 		=> "5000",
			]
		);
		$this->add_control(
			"slide_smart_speed",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Smart Speed", "cea" ),
				"description"	=> esc_html__( "This is option for content slider smart speed.", "cea" ),
				"default" 		=> "250",
			]
		);
		$this->add_control(
			"slide_slideby",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Slideby", "cea" ),
				"description"	=> esc_html__( "This is option for content slider scroll by.", "cea" ),
				"default" 		=> "1",
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
			'carousel_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .content-carousel-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'carousel_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .content-carousel-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .content-carousel-wrapper' => 'color: {{VALUE}};'
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
						'{{WRAPPER}} .content-carousel-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_opt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on carousel box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"carousel_box_shadow",
				[
					"label" 		=> esc_html__( "Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on carousel box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_opt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .content-carousel-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{carousel_box_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"carousel_box_shadow_pos",
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
						'{{WRAPPER}} .content-carousel-wrapper:hover' => 'color: {{VALUE}};'
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
						'{{WRAPPER}} .content-carousel-wrapper:hover' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_hopt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on carousel box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"carousel_hbox_shadow",
				[
					"label" 		=> esc_html__( "Hover Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on carousel box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_hopt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .content-carousel-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{carousel_hbox_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"carousel_hbox_shadow_pos",
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
					'{{WRAPPER}} .content-carousel-wrapper .content-carousel-title, {{WRAPPER}} .content-carousel-wrapper .content-carousel-title > a' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .content-carousel-wrapper:hover .content-carousel-title, {{WRAPPER}} .content-carousel-wrapper:hover .content-carousel-title > a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .content-carousel-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .content-carousel-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_alignment',
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
					'{{WRAPPER}} .content-carousel-title' => 'text-align: {{VALUE}};',
				],
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
					'{{WRAPPER}} .content-carousel-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .content-carousel-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'carousel_title_typography',
				'selector' 		=> '{{WRAPPER}} .content-carousel-wrapper .content-carousel-title'
			]
		);	
		$this->end_controls_section();
		
		// Style Carousel Item Section
		$this->start_controls_section(
			'section_style_carousel_item',
			[
				'label' => __( 'Carousel Item', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'item_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .content-carousel-wrapper .cea-carousel .owl-slide-item' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'carousel_item_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .content-carousel-wrapper .cea-carousel .owl-slide-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'carousel_item_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .content-carousel-wrapper .cea-carousel .owl-slide-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			"item_shadow_opt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
				"description"	=> esc_html__( "This is option for show/hide box shadow on carousel item.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"item_box_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", "cea" ),
				"description"	=> esc_html__( "This is option for set box shadow on carousel item.", "cea" ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'item_shadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .content-carousel-wrapper .cea-carousel .owl-slide-item' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{item_box_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"item_box_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", "cea" ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", "cea" ),
					'inset' => esc_html__( "Inset", "cea" ),
				],
				'condition' => [
					'item_shadow_opt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'carousel_item_border',
				'selector' => '{{WRAPPER}} .content-carousel-wrapper .owl-slide-item',
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'carousel_typography',
				'selector' 		=> '{{WRAPPER}} .content-carousel-wrapper'
			]
		);	
		$this->end_controls_section();	

	}
	
	/**
	 * Render Content Carousel widget output on the frontend.
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

		$class = isset( $layout ) && $layout != '' ? ' cea-carousel-style-' . $layout : '';
		?>
		
		<div class="elementor-widget-container content-carousel-wrapper<?php echo esc_attr( $class ); ?>" >
		
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
	 * Render Content Carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		extract( $settings );
		
		$title = isset( $title ) && $title != '' ? $title : '';
		$title_tag = isset( $title_tag ) && $title_tag != '' ? $title_tag : 'h3';
		$inner_contents = isset( $inner_contents ) && $inner_contents != '' ? $inner_contents : '';

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

		echo $title ? '<'. esc_attr( $title_tag ) .' class="content-carousel-title">'. esc_html( $title ) .'</'. esc_attr( $title_tag ) .'>' : '';
		
		//Content Carousel Slide
		echo '<div class="cea-carousel owl-carousel" '. ( $data_atts ) .'>';	
			foreach (  $inner_contents as $inner_content ) { 
				echo '<div class="owl-slide-item">';
					echo do_shortcode( $inner_content['inner_content'] );
				echo '</div>';
			}
		//Content Carousel Slide End
		echo '</div><!-- .owl-carousel -->';

	}
	
}