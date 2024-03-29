<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Contact Form 
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Contact_Form_Widget extends Widget_Base {
	
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
		return "contactform";
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
		return __( "Contact Form", "cea" );
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
		return "cea-default-icon ti-email";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Contact Form widget belongs to.
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
	 * Register Contact Form widget controls. 
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
	
		$contact_forms = array();
		if( class_exists( "WPCF7" ) ){
			$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
			if( $data = get_posts( $args ) ){
				foreach( $data as $key ){
					$contact_forms[$key->ID] = $key->post_title;
				}
			}
		}
		
		if( !empty( $contact_forms ) ){
			//General Section
			$this->start_controls_section(
				"general_section",
				[
					"label"	=> esc_html__( "General", "cea" ),
					"tab"	=> Controls_Manager::TAB_CONTENT,
					"description"	=> esc_html__( "Default contact form options.", "cea" ),
				]
			);
			$this->add_control(
				"contact_form",
				[
					"type"			=> Controls_Manager::SELECT,
					"label"			=> esc_html__( "Contact Form", "cea" ),
					"description"	=> esc_html__( "Choose one contact form from given contact forms.", "cea" ),
					"default"		=> "",
					"options"		=> $contact_forms
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
			$this->add_control(
				"cf_layout",
				[
					"label"			=> esc_html__( "Contact Form Layout", "cea" ),
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
			$this->add_responsive_control(
				'text_align',
				[
					'label' => __( 'Alignment', 'cea' ),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'left',
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
						'{{WRAPPER}} .contact-form-wrapper' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
			
			// Style General Section
			$this->start_controls_section(
				'section_style_contact_form',
				[
					'label' => __( 'General', 'cea' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			
			$this->start_controls_tabs( 'contact_form_content_styles' );
			$this->start_controls_tab(
				'contact_form_content_normal',
				[
					'label' => esc_html__( 'Normal', 'cea' ),
				]
			);
			$this->add_control(
				'bg_color',
				[
					'label' => esc_html__( 'Background Color', 'cea' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"font_color",
				[
					"type"			=> Controls_Manager::COLOR,
					"label"			=> esc_html__( "Font Color", "cea" ),
					"description"	=> esc_html__( "Here you can put the font color.", "cea" ),
					"default" 		=> "",
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_opt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"contact_form_box_shadow",
				[
					"label" 		=> esc_html__( "Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_opt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{contact_form_box_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"contact_form_box_shadow_pos",
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
				'contact_form_content_hover',
				[
					'label' => esc_html__( 'Hover', 'cea' ),
				]
			);
			$this->add_control(
				'bg_hcolor',
				[
					'label' => esc_html__( 'Hover Background Color', 'cea' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper:hover' => 'background-color: {{VALUE}};'
					],
				]
			);
			$this->add_control(
				"font_hcolor",
				[
					"type"			=> Controls_Manager::COLOR,
					"label"			=> esc_html__( "Hover Font Color", "cea" ),
					"default" 		=> "",
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper:hover' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_hopt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", "cea" ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"contact_form_hbox_shadow",
				[
					"label" 		=> esc_html__( "Hover Box Shadow", "cea" ),
					"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", "cea" ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_hopt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{contact_form_hbox_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"contact_form_hbox_shadow_pos",
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
			
			$this->add_control(
				'contact_widget_margin',
				[
					'label' => esc_html__( 'Margin', 'cea' ),
					'type' => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			$this->add_control(
				'contact_widget_padding',
				[
					'label' => esc_html__( 'Padding', 'cea' ),
					'type' => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .contact-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);
			
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'contact_form_content_typography',
					'selector' 		=> '{{WRAPPER}} .contact-form-wrapper'
				]
			);	
			
			$this->end_controls_section();
		}else{
			//Contact Section
			$this->start_controls_section(
				"general_section",
				[
					"label"	=> esc_html__( "Contact Form", "cea" ),
					"tab"	=> Controls_Manager::TAB_CONTENT
				]
			);
			$this->add_control(
				"cf7_install_msg",
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf( '<strong>%1$s</strong> is not installed/activated on your site. Please install and activate <strong>%2$s</strong> first.', __( 'Contact Form 7', 'cea' ), __( 'Contact Form 7', 'cea' ) ),
					'content_classes' => 'cea-elementor-warning',
				]
			);			
			$this->end_controls_section();
		}

	}

	/**
	 * Render Contact Form widget output on the frontend.
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
		$class = isset( $cf_layout ) ? ' cf-style-' . $cf_layout : ' cf-style-default';
		
		if( class_exists( "WPCF7" ) ){
			echo '<div class="contact-form-wrapper'. esc_attr( $class ) .'">';
				if( isset( $contact_form ) && $contact_form != '' ){
					echo '<div class="contact-form">';
						echo do_shortcode( '[contact-form-7 id="'. esc_attr( $contact_form ) .'"]' );
					echo '</div><!-- .contact-form -->';
				}
			echo '</div><!-- .contact-form-wrapper -->';
		}

	}
	
}