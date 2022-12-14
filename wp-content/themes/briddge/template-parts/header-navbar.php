<?php
	$class_array = array(
		'left'		=> ' element-left',
		'center'	=> ' pull-center justify-content-center',
		'right'		=> ' pull-right justify-content-end'
	);
	$header_keys = array(
		'chk' => 'header-chk',
		'fields' => array(
			'header_layout' => 'header-layout'
		)			
	);
	$header_values = briddge_wp_elements::briddge_get_meta_and_option_values( $header_keys );
	$keys = array(
		'chk' => 'header-navbar-chk',
		'fields' => array(
			'header_navbar_items' => 'navbar-items',
			'header_navbar_text_1' => 'navbar-custom-text-1',
			'header_navbar_text_2' => 'navbar-custom-text-2'
		)			
	);
	$navbar_values = briddge_wp_elements::briddge_get_meta_and_option_values( $keys );
	$navbar_items = $navbar_values['header_navbar_items'];
	if( !empty( $navbar_items ) ):	
		if( isset( $navbar_items['disabled'] ) ) unset( $navbar_items['disabled'] );
		
		$layout = $header_values['header_layout'];
		$container_class = $layout == 'wider' ? 'container-fluid' : 'container';
?>
		<div class="header-navbar navbar elements-<?php echo esc_attr( count( $navbar_items ) ); ?>">
			<?php
				/*
				 * Briddge Topbar Before Action
				 */
				do_action( 'briddge_navbar_before' );
			?>
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<?php 
				foreach( $navbar_items as $key => $value ){
					$navbar_class = $class_array[$key];
					$navbar_class .= isset( $navbar_items['right'] ) && !empty( $navbar_items['right'] ) ? ' right-element-exist' : '';
					echo '<ul class="nav navbar-ul'. esc_attr( $navbar_class ) .'">';
						foreach( $value as $element => $label ){
							switch( $element ){
								case "custom-text-1":
									if( $navbar_values['header_navbar_text_1'] )
									echo '<li>'. do_shortcode( stripslashes( $navbar_values['header_navbar_text_1'] ) ) .'</li>';
								break;
								case "custom-text-2":
									if( $navbar_values['header_navbar_text_2'] )
									echo '<li>'. do_shortcode( stripslashes( $navbar_values['header_navbar_text_2'] ) ) .'</li>';
								break;
								case "social":
									if( class_exists( 'briddge_custom_functions' ) ):
										echo '<li>';
										briddge_custom_functions::briddge_social_links();
										echo '</li>';
									endif;
								break;
								case "email":
									echo '<li>';
									briddge_wp_framework::briddge_email_link( briddge_wp_elements::briddge_options('header-email') );
									echo '</li>';
								break;
								case "address":
									echo '<li>';
									briddge_wp_framework::briddge_address( briddge_wp_elements::briddge_options('header-address') );
									echo '</li>';
								break;
								case "search":
									$keys = array(
										'chk' => 'header-chk',
										'fields' => array(
											'search_type' => 'search-type'
										)			
									);
									$search_values = briddge_wp_elements::briddge_get_meta_and_option_values( $keys );
									$search_type = $search_values['search_type'];
									echo '<li>';
									briddge_wp_framework::briddge_search_modal( $search_type, 'navbar' );
									echo '</li>';
								break;
									case "logo": ?>
									<li class="header-titles-wrapper">
										<div class="header-titles">
											<?php
												// Site title or logo.
												briddge_wp_framework::briddge_site_logo();
												// Sticky logo
												briddge_wp_framework::briddge_sticky_logo();
												// Site description.
												briddge_wp_framework::briddge_site_description();
											?>
										</div><!-- .header-titles -->
									</li><!-- .header-titles-wrapper -->
								<?php
								break;
								case "primary-menu": ?>
									<li class="header-navigation-wrapper">
										<?php if ( has_nav_menu( 'primary' ) ) { ?>
											<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'briddge' ); ?>">
												<ul class="nav wp-menu primary-menu">
													<?php
														wp_nav_menu(
															array(
																'container'  => '',
																'items_wrap' => '%3$s',
																'theme_location' => 'primary'
															)
														);
													?>
												</ul>
											</nav><!-- .primary-menu-wrapper -->
										<?php } else { 
											echo sprintf( 
												'<a href="%1$s">%2$s</a>',
												admin_url( 'nav-menus.php' ),
												esc_html__( 'Add a menu', 'briddge' )					
											); } ?>
									</li><!-- .header-navigation-wrapper -->
								<?php
								break;
								case "secondary-bar": ?>
									<li class="secondary-toggle-wrapper">
										<a href="<?php echo esc_url( site_url() ); ?>" class="secondary-menu-toggle briddge-toggle"><span></span><span></span><span></span></a>
									</li>
									<?php add_action( 'briddge_footer_after', array( 'briddge_wp_elements', 'briddge_secondary_bar' ), 10 ); ?>
								<?php
								break;
							}
						}
					echo '</ul>';
				}
				?>
			</div><!-- .container -->
			<?php
				/*
				 * Briddge Topbar After Action 
				 * 10 - briddge_fullbar_search_form
				 */
				do_action( 'briddge_navbar_after' );
			?>
		</div><!-- .header-navbar -->
<?php endif; ?>