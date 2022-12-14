<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage zozothemes
 * @since 1.0.0
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ( $next_post || $prev_post ) {

	$pagination_classes = '';

	if ( ! $next_post ) {
		$pagination_classes = ' only-one only-prev';
	} elseif ( ! $prev_post ) {
		$pagination_classes = ' only-one only-next';
	}

	?>

	<nav class="pagination-single section-inner<?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e( 'Post', 'briddge' ); ?>">

		<div class="pagination-single-inner">

			<?php
			if ( $prev_post ) {
				?>

				<h6 class="mb-0 pagination-prev"><a class="previous-post" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
					<span class="arrow" aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
					<span class="title"><span class="title-inner"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span></span>
				</a></h6>

				<?php
			}

			if ( $next_post ) {
				?>

				<h6 class="mb-0 pagination-next"><a class="next-post" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
					<span class="arrow" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
						<span class="title"><span class="title-inner"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span></span>
				</a></h6>
				<?php
			}
			?>

		</div><!-- .pagination-single-inner -->

	</nav><!-- .pagination-single -->

	<?php
}
