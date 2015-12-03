<?php
/**
 * The default template for displaying project content
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0722
 */
?>
		<!--// CAROUSEL //-->
		<div id="carousel">
			<p id="carousel-info"><span id="carousel-paging"><span id="carousel-image-index"></span> / <span id="carousel-image-count"></span> </span><span id="carousel-caption"></span></p>
			<svg id="carousel-close" x="0px" y="0px" viewBox="0 0 17.201 17.201" enable-background="new 0 0 17.201 17.201" xml:space="preserve">
				<polygon points="17.201,14.949 10.853,8.599 17.2,2.251 14.948,0 8.601,6.347 2.253,0 0.001,2.251 6.349,8.599 0,14.949 2.252,17.201 8.601,10.851 14.949,17.201 "/>
			</svg>
			<div id="carousel-container" class="content-container">
				<div id="carousel-window"></div>
				<a id="carousel-left" >
					<svg id="carousel-previous" class="carousel-arrow" x="0px" y="0px" viewBox="-13.689 2.196 17.201 29.89" enable-background="new -13.689 2.196 17.201 29.89" xml:space="preserve">
						<polygon points="-13.689,17.144 1.259,32.086 3.511,29.835 -9.183,17.139 3.512,4.448 1.26,2.196 -13.689,17.136 -13.686,17.14 "/>
					</svg>
				</a>
				<a id="carousel-right" >
					<svg id="carousel-next" class="carousel-arrow" x="0px" y="0px" viewBox="-13.689 2.196 17.201 29.89" enable-background="new -13.689 2.196 17.201 29.89" xml:space="preserve">
						<polygon points="3.512,17.138 -11.437,2.196 -13.688,4.447 -0.995,17.143 -13.689,29.834 -11.438,32.086 3.512,17.146 3.508,17.142 "/>
					</svg>
				</a>
			</div>
		</div>
	
		<!--// CONTENT //-->
		<div id="project-content-container" class="content-container">
			<div id="project-hero" class="hero" >
				<div id="title-box" style="background-color:<?php echo ( get_post_meta( get_the_ID(), 'color_space', true) )? '#' . ltrim(get_post_meta( get_the_ID(), 'color_space', true), '#'): '#000000'; ?>;">
					<h1><?php the_title(); ?></h1>
					<h5 id="disciplines"><?php foreach( wp_get_post_terms( get_the_ID(), 'discipline' ) as $discipline) { $disciplines .= $discipline->name. ', '; } echo rtrim($disciplines, ', '); ?></h5>
					<div id="gif-loader" style="background-image:url('<?php echo get_template_directory_uri(); ?>/images/loader.gif');"></div>
				</div>
				<?php if ( get_post_meta( get_post_thumbnail_id( ), '_carousel_image_field', true ) ) : $hero_image = get_post(get_post_thumbnail_id( )); ?>
				<script> carousel_images.push({"src":"<?php echo $hero_image->guid; ?>", "mtype":"<?php echo $hero_image->post_mime_type; ?>", "ptype":"<?php echo $hero_image->post_type; ?>", "caption":"<?php echo $hero_image->post_excerpt; ?>"}); </script> 
				<?php endif; ?>
				<img id="hero_image" class="big-unshifted" src="<?php $image_source = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'xlarge' ); echo $image_source[0]; ?>" <?php if ($hero_image) : ?>class="hot" onclick="callCarousel(<?php $GLOBALS['carousel_count']++; echo $GLOBALS['carousel_count']; ?>);"<?php endif; ?>  />
				<script type='text/javascript'> window.onload=function(){ jQuery('#image_load_holder').append('<img id="pre_hero_image" src="<?php $image_source = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'xlarge' ); echo $image_source[0]; ?>" >'); }; </script>
			</div>
		
			<!--// OVERVIEW //-->
			<div id="project-overview" class="overview">
				<div id="project-description">
					<?php the_content(); ?>
				</div>
				<div id="project-sharing">
					<h5>Share</h5>
					<ul>
						<li><a href="mailto:?Subject=<?php the_title(); ?>&body=<?php echo get_permalink( get_the_ID() ); ?>"><u>Email</u></a></li>
						<li><a href="https://twitter.com/share?url=<?php echo get_permalink( get_the_ID() ); ?>&text=<?php echo get_post_meta( get_the_ID(), 'meta_desc', true); ?>" target="_blank"><u>Twitter</u></a></li>
						<li><a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink( get_the_ID() ); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( ) ); ?>&description=<?php echo get_post_meta( get_the_ID(), 'meta_desc', true); ?>" target="_blank"><u>Pinterest</u></a></li>
					</ul>
				</div>
				<div id="project-deliverables">
					<?php if ( get_post_meta( get_the_ID(), 'project_services', true) ) : ?>
					<h5>Deliverables</h5>
					<ul>
					<?php
						$checked_deliverables = false;
						$services = get_posts( array( 'showposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => 'service' ) );
						foreach ($services as $service ) {
							if ( in_array($service->ID, get_post_meta( get_the_ID(), 'project_services', true) ) ) {
								$checked_deliverables[] = $service;
							}
						}
						foreach ( $checked_deliverables as $checked_deliverable ):
						 /*
						$checked_deliverables = get_the_terms(get_the_ID(), 'deliverable' );
						foreach ( $checked_deliverables as $checked_deliverable ):
						*/
					?>
						<li><?php echo $checked_deliverable->post_title; /* $checked_deliverable->name; */  ?></li>
					<?php endforeach;?>
					</ul>
					<?php endif; ?>
				</div>
				<br class="clearfix" />
			</div>
		
			<!--// GALLERY //-->
			<div id="project-masonry-wrapper" class="masonry-wrapper"></div>
			<?php echo DEVONA_rewriteArray( get_post_meta( get_the_ID(), 'project_gallery', true)  );?>
			<br class="clearfix"/>
		</div>


