<?php

// Woocommerce
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'Woocommerce', 'briddge-addon' ),
	'id'         => 'woocommerce-tab'
) );

Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Shop', 'briddge-addon' ),
	'id'         => 'shop-tab',
	'fields'	 => array(
		array(
			'id'			=> 'shop-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Shop Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for shop page title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'shop-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Shop Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable shop page title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'shop-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Shop Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are shop page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
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
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Shop Page Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of shop page title.', 'briddge-addon' ),
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Shop Page Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of shop page description.', 'briddge-addon' ),
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Shop Page Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for shop page title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Shop Page Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for shop page title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Shop Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of page title.', 'briddge-addon' ),
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Shop Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for shop page layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'shop-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Shop Single Post Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose shop page sidebar layout.', 'briddge-addon' ),
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
			'id'			=> 'shop-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Shop Page Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for shop page right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'shop-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Shop Page Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for shop page left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );

Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Product', 'briddge-addon' ),
	'id'         => 'product-tab',
	'fields'	 => array(
		array(
			'id'			=> 'product-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Product Page Title Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for product page title.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'product-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Product Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable product page title section', 'briddge-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'product-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Product Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are product page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
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
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Product Page Title Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of product page title.', 'briddge-addon' ),
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Product Page Title Description Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color settings of product page description.', 'briddge-addon' ),
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Product Page Title Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for product page title links. Like breadcrumbs color.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Product Page Title Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding for product page title. Example 10 for all side', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Product Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of page title.', 'briddge-addon' ),
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Product Page Layout Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for product page layout.', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'product-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Product Single Post Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose product page sidebar layout.', 'briddge-addon' ),
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
			'id'			=> 'product-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Product Page Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for product page right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'product-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Product Page Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for product page left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );

Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'woocommerce-end'	
));