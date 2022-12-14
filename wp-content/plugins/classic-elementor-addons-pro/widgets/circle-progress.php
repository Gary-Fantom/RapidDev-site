<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Circle Progress Widget
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Circle_Progress_Widget extends Widget_Base {
	
	private $excerpt_len;
	
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
		return "ceacircleprogress";
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
		return __( "Circle Progress", "cea" );
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
		return "cea-default-icon ti-control-record";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Circle Progress widget belongs to.
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
		return [ 'appear', 'circle-progress', 'cea-custom-front'  ];
	}

	/**
	 * Register Circle Progress widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		$this->start_controls_section(
			"progress_section",
			[
				"label"	=> esc_html__( "Progress", "cea" ),
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
				"default" 		=> esc_html__( "Progress", "cea" ),
			]
		);
		$this->add_responsive_control(
			'circle_val',
			[
				'label' => esc_html__( 'Progress %', 'cea' ),
				'description'	=> esc_html__( 'Here you can place progress value. This value must be in 1 to 100. Example 70', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				]
			]
		);	
		$this->add_control(
			"content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Content", "cea" ),
				"description"	=> esc_html__( "Here you put the progress content.", "cea" ),
				"default" 		=> ""
			]
		);
		$this->add_responsive_control(
			'progress_size',
			[
				'label' => esc_html__( 'Progress Size', 'cea' ),
				"description"	=> esc_html__( "Here you can set circle progress size. Example 200.", "cea" ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 200,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 600,
						'step' => 10,
					],
				]
			]
		);	
		$this->add_responsive_control(
			'progress_thikness',
			[
				'label' => esc_html__( 'Progress Thickness', 'cea' ),
				"description"	=> esc_html__( "Here you can set circle progress thickness. Example 10.", "cea" ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				]
			]
		);	
		$this->add_responsive_control(
			'progress_duration',
			[
				'label' => esc_html__( 'Progress Duration', 'cea' ),
				"description"	=> esc_html__( "Here you can set circle progress animation duration. Example 1500.", "cea" ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 1500,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 5000,
						'step' => 50,
					],
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
					'{{WRAPPER}} .circle-progress-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);		
		$this->add_control(
			"circle_layout",
			[
				"label"			=> esc_html__( "Layout", "cea" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"		=> esc_html__( "Default", "cea" ),
					"classic"		=> esc_html__( "Classic", "cea" ),
					"modern"		=> esc_html__( "Modern", "cea" ),
					"classic-pro"	=> esc_html__( "Classic Pro", "cea" ),
				]
			]
		);
		$this->add_control(
			"progress_heading",
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
		$this->add_control(
			"circle_items",
			[
				"label"				=> "Circle Progress Items",
				"description"		=> esc_html__( "This is settings for Circle Progress custom layout. here you can set your own layout. Drag and drop needed Circle Progress items to Enabled part.", "cea" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					"Enabled" 			=> [ 
						"circle"		=> esc_html__( "Circle", "cea" ),
						"title"			=> esc_html__( "Title", "cea" )
					],
					"disabled"			=> [
						'content'		=> esc_html__( 'Content', 'cea' )
					]
				]
			]
		);		
		$this->end_controls_section();		
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'progress_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .circle-progress-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'progress_margin',
			[
				'label' => esc_html__( 'Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .circle-progress-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .circle-progress-wrapper' => 'color: {{VALUE}};'
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
						'{{WRAPPER}} .circle-progress-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_opt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on progress box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"progress_box_shadow",
				[
					"label" 		=> esc_html__( "Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on progress box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_opt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .circle-progress-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{progress_box_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"progress_box_shadow_pos",
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
						'{{WRAPPER}} .circle-progress-wrapper:hover' => 'color: {{VALUE}};'
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
						'{{WRAPPER}} .circle-progress-wrapper:hover' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_hopt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on progress box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"progress_hbox_shadow",
				[
					"label" 		=> esc_html__( "Hover Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on progress box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_hopt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .circle-progress-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{progress_hbox_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"progress_hbox_shadow_pos",
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
		
		// Style Progress Section
		$this->start_controls_section(
			'section_style_progress',
			[
				'label' => __( 'Progress', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"circle_empty_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Circle Empty Fill Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the circle empty fill color.", "cea" ),
				"default" 		=> "#e1e1e1"
			]
		);
		$this->add_control(
			"circle_start_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Circle Start Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the circle fill start color.", "cea" ),
				"default" 		=> "#333333"
			]
		);
		$this->add_control(
			"circle_end_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Circle End Color", "cea" ),
				"description"	=> esc_html__( "Here you can put the circle fill end color. If you not giving end color, then circle take start color for end color.", "cea" ),
				"default" 		=> ""
			]
		);
		$this->add_responsive_control(
			'progress_spacing',
			[
				'label' => esc_html__( 'Progress Bar Spacing', 'cea' ),
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
					'{{WRAPPER}} .circle-progress-wrapper .circle-progress-circle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .circle-progress-wrapper .circle-progress-circle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .circle-progress-wrapper .circle-progress-title > *' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .circle-progress-wrapper:hover .circle-progress-title > *' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .circle-progress-wrapper .circle-progress-title > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .circle-progress-wrapper .circle-progress-title > *' => 'text-transform: {{VALUE}};'
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
					'{{WRAPPER}} .circle-progress-wrapper .circle-progress-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .circle-progress-wrapper .circle-progress-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .circle-progress-wrapper .circle-progress-title > *'
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
					'{{WRAPPER}} .circle-progress-wrapper .circle-progress-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .circle-progress-wrapper .circle-progress-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .circle-progress-wrapper .circle-progress-content'
			]
		);	
		$this->end_controls_section();	

	}

	/**
	 * Render Circle Progress widget output on the frontend.
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
		$class = isset( $circle_layout ) && $circle_layout != '' ? ' circle-progress-style-' . $circle_layout : '';
		?>
		
		<div class="elementor-widget-container circle-progress-wrapper<?php echo esc_attr( $class ); ?>" >
		
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
	 
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		//Define Variables
		$title = isset( $title ) && $title != '' ? $title : '';
		$circle_val = isset( $circle_val ) && !empty( $circle_val ) ? $circle_val : '';
		$heading = isset( $progress_heading ) && $progress_heading != '' ? $progress_heading : '';
		$content = isset( $content ) && $content != '' ? $content : '';
		$progress_size = isset( $progress_size ) && $progress_size != '' ? $progress_size : '200';
		$progress_thikness = isset( $progress_thikness ) && $progress_thikness != '' ? $progress_thikness : '10';
		$progress_duration = isset( $progress_duration ) && $progress_duration != '' ? $progress_duration : '1500';
		$empty_color = isset( $circle_empty_color ) && $circle_empty_color != '' ? $circle_empty_color : '#e1e1e1';
		$circle_start_color = isset( $circle_start_color ) && $circle_start_color != '' ? $circle_start_color : '#333333';
		$circle_end_color = isset( $circle_end_color ) && $circle_end_color != '' ? $circle_end_color : '';	
		
		$default_items = array(
			"circle" => esc_html__( "Circle", "cea" ),
			"title" => esc_html__( "Title", "cea" )
		);
		
		$elemetns = isset( $circle_items ) && !empty( $circle_items ) ? json_decode( $circle_items, true ) : array( 'Enabled' => $default_items );

		if( isset( $elemetns['Enabled'] ) ) :
		
			foreach( $elemetns['Enabled'] as $element => $value ){
				switch( $element ){
		
					case "circle":
						$progress_value = isset( $circle_val['size'] ) ? $circle_val['size'] : 10;
						$progress_size = isset( $progress_size['size'] ) ? $progress_size['size'] : 200;
						$progress_thikness = isset( $progress_thikness['size'] ) ? $progress_thikness['size'] : 10;
						$progress_duration = isset( $progress_duration['size'] ) ? $progress_duration['size'] : 1500;
						echo '<div class="circle-progress-circle" data-value="'. esc_attr( $progress_value ) .'" data-size="'. esc_attr( $progress_size ) .'" data-thickness="'. esc_attr( $progress_thikness ) .'" data-duration="'. esc_attr( $progress_duration ) .'" data-empty="'. esc_attr( $empty_color ) .'" data-scolor="'. esc_attr( $circle_start_color ) .'" data-ecolor="'. esc_attr( $circle_end_color ) .'">';
							echo '<span class="progress-value"></span>';
						echo '</div><!-- .circle-progress-circle -->';
					break;
					
					case "title":
						echo '<div class="circle-progress-title">';
							echo '<'. esc_attr( $heading ) .'>'. esc_html( $title ) .'</'. esc_attr( $heading ) .'>';
						echo '</div><!-- .circle-progress-title -->';
					break;
					
					case "content":
						echo '<div class="circle-progress-content">';
							echo esc_textarea( $content );
						echo '</div><!-- .circle-progress-read-more -->';
					break;
					
				}
			} // foreach end
				
		endif;

	}
	
}