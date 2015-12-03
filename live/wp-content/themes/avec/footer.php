<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0606
 */
?>

		<?php if ( get_post_type( get_queried_object_id() ) == 'project' || get_post_type( get_queried_object_id() ) == 'post' ) : ?>
		<?php 
			$current_post_id = get_the_ID(); 
			$cntr = 1;
			$taonomy_term = ( get_post_type( get_queried_object_id() ) == 'project' )? 'discipline': 'category';
			$tax_terms = array();
			foreach( get_terms( array(  $taonomy_term ) ) as $discipline) : 
				$tax_terms[] = $discipline->slug;
			endforeach; 
			$projects = get_posts( 
				array(
    				'showposts' => -1, 
				    'post_type' => get_post_type( get_queried_object_id() ), 
				    'orderby' => 'menu_order',
				    'order' => 'asc',
				    'tax_query' => array(
				        array(
					        'taxonomy' => $taonomy_term, 
					        'field' => 'slug', 
					        'terms' => $tax_terms
					    )
   					 )
				)
			);
			if ( get_post_type( get_queried_object_id() ) == 'post' ) {
				foreach ( $projects as $project ) : 
					if ( 
							$project->post_content && 
							$project->post_content != '' && 
							!get_post_meta( $project->ID, 'external_link', true) 
						){
						$projects_to_count[] = $project;
					} 
				endforeach;
			} else {
				$projects_to_count = $projects;
			}
			//var_dump($projects_to_count);
			
			foreach ( $projects_to_count as $project_to_count ) : 
				$posarray[$cntr] = $project_to_count->ID; 
				if ($posarray[$cntr] == $current_post_id) {
					$ppost_index = ($cntr > 1)? $cntr-1: count($projects_to_count);
					$cpost_index = $cntr;
					$npost_index = ($cntr < count($projects_to_count))? $cntr+1: 1;
				}
				$cntr++;
			endforeach;
			
			// REORDER IF ONLY TWO PROJECTS
			if (!isset($posarray[$ppost_index]) ) { $posarray[$ppost_index] = $posarray[$npost_index]; }
			if (!isset($posarray[$npost_index]) ) { $posarray[$npost_index] = $posarray[$ppost_index]; }
		?>
			
		<!--// BOTTOM NAV //-->
		<nav id="bottom-nav" >
			<?php if ( isset($posarray[$ppost_index]) && isset($posarray[$npost_index]) && ($posarray[$ppost_index] != $posarray[$npost_index]) ): ?>
			<h5 id="bottom-nav-previous" class="bottom-nav-item"><a href="<?php echo get_permalink($posarray[$ppost_index]); ?>"><u>Previous<span class="page-type"> <?php echo get_post_type( get_queried_object_id() ); ?></span></u></a></h5>
			<h5 id="bottom-nav-top" class="bottom-nav-item"><a href="javascript:scrollToTop();"><u><span class="page-type">Back to </span>Top</u></a></h5>
			<h5 id="bottom-nav-next" class="bottom-nav-item"><a href="<?php echo get_permalink($posarray[$npost_index]); ?>"><u>Next<span class="page-type"> <?php echo get_post_type( get_queried_object_id() ); ?></span></u></a></h5>
			<?php endif ?>
			<br class="clearfix">
		</nav>
		<?php endif; ?>
	
	<?php if ( !$GLOBALS['landing'] ): ?>
	</div>
	<?php endif; ?>
	
	<!--// FOOTER //-->
	<footer id="site-footer" class="content-wrapper <?php echo ( $GLOBALS['white_page'] )? 'white': 'black'; ?>">
		<div id="footer-container" >

			<div id="get-column" class="footer-column">
				<h5>Get&nbsp;with&nbsp;us</h5>
				<ul>
					<li><a href="mailto:<?php echo get_option('company_email'); ?>;"><u><?php echo get_option('company_email'); ?></u></a></li>
					<li><?php echo get_option('company_phone'); ?></li>
					<?php 
						$map_link = 'https://www.google.com/maps/place/'.str_replace( ' ', '+', get_option('company_address').' '.get_option('company_city').' '.get_option('company_state').' '.get_option('company_zip'));
						/* //Phone Link
							<a href="tel:+<?php echo ltrim( str_replace(' ', '', get_option('company_phone') ), '+' ); ?>"><u></u></a>
							//Address Link
							<a href="<?php echo $map_link; ?>" target="_blank"><u></u></a> 
						*/
					?>
					<li>
						<?php echo get_option('company_address'); ?><br /><?php echo get_option('company_city'); ?>, <?php echo get_option('company_state'); ?> <?php echo get_option('company_zip'); ?>
					</li>
				</ul>
			</div>
			
			<div id="look-column" class="footer-column">
				<h5>Keep&nbsp;up&nbsp;with&nbsp;us</h5>
				
				<!-- Begin MailChimp Signup Form -->
				<div id="mc_embed_signup">
					<form action="http://avec.us8.list-manage.com/subscribe/post-json?u=b24b673ff8bf3c7bc7402d711&id=d3162252ca&c=?" method="get" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form">
						<div class="mc-field-group">
							<label for="mce-EMAIL" id="mce-label">Subscribe to our Newsletter</label>
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Enter email address">
							<hr id="mce-rule">
						</div>
						<div id="mce-responses"></div>    
						<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_b24b673ff8bf3c7bc7402d711_d3162252ca" tabindex="-1" value=""></div>
					    <div class="clear"><a href="javascript:{}" onclick="submitSubscription();" name="mc-embedded-subscribe" id="mc-embedded-subscribe"><u>Submit</u></a></div>
					    <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
					</form>
				</div>
			</div>
			
			<div id="work-column" class="footer-column">
				<h5>Work&nbsp;with&nbsp;us</h5>
				<ul>
					<li>Got what it takes?</li>
					<li><a href="mailto:<?php echo get_option('jobs_email'); ?>;"><u><?php echo get_option('jobs_email'); ?></u></a></li>
				</ul>
			</div>
			
			<div id="social-column" class="footer-column">
				<h5>#&nbsp;with&nbsp;us</h5>
				<ul>
				<?php if ( 
						get_option('facebook_url') ||
						get_option('twitter_url') ||
						get_option('pinterest_url') ||
						get_option('tumblr_url') ||
						get_option('google_url') 
					) : ?>
					<?php if ( get_option('facebook_url') ) : ?><li><a href="<?php echo get_option('facebook_url') ?>" target="_blank" ><u>Facebook</u></a></li><?php endif; ?>
					<?php if ( get_option('twitter_url') ) : ?><li><a href="<?php echo get_option('twitter_url') ?>" target="_blank" ><u>Twitter</u></a></li><?php endif; ?>
					<?php if ( get_option('pinterest_url') ) : ?><li><a href="<?php echo get_option('pinterest_url') ?>" target="_blank" ><u>Pinterest</u></a></li><?php endif; ?>
					<?php if ( get_option('tumblr_url') ) : ?><li><a href="<?php echo get_option('tumblr_url') ?>" target="_blank" ><u>Tumblr</u></a></li><?php endif; ?>
					<?php if ( get_option('google_url') ) : ?><li><a href="<?php echo get_option('google_url') ?>" target="_blank" ><u>Google+</u></a></li><?php endif; ?>
				<?php endif; ?>
				</ul>
			</div>
			<br class="clearfix">
			
		</div>
	</footer>
	
	<?php if ( $GLOBALS['landing'] ): ?>
	</div>
	</div>
	<?php endif; ?>
	
	<?php wp_footer(); ?>
</body>
</html>