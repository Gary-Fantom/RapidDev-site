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
		'chk' => 'header-topbar-chk',
		'fields' => array(
			'header_topbar_items' => 'topbar-items',
			'header_topbar_text_1' => 'topbar-custom-text-1',
			'header_topbar_text_2' => 'topbar-custom-text-2'
		)			
	);
	$topbar_values = briddge_wp_elements::briddge_get_meta_and_option_values( $keys );
	$topbar_items = $topbar_values['header_topbar_items'];
	if( !empty( $topbar_items ) ):
		if( isset( $topbar_items['disabled'] ) ) unset( $topbar_items['disabled'] );
		
		$layout = $header_values['header_layout'];
		$container_class = $layout == 'wider' ? 'container-fluid' : 'container'; //justify-content-between class removed
?>
		<div class="header-topbar navbar elements-<?php echo esc_attr( count( $topbar_items ) ); ?>">
			<?php
				/*
				* Briddge Topbar Before Action 
				*/
				do_action( 'briddge_topbar_before' );
			?>
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<?php 
					foreach( $topbar_items as $key => $value ){
						$topbar_class = $class_array[$key];
						$topbar_class .= isset( $topbar_items['right'] ) && !empty( $topbar_items['right'] ) ? ' right-element-exist' : '';
						echo '<ul class="nav topbar-ul'. esc_attr( $topbar_class ) .'">';
							foreach( $value as $element => $label ){
								switch( $element ){
									case "custom-text-1":
										if( $topbar_values['header_topbar_text_1'] )
										echo '<li>'. do_shortcode( stripslashes( $topbar_values['header_topbar_text_1'] ) ) .'</li>';
									break;
									case "custom-text-2":
										if( $topbar_values['header_topbar_text_1'] )
										echo '<li>'. do_shortcode( stripslashes( $topbar_values['header_topbar_text_2'] ) ) .'</li>';
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
									case "top-menu":
										echo '<li>';
										$top_menu_args = apply_filters( 'briddge_top_menu_args', array(
											'menu' => 'top-menu',
											'menu_class' => 'nav top-menu'
										) );
										wp_nav_menu( $top_menu_args );
										echo '</li>';
									break;
									case "search":
										echo '<li>';
										briddge_wp_framework::briddge_search_modal( briddge_wp_elements::briddge_options('search-type'), 'topbar' );
										echo '</li>';
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
				do_action( 'briddge_topbar_after' );
			?>
		</div><!-- .header-topbar -->
<?php endif; ?>