<?php
/**
 * Template Name: News
 *
 * Description: The template for displaying the news page
 *
 * @package WordPress
 * @subpackage avec
 * @since ave 14.0710
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="news-content-container"  class="content-container">

			<!--// OVERVIEW //-->
			<div id="news-overview" class="overview" >
			<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						echo DEVONA_translate(get_the_content());
					endwhile;
				endif; 
			?>
			</div>
	
			<!--// GRID //-->
			<div id="news-grid" class="grid">
	
				<?php // GET POSTS INFO
					$posts = get_posts( array( 'showposts' => -1, 'post_type' => 'post' ) );
					$images_script = ' var display_images = {';
					$preload_script = 'var preloading_images = new Array(';
					foreach( $posts as $post ): //var_dump($post);
						$term_class = ''; 
						$term_list = wp_get_post_terms( $post->ID, 'category' ); 
						foreach ($term_list as $term ) { 
							$term_class .= $term->slug . ' '; 
						} 
						$link_to = false;
						if ( get_post_meta( $post->ID, 'external_link', true) || $post->post_content != '' ) {
							$link_to = ( get_post_meta( $post->ID, 'external_link', true) )? get_post_meta( $post->ID, 'external_link', true): get_permalink( $post->ID ); 
						}
						$display_size;
						if ( $GLOBALS['device_type'] == 'mobile' ) {
							$display_size = 'small';
						} else {
							$display_size = 'small';
						}
						$off_image = false;
						$off_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'xsmall' );
						$off_image_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $display_size );
						if ($off_image) {
							$images_script .= '"off-image-' . $post->ID . '":"' . $off_image_large[0] . '", '; 
						}
						$over_image = false;
						$over_image = MultiPostThumbnails::get_post_thumbnail_url('post', 'rollover-image', $post->ID, $display_size );
						if ($over_image) {
							$preload_script .= "'".$over_image."',";
							//$images_script .= '"over-image-' . $post->ID . '":"' . $over_image . '", ';  
						}
					
						
				?>
				<div class="grid-element <?php echo rtrim( $term_class, ' ' ); ?>">
					<?php if ( $link_to ) : ?><a href="<?php echo $link_to; ?>" class="grid-link"><?php endif; ?>
						<div class="grid-image scroll_load" id="off-image-<?php echo $post->ID;?>" style="background-image:url('<?php echo $off_image[0]; ?>');" onmouseover="swapBackground(this,'<?php echo $over_image; ?>');" onmouseout="swapBackground(this,'<?php echo $off_image_large[0]; ?>');"></div>
						<p><b><?php $bev = get_the_category( $post->ID ); echo $bev[0]->name;  ?> / </b><?php echo $post->post_title; ?></p>
					<?php  if ( $link_to ) : ?></a><?php endif; ?>
				</div>
				<?php 
					endforeach; 
					echo '<script type=\'text/javascript\'> ' . rtrim($preload_script,','). '); ' . rtrim($images_script, ", ") . '}; </script>';
				?>
				<br class="clearfix" />
			</div>
			
		</div>
	
<?php get_footer(); ?>