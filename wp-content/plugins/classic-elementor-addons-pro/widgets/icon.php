<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Icon
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
 
class CEA_Elementor_Icon_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cea-icon';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Icon', 'cea' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cea-default-icon ti-crown';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'classic-elements' ];
	}

	/**
	 * Register icon widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'cea' ),
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
			'view',
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
			'shape',
			[
				'label' => esc_html__( 'Shape', 'cea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'cea' ),
					'square' => esc_html__( 'Square', 'cea' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
				],
				'prefix_class' => 'cea-shape-',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'cea' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'cea' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'cea' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .cea-icon-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

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
			'primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-icon svg' => 'fill: {{VALUE}};'
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .cea-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked .cea-icon' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .cea-icon' => 'border-color: {{VALUE}};'
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
			'hover_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cea-icon:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-icon:hover svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .cea-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked .cea-icon:hover' => 'background-color: {{VALUE}};'
				],
			]
		);
		
		$this->add_control(
			'hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .cea-icon:hover' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'cea' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'size',
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
					'{{WRAPPER}} .cea-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}}.cea-view-stacked .cea-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.cea-view-framed .cea-icon' => 'padding: {{SIZE}}{{UNIT}};'
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
					'view!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'rotate',
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
					'{{WRAPPER}} .cea-icon i, {{WRAPPER}} .cea-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => esc_html__( 'Border Width', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render icon widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'cea-icon-wrapper' );

		$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-icon' );

		if ( ! empty( $settings['hover_animation'] ) ) {
			$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		$icon_tag = 'div';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'icon-wrapper', $settings['link'] );

			$icon_tag = 'a';
		}

		if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			$settings['icon'] = 'ti-heart';
		}

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<<?php echo $icon_tag . ' ' . $this->get_render_attribute_string( 'icon-wrapper' ); ?>>
			<?php if ( $is_new || $migrated ) :
				Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
			else : ?>
				<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
			<?php endif; ?>
			</<?php echo $icon_tag; ?>>
		</div>
		<?php
	}
}
