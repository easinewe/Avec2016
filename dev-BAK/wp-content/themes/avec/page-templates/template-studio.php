<?php
/**
 * Template Name: About
 *
 * Description: The template for displaying the about page
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0703
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="about-content-container" class="content-container">

			<!--// OVERVIEW //-->
			<div id="about-overview" class="overview">
			<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						echo DEVONA_translate(get_the_content());
					endwhile;
				endif; 
			?>
			</div>

			<!--// PROCESS //-->
			<div id="process-block">
			<h3 id="process-title" class="about-title">Process Makes Perfect:</h3>
			<?php $process_steps = get_posts( array( 'showposts' => -1, 'post_type' => 'process', 'orderby' => 'menu_order', 'order' => 'ASC' ) ); ?>
			<?php $p_count = 0; foreach( $process_steps as $process_step ): $p_count ++; $p_titles = explode("+",$process_step->post_title); ?>
				<div id="process-step-<?php echo $process_step->menu_order; ?>" class="process-step<?php if ($p_count %2 == 0) echo ' pad-top'; ?>">
					<div class="process-border">
						<h1><?php echo $process_step->menu_order; ?></h1>
						<svg class="process-slash" x="0px" y="0px" viewBox="0 0 119.959 234.292" enable-background="new 0 0 119.959 234.292" xml:space="preserve"><polygon points="112.411,0 0,234.292 7.547,234.292 119.959,0 "/></svg>
						<h3 class="process-step-title"><?php $p = 0; foreach ($p_titles as $p_title): ?><div><?php if ($p > 0) : ?>+ <?php endif; ?><?php echo $p_title; ?></div><?php $p++; endforeach; ?></h3>
						<p class="process-step-description"><?php echo $process_step->post_content; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
			<br class="clearfix" />
			</div>

			<!--// PRINCIPALS //-->
			<div id="principals-block">
			<h3 id="principals-title" class="about-title">Principals:</h3>
			<?php $principals = get_users(  ); ?>
			<?php foreach( $principals as $principal ):  ?>
			<?php if ( get_user_meta( $principal->ID, 'show_user', true ) ) : ?>
				<div class="principal">
					
					<div class="principal-image animate-<?php echo get_user_meta( $principal->ID, 'animate-from', true ); ?>" style="background-image: url('<?php echo get_user_meta( $principal->ID, 'roll-image', true ); ?>');"></div>
					<h3 class="principal-name"><?php echo get_user_meta( $principal->ID, 'first_name', true ) . ' ' . get_user_meta( $principal->ID, 'last_name', true ); ?></h3>
					<h4 class="principal-job-title"><?php echo get_user_meta( $principal->ID, 'job_title', true ); ?></h4>
					<p class="principal-bio"><?php echo get_user_meta( $principal->ID, 'description', true ); ?></p>
					<p class="principal-slashes">Avec / <?php $prince_slashes =  explode(",", get_user_meta( $principal->ID, 'between_slashes', true )); echo $prince_slashes[array_rand($prince_slashes)]; ?> /</p>
				</div>
			<?php endif; ?>
			<?php endforeach; ?>
				<br class="clearfix">
			</div>
	
			<!--// CLIENTS //-->
			<div id="clients-block">
			<h3 id="clients-title" class="about-title">We’ve Worked With:</h3>
				<ul class="clients-list">
				<?php $clients = get_posts( array( 'showposts' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_type' => 'client' ) ); ?>
				<?php foreach( $clients as $client ): 
					$client_link = false;
					if ( get_post_meta( $client->ID, 'external_link', true) || get_post_meta( $client->ID, 'capability_projects', true) ) {
						if ( get_post_meta( $client->ID, 'capability_projects', true) ) $client_link = get_post_meta( $client->ID, 'capability_projects', true);
						if ( get_post_meta( $client->ID, 'external_link', true) ) $client_link = ( get_post_meta( $client->ID, 'external_link', true) );
						else $client_link = get_the_permalink($client_link[0]);
					}
				?>
					<li>
					<?php if ( $client_link ) : ?><a href="<?php echo $client_link; ?>" ><u><?php endif; ?>
					<?php echo $client->post_title; ?>
					<?php if ( $client_link ) : ?></u></a><?php endif; ?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>

			<!--// SERVICES //-->
			<div id="services-block">
			<h3 id="services-title" class="about-title">We Provide:</h3>
				<ul class="services-list">
				<?php $services = get_posts( array( 'showposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => 'service' ) ); ?>
				<?php foreach( $services as $service ): ?>
					<li><?php echo $service->post_title; ?></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<br class="clearfix">
			
		</div>
				
				
<?php get_footer(); ?>
