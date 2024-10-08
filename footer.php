<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_LD_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-content">
            <?php
                if (has_custom_logo()) : ?>
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php the_custom_logo(); ?>
                        </a>
                    </div>
                    
                    <?php endif; ?>

                    <section class="footer-credits">
                        <h2>Credits</h2>
                        <p>Created by: 
                            <strong><a href="https://github.com/danielacmelo/">Dani Melo</a></strong></p>
                        <p>Photos courtesy of:
                            <strong><a href="https://burst.shopify.com">Burst</a><strong></p>
                    </section>

                    
                    <?php

                    // Get the footer menu
                    
                    $menu_location = 'footer-menu';
                    $locations = get_nav_menu_locations();
                    $menu_id = $locations[$menu_location];
                    $menu = wp_get_nav_menu_object($menu_id);
                    $menu_name = $menu->name;

                    // Display the footer menu
                    wp_nav_menu(
                        array(
                            'items_wrap' => '<h2>' . esc_html($menu_name) . '</h2><ul id="%1$s" class="%2$s">%3$s</ul>',
                            'theme_location' => $menu_location,
                            'menu_id'        => 'footer-menu',
                        )
                    );
                    
                    ?>
		</div><!-- .footer-content -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
