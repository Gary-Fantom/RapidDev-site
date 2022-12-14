<?php
/**
 * Archive template
 */

get_header();

briddge_wp_elements::$template = 'archive';

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
					echo '<div class="briddge-masonry" data-columns="2" data-gutter="30">';
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', 'excerpt' );
						} 
					echo '</div>';		
				}
				?>
				<?php get_template_part( 'template-parts/pagination' ); ?>
			</div><!-- .col -->
			<?php get_template_part( 'template-parts/content-sidebar' ); ?>
		</div><!-- .row -->
	</div><!-- .briddge-content-wrap -->

</main><!-- #site-content -->

<?php
get_footer();
