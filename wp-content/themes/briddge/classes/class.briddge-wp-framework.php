<?php 

/*
 * Briddge WP Framework Class
 */

class briddge_wp_framework {
	
	private static $_instance = null;

	public function __construct(){
		//Search form filter
		add_filter( 'get_search_form', array( 'briddge_wp_framework', 'briddge_search_form' ) );
	}
	
	public static function briddge_mobile_logo() {
		
		$logo_keys = array(
			'chk' => 'logo-chk',
			'fields' => array(
				'mobile_logo' => 'mobile-logo'
			)			
		);
		$logo_values = briddge_wp_elements::briddge_get_meta_and_option_values( $logo_keys );
		extract( $logo_values );
		
		$mobile_logo_url = '';
		if( !empty( $mobile_logo ) && is_array( $mobile_logo ) && isset( $mobile_logo['image'] ) ){
			$mobile_logo = $mobile_logo['image'];
			$mobile_logo_id = isset( $mobile_logo['id'] ) ? $mobile_logo['id'] : '';
			if ( wp_attachment_is_image( $mobile_logo_id ) ) {
				$mobile_logo_url = isset( $mobile_logo['url'] ) ? wp_get_attachment_url( $mobile_logo_id ) : '';
				$site_title = get_bloginfo( 'name' );
				?>
				<a class="site-link" href="<?php echo esc_url( get_home_url( null, '/' ) ); ?>"><img class="img-fluid mobile-logo" src="<?php echo esc_url( $mobile_logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>" /></a>
				<?php
			}else{
				briddge_wp_framework::briddge_site_logo();
			}
		}
	}
	
	public static function briddge_site_logo( $sticky = false ) {
		$site_logo = '';
		
		$logo_keys = array(
			'chk' => 'logo-chk',
			'fields' => array(
				'site_logo' => 'site-logo'
			)			
		);
		$logo_values = briddge_wp_elements::briddge_get_meta_and_option_values( $logo_keys );
		extract( $logo_values );
		
		$class_names = array(
			'parent_class' =>  $sticky ? 'site-link sticky-logo-link' : 'site-link',
			'item_class' => $sticky ? 'img-fluid sticky-logo' : 'img-fluid site-logo'
		);
		
		$site_logo_url = '';
		if( !empty( $site_logo ) && is_array( $site_logo ) && isset( $site_logo['image'] ) ){
			$site_logo = $site_logo['image'];
			$site_logo_id = isset( $site_logo['id'] ) ? $site_logo['id'] : '';
			if ( wp_attachment_is_image( $site_logo_id ) ) {
				$site_logo_url = isset( $site_logo['url'] ) ? wp_get_attachment_url( $site_logo_id ) : '';
				$site_title = get_bloginfo( 'name' );
				?>
				<a class="<?php echo esc_attr( $class_names['parent_class'] ); ?>" href="<?php echo esc_url( get_home_url( null, '/' ) ); ?>"><img class="<?php echo esc_attr( $class_names['item_class'] ); ?>" src="<?php echo esc_url( $site_logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>" /></a>
				<?php
			}else{
				if( !$sticky ) {
					briddge_wp_framework::briddge_basic_logo();
				}
			}
		}
	}
	
	public static function briddge_sticky_logo() {
		
		$logo_keys = array(
			'chk' => 'logo-chk',
			'fields' => array(
				'sticky_logo' => 'sticky-logo'
			)			
		);
		$logo_values = briddge_wp_elements::briddge_get_meta_and_option_values( $logo_keys );
		extract( $logo_values );
		
		$site_logo_url = '';
		if( !empty( $sticky_logo ) && is_array( $sticky_logo ) && isset( $sticky_logo['image'] ) ){
			$sticky_logo = $sticky_logo['image'];
			$sticky_logo_id = isset( $sticky_logo['id'] ) ? $sticky_logo['id'] : '';
			if ( wp_attachment_is_image( $sticky_logo_id ) ) {
				$sticky_logo_url = isset( $sticky_logo['url'] ) ? wp_get_attachment_url( $sticky_logo_id ) : '';
				$site_title = get_bloginfo( 'name' );
				?>
				<a class="site-link sticky-logo-link" href="<?php echo esc_url( get_home_url( null, '/' ) ); ?>"><img class="img-fluid sticky-logo" src="<?php echo esc_url( $sticky_logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>" /></a>
				<?php
			}else{
				briddge_wp_framework::briddge_site_logo(true);
			}
		}
	}

	public static function briddge_basic_logo( $args = array(), $head_tag = 'h1' ) {
		$site_title = get_bloginfo( 'name' );
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$sticky_logo_id = get_theme_mod( 'sticky_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		
		$contents   = '';
		$classname  = '';
		//$page_title_opts = briddge_wp_elements::briddge_options( 'page-title-enable' );
		$current = '';
		
		if( is_page() ) $current = 'page';
		elseif( is_home() ) $current = 'blog';
		elseif( is_singular( 'post' ) ) $current = 'single';
		elseif( is_post_type_archive() && !is_post_type_archive( 'post' ) ) $current = 'custom-archive';
		elseif( is_singular() && !is_singular( 'post' ) ) $current = 'custom-single';
		else $current = 'archive';
		
		$opt_stat = false;
		/*if( isset( $page_title_opts[$current] ) && is_array( $page_title_opts[$current] ) ){
			$pages_arr = $page_title_opts[$current];
			$current_page_id = get_the_ID();
			if( isset( $pages_arr['include'] ) && !empty( $pages_arr['include'] ) ){
				$opt_stat = in_array( $current_page_id, $pages_arr['include'] );
			}elseif( isset( $pages_arr['exclude'] ) && !empty( $pages_arr['exclude'] ) ){
				$opt_stat = !in_array( $current_page_id, $pages_arr['exclude'] );
			}else{
				$opt_stat = true;
			}			
		}else{
			$opt_stat = in_array( $current, $page_title_opts );
		}*/

		$defaults = array(
			'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
			'logo_class'  => 'site-logo',
			'title'       => '<a href="%1$s">%2$s</a>',
			'title_class' => 'site-title',
			'with_heading'   => '<'. esc_attr( $head_tag ) .' class="%1$s">%2$s</'. esc_attr( $head_tag ) .'>',
			'without_heading' => '<div class="%1$s inline-heading">%2$s</div>',
			'condition'   => !$opt_stat //( is_front_page() || is_home() ) && ! is_page(),
		);
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'briddge_site_logo_args', $args, $defaults );
		if ( has_custom_logo() ) {
			$logo = '<a href="'. esc_url( get_home_url( null, '/' ) ) .'" class="default-logo test"><img src="'. esc_url( $image[0] ) .'" alt="'. esc_attr( $site_title ) .'" /></a>';
			$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
			$classname = $args['logo_class'];
		} else {
			$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
			$classname = $args['title_class'];
		}
		$wrap = $args['condition'] ? 'with_heading' : 'without_heading';
		$html = sprintf( $args[ $wrap ], $classname, $contents );
		echo apply_filters( 'briddge_site_logo', $html, $args, $classname, $contents );
	}

	public static function briddge_site_description() { //briddge_wp_framework::briddge_site_description()
		$logo_keys = array(
			'chk' => 'logo-chk',
			'fields' => array(
				'logo_desc' => 'site-logo-desc'
			)			
		);
		$logo_values = briddge_wp_elements::briddge_get_meta_and_option_values( $logo_keys );
		extract( $logo_values );
		
		if( isset( $logo_desc ) && $logo_desc ){
			$description = get_bloginfo( 'description' );
			if ( ! $description ) {
				return;
			}
			$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';
			$html = sprintf( $wrapper, esc_html( $description ) );
			echo apply_filters( 'briddge_site_description', $html, $description, $wrapper );
		}
	}

	public static function briddge_get_the_terms_as_out( $post_id, $term_slug ){ //briddge_wp_framework::briddge_get_the_terms_as_out
		$terms = get_the_terms( $post_id, $term_slug );                         
		if ( $terms && ! is_wp_error( $terms ) ) :							 
		    foreach ( $terms as $term ) {
		    	$term_link = get_term_link( $term );
		    	if ( !is_wp_error( $term_link ) ) { ?>
		        	<a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $term->name ); ?></a>
				<?php
		        }
		    }								 
		endif;
	}

	public static function briddge_get_post_date_as_link(){ //briddge_wp_framework::briddge_get_post_date_as_link
		$archive_year  = get_the_time('Y');
		$archive_month = get_the_time('m'); 
		$archive_day   = get_the_time('d');
		echo '<span class="bi bi-calendar3"></span>';
		echo '<a href="'. esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) .'" ><time>'. get_the_time( get_option('date_format') ) .'</time></a>';
	}

	public static function briddge_get_post_author(){ //briddge_wp_framework::briddge_get_post_author
		echo '<span class="bi bi-person"></span>';
		echo '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>';
	}

	public static function briddge_get_post_comment_count(){ //briddge_wp_framework::briddge_get_post_comment_count
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="bi bi-chat-left-dots"></span> ';
			comments_popup_link( esc_html__( 'No Comments', 'briddge' ), esc_html__( '1 Comment', 'briddge' ), esc_html__( '%s Comments', 'briddge' ) );
		}
	}
	
	public static function briddge_email_link( $email, $target = '_self' ){ 
		if( $email )
		echo '<a href="mailto:'. esc_attr( $email ) .'" class="email-link" target="'. esc_attr( $target ) .'">'. esc_html( $email ) .'</a>';
	}
	
	public static function briddge_address( $address ){ 
		if( $address ){
			echo '<address>'. nl2br( $address ) .'</address>';
		}
	}

	public static function briddge_search_form(){ 
		ob_start();	
	?>
		<form role="search" class="form-inline search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="input-group">
				<input class="form-control" type="text" placeholder="<?php esc_attr_e( 'Search', 'briddge' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
				<span class="input-group-btn">
					<button class="btn btn-outline-success" type="submit"><span class="bi bi-search"></span></button>
				</span>
			</div>
		</form>
	<?php	
		return ob_get_clean();
	}
	
	public static function briddge_fullbar_search_form(){ ?>
		<div class="full-bar-search-wrap">
			<?php get_search_form(); ?>
			<a href="#" class="close full-bar-search-toggle"></a>
		</div>
	<?php
	}
	
	public static function briddge_overlay_search_form(){
	?>
		<div class="full-search-wrapper">
			<a class="full-search-toggle close" href="#"></a>
			<?php get_search_form(); ?>
		</div>
	<?php
	}
	
	public static function briddge_textbox_search_form(){
	?>		
		<div class="textbox-search-wrap">
			<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="input-group">
					<input name="s" type="text" class="form-control" value="<?php echo get_search_query(); ?>" placeholder="<?php echo apply_filters( 'briddge_search_placeholder', esc_attr__( 'Search and hit enter..', 'briddge' ) ); ?>">
				</div>
			</form>
		</div>		
	<?php
	}
	
	public static function briddge_search_modal( $serach_opt, $part = 'navbar' ){
		switch( $serach_opt ){
		
			case '1': ?>
				<a class="full-search-toggle" href="#"><i class="bi bi-search"></i></a>
			<?php
				add_action( 'briddge_footer_after', array( 'briddge_wp_framework', 'briddge_overlay_search_form' ), 10 );
			break;
			
			case '2': 
				self::briddge_textbox_search_form();
			?>				
				<a class="textbox-search-toggle" href="#"><i class="bi bi-search"></i></a>
			<?php
			break;
			
			case '3': ?>
				<a class="full-bar-search-toggle" href="#"><i class="bi bi-search"></i></a>
			<?php
				add_action( 'briddge_'. esc_attr( $part ) .'_after', array( 'briddge_wp_framework' , "briddge_fullbar_search_form" ) , 10 );
			break;
			
			case '4': ?>
				<a class="bottom-search-toggle" href="#"><i class="bi bi-search"></i></a>
				<div class="bottom-search-wrap">
					<?php get_search_form(); ?>
				</div>
			<?php
			break;
			
			default:
				 get_search_form();
			break; 
			
		}
	}

	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
briddge_wp_framework::get_instance();