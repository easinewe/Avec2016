<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0606
 */

?>
<?php get_header(); ?>

	<!--// OVERVIEW //-->
	<div id="page-overview" class="overview" >
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	</div>
	
<?php get_footer(); ?>
