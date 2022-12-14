<?php
	
	/*
	 * Briddge Footer Action 
	 * 10 - briddge_site_footer
	 */
	do_action( 'briddge_footer' ); 

	/*
	 * Briddge Footer After Action 
	 * 10 - briddge_overlay_search_form
	 * 20 - briddge_mobile_menu
	 * 30 - briddge_secondary_bar
	 * 40 - briddge_back_to_top
	 */
	do_action( 'briddge_footer_after' ); 
?>
		</div><!-- .briddge-body-inner -->
	<?php wp_footer(); ?>
	</body>
</html>
