<?php
/**
 * Template coming soon default
 */
 
 //get maintenance header
 require_once( BRIDDGE_ADDON_DIR . 'maintenance/header.php' );

 $address = Briddge_Theme_Option::briddge_options( 'maintenance-address' );
 $email = Briddge_Theme_Option::briddge_options( 'maintenance-email' );
 $phone = Briddge_Theme_Option::briddge_options( 'maintenance-phone' );
 
?>
<div class="container text-center maintenance-wrap">
	<div class="row">
		<div class="col-md-12">
			<h1 class="maintenance-title"><?php esc_html_e( 'Coming Soon', 'briddge-addon' ); ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h4><?php esc_html_e( 'Phone', 'briddge-addon' ); ?></h4>
			<div class="maintenance-phone">
				<?php echo esc_html(  $phone ); ?>
			</div>
		</div>
		<div class="col-md-4">
			<h4><?php esc_html_e( 'Address', 'briddge-addon' ); ?></h4>
			<div class="maintenance-address">
				<?php echo wp_kses_post( $address ); ?>
			</div>
		</div>
		<div class="col-md-4">
			<h4><?php esc_html_e( 'Email', 'briddge-addon' ); ?></h4>
			<div class="maintenance-email">
				<?php echo esc_html(  $email ); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 maintenance-footer">
			<p><?php esc_html_e( 'We are currently working on an awesome new site, which will be ready soon. Stay Tuned!', 'briddge-addon' ); ?></p>
		</div>
	</div>
	
</div>
<?php
 //get maintenance header
 require_once( BRIDDGE_ADDON_DIR . 'maintenance/footer.php' );
?>
