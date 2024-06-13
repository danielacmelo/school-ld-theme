<?php
    // Get the terms related to the current post
    $terms = get_the_terms(get_the_ID(), 'school-student-category');

    // If terms are found, display the students that are in the same category
    if ($terms) {
        foreach ($terms as $term) {
            $args = array(
                'post_type' => 'school-student',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'school-student-category',
                        'field' => 'slug',
                        'terms' => $term->slug,
                    ),
                ),
            );

            // The Query
            $query = new WP_Query($args);

            // Get the current post ID
            $current_id = get_the_ID();

            // The Loop
            if ($query->have_posts()) {
                echo "<h3>Meet other " . $term->name . " students</h3>";
                echo "<div class='others-students'>";

                while ($query->have_posts()) {
                    $query->the_post();
                    echo $current_id == get_the_ID() ? '' : "<h3><a href='" . get_the_permalink() . "'>" . get_the_title() . "</a></h3>";
                }

                echo '</div>';
                wp_reset_postdata();
            }
        }
    }
?>
