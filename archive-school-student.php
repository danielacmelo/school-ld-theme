<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_LD_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php

            // Start the Loop
            $args = array(
                'post_type'      => 'school-student',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC'
            );
            

            // The Query
            $query = new WP_Query( $args );

            // The Loop
            if ( $query->have_posts() ) {
                echo '<section class="students">';
                while( $query->have_posts() ) {
                    $query->the_post(); 
                    ?>
                    <article class="student">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <?php the_post_thumbnail('300x220'); ?>
                        </a>
                        <?php the_excerpt(); ?>
                        <p>Specialty:<?php display_student_terms('school-student-category'); ?></p>
                        
                    </article>
                    <?php
                }
                wp_reset_postdata();
                echo '</section>';
            } 
            
        ?>

            
        <?php     
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
