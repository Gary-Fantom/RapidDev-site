<?php
/**
 * The template for displaying all single portfolio
 *
 */

get_header(); 

$t = new CEACPTElements();
$team_sidebars = $t->ceaGetThemeOpt('cpt-team-sidebars');
$sidebar_class = array( '12', '8', '4' );
$sidebar_stat = false;
if( !empty( $team_sidebars ) && is_active_sidebar( $team_sidebars ) ){
	$sidebar_stat = true;
}

?>

<div class="wrap cea-content">

	<?php do_action( 'cea_team_before_content' ); ?>

	<div class="team-content-area">
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr( $sidebar_stat ? $sidebar_class[1] : $sidebar_class[0] ); ?>">
					<?php
					$t = new CEACPTElements();
					$title_opt = $t->ceaGetThemeOpt('team-title-opt');
					
					while ( have_posts() ) : the_post();
					?>
						
						<div class="row team">
						
							<?php if( has_post_thumbnail( get_the_ID() ) ): ?>
							<div class="col-sm-5 team-image-wrap">
								<div class="team-img">
									<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
								</div>
							</div> <!-- .team-content-wrap -->
							<?php endif; // if thumb exists ?>
							
							<div class="col-sm-7 team-info">
								<div class="team-title">
									<?php if( $title_opt ) : ?>
										<h2><?php the_title(); ?></h2>
									<?php endif; // desg exists ?>
									<?php
										$desg = get_post_meta( get_the_ID(), 'cea_team_designation', true ); 
										if( $desg ):
									?>
									<div class="team-designation-wrap">
										<span class="team-designation"><?php echo esc_html( $desg ); ?></span>				
									</div><!-- .team-designation -->
									<?php endif; // desg exists ?>
									
									<?php
										$email = get_post_meta( get_the_ID(), 'cea_team_email', true ); 
										if( $email ):
									?>
									<div class="team-email-wrap">
										<span class="team-email"><?php echo esc_html( $email ); ?></span>				
									</div><!-- .team-email-wrap -->
									<?php endif; // desg exists ?>
									
								</div><!-- .team-title -->
								<div class="team-social-wrap">
									<ul class="nav social-icons team-social">
										<?php
										
											$taget = get_post_meta( get_the_ID(), 'cea_team_link_target', true );
										
											$social_media = array( 
												'social-fb' => 'fa fa-facebook', 
												'social-twitter' => 'fa fa-twitter', 
												'social-instagram' => 'fa fa-instagram',
												'social-linkedin' => 'fa fa-linkedin', 
												'social-pinterest' => 'fa fa-pinterest-p', 
												'social-gplus' => 'fa fa-google-plus',  
												'social-youtube' => 'fa fa-youtube-play', 
												'social-vimeo' => 'fa fa-vimeo',
												'social-flickr' => 'fa fa-flickr', 
												'social-dribbble' => 'fa fa-dribbble'
											);
											
											$social_opt = array(
												'social-fb' => 'cea_team_facebook', 
												'social-twitter' => 'cea_team_twitter',
												'social-instagram' => 'cea_team_instagram',
												'social-linkedin' => 'cea_team_linkedin',
												'social-pinterest' => 'cea_team_pinterest',
												'social-gplus' => 'cea_team_gplus',
												'social-youtube' => 'cea_team_youtube',
												'social-vimeo' => 'cea_team_vimeo',
												'social-flickr' => 'cea_team_flickr',
												'social-dribbble' => 'cea_team_dribbble',
											);
										
										
											// Actived social icons from theme option output generate via loop
											foreach( $social_media as $key => $class ){
					
												$social_url = get_post_meta( get_the_ID(), $social_opt[$key], true );
												if( $social_url ): ?>
													<li>
														<a class="<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( $social_url ); ?>" target="<?php echo esc_attr( $taget ); ?>">
															<i class="<?php echo esc_attr( $class ); ?>"></i>
														</a>
													</li>
												<?php
												endif;
					
											}
										?>
									</ul>
								</div> <!-- .team-social-wrap -->
								
							</div> <!-- .team-info --> 
							
						</div> <!-- .team -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="team-content-wrap">
									<?php the_content(); ?>
								</div><!-- .team-content-wrap -->
								
								<?php $t->ceaCPTNav(); ?>
								
							</div><!-- .col -->
						</div><!-- .row -->
					
					<?php
					endwhile; // End of the loop.
					?>
				</div><!-- .col -->
				
				<?php if( $sidebar_stat ): ?>
				<div class="col-md-<?php echo esc_attr( $sidebar_class[2] ); ?>">
				<aside class="sidebar-widget widget-area">
					<?php dynamic_sidebar( $team_sidebars ); ?>
				</aside><!-- #secondary -->
				</div><!-- .col -->
				<?php endif; ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .team-content-area -->
	
	<?php do_action( 'cea_team_after_content' ); ?>
	
</div><!-- .wrap -->

<?php
get_footer();