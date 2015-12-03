<?php
/**
 * Template Name: Modules Gallery
 *
 * Description: The template for displaying the modules gallery
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0710
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="landing-content-wrapper" class="content-wrapper">		
			<div id="landing-content-container" class="content-container">		
		
					
				<!--// GALLERY //-->
				<div id="landing-masonry-wrapper" class="masonry-wrapper">
					<?php // GET MODULE INFO
						$images_script = '<script type=\'text/javascript\'> var display_images = {';
						$modules = get_posts( array( 'showposts' => -1, 'post_type' => 'homepage_module', 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
						foreach ( $modules as $module ) : 
							$block = get_post( get_post_meta( $module->ID, 'module_id', true) );
							//var_dump($block);
							if ( $block->post_status == 'publish' ) :
						
								$disciplines = '';
								$display_size;
								if ( $GLOBALS['device_type'] == 'mobile' ) {
									$display_size = 'medium';
								} else if (
										get_post_meta( $module->ID, 'module_size', true) == "post" ||
										get_post_meta( $module->ID, 'module_size', true) == "single-small" 
									) {
									$display_size = 'small';
								} else if (
										get_post_meta( $module->ID, 'module_size', true) == "single-medium" ||
										get_post_meta( $module->ID, 'module_size', true) == "dual-medium" 
									) {
									$display_size = 'medium';
								} else if (
										get_post_meta( $module->ID, 'module_size', true) == "single-large" ||
										get_post_meta( $module->ID, 'module_size', true) == "dual-large" 
									) {
									$display_size = 'large';
								}
						
						
								$block_link = false;
								if ( $block->post_content && $block->post_content != '' ) { $block_link = get_permalink( get_post_meta( $module->ID, 'module_id', true) ); }
								if ( get_post_meta( $block->ID, 'external_link', true ) ) { $block_link = get_post_meta( $block->ID, 'external_link', true ); }
					?>
				
					<div class="masonry-block module-<?php echo get_post_meta( $module->ID, 'module_size', true); ?> <?php echo get_post_meta( $module->ID, 'module_rollover', true); ?>">
						<?php if ( $block_link ) : ?><a href="<?php echo $block_link; ?>"><?php endif; ?>
					
						<?php // TEXT ONLY MODULE
							if (  get_post_meta( $module->ID, 'module_size', true) == 'post' ) : ?>
						<h5 class="text-module-head">News</h5> 
						<svg class="medium-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg>
						<p><?php echo get_the_title( get_post_meta( $module->ID, 'module_id', true) ); ?></p>
					
						<?php else: // SINGLE IMAGE MODULE 
						?>
						<div class="module-foreground-image">
							<div class="module-foreground-rollover" style="background: #<?php echo get_post_meta( get_post_meta( $module->ID, 'module_id', true), 'color_space', true); ?>;" >
								<h3><?php echo get_the_title( get_post_meta( $module->ID, 'module_id', true) ); ?></h3>
								<h5 class="module-disciplines"><?php foreach( wp_get_post_terms( get_post_meta( $module->ID, 'module_id', true), 'discipline' ) as $discipline) { $disciplines .= $discipline->name. ', '; } echo rtrim($disciplines, ', '); ?></h5>
							</div>
							<img id="foreground-image-<?php echo get_post_meta( $module->ID, 'module_id', true); ?>" class="scroll_load" src="<?php if ( class_exists('MultiPostThumbnails') ) echo MultiPostThumbnails::get_post_thumbnail_url('project', 'foreground-rollover-image', get_post_meta( $module->ID, 'module_id', true), 'xsmall');  ?>" />
							<?php $images_script .= '"foreground-image-' . get_post_meta( $module->ID, 'module_id', true) . '":"' . MultiPostThumbnails::get_post_thumbnail_url('project', 'foreground-rollover-image', get_post_meta( $module->ID, 'module_id', true), $display_size) . '", '; ?>
						</div>
						<?php endif; ?>
							
						<?php // ADD DUAL IMAGE IF APPROPRIATE
							if (  get_post_meta( $module->ID, 'module_size', true) == 'dual-small' || get_post_meta( $module->ID, 'module_size', true) == 'dual-medium' || get_post_meta( $module->ID, 'module_size', true) == 'dual-large' ) : ?>
						<div class="module-background-image">
							<img id="background-image-<?php echo get_post_meta( $module->ID, 'module_id', true); ?>" class="scroll_load" src="<?php if ( class_exists('MultiPostThumbnails') ) echo MultiPostThumbnails::get_post_thumbnail_url('project', 'background-rollover-image', get_post_meta( $module->ID, 'module_id', true), 'xsmall');  ?>" />
							<?php $images_script .= '"background-image-' . get_post_meta( $module->ID, 'module_id', true) . '":"' . MultiPostThumbnails::get_post_thumbnail_url('project', 'background-rollover-image', get_post_meta( $module->ID, 'module_id', true), $display_size) . '", '; ?>
						</div>
						<?php endif; ?>
						
						<?php if ( $block_link ) : ?></a><?php endif; ?>
					</div>
					
					<?php 
							endif;
						endforeach; 
						echo rtrim($images_script, ", ") . '}; </script>';
					?>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />

			</div>
				
<?php get_footer(); ?>
