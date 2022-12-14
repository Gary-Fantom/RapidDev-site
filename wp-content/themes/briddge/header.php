<?php
/**
 * Header file for the Briddge WordPress theme.
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); // For wp wp_body_open action hook ?>

		<?php
			/*
			* Set briddget page meta
			*/
			if( is_singular() ){
				briddge_wp_elements::$briddge_page_options = get_post_meta( get_the_ID(), 'briddge_post_meta', true );
			}
			$keys = array(
				'chk' => 'general-chk',
				'fields' => array(
					'site_layout' => 'site-layout'
				)			
			);
			$layout = briddge_wp_elements::briddge_get_meta_and_option_values( $keys );
		?>

		<div class="briddge-body-inner<?php if( $layout['site_layout'] == 'boxed' ) echo esc_attr( ' container' ); ?>">
		
			<div class="page-loader"><span class="page-loader-divider"></span></div>

			<?php
			/*
			 * Briddge Header Before Action 
			 * 10 - briddge_mobile_header
			 */
			do_action( 'briddge_header_before' );
			?>
			
			<?php
			/*
			 * Briddge Header Action 
			 * 10 - briddge_desktop_header
			 */
			do_action( 'briddge_header' );
			?>
			
			<?php
			/*
			 * Briddge Header After Action 
			 * 10 - briddge_header_slider
			 */
			do_action( 'briddge_header_after' );
			?>