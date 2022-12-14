<?php

//Service Tab
ceaPluginOptions::ceaSetSection( array(
	'title'      => esc_html__( 'Service', 'cea-post-types' ),
	'id'         => 'cea-service-tab',
	'fields'	 => array(
		array(
			'id'       => 'service-title-opt',
			'type'     => 'switch',
			'title'    => esc_html__( 'Service Title', 'cea-post-types' ),
			'subtitle' => esc_html__( 'Enable/Disable service title on single service( not page title ).', 'cea-post-types' ),
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'cpt-service-slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Service Slug', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter service slug for register custom post type.', 'cea-post-types' ),
			'default'  => 'service'
		),
		array(
			'id'       => 'cpt-service-sidebars',
			'type'     => 'select',
			'title'    => esc_html__( 'Service Sidebar', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select single service sidebar.', 'cea-post-types' ),
			'sidebars'  => true
		)
	)
) );