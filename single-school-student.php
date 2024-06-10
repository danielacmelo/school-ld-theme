<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
            
                <article>
                        <?php the_post_thumbnail( 'medium', array('class' => 'alignright') ); ?>
                        <?php the_content(); ?>
                </article>    

            </div><!-- .entry-content -->   

            <?php get_template_part( 'template-parts/student-categories' ); ?>
            
        <?php 
        endwhile;
        ?>

    </main><!-- #main -->  
       

<?php
get_footer();
