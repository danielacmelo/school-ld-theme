<?php
/**
 * The template for displaying Staff page
 *
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

                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
            
                <div class="entry-content">
                    <?php
                    the_content();

                    
                    // Display Staff
                     $taxonomy = 'school-staff-terms';
                    $terms = get_terms( 
                        array(
                            'taxonomy' => $taxonomy
                        ) 
                    );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $args = array(
                                'post_type'      => 'school-staff',
                                'posts_per_page' => -1,
                                'orderby'        => 'title',
                                'order'          => 'ASC',
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'slug',
                                        'terms'    => $term->slug,
                                    )
                                )
                            );
                            $query = new WP_Query( $args );
                    
                            if ( $query->have_posts() ) {
                                echo '<h2>' . esc_html( $term->name ) . '</h2>';
                                while( $query->have_posts() ) {
                                    $query->the_post(); 
                                    if ( function_exists( 'get_field' ) ) {
                                        echo '<h3 id="'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</h3>';
                                        if ( get_field( 'short_staff_biography' ) ) {
                                            the_field( 'short_staff_biography' );
                                        }
                                    }
                                }
                                wp_reset_postdata();
                            }    
                        }
                    }   
            
                   
                            ?>
                </div><!-- .entry-content --> 


        
        <?php endwhile; // End of the loop.?>

	</main><!-- #primary -->

<?php
get_footer();
