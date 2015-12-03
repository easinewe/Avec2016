<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0606
 */
?>

		<!--// CONTENT //-->
		<div class="content-container">
			<div id="content">
				<h2><?php the_title(); ?></h2>
				<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( ) ); ?>" />
				<?php the_content(); ?>
			</div>
		</div>


