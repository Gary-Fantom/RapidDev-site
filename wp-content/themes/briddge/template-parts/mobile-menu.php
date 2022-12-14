<?php
/*
 * Mobile Menu Template
 */
?>
<div class="mobile-menu-floating">
	<a href="<?php echo esc_url( site_url() ); ?>" class="mobile-menu-toggle"><i class="close-icon"></i></a>

	<?php
	do_action( 'briddge_mobile_menu_before' );
	$mobilebar_items = briddge_wp_elements::briddge_options('mobilebar-menu-items');
	$mobilebar_items = isset( $mobilebar_items['enabled'] ) ? $mobilebar_items['enabled'] : ''; 
	if( !empty( $mobilebar_items ) && is_array( $mobilebar_items ) ):	
		foreach( $mobilebar_items as $element => $value ){
			switch($element){ 

				case "logo": ?>
				<div class="header-titles">
					<?php
						// Site title or logo.
						briddge_wp_framework::briddge_site_logo( array(), 'div' );
					?>
				</div><!-- .header-titles --> <?php
				break;

				case "menu":			
					if ( has_nav_menu( 'mobile' ) ) { ?>
						<nav class="mobile-menu-wrapper">
							<ul class="wp-menu mobile-menu">
								<?php
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'mobile'
										)
									);
								?>
							</ul>
						</nav><!-- .mobile-menu-wrapper --> <?php
					}
				break;

				case "search": ?>
					<form role="search" class="form-inline search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="input-group">
							<input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'briddge' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
							<span class="input-group-btn">
								<button class="btn btn-outline-success" type="submit"><span class="bi bi-search"></span></button>
							</span>
						</div>
					</form>
				<?php
				break;

				case "social": 
					if( class_exists( 'briddge_custom_functions' ) ):
				?>
					<div class="mobile-menu-social-wrap">
						<?php
							// Mobile menu social links.
							briddge_custom_functions::briddge_social_links();
						?>
					</div>
				<?php
					endif;
				break;

			} //switch	
		} //foreach
	endif; 	
	do_action( 'briddge_mobile_menu_after' ); 
	?>

</div><!-- .mobile-menu-floating -->