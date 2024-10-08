<?php
/**
 * School LD Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_LD_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_ld_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School LD Theme, use a find and replace
		* to change 'school-ld-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-ld-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

    // Custom image Crop Sizes 
      
    add_image_size( '1920x1280', 1920, 1280, true );
    add_image_size( '300x220', 300, 220, true );
    add_image_size( '300x200', 300, 200, true );
    add_image_size( '200x300', 200, 300, true );

    //Add theme support for custom logo

    add_theme_support(
		'custom-logo',
		array(
			'height' => 240,
			'width' => 240,
			'flex-width' => true,
			'flex-height' => true,
		)
	);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__( 'Primary', 'school' ),
            'footer-menu' => esc_html__('Footer Menu', 'school'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
            'navigation-widgets',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_ld_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

    /**
	 * Add support for Block Editor features.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	 */
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
    add_theme_support( 'align-full' );
}
add_action( 'after_setup_theme', 'school_ld_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_ld_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_ld_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_ld_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_ld_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-ld-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-ld-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_ld_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function school_ld_theme_scripts() {
    wp_enqueue_style( 
        'fwd-googlefonts', //unique handle
        'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap', // url
        array(), // dependencies
        null // version, must be set to null for Google Fonts to load multiple font families 
    );

	wp_enqueue_style( 'school-ld-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-ld-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school-ld-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Enqueue the AOS
    if ( is_singular('post') || is_home() ) {
        wp_enqueue_style(
            'aos-css',
            get_template_directory_uri() . '/aos/aos.css',
            array(),
            _S_VERSION 
        );

        wp_enqueue_script(
            'aos-js',
            get_template_directory_uri() . '/js/aos.js',
            array(),
            _S_VERSION,
            true 
        );
    }   
}
add_action( 'wp_enqueue_scripts', 'school_ld_theme_scripts' );

function initialize_aos_script() {
    if ( is_singular('post') || is_home() ) { 
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                AOS.init();
            });
        </script>';
    }  
}
add_action('wp_footer', 'initialize_aos_script', 20);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register CPTs and Taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

// Function to display the terms of a post student
function display_student_terms( $taxonomy ) {
    $terms = get_the_terms( get_the_ID(), $taxonomy );

    if ( $terms && ! is_wp_error( $terms ) ) {
        $term_links = array();

        foreach ( $terms as $term ) {
            $term_links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
        }

        $all_terms = join( ', ', $term_links );

        echo '<span class="student-terms-' . esc_attr( $taxonomy ) . '">' . $all_terms . '</span>';
    } else {
        echo '<span class="student-terms-' . esc_attr( $taxonomy ) . '">No categorie found.</span>';
    }
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Add Theme Color Meta Tag 
function school_theme_color() {
    echo '<meta name="theme-color" content="#fff200">';
}
add_action( 'wp_head', 'school_theme_color', 1 );


// Change the excerpt length only for the school-student CPT
function school_excerpt_length( $length ) {
    if (is_post_type_archive('school-student') || is_singular('school-student')) {
        return 25;
    }
    return $length;
}
add_filter( 'excerpt_length', 'school_excerpt_length', 999 );

// Change the excerpt more text only for the school-student CPT
function school_excerpt_more( $more ) {
    if (is_post_type_archive('school-student') || is_singular('school-student')) {
        $more =  '<br><a href="'. esc_url(get_permalink()) . '">'. __( 'Read More about the Student...'). '</a>';
    }
    return $more;
}
add_filter( 'excerpt_more', 'school_excerpt_more' );


// Change placeholder CPT Title 
function school_change_title_text( $title ){
    $screen = get_current_screen();
    if  ( 'school-staff' == $screen->post_type ) {
        $title = 'Add staff name';
    }
    if  ( 'school-student' == $screen->post_type ) {
        $title = 'Add student name';
    }
    return $title;
}   

add_filter( 'enter_title_here', 'school_change_title_text' );

// Remove Archive Title Prefix
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
