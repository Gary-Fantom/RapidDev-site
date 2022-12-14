<?php
/**
 * The template for displaying pages.
 */

get_header();

briddge_wp_elements::$template = 'archive';
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
			<div class="col">
				<div class="section-inner thin error404-content">
					<h1 class="entry-title"><?php _e( 'Page Not Found', 'briddge' ); ?></h1>
					<div class="intro-text"><p><?php _e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'briddge' ); ?></p></div>
					<?php
					get_search_form(
						array(
							'label' => __( '404 not found', 'briddge' ),
						)
					);
					?>
				</div><!-- .section-inner -->
			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- #site-content -->

<?php get_footer(); ?>
