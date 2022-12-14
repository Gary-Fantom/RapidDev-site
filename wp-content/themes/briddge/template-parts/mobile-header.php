<?php
	$class_array = array(
		'left'		=> ' element-left',
		'center'	=> ' pull-center justify-content-center',
		'right'		=> ' pull-right justify-content-end'
	);
	$mobilebar_items = briddge_wp_elements::briddge_options('mobilebar-items');
	if( !empty( $mobilebar_items ) ):
	
		if( isset( $mobilebar_items['disabled'] ) ) unset( $mobilebar_items['disabled'] );

		$sticky_opt = briddge_wp_elements::briddge_options('mobilebar-sticky');
		if( $sticky_opt != 'off' ): ?>
		<div class="sticky-outer" data-stickyup="<?php echo esc_attr( $sticky_opt == 'on_scrollup' ? "1" : "0" ); ?>"><div class="sticky-head">
		<?php endif; ?>
		<div class="header-mobilebar navbar">
			<div class="container">
				<?php 
					foreach( $mobilebar_items as $key => $value ){
						$mobilebar_class = $class_array[$key];
						$mobilebar_class .= isset( $mobilebar_items['right'] ) && !empty( $mobilebar_items['right'] ) ? ' right-element-exist' : '';
						
						echo '<ul class="nav mobilebar'. esc_attr( $mobilebar_class ) .'">'; 
						foreach( $value as $element => $label ){
							switch($element){
								case "logo": ?>
									<li class="header-titles-wrapper">
										<div class="header-titles">
											<?php
												// Site title or logo.
												briddge_wp_framework::briddge_mobile_logo();
											?>
										</div><!-- .header-titles -->
									</li><!-- .header-titles-wrapper -->
								<?php
								break;
								case "menu-toggle": ?>
									<li class="header-mobile-toggle-wrapper">
										<a href="<?php echo esc_url( site_url() ); ?>" class="mobile-menu-toggle"><i class="bi bi-list"></i></a>
										<?php add_action( 'briddge_footer_after', function(){ get_template_part( 'template-parts/mobile', 'menu' ); }, 20 ); ?>
									</li><!-- .header-navigation-wrapper -->
								<?php
								break;
								case "search": ?>
									<li class="header-search-wrapper">
										<?php briddge_wp_framework::briddge_search_modal( '1', 'mobile_bar' ); ?>
									</li>
								<?php
								break;
							}
						}
						echo '</ul>';
					}
				?>
			</div><!-- .container -->
		</div><!-- .header-mobilebar --> <?php 
	if( $sticky_opt != 'off' ): ?>
	</div> <!-- .sticky-head --></div> <!-- .sticky-outer -->
	<?php endif; ?>	
<?php endif; ?>