<?php
/**
 * The template for displaying pages.
 */

get_header();

briddge_wp_elements::$template = apply_filters( 'briddge_define_page_template', 'page' );
briddge_wp_elements::$briddge_page_options = get_post_meta( get_the_ID(), 'briddge_post_meta', true );

?>

<main id="site-content">

	<?php 
		/*
		* Page title template call
		*/
		get_template_part( 'template-parts/page', 'title' );
	?>

	<div class="briddge-content-wrap container page">
		<div class="row">
			<?php
				$content_col_class = briddge_wp_elements::briddge_get_content_class();
			?>
			<div class="<?php echo esc_attr( $content_col_class ); ?>">
				<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content' );
						}
					}
				?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- #site-content -->

<?php get_footer(); ?>
