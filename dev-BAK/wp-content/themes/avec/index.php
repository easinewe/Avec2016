<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage avec
 * @since avec 14.0606
 */

?>
<?php get_header(); ?>




		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					
					get_template_part( 'content', get_post_type(get_the_ID()) );

				endwhile;

			else :
			echo "BUST";
				$caps = get_posts( array( 'showposts' => -1, 'post_type' => 'capability_page', 'orderby' => 'menu_order', 'order' => 'ASC' ) ); 
				foreach( $caps as $cap ){
					var_dump($cap);
				}
					
			endif;
		?>

<?php get_footer(); ?>
