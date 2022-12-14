<?php 
/*
 * Page title template definition
 */

$keys = array(
	'chk' => 'page-title-chk',
	'fields' => array(
		'page_title_opt' => array( 'page-title', briddge_wp_elements::$template.'-title' ),
		'page_title_items' => array( 'page-title-items', briddge_wp_elements::$template.'-title-items' )
	)			
);
$page_title_values = briddge_wp_elements::briddge_get_meta_and_option_values( $keys );
if( $page_title_values['page_title_opt'] ):
	do_action( 'briddge_page_title_before' );
	
	$pt_custom_class = isset( $page_title_values['pt_custom_class'] ) ? $page_title_values['pt_custom_class'] : '';
?>
	<header class="briddge-page-header <?php echo esc_attr( $pt_custom_class ); ?>"> 
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php briddge_wp_elements::briddge_show_page_title( $page_title_values['page_title_items'] ); ?>
				</div>
			</div>
		</div><!-- .container -->
	</header><!-- .briddge-page-header -->
<?php
	do_action( 'briddge_page_title_after' );
endif;
