<?php
/**
 * Template Name: Compost Gallery
 *
 * Description: The template for displaying the compost gallery
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0703
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="compost-content-container"  class="content-container">
	
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<!--// OVERVIEW //-->
			<div id="compost-overview" class="overview" >
				<?php echo DEVONA_translate(get_the_content()); ?>
			</div>
			
			<center>

			<!--// GALLERY //-->
				<div id="compost-masonry-wrapper" class="masonry-wrapper">
					<?php echo DEVONA_rewriteGallery( get_post_meta( get_the_ID(), 'compost_gallery', true) );?>
					<br class="clearfix" />
				</div>
			</center>
			<?php endwhile; ?>
		<?php endif; ?>

		</div>
				
				
<?php get_footer(); ?>
