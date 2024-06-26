<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_LD_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up" >
   <div class="news-article"> 
      <header class="entry-header">
         <?php
         if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
         else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
         endif;

         if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
               <?php
               school_ld_theme_posted_on();
               school_ld_theme_posted_by();
               ?>
            </div><!-- .entry-meta -->
         <?php endif; ?>
      </header><!-- .entry-header -->

      <?php school_ld_theme_post_thumbnail(); ?>

      <div class="entry-content">
         <?php
         if ( is_single() ) {     
            the_content();
         } else {
            the_excerpt();
         }

         wp_link_pages(
            array(
               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'school-ld-theme' ),
               'after'  => '</div>',
            )
         );
         ?>
      </div><!-- .entry-content -->

      <footer class="entry-footer">
         <?php school_ld_theme_entry_footer(); ?>
      </footer><!-- .entry-footer -->
   </div> <!-- Close the div here -->
</article><!-- #post-<?php the_ID(); ?> -->
