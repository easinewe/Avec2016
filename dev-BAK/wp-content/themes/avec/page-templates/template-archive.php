<?php
/**
 * Template Name: Archive
 *
 * Description: The template for displaying the archive page
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0710
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="archive-content-container" class="content-container">

			<!--// OVERVIEW //-->
			<div id="archive-overview" class="overview" >
			<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						echo DEVONA_translate(get_the_content());
					endwhile;
				endif; 
			?>
			</div>
	
			<!--// GRID //-->
			<div id="archive-grid" class="grid">
		
				<?php  // GET PROJECT INFO
					$tax_terms = array();
					foreach( get_terms( array(  'discipline' ) ) as $discipline) : 
						$tax_terms[] = $discipline->slug;
					endforeach; 
					$projects = get_posts( array( 'showposts' => -1, 'post_type' => 'project', 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_key' => 'project_archived', 'meta_value' => '1', 'tax_query' => array( array( 'taxonomy' => 'discipline', 'field' => 'slug', 'terms' => $tax_terms ) ) ) );
					$images_script = '<script type=\'text/javascript\'> var display_images = {';
					foreach( $projects as $project ): 
						$term_class = ''; 
						$disciplines = '';
						$term_list = wp_get_post_terms( $project->ID, 'discipline' ); 
						foreach ($term_list as $term ) { 
							$term_class .= $term->slug . ' '; 
						} 
						$display_size;
						if ( $GLOBALS['device_type'] == 'mobile' ) {
							$display_size = 'small';
						} else {
							$display_size = 'medium';
						}
						$off_image = false;
						$off_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'xsmall' );
						$off_image_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $display_size );
						if ($off_image) {
							$images_script .= '"off-image-' . $post->ID . '":"' . $off_image_large[0] . '", '; 
						}
				?>
				<div class="grid-element <?php echo rtrim( $term_class, ' ' ); ?>">
					<a href="<?php echo get_permalink( $project->ID ); ?>" >
						<div class="grid-image scroll_load" id="off-image-<?php echo $post->ID;?>" style="background-image:url('<?php echo $off_image[0]; ?>');" >
							<div class="module-foreground-rollover" style="background: #<?php echo get_post_meta( $project->ID, 'color_space', true); ?>;" >
								<h2><?php echo get_the_title( $project->ID ); ?></h2>
								<!--h5><?php foreach( wp_get_post_terms( $project->ID, 'discipline' ) as $discipline) { $disciplines .= $discipline->name. ', '; } echo rtrim($disciplines, ', '); ?></h5-->
							</div>
						</div>
					</a>
				</div>
				<?php 
					endforeach; 
					echo rtrim($images_script, ", ") . '}; </script>';
				?>
				<br class="clearfix" />
			</div>

		</div>
	
<?php get_footer(); ?>