<?php
/**
 * Template Name: Contact
 *
 * Description: The template for displaying the contact page
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0606
 */

?>
<?php get_header(); ?>

		<!--// CONTENT //-->
		<div id="contact-content-container" class="content-container">
			<center>
			
			<!--// OVERVIEW //-->
			<div id="contact-overview" class="overview">
			<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						echo DEVONA_translate(get_the_content());
					endwhile;
				endif; 
			?>
			</div>
			
			<h1 id="main-phone"><a href="tel:+<?php echo ltrim( str_replace(' ', '', get_option('company_phone') ), '+' ); ?>"><u>+ <?php echo get_option('company_phone'); ?></u></a></h1>
			<h1 id="main-email"><a href="mailto:<?php echo get_option('company_email'); ?>"><u><?php echo get_option('company_email'); ?></u></a></h1>
			<img id="contact-image" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" />
			<div id="office-locations">
				<div id="secondary-office">
					<h2 class="office-division"><?php echo get_option('secondary_company_division'); ?></h2>
					<h2 class="office-address"><?php echo get_option('secondary_company_neighborhood'); ?>, <?php echo get_option('secondary_company_city'); ?></h2>
					<?php $po_map_link = 'https://www.google.com/maps/place/'.str_replace( ' ', '+', get_option('company_address').' '.get_option('company_city').' '.get_option('company_state').' '.get_option('company_zip')); ?>
					<?php $so_map_link = 'https://www.google.com/maps/place/'.str_replace( ' ', '+', get_option('secondary_company_address').' '.get_option('secondary_company_city').' '.get_option('secondary_company_state').' '.get_option('secondary_company_zip')); ?>
					<p><a href="<?php echo $so_map_link; ?>" target="_blank">Google it</a></p>
				</div>
				<svg id="office-locations-slash" x="0px" y="0px" viewBox="0 0 115.955 234.292" enable-background="new 0 0 115.955 234.292" xml:space="preserve">
					<polygon points="112.411,0 0,234.292 3.543,234.292 115.955,0 "/>
				</svg>
				<div id="primary-office">
					<p>Main Office</p>
					<h2 class="office-division"><?php echo get_option('company_division'); ?></h2>
					<h2 class="office-address"><?php echo get_option('company_neighborhood'); ?>, <?php echo get_option('company_city'); ?></h2>
					<p><a href="<?php echo $po_map_link; ?>" target="_blank">Google it</a></p>
				</div>
				<br class="clearfix">
			</div>

			</center>
		</div>
				
				
<?php get_footer(); ?>
