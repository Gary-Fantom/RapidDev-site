<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Contact Form 
 *
 * @since 1.0.0
 */

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
 
class CEA_Elementor_Contact_Info_Widget extends Widget_Base {
	
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
		return "contactinfo";
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
		return __( "Contact Info", "cea" );
	}
	
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'contact', 'address', 'social', 'icon', 'link' ];
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
		return "cea-default-icon ti-id-badge";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Contact Info widget belongs to.
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
	 * Register Contact Info widget controls. 
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
				"label" 		=> esc_html__( "Contact Widget Title", "cea" ),
				"description"	=> esc_html__( "Enter contact widget title here. If no need title, leave it blank.", "cea" ),
				"default" 		=>  esc_html__( "Contact Info", "cea" )
			]
		);		
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Title Heading Tag", "cea" ),
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
					'{{WRAPPER}} .contact-info-wrapper .contact-info-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();	
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Contact widgets layout options here available.", "cea" ),
			]
		);
		$this->add_responsive_control(
			'text_align',
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
					'{{WRAPPER}} .contact-info-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			"contact_layout",
			[
				"label"			=> esc_html__( "Contact Info Layout", "cea" ),
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
			"contact_items",
			[
				"label"				=> "Contact Info Items",
				"description"		=> esc_html__( "This is settings for contact info custom layout. here you can set your own layout. Drag and drop needed contact items to Enabled part.", "cea" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					esc_html__( "Enabled", "cea" ) => [ 
						"info"		=> esc_html__( "Info", "cea" ),
						"mail"		=> esc_html__( "Mail ID", "cea" ),
						"phone"		=> esc_html__( "Phone", "cea" ),
											],
					esc_html__( "disabled", "cea" ) => [
						"social"	=> esc_html__( "Social", "cea" ),
						"address"	=> esc_html__( "Address", "cea" ),
						"form"		=> esc_html__( "Form", "cea" ),
						"timing"	=> esc_html__( "Timing", "cea" )
					]
				]
			]
		);
		$this->end_controls_section();
		
		//Info Section
		$this->start_controls_section(
			"info_section",
			[
				"label"			=> esc_html__( "Info", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Contact info tab.", "cea" ),
			]
		);
		$this->add_control(
			"contact_info",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Contact Information or Description", "cea" ),
				"description"	=> esc_html__( "Enter contact informaion or description here.", "cea" ),
				"default" 		=> esc_html__( "About your company.", "cea" )
			]
		);
		$this->add_control(
			"contact_address",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Contact Address", "cea" ),
				"description"	=> esc_html__( "Enter contact address here.", "cea" ),
				"default" 		=> esc_html__( "#123 Your address", "cea" )
			]
		);
		$this->add_control(
			"contact_email",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Email Id", "cea" ),
				"description"	=> esc_html__( "Enter email id. If you enter multiple email id means, seperate with comma(,).", "cea" ),
				"default" 		=> esc_html__( "username@email.com", "cea" )
			]
		);
		$this->add_control(
			"contact_number",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Contact Number", "cea" ),
				"description"	=> esc_html__( "Enter contact number. If you enter multiple contact number means, seperate with comma(,).", "cea" ),
				"default" 		=> "+12 1234567890"
			]
		);		
		$this->add_control(
			"contact_timing",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Contact Timing", "cea" ),
				"description"	=> esc_html__( "Enter contact timing here.", "cea" ),
				"default" 		=> ""
			]
		);
		$this->end_controls_section();
		
		//Form Section
		$this->start_controls_section(
			"form_section",
			[
				"label"			=> esc_html__( "Form", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Contact form tab.", "cea" ),
			]
		);		
		if( class_exists( "WPCF7" ) ){
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
		}else{
			$this->add_control(
				'contact_form_note',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf( '<strong>%1$s</strong> is not installed/activated on your site. Please install and activate <strong>%2$s</strong> first.', __( 'Contact Form 7', 'cea' ), __( 'Contact Form 7', 'cea' ) ),
					'content_classes' => 'cea-elementor-warning',
				]
			);
		}		
		$this->end_controls_section();
		
		//Social Links Section
		$this->start_controls_section(
			"links_section",
			[
				"label"			=> esc_html__( "Social Links", "cea" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Contact info social links tab.", "cea" ),
			]
		);
		$this->add_control(
			"social_icons_type",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Social Iocns Type", "cea" ),
				"default"		=> "rounded",
				"options"		=> [
					"squared"		=> esc_html__( "Squared", "cea" ),
					"rounded"		=> esc_html__( "Rounded", "cea" ),
					"circled"		=> esc_html__( "Circled", "cea" )
				]
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'social_icon',
			[
				'label' => __( 'Icon', 'cea' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
				'recommended' => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mix',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'cea' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'is_external' => 'true',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'cea' ),
			]
		);		
		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'cea' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
			]
		);
		$this->end_controls_section();
				
		// Style General Section
		$this->start_controls_section(
			'section_style_contact_info',
			[
				'label' => __( 'General', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'contact_info_content_styles' );
		$this->start_controls_tab(
			'contact_info_content_normal',
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
					'{{WRAPPER}} .contact-info-wrapper' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .contact-info-wrapper' => 'color: {{VALUE}};'
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
			"contact_info_box_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", "cea" ),
				"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", "cea" ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .contact-info-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{contact_info_box_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"contact_info_box_shadow_pos",
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
			'contact_info_content_hover',
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
					'{{WRAPPER}} .contact-info-wrapper:hover' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .contact-info-wrapper:hover' => 'color: {{VALUE}};'
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
			"contact_info_hbox_shadow",
			[
				"label" 		=> esc_html__( "Hover Box Shadow", "cea" ),
				"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", "cea" ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_hopt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .contact-info-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{contact_info_hbox_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"contact_info_hbox_shadow_pos",
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
					'{{WRAPPER}} .contact-info-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'contact_widget_padding',
			[
				'label' => esc_html__( 'Padding', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-info-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'contact_info_content_typography',
				'selector' 		=> '{{WRAPPER}} .contact-info-wrapper'
			]
		);	
		
		$this->add_control(
			'absolute_icon_style',
			[
				'label' => esc_html__( "Absolute Icon Color", "cea" ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'condition' => [
					'contact_layout' => 'classic',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-info-wrapper:before' => 'background-color: {{VALUE}};',
				]
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
					'{{WRAPPER}} .contact-info-wrapper .contact-info-title' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .contact-info-wrapper:hover .contact-info-title' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .contact-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .contact-info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .contact-info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'contact_info_title_typography',
				'selector' 		=> '{{WRAPPER}} .contact-info-wrapper .contact-info-title'
			]
		);	
		$this->end_controls_section();
		
		// Style Info Section
		$this->start_controls_section(
			'section_style_info',
			[
				'label' => __( 'Info', 'cea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'desc_styles',
			[
				'label' => esc_html__( 'Description Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Description Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'address_styles',
			[
				'label' => esc_html__( 'Address Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'address_margin',
			[
				'label' => esc_html__( 'Address Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-address' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'email_styles',
			[
				'label' => esc_html__( 'Email Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'email_margin',
			[
				'label' => esc_html__( 'Email Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-mail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'phone_styles',
			[
				'label' => esc_html__( 'Phone Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'phone_margin',
			[
				'label' => esc_html__( 'Phone Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-phone' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'timing_styles',
			[
				'label' => esc_html__( 'Timing Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'timing_margin',
			[
				'label' => esc_html__( 'Timing Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-timing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'cf_styles',
			[
				'label' => esc_html__( 'Form Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'cf_margin',
			[
				'label' => esc_html__( 'Form Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'social_icons_styles',
			[
				'label' => esc_html__( 'Social Icons Styles', 'cea' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'social_icons_margin',
			[
				'label' => esc_html__( 'Social Icons Margin', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .social-icons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_social_style',
			[
				'label' => __( 'Icon', 'cea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Official Color', 'cea' ),
					'custom' => __( 'Custom', 'cea' ),
				],
			]
		);

		$this->start_controls_tabs( 'icons_colors' );
		$this->start_controls_tab(
			'icon_color_normal',
			[
				'label' => esc_html__( 'Normal', 'cea' ),
			]
		);
		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Primary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-social-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border', // We know this mistake - TODO: 'icon_border' (for hover control condition also)
				'selector' => '{{WRAPPER}} .elementor-social-icon',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Hover', 'cea' ),
			]
		);
		$this->add_control(
			'icon_primary_hcolor',
			[
				'label' => __( 'Primary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_secondary_hcolor',
			[
				'label' => __( 'Secondary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-social-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_border_color',
			[
				'label' => __( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'image_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--icon-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-social-icon' => '--icon-padding: {{SIZE}}{{UNIT}}',
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .cea-social-icons > li > a' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .cea-social-icons' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'cea' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .cea-social-icons > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-social-icons' => 'margin-bottom: -{{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render Contact Info widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$class = '';		
		$class .= isset( $contact_style ) ? ' contact-info-' . $contact_style : '';
		$class .= ' contact-info-style-default';
		$class .= isset( $contact_layout ) && $contact_layout != '' ? ' contact-info-style-' . $contact_layout : 'contact-info-style-default';
		$title = isset( $title ) && $title != '' ? $title : '';
		$title_head = isset( $title_head ) && $title_head != '' ? $title_head : 'h3';
		
		$default_items = array( 
			"info"		=> esc_html__( "Info", "cea" ),
			"mail"		=> esc_html__( "Mail ID", "cea" ),
			"phone"		=> esc_html__( "Phone", "cea" )			
		);
		$elemetns = isset( $contact_items ) && !empty( $contact_items ) ? json_decode( $contact_items, true ) : array( 'Enabled' => $default_items );
		
		echo '<div class="contact-info-wrapper'. esc_attr( $class ) .'">';
		
			echo $title ? '<'. esc_attr( $title_head ) .' class="contact-info-title">'. esc_html( $title ) .'</'. esc_attr( $title_head ) .'>' : '';
			
			if( isset( $elemetns['Enabled'] ) ) :
				foreach( $elemetns['Enabled'] as $element => $value ){
					switch( $element ){
						case "info":
							if( isset( $contact_info ) && $contact_info != '' ){
								echo '<div class="contact-info">';
									echo do_shortcode( $contact_info );
								echo '</div><!-- .contact-info -->';
							}
						break;
						
						case "address":
							if( isset( $contact_address ) && $contact_address != '' ){
								echo '<div class="contact-address">';
									echo '<span class="icon-directions icons"></span><div class="contact-info-inner">'. do_shortcode( $contact_address ) .'</div>';
								echo '</div><!-- .contact-info -->';
							}
						break;
						
						case "mail":
							if( isset( $contact_email ) && $contact_email != '' ){
								echo '<div class="contact-mail">';
								$mail_out = '';
								foreach( explode( ",", $contact_email ) as $email ){
									$mail_out .= '<a href="mailto:'. esc_attr( trim( $email ) ) .'"><span class="icon-envelope icons"></span> '. esc_html( trim( $email ) ) .'</a>, ';
								}
								echo rtrim( $mail_out, ', ' );
								echo '</div><!-- .contact-mail -->';
							}
						break;
						
						case "phone":
							if( isset( $contact_number ) && $contact_number != '' ){
								echo '<div class="contact-phone">';
								$phone_out = '';
								foreach( explode( ",", $contact_number ) as $phone ){
									$phone_out .= '<span class="icon-screen-smartphone icons"></span> <span>'. esc_html( trim( $phone ) ) .'</span>, ';
								}
								echo rtrim( $phone_out, ', ' );
								echo '</div><!-- .contact-phone -->';
							}
						break;
						
						case "timing":
							if( isset( $contact_timing ) && $contact_timing != '' ){
								echo '<div class="contact-timing">';
									echo '<span class="icon-directions icons"></span><div class="contact-info-inner">'. do_shortcode( $contact_timing ) .'</div>';
								echo '</div><!-- .contact-timing -->';
							}
						break;						
						
						case "social":
							$fallback_defaults = [
								'fa fa-facebook',
								'fa fa-twitter',
								'fa fa-google-plus',
							];
							$migration_allowed = Icons_Manager::is_migration_allowed();
							echo '<ul class="nav d-inline-block cea-social-icons">';
							foreach ( $settings['social_icon_list'] as $index => $item ) {
								$migrated = isset( $item['__fa4_migrated']['social_icon'] );
								$is_new = empty( $item['social'] ) && $migration_allowed;
								$social = '';

								// add old default
								if ( empty( $item['social'] ) && ! $migration_allowed ) {
									$item['social'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-wordpress';
								}

								if ( ! empty( $item['social'] ) ) {
									$social = str_replace( 'fa fa-', '', $item['social'] );
								}

								if ( ( $is_new || $migrated ) && 'svg' !== $item['social_icon']['library'] ) {
									$social = explode( ' ', $item['social_icon']['value'], 2 );
									if ( empty( $social[1] ) ) {
										$social = '';
									} else {
										$social = str_replace( 'fa-', '', $social[1] );
									}
								}
								if ( 'svg' === $item['social_icon']['library'] ) {
									$social = get_post_meta( $item['social_icon']['value']['id'], '_wp_attachment_image_alt', true );
								}

								$link_key = 'link_' . $index;

								$this->add_render_attribute( $link_key, 'class', [
									'elementor-icon',
									'elementor-social-icon',
									'elementor-social-icon-' . $social . $class_animation,
									'elementor-repeater-item-' . $item['_id'],
								] );

								$this->add_link_attributes( $link_key, $item['link'] );

								?>
								<li class="elementor-grid-item">
									<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
										<span class="elementor-screen-only"><?php echo ucwords( $social ); ?></span>
										<?php
										if ( $is_new || $migrated ) {
											Icons_Manager::render_icon( $item['social_icon'] );
										} else { ?>
											<i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
										<?php } ?>
									</a>
								</li>
							<?php }
							echo '</ul>';
						break;
						
						case "form":
							if( isset( $contact_form ) && $contact_form != '' ){
								echo '<div class="contact-form">';
									echo do_shortcode( '[contact-form-7 id="'. esc_attr( $contact_form ) .'"]' );
								echo '</div><!-- .contact-form -->';
							}
						break;
					}
				}
			endif;
		echo '</div><!-- .contact-info-wrapper -->';

	}
	
}