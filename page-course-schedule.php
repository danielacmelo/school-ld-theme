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

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_content();

            // Display Course Schedule
            
            // Check if the repeater field has rows of data
            if( have_rows('weekly_course_schedule') ):
            ?>
                <table class="schedule">
                <caption>Weekly Course Schedule</caption>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Course</th>
                            <th>Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through the rows of data
                        while( have_rows('weekly_course_schedule') ) : the_row();
                            // Get subfield values
                            $date = get_sub_field('date');
                            $course = get_sub_field('course');
                            $instructor = get_sub_field('instructor');
                            
                            ?>
                            <tr>
                                <td><?php echo esc_html( is_array($date) ? implode(', ', $date) : $date ); ?></td>
                                <td><?php echo esc_html( is_array($course) ? implode(', ', $course) : $course ); ?></td>
                                <td><?php echo esc_html( is_array($instructor) ? implode(', ', $instructor) : $instructor ); ?></td>
                            </tr>
                        <?php
                        endwhile;
                        ?>
                    </tbody>
                </table>
            <?php
            else :
                // No rows found
                echo '<p>No course schedule available.</p>';
            endif;
            ?>
        </div><!-- .entry-content -->

    </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php
get_footer();
