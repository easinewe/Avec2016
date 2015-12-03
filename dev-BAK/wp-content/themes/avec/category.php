<?php
/**
 * The template for displaying Category pages
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0606
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="news-content-container"  class="content-container">

			<!--// OVERVIEW //-->
			<div id="news-overview" class="overview" >
				<?php $news_post = get_post(30); echo $news_post->post_content; ?>
			</div>
	
			<?php if ( have_posts() ) : ?>
			<!--// GRID //-->
			<div id="news-grid"  class="grid">
				<?php while ( have_posts() ) : the_post(); ?>
	
				<?php // GET POSTS INFO
						$link_to = false;
						if ( get_post_meta( $post->ID, 'external_link', true) || $post->post_content != '' ) {
							$link_to = ( get_post_meta( $post->ID, 'external_link', true) )? get_post_meta( $post->ID, 'external_link', true): get_permalink( $post->ID ); 
						}
				?>
				
				<?php if ( $link_to ) : ?><a href="<?php echo $link_to; ?>"><?php endif; ?>
					<div class="grid-element <?php echo rtrim( $term_class, ' ' ); ?>">
						<div class="grid-image" style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>');" onmouseover="swapBackground(this,'<?php echo MultiPostThumbnails::get_post_thumbnail_url('post', 'rollover-image', $post->ID ); ?>');" onmouseout="swapBackground(this,'<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>');"></div>
						<p><b><?php $bev = get_the_category( $post->ID ); echo $bev[0]->name;  ?> / </b><?php echo $post->post_title; ?></p>
					</div>
				<?php  if ( $link_to ) : ?></a><?php endif; ?>
				
				<?php endwhile; ?>
				<br class="clearfix" />
			</div>
			<?php endif; ?>
			
		</div>
	
<?php get_footer(); ?>