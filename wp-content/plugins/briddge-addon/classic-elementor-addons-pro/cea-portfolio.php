<?php
/**
 * The template for displaying all single portfolio
 *
 */

$t = new CEACPTElements();

?>

<div class="wrap cea-content">
	
	<?php do_action( 'cea_portfolio_before_content' ); ?>

	<div class="portfolio-content-area">
		<?php
			$sticky_col = get_post_meta( get_the_ID(), 'cea_portfolio_sticky', true );
			$sticky_lclass = $sticky_rclass = '';
			if( !empty( $sticky_col ) && $sticky_col != 'none' ){
				$sticky_lclass = $sticky_col == 'left' ? ' cea-sticky-obj' : '';
				$sticky_rclass = $sticky_col == 'right' ? ' cea-sticky-obj' : '';
			}						
		?>						
		<div class="portfolio-single portfolio-model-2">
			<div class="row">
			
				<div class="col-sm-12">
					<div class="portfolio-format">
						<?php $t->ceaCPTPortfolioFormat(); ?>
					</div>
				</div>
				
			</div><!-- .row -->
			<div class="row portfolio-details">
			
				<div class="col-sm-8">
					<div class="portfolio-content-wrap<?php echo esc_attr( $sticky_lclass ); ?>">
						<?php $t->ceaCPTPortfolioTitle(); ?>
						<?php $t->ceaCPTPortfolioContent(); ?>
						<?php $t->ceaCPTNav(); ?>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="portfolio-meta<?php echo esc_attr( $sticky_rclass ); ?>">
						<?php $t->ceaCPTMeta(); ?>
					</div>
				</div>
				
			</div><!-- .row -->
		</div><!-- .portfolio-single -->
		<?php
		
			//Portfolio Related Slider
			$t->ceaCPTPortfolioRelated();
		?>
	</div><!-- .portfolio-content-area -->
	
	<?php do_action( 'cea_portfolio_after_content' ); ?>
	
</div><!-- .wrap -->