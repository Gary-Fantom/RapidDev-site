<?php
/**
 * The template for displaying single custom posts.
 */

get_header();

briddge_wp_elements::$template = is_singular('post') ? 'single' : apply_filters( 'briddge_define_custom_single_template', 'custom-single' );
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
			<?php
				$content_col_class = briddge_wp_elements::briddge_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							if( is_single() ){
								do_action( 'briddge_single_content_after' );
							}

							//content template
							get_template_part( 'template-parts/content' );

							if( is_single() ){
								do_action( 'briddge_single_content_after' );
							}
						}
					}
				?>
			</div><!-- .col -->
			<?php 
				get_template_part( 'template-parts/content-sidebar' ); 
			?>
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- #site-content -->

<?php get_footer(); ?>
