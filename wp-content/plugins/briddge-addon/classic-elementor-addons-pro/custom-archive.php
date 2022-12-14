<?php
/**
 * The template for displaying archive custom posts.
 */

get_header();

briddge_wp_elements::$template = apply_filters( 'briddge_define_custom_single_template', 'custom-archive' );
?>

<main id="site-content">

	<?php 
		/*
		* Page title template call
		*/
		get_template_part( 'template-parts/page', 'title' );
	?>
	
	<div class="briddge-content-wrap container">
		<div class="row">
			<div class="col order-md-2">
				<?php				
					require_once ( BRIDDGE_ADDON_DIR . '/classic-elementor-addons-pro/cea-portfolio-archive-content.php' );
				?>
				<?php get_template_part( 'template-parts/pagination' ); ?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .briddge-content-wrap -->

</main><!-- #site-content -->

<?php get_footer(); ?>
