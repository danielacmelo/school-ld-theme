<?php
    $terms = get_terms( 
        array(
            'taxonomy' => 'school-student-category',
    )
 );
    if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
        <section>
            <h3><?php esc_html_e( 'Meet other Designer students:', 'school' ); ?></h3>
            <ul>
                <?php foreach ( $terms as $term ) : ?>
                    <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
                <?php endforeach; ?>
            </ul>    
        </section>  
        <?php  
    endif;
    ?>