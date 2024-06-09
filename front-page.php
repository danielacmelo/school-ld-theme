<?php
/**
 * The template for displaying Home page 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_LD_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

           
		?>

        <section class="blog-posts">
        <h2><?php esc_html_e( 'Recent News', 'school-ld' ); ?></h2> 
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                );
                $blog_query = new WP_Query( $args );
                if ( $blog_query -> have_posts() ) {
                    while ( $blog_query->have_posts() ) {
                        $blog_query -> the_post();
                        ?>
                        <article>
                            <a href="<?php the_permalink(); ?>"> 
                                <?php the_post_thumbnail( '300x200' ); ?>
                                <h3><?php the_title(); ?></h3>
                            </a> 
                        </article>       
                        <?php 
                    }
                    wp_reset_postdata();
                }
                ?> 

      
        </section>

        

			
        <?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();