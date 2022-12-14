<?php


namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Cea Accordion
 *
 * @since 1.0.0
 */
 
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;
 
class CEA_Elementor_Accordion_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Cea Accordion widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaaccordion";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Cea Accordion widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Accordion", "cea" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Cea Accordion widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-accordion-merged";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Accordion widget belongs to.
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
		return [ 'cea-custom-front'  ];
	}

	/**
	 * Register Cea Accordion widget controls.
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
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default accordion options.", "cea" ),
			]
		);
		$this->add_control(
			"extra_class",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Extra Class", "cea" ),
				"description"	=> esc_html__( "Put extra class for some additional styles.", "cea" )
			]
		);		
		$this->end_controls_section();		
		
		//Accordion Section
		$this->start_controls_section(
			"cea_accordion_section",
			[
				"label"	=> esc_html__( "Accordion", "cea" ),
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Accordion options.", "cea" ),
			]
		);	
			
		$repeater = new Repeater();		
		$repeater->add_control(
			"cea_accordion_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Title", "cea" ),
				"description"	=> esc_html__( "accordion title.", "cea" )
			]
		);		
		$repeater->add_control(
			'accordion_type',
			[
				'label' => esc_html__( 'Type', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				"default"		=> "content",
				'options' => [
					'content' => [
						'title' => esc_html__( 'Text Content', 'cea' ),
						'icon' => 'eicon-text',
					],
					'element' => [
						'title' => esc_html__( 'HTML Element', 'cea' ),
						'icon' => 'eicon-code-bold',
					],
					'templates' => [
						'title' => esc_html__( 'Saved Templates', 'cea' ),
						'icon' => 'eicon-library-open',
					]					
				],
				'toggle' => false,
			]
		);
		$repeater->add_control(
			"cea_accordion_content",
			[
				"label"			=> esc_html__( "Accordion Content", "cea" ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"description" 	=> esc_html__( "You can place here accordion content.", "cea" ),
				"default"		=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
				'condition' => [
					'accordion_type' => 'content',
				],
			]
		);		
		$repeater->add_control(
			"cea_element_id",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Element ID", "cea" ),
				"description"	=> esc_html__( "Enter element id", "cea" ),
				'condition' => [
					'accordion_type' => 'element',
				],
			]
		);	
		$repeater->add_control(
			'ele_templates',
			[
				'label' 	=> __( 'Choose Templates', 'cea' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> Cea_Post_Helper::cea_get_elementor_templates(),
				'separator' => 'before',
				'condition' => [
					'accordion_type' => 'templates',
				],
			]
		);
		
		$this->add_control(
			"accordion_list",
			[
				"type"			=> Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Accordion List", "cea" ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						"cea_accordion_title" 	=> esc_html__( "Title 1", "cea" ),
						"accordion_type" => "content",
						"cea_element_id"	=> "",
						"cea_accordion_content"	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
						"ele_templates" => ""
					],
					[
						"cea_accordion_title" 	=> esc_html__( "Title 2", "cea" ),
						"accordion_type" => "content",
						"cea_element_id"	=> "",
						"cea_accordion_content"	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
						"ele_templates" => ""
					],
				],
				"title_field"	=> "{{{ cea_accordion_title }}}"
			]
		);	
		$this->add_control(
			"multi_open",
			[
				"label" 		=> esc_html__( "Multi Open", "cea" ),
				"description"	=> esc_html__( "This is option for off the accordion toggle.", "cea" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' 		=> esc_html__( 'Icon', 'cea' ),
				'type' 			=> Controls_Manager::ICONS,
				'separator' 	=> 'before',
				'fa4compatibility' => 'icon',
				'default' 		=> [
					'value' => 'ti-plus',
					'library' => 'themify'
				],
				'recommended' 	=> [
					'fa-solid' 	=> [
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					],
					'fa-regular' => [
						'caret-square-down',
					],
					'themify' => [
						'angle-down',
						'angle-double-down',
						'plus',
					]
				],
				'skin' => 'inline',
				'label_block' => false,
			]
		);
		$this->add_control(
			'selected_active_icon',
			[
				'label' => esc_html__( 'Active Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon_active',
				'default' => [
					'value' => 'ti-minus',
					'library' => 'themify'
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-up',
						'angle-up',
						'angle-double-up',
						'caret-up',
						'caret-square-up',
					],
					'fa-regular' => [
						'caret-square-up',
					],
					'themify' => [
						'angle-up',
						'angle-double-up',
						'minus',
					]
				],
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);
		$this->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon Alignment', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Start', 'cea' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'End', 'cea' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
			]
		);		
		$this->end_controls_section();
		
		// Style Accordion Section
		$this->start_controls_section(
			'section_style_accordion',
			[
				'label' => __( 'Accordion', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'accordion_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'accordion_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'accordion_border',
				'selector' => '{{WRAPPER}} .cea-accordion-elementor-widget',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'accordion_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accordion_box_shadow',
				'selector' => '{{WRAPPER}} .cea-accordion-elementor-widget'
			]
		);
		$this->add_control(
			'accordion_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'accordion_spacing',
			[
				'label' => esc_html__( 'Accordion Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-accordions > .cea-accordion:not(first-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-accordions > .cea-accordion:not(first-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .cea-accordion-header > a'
			]
		);
		$this->start_controls_tabs( 'accordion_title_styles' );
		$this->start_controls_tab(
			'accordion_title_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_title_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a:hover, {{WRAPPER}} .cea-accordion-header > a.active' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a:hover, {{WRAPPER}} .cea-accordion-header > a.active' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			"title_tag",
			[
				"label"			=> esc_html__( "Title Tag", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "div",
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
					'{{WRAPPER}} .cea-accordion-header > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .cea-accordion-header > a',
			]
		);
		$this->add_control(
			'title_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		
		$this->add_responsive_control(
			'title_align',
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
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_control(
			'icon_styles',
			[
				'label' => __( 'Icon Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'accordion_icon_styles' );
		$this->start_controls_tab(
			'accordion_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a .elementor-accordion-icon > span > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'icon_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a:hover .elementor-accordion-icon > span > *, {{WRAPPER}} .cea-accordion-header > a.active .elementor-accordion-icon > span > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();	
		
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .cea-accordion-content'
			]
		);	
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'content_align',
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
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-pane' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
	
	}
	
	/**
	 * Render Accordion widget output on the frontend.
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
		$multi_open = isset( $multi_open ) && $multi_open == 'yes' ? true : false;		
		?>
		
		<div class="elementor-widget-container cea-accordion-elementor-widget<?php echo esc_attr( $class ); ?>" data-toggle="<?php echo esc_attr( $multi_open ); ?>">
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
	 * Render Accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$accordion_list = isset( $accordion_list ) ? $accordion_list : '';
		$rand_id = cea_shortcode_rand_id();
		
		//Icon migrated
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon'] = 'ti-plus';
			$settings['icon_active'] = 'ti-minus';
			$settings['icon_pos'] = $this->get_settings( 'icon_pos' );
		}
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['selected_icon']['value'] ) );
		
		$list_active_class = ' active'; $content_active_class = ' active';  $i = 1;
		if( !empty( $accordion_list ) ){		

			echo '<div class="cea-accordions" id="cea-accordion-'. esc_attr( $rand_id ) .'">';
		
			foreach( $accordion_list as $accordion_single ){
				
				$accordion_type = isset( $accordion_single['accordion_type'] ) ? $accordion_single['accordion_type'] : 'content';
				echo '<div class="card cea-accordion">';
				
					$accordion_id = esc_attr( $rand_id ) .'-'. esc_attr( $i );				
					if( isset( $accordion_single['cea_accordion_title'] ) && !empty( $accordion_single['cea_accordion_title'] ) ){
						$title_tag = isset( $title_tag ) ? $title_tag : 'div';
						echo '<'. esc_attr( $title_tag ) .' class="card-header cea-accordion-header">';
							echo '<a class="nav-item nav-link'. esc_attr( $list_active_class ) .'" href="#cea-accordion-'. esc_attr( $accordion_id ) .'">';
								
								if ( $has_icon ) :
									echo '<span class="elementor-accordion-icon elementor-accordion-icon-'. esc_attr( $settings['icon_pos'] ) .'" aria-hidden="true">';
									if ( $is_new || $migrated ) {
										echo '<span class="cea-accordion-icon-closed">';
											Icons_Manager::render_icon( $settings['selected_icon'] );
										echo '</span>';
										echo '<span class="cea-accordion-icon-opened">';
											Icons_Manager::render_icon( $settings['selected_active_icon'] );
										echo '</span>';
									} else {
										echo '<i class="cea-accordion-icon-closed '. esc_attr( $settings['icon'] ) .'"></i>';
										echo '<i class="cea-accordion-icon-opened '. esc_attr( $settings['icon_active'] ) .'"></i>';
									}
									echo '</span>';
								endif;
								
								echo $accordion_single['cea_accordion_title'];
							echo '</a>';
						echo '</'. esc_attr( $title_tag ) .'><!-- .card-header -->';
					}
					
					echo '<div class="cea-accordion-content'. esc_attr( $content_active_class ) .'" id="cea-accordion-'. esc_attr( $accordion_id ) .'">';		
						echo '<div class="card-body">';
							if( $accordion_type == 'content' ){
								if( isset( $accordion_single['cea_accordion_content'] ) && !empty( $accordion_single['cea_accordion_content'] ) ){
									echo '<div class="cea-accordion-pane">'. $accordion_single['cea_accordion_content'] .'</div>';
								}
							}elseif( $accordion_type == 'element' ){
								if( isset( $accordion_single['cea_element_id'] ) && !empty( $accordion_single['cea_element_id'] ) ){
									echo '<div class="cea-accordion-pane"><span class="cea-accordion-id-to-element" data-id="'. esc_attr( $accordion_single['cea_element_id'] ) .'"></span></div>';
								}
							}elseif( $accordion_type == 'templates' ){
								$template_id = isset( $accordion_single['ele_templates'] ) ? $accordion_single['ele_templates'] : '';
								echo Plugin::$instance->frontend->get_builder_content( $template_id, true );
							}
						echo '</div><!-- .card-body -->';
					echo '</div><!-- .cea-accordion-content -->';
				
				echo '</div><!-- .card -->';
				
				$list_active_class = $content_active_class = '';
				$i++;
			}
			echo '</div>';
			
		}
		

	}
		
}