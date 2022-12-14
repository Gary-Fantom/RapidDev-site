<?php 

//CEA Templates Fields
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'CEA Templates', 'briddge-addon' ),
	'id'         => 'cea-templates'
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'CEA Service', 'briddge-addon' ),
	'id'         => 'cea-service-single-tab',
	'fields'	 => array(
		array(
			'id'			=> 'cea-service-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Service Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA service title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-service-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable CEA service title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-service-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'CEA Service Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are CEA service page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'title' => esc_html__( 'Title', 'briddge-addon' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'briddge-addon' )
				),
				'right' => array(
				),
				'disabled' => array(
					'description' => esc_html__( 'Description', 'briddge-addon' )
				)
			),
			'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-service-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Service Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA service title.', 'briddge-addon' ),
			'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-service-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Service Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA service description.', 'briddge-addon' ),
			'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-service-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'CEA Service Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for CEA service title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-service-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Custom Single Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for common CEA service title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-service-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'CEA Service Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of CEA service title.', 'briddge-addon' ),
			'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-service-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Service Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA service page layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-service-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'CEA Service Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose CEA service sidebar layout.', 'briddge-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'cea-service-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA service right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-service-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'cea-service-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA service left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-service-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'CEA Team', 'briddge-addon' ),
	'id'         => 'cea-team-single-tab',
	'fields'	 => array(
		array(
			'id'			=> 'cea-team-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Team Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA team page title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-team-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable CEA team page title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-team-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'CEA Team Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are CEA team page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'title' => esc_html__( 'Title', 'briddge-addon' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'briddge-addon' )
				),
				'right' => array(
				),
				'disabled' => array(
					'description' => esc_html__( 'Description', 'briddge-addon' )
				)
			),
			'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-team-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Team Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA team title.', 'briddge-addon' ),
			'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-team-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Team Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA team page description.', 'briddge-addon' ),
			'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-team-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'CEA Team Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for CEA team page title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-team-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Custom Single Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for common CEA team title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-team-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'CEA Team Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of CEA team page title.', 'briddge-addon' ),
			'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-team-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Team Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA team layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-team-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'CEA Team Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose archive sidebar layout.', 'briddge-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'cea-team-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA team right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-team-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'cea-team-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA team left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-team-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'CEA Testimonial', 'briddge-addon' ),
	'id'         => 'cea-testimonial-single-tab',
	'fields'	 => array(
		array(
			'id'			=> 'cea-testimonial-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Testimonial Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA testimonial page title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-testimonial-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable CEA testimonial page title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-testimonial-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'CEA Testimonial Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are CEA testimonial title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'title' => esc_html__( 'Title', 'briddge-addon' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'briddge-addon' )
				),
				'right' => array(
				),
				'disabled' => array(
					'description' => esc_html__( 'Description', 'briddge-addon' )
				)
			),
			'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-testimonial-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Testimonial Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA testimonial title.', 'briddge-addon' ),
			'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-testimonial-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Testimonial Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA testimonial page description.', 'briddge-addon' ),
			'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-testimonial-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'CEA Testimonial Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for CEA testimonial page title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-testimonial-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Custom Single Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for common CEA testimonial title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-testimonial-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'CEA Testimonial Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of CEA testimonial page title.', 'briddge-addon' ),
			'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-testimonial-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Testimonial Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA testimonial page layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-testimonial-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'CEA Testimonial Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose CEA testimonial sidebar layout.', 'briddge-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'cea-testimonial-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA testimonial right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-testimonial-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'cea-testimonial-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA testimonial left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-testimonial-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'CEA Portfolio', 'briddge-addon' ),
	'id'         => 'cea-portfolio-single-tab',
	'fields'	 => array(
		array(
			'id'			=> 'cea-portfolio-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Portfolio Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA portfolio page title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-portfolio-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable CEA portfolio page title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-portfolio-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'CEA Portfolio Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are CEA portfolio page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'title' => esc_html__( 'Title', 'briddge-addon' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'briddge-addon' )
				),
				'right' => array(
				),
				'disabled' => array(
					'description' => esc_html__( 'Description', 'briddge-addon' )
				)
			),
			'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-portfolio-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Portfolio Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA portfolio page title.', 'briddge-addon' ),
			'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-portfolio-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Portfolio Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA portfolio post page description.', 'briddge-addon' ),
			'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-portfolio-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'CEA Portfolio Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for CEA portfolio post page title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-portfolio-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Custom Single Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for common CEA portfolio title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-portfolio-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'CEA Portfolio Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of CEA portfolio post page title.', 'briddge-addon' ),
			'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-portfolio-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Portfolio Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA portfolio page layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-portfolio-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'CEA Portfolio Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose CEA portfolio sidebar layout.', 'briddge-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'cea-portfolio-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA portfolio right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-portfolio-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'cea-portfolio-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA portfolio left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-portfolio-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'CEA Event', 'briddge-addon' ),
	'id'         => 'cea-event-single-tab',
	'fields'	 => array(
		array(
			'id'			=> 'cea-event-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Event Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA event page title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-event-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable CEA event page title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-event-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'CEA Event Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are CEA event page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'title' => esc_html__( 'Title', 'briddge-addon' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'briddge-addon' )
				),
				'right' => array(
				),
				'disabled' => array(
					'description' => esc_html__( 'Description', 'briddge-addon' )
				)
			),
			'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-event-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Event Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA event page title.', 'briddge-addon' ),
			'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-event-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'CEA Event Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of CEA event page description.', 'briddge-addon' ),
			'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-event-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'CEA Event Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for CEA event page title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-event-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Custom Single Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for common CEA event title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-event-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'CEA Event Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of CEA event page title.', 'briddge-addon' ),
			'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'cea-event-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Event Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for CEA event page layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-event-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'CEA Event Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose CEA event sidebar layout.', 'briddge-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'cea-event-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA event right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-event-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'cea-event-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for CEA event left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'cea-event-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'cea-templates-tab-end'	
));