<?php
/**
 * Template Name: Full Width, No Sidebar
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

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();

            
                    $args  = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                    );
                    $query = new WP_Query( $args );
                    ?>
                    <?php if ( $query->have_posts() ) : ?>
                        <section class="blog-posts">
                            <h2>Latest Blog Posts</h2>
                            <?php
                            while ( $query->have_posts() ) :
                                $query->the_post();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="open-modal" data-id="<?php echo get_the_ID(); ?>">
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                            <p class="all-posts"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">See All Posts</a></p>
                        </section>
                        <div id="modal-window" class="modal-window">
                            <button id="close-modal" class="close-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <title><?php _e( 'Close' ); ?></title>
                                    <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"></path>
                                </svg>
                            </button>
                            <div id="modal-window-content"></div>
                        </div>
                        <div id="dimmer"></div>
                    <?php endif; ?>
                            </div><!-- .entry-content -->
             
            </article><!-- #post-<?php the_ID(); ?> -->     
            
        <?php
        endwhile;
        ?>

	</main><!-- #primary -->

<?php 
get_footer();