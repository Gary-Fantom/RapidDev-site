<?php

Briddge_Options::$briddge_options = get_post_meta( get_the_ID(), 'briddge_post_meta', true );

// General
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'General', 'briddge-addon' ),
	'id'         => 'general-tab'
) );

Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Site General', 'briddge-addon' ),
	'id'         => 'site-general',
	'fields'	 => array(
		array(
			'id'			=> 'general-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Site General Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit site general settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'site-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Site Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose site layout either wide or boxed.', 'briddge-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'general-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'content-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Content Padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'Assign content padding. If need no padding means just leave this empty. Example 10 10 10 10', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'general-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-slider',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Header Slider', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enter shortcode for header slider.', 'briddge-addon' ),
			'default'		=> '',
		)		
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Logo Settings', 'briddge-addon' ),
	'id'         => 'site-logo',
	'fields'	 => array(
		array(
			'id'			=> 'logo-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Site General Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit site logo settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'logo-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Logo Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is settings for site logo.', 'briddge-addon' ),
			'seperator'		=> 'after',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'site-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Default Logo', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose site logo image.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'site-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Site Logo Maximum Width', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is maximum width of logo. if you want original width leave this field empty.', 'briddge-addon' ),
			'only_dimension' => 'width',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'site-logo-desc',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable Site Logo Description', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is logo description options for this site. You can enable or disable.', 'briddge-addon' ),
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'sticky-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Sticky Logo', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose site sticky logo image.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'sticky-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Sticky Logo Maximum Width', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is maximum width of sticky logo. if you want original width leave this field empty.', 'briddge-addon' ),
			'only_dimension' => 'width',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'mobile-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Mobile Logo', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose site mobile logo image.', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'mobile-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Mobile Logo Maximum Width', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is maximum width of mobile logo. if you want original width leave this field empty.', 'briddge-addon' ),
			'only_dimension' => 'width',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
	)
) );

Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'general-tab-end'	
));

// Header
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'Header', 'briddge-addon' ),
	'id'         => 'header-tab'
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'General', 'briddge-addon' ),
	'id'         => 'header-general',
	'fields'	 => array(
		array(
			'id'			=> 'header-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Header Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose header layout either wide or boxed.', 'briddge-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wide.png'
				),
				'wider' => array(
					'title' => esc_html__( 'Wider', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wider.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Header Bars', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are header items. Drag which items you want to display normal and sticky.', 'briddge-addon' ),
			'default'		=> array(
				'normal' => array(
					'topbar' => esc_html__( 'Topbar', 'briddge-addon' ),
					'logobar' => esc_html__( 'Logo bar', 'briddge-addon' )
				),
				'sticky' => array(
					'navbar' => esc_html__( 'Navbar', 'briddge-addon' )
				),
				'disabled' => array(
				)
			),
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-absolute',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Header Absolute', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable/Disable header absolute. Like floating on slider', 'briddge-addon' ),
			'default'		=> false,
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'search-type',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Search Toggle Modal', 'briddge-addon' ),
			'description'	=> esc_html__( 'Slect search box type', 'briddge-addon' ),
			'choices'		=> array(
				'1'	=> esc_html__( 'Full Screen Search', 'briddge-addon' ),
				'2' => esc_html__( 'Text Box Toggle Search', 'briddge-addon' ),
				'3' => esc_html__( 'Full Bar Toggle Search', 'briddge-addon' ),
				'4' => esc_html__( 'Bottom Seach Box Toggle', 'briddge-addon' )
			),
			'default'		=> '1',
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header styles.', 'briddge-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Style Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header style settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Header Border', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is border setting for header', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header margin', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		)
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Topbar', 'briddge-addon' ),
	'id'         => 'header-topbar',
	'fields'	 => array(
		array(
			'id'			=> 'header-topbar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Topbar Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header topbar settings.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'topbar-custom-text-1',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Topbar Custom Text 1', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is topbar custom text field. Here you can place shortcodes too', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'topbar-custom-text-2',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Topbar Custom Text 2', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is topbar custom text field. Here you can place shortcodes too', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'topbar-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Topbar Items', 'briddge-addon' ),
			'description'	=> esc_html__( 'These all are topbar items. You can make your own layout by drag and drop', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
					'custom-text-1' => esc_html__( 'Custom Text 1', 'briddge-addon' )
				),
				'center' => array(					
				),
				'right' => array(
					'social' => esc_html__( 'Social', 'briddge-addon' )
				),
				'disabled' => array(
					'address' => esc_html__( 'Address', 'briddge-addon' ),
					'email' => esc_html__( 'Email', 'briddge-addon' ),
					'search' => esc_html__( 'Search', 'briddge-addon' ),
					'top-menu' => esc_html__( 'Top Menu', 'briddge-addon' ),
					'custom-text-2' => esc_html__( 'Custom Text 2', 'briddge-addon' )
				)
			),
			'required'		=> array( 'header-topbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Topbar Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header topbar styles.', 'briddge-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-topbar-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Topbar Style Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header topbar style settings.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-topbar-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Topbar Height', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is height property of header topbar.', 'briddge-addon' ),
			'only_dimension' => 'height',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-sticky-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Topbar Sticky Height', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is height property of header sticky topbar.', 'briddge-addon' ),
			'only_dimension' => 'height'
		),
		array(
			'id'			=> 'header-topbar-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Topbar Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header topbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Topbar Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header topbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Topbar Border', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is border setting for header topbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Topbar padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header topbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Topbar margin', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header topbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),	
		array(
			'id'			=> 'header-topbar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Topbar Sticky Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header topbar sticky styles.', 'briddge-addon' ),
			'seperator'		=> 'before',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Topbar Sticky Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header topbar on sticky', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Topbar Sticky Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header topbar on sticky', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),	
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Logo bar', 'briddge-addon' ),
	'id'         => 'header-logobar',
	'fields'	 => array(
		array(
			'id'			=> 'header-logobar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Logo bar Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header logo bar settings.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'logobar-custom-text-1',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Logobar Custom Text1', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is logo custom text field. Here you can place shortcodes too', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'logobar-custom-text-2',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Logobar Custom Text2', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is logo custom text field. Here you can place shortcodes too', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'logobar-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Logo bar Items', 'briddge-addon' ),
			'description'	=> esc_html__( 'These all are logobar items. You can make your own layout by drag and drop', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'logo' => esc_html__( 'Logo', 'briddge-addon' )
				),
				'right' => array(					
				),
				'disabled' => array(
					'social' => esc_html__( 'Social', 'briddge-addon' ),
					'address' => esc_html__( 'Address', 'briddge-addon' ),
					'email' => esc_html__( 'Email', 'briddge-addon' ),
					'search' => esc_html__( 'Search', 'briddge-addon' ),
					'primary-menu' => esc_html__( 'Primary Menu', 'briddge-addon' ),
					'secondary-bar' => esc_html__( 'Secondary Bar', 'briddge-addon' ),
					'signin' => esc_html__( 'Signin/Register', 'briddge-addon' ),
					'custom-text-2' => esc_html__( 'Custom Text 2', 'briddge-addon' ),
					'custom-text-1' => esc_html__( 'Custom Text 1', 'briddge-addon' ),
				)
			),
			'required'		=> array( 'header-logobar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Logo bar Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header logobar styles.', 'briddge-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-logobar-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Logo bar Style Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header logo bar style settings.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-logobar-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Logo bar Height', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is height property of header logobar.', 'briddge-addon' ),
			'only_dimension' => 'height',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-sticky-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Logo bar Sticky Height', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is height property of header sticky logobar.', 'briddge-addon' ),
			'only_dimension' => 'height'
		),
		array(
			'id'			=> 'header-logobar-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Logo bar Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header logobar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header logobar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Logo bar Border', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is border setting for header logobar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Logo bar padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header logobar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Logo bar margin', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header logobar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),	
		array(
			'id'			=> 'header-logobar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Logobar Sticky Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header logobar sticky styles.', 'briddge-addon' ),
			'seperator'		=> 'before',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Logobar Sticky Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header logobar on sticky', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Logobar Sticky Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header logobar on sticky', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Navbar', 'briddge-addon' ),
	'id'         => 'header-navbar',
	'fields'	 => array(
		array(
			'id'			=> 'header-navbar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Navbar Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header navbar settings.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'navbar-custom-text-1',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Navbar Custom Text 1', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is nav custom text field. Here you can place shortcodes too', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'navbar-custom-text-2',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Navbar Custom Text 2', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is nav custom text field. Here you can place shortcodes too', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'navbar-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Nav bar Items', 'briddge-addon' ),
			'description'	=> esc_html__( 'These all are navbar items. You can make your own layout by drag and drop', 'briddge-addon' ),
			'default'		=> array(
				'left' => array(	
					'logo' => esc_html__( 'Logo', 'briddge-addon' ),
					'primary-menu' => esc_html__( 'Primary Menu', 'briddge-addon' )
				),
				'center' => array(					
				),
				'right' => array(	
					'search' => esc_html__( 'Search', 'briddge-addon' ),
				),
				'disabled' => array(
					'social' => esc_html__( 'Social', 'briddge-addon' ),
					'address' => esc_html__( 'Address', 'briddge-addon' ),
					'email' => esc_html__( 'Email', 'briddge-addon' ),
					'secondary-bar' => esc_html__( 'Secondary Bar', 'briddge-addon' ),
					'signin' => esc_html__( 'Signin/Register', 'briddge-addon' ),
					'custom-text-2' => esc_html__( 'Custom Text 2', 'briddge-addon' ),
					'custom-text-1' => esc_html__( 'Custom Text 1', 'briddge-addon' ),
				)
			),
			'required'		=> array( 'header-navbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Navbar Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header navbar styles.', 'briddge-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-navbar-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Navbar Style Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header logo bar style settings.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-navbar-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Navbar Height', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is height property of header navbar.', 'briddge-addon' ),
			'only_dimension' => 'height',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-sticky-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Navbar Sticky Height', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is height property of header sticky navbar.', 'briddge-addon' ),
			'only_dimension' => 'height'
		),
		array(
			'id'			=> 'header-navbar-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Navbar Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header navbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header navbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Navbar Border', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is border setting for header navbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Navbar padding', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header navbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Navbar margin', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header navbar', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),	
		array(
			'id'			=> 'header-navbar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Navbar Sticky Styles', 'briddge-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header navbar sticky styles.', 'briddge-addon' ),
			'seperator'		=> 'before',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Navbar Sticky Link Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header navbar on sticky', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Navbar Sticky Background Color', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background setting for header navbar on sticky', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
	)
) );
Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'header-tab-end'	
));

//Layout Settings
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'Layout', 'briddge-addon' ),
	'id'         => 'post-layout'
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Page Title', 'briddge-addon' ),
	'id'         => 'page-title-options',
	'fields'	 => array(
		array(
			'id'			=> 'page-title-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit page title options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'page-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disabe Page Title', 'briddge-addon' ),
			'description'	=> esc_html__( 'Enable or disable blog page title section', 'briddge-addon' ),
			'default'		=> true,
			'required'		=> array( 'page-title-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'page-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Blog Page Title Elements', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are blog page title elements. Drag which items you want to display left, center and right part.', 'briddge-addon' ),
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
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'page-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Page Title Background', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background settings of page title.', 'briddge-addon' ),
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'page-title-custom-class',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Page Title Custom Class', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is setting for add custom class name to page title wrapper.', 'briddge-addon' ),
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Sidebar Layout', 'briddge-addon' ),
	'id'         => 'sidebar-layout-options',
	'fields'	 => array(
		array(
			'id'			=> 'sidebar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Sidebar', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit sidebar layout options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Sidebar Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose sidebar layout.', 'briddge-addon' ),
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
			'default' => 'right-sidebar',
			'required'		=> array( 'sidebar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for right widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for left widget area', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );
Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'post-layout-end'	
));

// Footer
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'Footer', 'briddge-addon' ),
	'id'         => 'footer-tab'
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'General', 'briddge-addon' ),
	'id'         => 'footer-general',
	'fields'	 => array(
		array(
			'id'			=> 'footer-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit footer settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose footer layout either wide or boxed.', 'briddge-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'footer-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Footer Items', 'briddge-addon' ),
			'description'	=> esc_html__( 'These are footer items. Drag which items you want to display Enabled and Disabled.', 'briddge-addon' ),
			'default'		=> array(
				'enabled' => array(
					'footer-middle' => esc_html__( 'Footer Widgets', 'briddge-addon' ),
					'footer-bottom' => esc_html__( 'Copyright Section', 'briddge-addon' )
				),
				'disabled' => array(
					'footer-top' => esc_html__( 'Insta Footer', 'briddge-addon' ),
				)
			),
			'required'		=> array( 'footer-chk', '=', array( 'custom' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Insta Footer', 'briddge-addon' ),
	'id'         => 'footer-insta',
	'fields'	 => array(
		array(
			'id'			=> 'insta-footer-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Insta Footer Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit insta footer settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'insta-footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Insta Footer Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose insta footer layout either wide or boxed.', 'briddge-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'insta-footer-chk', '=', array( 'custom' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Footer Widgets', 'briddge-addon' ),
	'id'         => 'footer-widgets',
	'fields'	 => array(
		array(
			'id'			=> 'footer-middle-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Footer Widgets Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit footer middle settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'widgets-footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Widgets Footer Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widgets footer layout either wide or boxed.', 'briddge-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'boxed',
			'required'		=> array( 'footer-middle-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-widgets-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Widgets Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose footer widgets layout.', 'briddge-addon' ),
			'items'		=> array(
				'3-3-3-3' => array(
					'title' => esc_html__( 'Column 3/3/3/3', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-3-3-3-3.png'
				),
				'3-3-6' => array(
					'title' => esc_html__( 'Column 3/3/6', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-3-3-6.png'
				),
				'12' => array(
					'title' => esc_html__( 'Column 12', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-12.png'
				),
				'4-4-4' => array(
					'title' => esc_html__( 'Column 4/4/4', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-4-4-4.png'
				),
				'4-8' => array(
					'title' => esc_html__( 'Column4/8', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-4-8.png'
				),
				'6-3-3' => array(
					'title' => esc_html__( 'Column 6/3/3', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-6-3-3.png'
				),
				'8-4' => array(
					'title' => esc_html__( 'Column 8/4', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-8-4.png'
				)
			),
			'default' => '12',
			'required'		=> array( 'footer-middle-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-widget-1',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 1', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 1', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-middle-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-widget-2',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 2', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 2', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-widgets-layout', '!=', array( '12' ) )
		),
		array(
			'id'			=> 'footer-widget-3',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 3', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 3', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-widgets-layout', '=', array( '3-3-3-3', '3-3-6', '4-4-4', '6-3-3' ) )
		),
		array(
			'id'			=> 'footer-widget-4',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 4', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 4', 'briddge-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-widgets-layout', '=', array( '3-3-3-3' ) )
		),
	)
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Copyright Section', 'briddge-addon' ),
	'id'         => 'copyright-section',
	'fields'	 => array(
		array(
			'id'			=> 'footer-bottom-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Footer Widgets Settings', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit footer middle settings options.', 'briddge-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'briddge-addon' ),
				'custom'	=> esc_html__( 'Custom', 'briddge-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'footer-bottom-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Bottom Layout', 'briddge-addon' ),
			'description'	=> esc_html__( 'Choose footer bottom layout either wide or boxed.', 'briddge-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'briddge-addon' ),
					'url' => BRIDDGE_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'boxed',
			'required'		=> array( 'footer-bottom-chk', '=', array( 'custom' ) )
		),
	)
) );
Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'footer-end'	
));


/*
//All Fields
Briddge_Options::briddge_set_section( array(
	'title'      => esc_html__( 'All Fields', 'briddge-addon' ),
	'id'         => 'all-fields'
) );
Briddge_Options::briddge_set_sub_section( array(
	'title'      => esc_html__( 'Fields', 'briddge-addon' ),
	'id'         => 'un-fields-tab',
	'fields'	 => array(
		array(
			'id'			=> 'test_text_field',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Text Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is text field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'test_textarea_field',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Textarea Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is textarea field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'test_select_field',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Select Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is select field', 'briddge-addon' ),
			'choices'		=> array(
				'1'	=> 'One',
				'2'	=> 'Two',
				'3'	=> 'Three'
			),
			'default'		=> '2'
		),
		array(
			'id'			=> 'test_color_field',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Color Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is color field', 'briddge-addon' ),
			'alpha'			=> false,
			'default'		=> '#111111'
		),
		array(
			'id'			=> 'test_link_field',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Link Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is link field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'ajax-trigger-fonts-test',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Google Fonts Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is fonts field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'background_test',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Background Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is background field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'image_test',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Image Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is image field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'border_test',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Border Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is border field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'dimension_test',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Dimension Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is dimension field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'hw_test',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Width/Height Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is width height field', 'briddge-addon' ),
			'only_dimension' => 'both'
		),
		array(
			'id'			=> 'toggle_test',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Toggle Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is toggle field', 'briddge-addon' )
		),
		array(
			'id'			=> 'sidebars_test',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Sidebars Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is sidebars field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'pages_test',
			'type'			=> 'pages',
			'title'			=> esc_html__( 'Pages Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is pages field', 'briddge-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'multicheck_test',
			'type'			=> 'multicheck',
			'title'			=> esc_html__( 'Multi Check Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is multi check box field', 'briddge-addon' ),
			'items'		=> array(
				'one' => esc_html__( 'One', 'briddge-addon' ),
				'two' => esc_html__( 'Two', 'briddge-addon' ),
				'three' => esc_html__( 'Three', 'briddge-addon' ),
				'four' => esc_html__( 'Four', 'briddge-addon' ),
				'five' => esc_html__( 'Five', 'briddge-addon' )
			)
		),
		array(
			'id'			=> 'radioimage_test',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Radio Image Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is radio image field', 'briddge-addon' ),
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
			'default' => 'left-sidebar'
		),
		array(
			'id'			=> 'dragdrop_test',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Drag Drop Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is drag and drop field', 'briddge-addon' ),
			'default'		=> array(
				'enabled' => array(
					'one' => esc_html__( 'One', 'briddge-addon' ),
					'two' => esc_html__( 'Two', 'briddge-addon' )
				),
				'disabled' => array(
					'three' => esc_html__( 'Three', 'briddge-addon' ),
					'four' => esc_html__( 'Four', 'briddge-addon' ),
					'five' => esc_html__( 'Five', 'briddge-addon' )
				)
			)
		),
		array(
			'id'			=> 'test_label_field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Label Field', 'briddge-addon' ),
			'description'	=> esc_html__( 'This is label field', 'briddge-addon' ),
			'seperator'		=> 'after'
		),
	)
) );
Briddge_Options::briddge_set_end_section( array(
	'id'		=> 'all-fields-end'	
));*/