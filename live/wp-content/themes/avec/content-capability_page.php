<?php
/**
 * The default template for displaying capability_page content
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0710
 */
?>

		<!--// CONTENT //-->
		<div id="capability-page-content-container" class="content-container">

			<!--// OVERVIEW //-->
			<div id="capability-overview" class="overview" >
				<?php 
					$q_object = get_queried_object();
					//var_dump($q_object); 
					the_content(); 
				?>
			</div>
	
			<!--// GRID //-->
			<div id="capability-grid" class="grid">
		
				<?php  // GET PROJECT INFO
					$projects = get_post_meta( get_the_ID(), 'capability_projects');
					$images_script = '<script type=\'text/javascript\'> var display_images = {';
					foreach( $projects[0] as $project_id ): 
						$project = get_post($project_id);
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
						$off_image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'xsmall' );
						$off_image_large = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), $display_size );
						if ($off_image) {
							$images_script .= '"off-image-' . $project->ID . '":"' . $off_image_large[0] . '", '; 
						}
				?>
				<a href="<?php echo get_permalink( $project->ID ); ?>" target="_blank" >
					<div class="grid-element <?php echo rtrim( $term_class, ' ' ); ?>">
						<div class="grid-image scroll_load" id="off-image-<?php echo $project->ID;?>" style="background-image:url('<?php echo $off_image[0]; ?>');" >
							<div class="module-foreground-rollover" style="background: #<?php echo get_post_meta( $project->ID, 'color_space', true); ?>;" >
								<h2><?php echo get_the_title( $project->ID ); ?></h2>
								<!--h5><?php foreach( wp_get_post_terms( $project->ID, 'discipline' ) as $discipline) { $disciplines .= $discipline->name. ', '; } echo rtrim($disciplines, ', '); ?></h5-->
							</div>
						</div>
					</div>
				</a>
				<?php 
					endforeach;
					echo rtrim($images_script, ", ") . '}; </script>';
				?>
				<br class="clearfix" />
			</div>

		</div>
	

