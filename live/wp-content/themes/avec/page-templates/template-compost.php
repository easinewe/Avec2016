<?php
/**
 * Template Name: Compost Gallery
 *
 * Description: The template for displaying the compost gallery
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0721
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
				<div id="compost-masonry-wrapper" class="masonry-wrapper" style="min-height:1000px;">
				</div>
					<?php echo DEVONA_rewriteArray( get_post_meta( get_the_ID(), 'compost_gallery', true) );?>
			</center>
			<?php endwhile; ?>
		<?php endif; ?>

		</div>
				
				
<?php get_footer(); ?>
