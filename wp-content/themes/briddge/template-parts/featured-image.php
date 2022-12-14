<?php
/**
 * Displays the featured image
 */

if ( has_post_thumbnail() && ! post_password_required() ) {
	?>

	<figure class="featured-media">
		<div class="featured-media-inner section-inner">
		<?php
			the_post_thumbnail( is_singular() ? 'large' : 'medium' );
			$caption = get_the_post_thumbnail_caption();
			if ( $caption ) {
			?>
				<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>
			<?php
			}
			?>
		</div><!-- .featured-media-inner -->
	</figure><!-- .featured-media -->

	<?php
}