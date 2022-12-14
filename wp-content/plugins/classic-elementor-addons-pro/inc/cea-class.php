<?php
class CEAPostElements {

	function ceaWpBootstrapPagination( $args = array(), $max = '', $print = true ) {
    
		$defaults = array(
			'range'           => 4,
			'custom_query'    => false,
			'first_string' => esc_html__( 'First', 'cea' ),
			'previous_string' => esc_html__( 'Prev', 'cea' ),
			'next_string'     => esc_html__( 'Next', 'cea' ),
			'last_string'     => esc_html__( 'Last', 'cea' ),
			'before_output'   => '<div class="post-pagination-wrap"><ul class="nav pagination post-pagination justify-content-center">',
			'after_output'    => '</ul></div>'
		);
		
		$args = wp_parse_args( 
			$args, 
			apply_filters( 'cea_wp_bootstrap_pagination_defaults', $defaults )
		);
		
		$args['range'] = (int) $args['range'] - 1;
		if ( !$args['custom_query'] ){
			$args['custom_query'] = $GLOBALS['wp_query'];
		}
		$count = (int) $args['custom_query']->max_num_pages;
		$count = absint( $count ) ? absint( $count ) : (int) $max;
		
		$page = 1;
		if( get_query_var('paged') ){
			$page = intval( get_query_var('paged') );
		}elseif( get_query_var('page') ){
			$page = intval( get_query_var('page') );
		}
		
		$ceil  = ceil( $args['range'] / 2 );
		
		if ( $count <= 1 )
			return FALSE;
		
		if ( !$page )
			$page = 1;
		
		if ( $count > $args['range'] ) {
			if ( $page <= $args['range'] ) {
				$min = 1;
				$max = $args['range'] + 1;
			} elseif ( $page >= ($count - $ceil) ) {
				$min = $count - $args['range'];
				$max = $count;
			} elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
				$min = $page - $ceil;
				$max = $page + $ceil;
			}
		} else {
			$min = 1;
			$max = $count;
		}
		
		$echo = '';
		$previous = intval($page) - 1;
		$previous = esc_attr( get_pagenum_link($previous) );
		
		// For theme check
		$t_next_post_link = get_next_posts_link();
		$t_prev_post_link = get_previous_posts_link();
		
		$firstpage = esc_attr( get_pagenum_link(1) );
		if ( $firstpage && (1 != $page) && isset( $args['first_string'] ) && $args['first_string'] != '' )
			$echo .= '<li class="nav-item previous"><a href="' . $firstpage . '" title="' . esc_attr__( 'First', 'cea') . '">' . $args['first_string'] . '</a></li>';
		if ( $previous && (1 != $page) )
			$echo .= '<li class="nav-item"><a href="' . $previous . '" title="' . esc_attr__( 'previous', 'cea') . '">' . $args['previous_string'] . '</a></li>';
		
		if ( !empty($min) && !empty($max) ) {
			for( $i = $min; $i <= $max; $i++ ) {
				if ($page == $i) {
					$echo .= '<li class="nav-item active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
				} else {
					$echo .= sprintf( '<li class="nav-item"><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
				}
			}
		}
		
		$next = intval($page) + 1;
		$next = esc_attr( get_pagenum_link($next) );
		if ($next && ($count != $page) )
			$echo .= '<li class="nav-item"><a href="' . $next . '" class="next-page" title="' . esc_attr__( 'next', 'cea') . '">' . $args['next_string'] . '</a></li>';
		
		$lastpage = esc_attr( get_pagenum_link($count) );
		if ( $lastpage && isset( $args['last_string'] ) && $args['last_string'] != '' ) {
			$echo .= '<li class="nav-item next"><a href="' . $lastpage . '" title="' . esc_attr__( 'Last', 'cea') . '">' . $args['last_string'] . '</a></li>';
		}
		if ( isset($echo) && $print ){
			echo ( '' . $args['before_output'] . $echo . $args['after_output'] );
		}else{
			return $args['before_output'] . $echo . $args['after_output'];
		}
	}
	
	function ceaBreadcrumbs() {
	 
	  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	  $delimiter = ''; // delimiter between crumbs
	  $home = esc_html__('Home', 'cea'); // text for the 'Home' link
	  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before = '<span class="current">'; // tag before the current crumb
	  $after = '</span>'; // tag after the current crumb
	 
	  global $post;
	  $homeLink = home_url( '/' );
	  echo '<div id="breadcrumb" class="breadcrumb">';
	
	  if (is_home() || is_front_page()) {
		
		if ($showOnHome == 1) echo wp_kses_post( $before . $home . $after );//'<a href="' . $homeLink . '">' . $home . '</a>';
	 
	  } else {
	
		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	 
		if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			
			$post_type = get_post_type_object(get_post_type());
			if( $post_type ){
				echo wp_kses_post( $before . $post_type->labels->singular_name . $after );
			}else{
				$queried_object = get_queried_object();
				if( $queried_object )
				echo wp_kses_post( $before . $queried_object->name . $after );
			}
			
	 
		} elseif ( is_category() ) {
		  $thisCat = get_category(get_query_var('cat'), false);
		  if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
		  echo wp_kses_post( $before . single_cat_title('', false) . $after );
	 
		} elseif ( is_search() ) {
		  echo wp_kses_post( $before . get_search_query() . $after );
	 
		} elseif ( is_day() ) {
		  echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		  echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		  echo wp_kses_post( $before . get_the_time('d') . $after );
	 
		} elseif ( is_month() ) {
		  echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		  echo wp_kses_post( $before . get_the_time('F') . $after );
	 
		} elseif ( is_year() ) {
		  echo wp_kses_post( $before . get_the_time('Y') . $after );
	 
		} elseif ( is_single() && !is_attachment() ) {
		  if ( get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		  } else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			echo wp_kses_post( $cats );
			if ($showCurrent == 1) echo wp_kses_post( $before . get_the_title() . $after );
		  }
	 
		} elseif ( is_attachment() ) {
		  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;	 
		} elseif ( is_page() && !$post->post_parent ) {
		  if ($showCurrent == 1) echo wp_kses_post( $before . get_the_title() . $after );
	 
		} elseif ( is_page() && $post->post_parent ) {
		  $parent_id  = $post->post_parent;
		  $breadcrumbs = array();
		  while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		  }
		  $breadcrumbs = array_reverse($breadcrumbs);
		  for ($i = 0; $i < count($breadcrumbs); $i++) {
			echo wp_kses_post( $breadcrumbs[$i] );
			if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
		  }
		  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	 
		} elseif ( is_tag() ) {
		  echo wp_kses_post( $before . single_tag_title('', false) . $after );
	 
		} elseif ( is_author() ) {
		   global $author;
		  $userdata = get_userdata($author);
		  echo wp_kses_post( $before . esc_html__('Posts by ', 'cea') . $userdata->display_name . $after );
	 
		} elseif ( is_404() ) {
		  echo wp_kses_post( $before . esc_html__('Error 404', 'cea') . $after );
		}
	 
		if ( get_query_var('paged') ) {
		  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		  echo esc_html__('Page', 'cea') . ' ' . get_query_var('paged');
		  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
	  }
	  echo '</div>';
	} 
	
}