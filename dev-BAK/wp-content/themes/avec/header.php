<?php
/**
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0710
 */
 
// GET NAV INFO
	$dumb_links = ''; foreach( get_option('hide_from_nav') as $key => $val)$dumb_links .= $val . ',';
	$pages = get_pages( array( 'sort_order' => 'desc', 'sort_column' => 'menu_order', 'post_type' => 'page', 'post_status' => 'publish', 'exclude'   => rtrim( $dumb_links,',') ) ); 
	$all_categories = get_categories( array( 'type' => 'post', 'child_of' => 0, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 1, 'hierarchical' => 1, 'taxonomy' => 'category', 'pad_counts' => false ) );
	foreach ( $all_categories as $category_object ) {
		$category_ids[] = $category_object->term_id; 
		$category_names[] = $category_object->slug; 
	}
	$post_categories = get_the_category($queried_object->ID);
	foreach ( $post_categories as $post_category_object ) {
		$queried_category_ids[] = $post_category_object->term_id; 
		$queried_category_names[] = $post_category_object->slug; 
	}
	$queried_object = get_queried_object();
	//var_dump($queried_object);
	
// GET SLASH VARIABLES
	$slashes = (is_category())? explode(",", get_post_meta( 30, 'between_slashes', true)): explode(",", get_post_meta( get_queried_object_id(), 'between_slashes', true));
	foreach ( $slashes as $slash => $slash_val  ) {
		if ( $slash_val != '' ) $between_the_slashes .= '" ' . $slash_val . ' ",';
	}

// GET OBJECT INFO
	$post = get_post(get_queried_object_id()); 
	$slug = $post->post_name; 
	
// GET GLOBALS
	$GLOBALS['landing'] = ( $slug == 'landing' )? true: false;
	$GLOBALS['white_page'] = (get_post_type( get_queried_object_id() ) == 'project' || get_post_type( get_queried_object_id() ) == 'capability_page' || $GLOBALS['landing']  || $slug == 'archives' || !$post)? true: false;
	$GLOBALS['carousel_count'] = -1;

	require_once 'inc/Mobile_Detect.php';
	$detect = new Mobile_Detect;
	$GLOBALS['device_type'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	



?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<title></title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="initial-scale=.5, minimum-scale=.5, maximum-scale=.5, width=device-width, height=device-height, target-densitydpi=device-dpi, minimal-ui" />
	
	<?php if ( get_option('meta_description') ||  get_post_meta( $post->ID, 'meta_desc', true) ) : ?>
	<meta name="description" content="<?php if ( get_post_meta( $post->ID, 'meta_desc', true) ) {
        echo get_post_meta( $post->ID, 'meta_desc', true);
    } else {
        echo get_option('meta_description');
    }
    ?>" />
    <?php endif ?>
	<?php if ( get_option('meta_keywords') || get_post_meta( $post->ID, 'meta_keys', true) ) : ?>
	<meta name="keywords" content="<?php if ( get_post_meta( $post->ID, 'meta_keys', true) ) {
        echo get_post_meta( $post->ID, 'meta_keys', true);
    } else {
        echo get_option('meta_keywords');
    }
    ?>" />
    <?php endif ?>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<?php wp_head(); ?>
	<style>
		.content-container{ max-width: <?php echo ( $GLOBALS['device_type']=='computer' )? get_option('max_width'): 10000; ?>px; }
		@media screen and (min-width: 901px) {
			body, html, .content-wrapper, .content-container { min-width: <?php echo get_option('min_width'); ?>px; }
			#work-nav { min-width: <?php echo get_option('min_width')/2; ?>px; }
		}
		
		<?php if ( $GLOBALS['device_type']=='tablet' || $GLOBALS['device_type']=='phone' ) : ?>
		.process-step h1 {
			color: #FFFFFF;
		}
		.process-slash {
			fill: #FFFFFF;
		}
		<?php endif; ?>
		
	</style>
	<script>
		var slash_content = [<?php echo rtrim($between_the_slashes,','); ?>],
			carousel_images = [],
			display_images = {},
			blink_interval = <?php echo (get_option('blink_interval'))? get_option('blink_interval'): '0'; ?>,
			rem_val,
	    	mobile = ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )? true: false,
	    	ios = ( /iPhone|iPad|iPod/i.test(navigator.userAgent) )? true: false,
			tipping_point = 901,
			max_width = <?php echo ( $GLOBALS['device_type']=='computer' )? get_option('max_width'): 10000; ?>,
			min_width = <?php echo get_option('min_width'); ?>;
		console.log('ios = ' + ios);
		
		// Set rem val
		function remSet(){
			rem_val = window.innerWidth/1250 * 10;
			rem_val = ( window.innerWidth < min_width )? min_width/1250 * 10: rem_val;
			rem_val = ( window.innerWidth > max_width )? max_width/1250 * 10: rem_val;
			if (mobile && window.innerWidth < tipping_point) rem_val = 10;
			var html_wrapper = document.getElementsByTagName('html')[0];
			html_wrapper.style.fontSize = rem_val + 'px';
			//jQuery('html').css('font-size', rem_val + 'px');
		}
		remSet();
		console.log(screen.width);
		
	</script>
</head>
<body class="<?php echo ( $GLOBALS['white_page'] )? 'white': 'black'; ?>">

	<div id="image_load_holder" style="width: 0px; height:0px; overflow: hidden; position: fixed; top:0px; left:0px; background: #ff0000; z-index: 100;"></div>

	<!--// WORK NAV //-->
	<nav id="work-nav" class="<?php echo ( $GLOBALS['white_page'] )? 'white': 'black'; ?>">
	
		<!--// SECTIONS //-->
		<svg id="work-close" x="0px" y="0px" viewBox="0 0 17.201 17.201" enable-background="new 0 0 17.201 17.201" xml:space="preserve">
			<polygon points="17.201,14.949 10.853,8.599 17.2,2.251 14.948,0 8.601,6.347 2.253,0 0.001,2.251 6.349,8.599 0,14.949 2.252,17.201 8.601,10.851 14.949,17.201 "/>
		</svg>
		<ul id="work-section-list" class="section-list posfix">
			<li><a href="javascript:showTerms('all', 'disciplines-list');"><u><?php echo get_the_title(26); ?></u></a></li>
		</ul>
		<br class="clearfix">
		
		<!--// DISCIPLINES //-->
		<ul id="disciplines-list" class="posfix">
			<li id="disciplines-list-filter" class="filter">
				<a href="javascript:toggleFilter();">Filter</a>
			</li>
			<?php  
				$tax_terms = array();
				foreach( get_terms( array(  'discipline' ) ) as $discipline) : 
			?> 
			<li id="disciplines-list-<?php echo $discipline->slug; ?>" class="filtered-list">
				<a href="javascript:showTerms('<?php echo $discipline->slug; ?>', 'disciplines-list');">
					<?php echo $discipline->name; ?>
				</a>
			</li>
			<?php 
				$tax_terms[] = $discipline->slug;
				endforeach; 
			?>
		</ul>
		<br class="clearfix">
		
		<!--// PROJECTS //-->
		<div id="projects-list">
			<div id="scrolling-wrapper" class="scroll-wrapper">
			<div id="scrolling-contents">
				<?php 
					$display_size;
					if ( $GLOBALS['device_type'] == 'mobile' ) {
						$display_size = 'small';
					} else {
						$display_size = 'small';
					}
					$projects = get_posts( array( 'showposts' => -1, 'post_type' => 'project', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array( array( 'taxonomy' => 'discipline', 'field' => 'slug', 'terms' => $tax_terms ) ) ) ); 
				?>
				<?php foreach( $projects as $project ): 
					$term_class = ''; 
					$disciplines = '';
					$term_list = wp_get_post_terms( $project->ID, 'discipline' ); 
					foreach ($term_list as $term ) { 
						$term_class .= $term->slug . ' '; 
					} 
					if ( get_post_meta( $project->ID, 'project_archived', true) != 1 ) :
				?>
				<div class="project <?php echo rtrim( $term_class, ' ' ); ?>">
					<a href="<?php echo get_permalink( $project->ID ); ?> ">
					<div class="project-thumb" style="background-image: url('<?php if ( class_exists('MultiPostThumbnails') ) echo MultiPostThumbnails::get_post_thumbnail_url('project', 'menu-image', $project->ID, $display_size );  ?>');">
						<div class="module-foreground-rollover" style="background: #<?php echo get_post_meta( $project->ID, 'color_space', true); ?>;" >
							<h4><?php echo get_the_title( $project->ID ); ?></h4>
						</div>
					</div>
					</a>
				</div>
				<?php endif; endforeach; ?>
				<?php 
					$archives = get_posts( array( 'showposts' => -1, 'post_type' => 'project', 'orderby' => 'menu_order', 'order' => 'ASC', 'meta_key' => 'project_archived', 'meta_value' => '1', 'tax_query' => array( array( 'taxonomy' => 'discipline', 'field' => 'slug', 'terms' => $tax_terms ) ) ) );
					if ( !empty($archives) ) :
						$source = wp_get_attachment_image_src(get_post_thumbnail_id( 26 ), $display_size);
				?>
				<div class="project persistant">
					<a href="<?php echo get_permalink( 26 ); ?> ">
					<div class="project-thumb" style="background-image: url('<?php echo $source[0]; ?>');">
						<div class="module-foreground-rollover" style="background: #<?php echo get_post_meta( 26, 'color_space', true); ?>;" >
							<h4><?php echo get_post_meta( 26, 'external_link', true); ?></h4>
						</div>
					</div>
					</a>
				</div>
				<?php endif; ?>
			</div>
			</div>
		</div>
	</nav>


	<!--// OVERLAY TINT //-->
	<div id="tint" class="<?php echo ( $GLOBALS['white_page'] )? 'white': 'black'; ?>"></div>
		
	<!--// HEADER //-->
	<div id="header-wrapper" class="content-wrapper">
	<header id="site-header" class="content-wrapper <?php echo ( $GLOBALS['white_page'] && !$GLOBALS['landing'])? 'white': 'black'; ?>" >
	
		<a id="home-link" href="<?php echo get_bloginfo('url'); ?>"><b><?php echo get_bloginfo('name'); ?></b> /<span id="slashes" class="entre-les-slashes"></span>/</a>
			
		<!--// STUDIO NAV //-->
		<nav id="studio-nav">
		
			<!--// SECTIONS //-->
			<ul id="studio-section-list" class="section-list posfix">
				<?php
					foreach( $pages as $page): if ( !$page->post_parent ) : 
					$selected = ( 
						(
							$queried_object->ID == $page->ID || 
							$queried_object->post_parent == $page->ID  ||
							($queried_object->ID == 26 && $page->ID == 26 )  ||
							( ( $queried_object->post_type == 'post' || is_category() ) && $page->ID == 2 )  
						) 
					)? true: false; 
					
				?>
				<li id="section-list-<?php echo strtolower($page->post_title); ?>"<?php if ($selected) : ?> class="current-page"<?php endif; ?> >
					<a href="<?php echo ($page->ID == 26)? 'javascript:void(0);': get_permalink( $page->ID ); ?>">
						<u><?php echo $page->post_title; ?></u>
					</a>
				</li>
				<?php endif; endforeach; ?>
			</ul>
			<br class="clearfix">
	
		<?php if ( $post->post_parent == 2 || $post->post_type == 'post'  || is_category()  ) : ?>
			
			<!--// PAGES //-->
			<ul id="page-list" class="posfix">
				<?php  
					foreach( $pages as $page): if ( $page->post_parent ) : 
					$selected = ( 
						$queried_object->ID == $page->ID   ||
						( ( $queried_object->post_type == 'post' || is_category() ) && $page->ID == 30 ) 
					)? true: false; 
				?>
				
				<li id="page-list-<?php echo $page->post_slug; ?>"<?php if ($selected) : ?> class="current-page"<?php endif; ?> >
					<a href="<?php echo get_permalink( $page->ID ); ?>">
						<?php echo $page->post_title; ?>
					</a>
				</li>
				
				<?php endif; endforeach; ?>
			</ul>
			<br class="clearfix" />
			 
		<?php endif; ?>
		</nav>
	</header>
	</div>
	<?php if ($GLOBALS['landing']): ?>
	<!--// MESSAGING //-->
	<div id="landing-message-wrapper" class="content-wrapper">
		<div id="landing-message">
			<h2><?php 
			$phrases = get_posts( 
				array(
  						'showposts' => -1, 
					'post_type' => 'phrase'
				)
			);
			echo DEVONA_translate( $phrases[array_rand($phrases)]->post_content );
			?></h2>
		</div>
	</div>
	<?php endif; ?>
			
	<!--// SITE WRAPPER //-->
	<div id="site-wrapper" class="content-wrapper <?php echo ( $GLOBALS['white_page'] )? 'white': 'black'; ?>">

