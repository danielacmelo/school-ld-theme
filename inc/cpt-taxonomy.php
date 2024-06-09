<?php
function school_register_custom_post_types() {
    
    // Register Custom Post Type Staff
    $labels = array(
        'name'                  => _x( 'Staff', 'post type general name' ),
        'singular_name'         => _x( 'Staff', 'post type singular name'),
        'menu_name'             => _x( 'Staff', 'admin menu' ),
        'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'staff' ),
        'add_new_item'          => __( 'Add New Staff' ),
        'new_item'              => __( 'New Staff' ),
        'edit_item'             => __( 'Edit Staff' ),
        'view_item'             => __( 'View Staff' ),
        'all_items'             => __( 'All Staff' ),
        'search_items'          => __( 'Search Staff' ),
        'parent_item_colon'     => __( 'Parent Staff:' ),
        'not_found'             => __( 'No staff found.' ),
        'not_found_in_trash'    => __( 'No staff found in Trash.' ),
        'archives'              => __( 'Staff Archives'),
        'insert_into_item'      => __( 'Insert into staff'),
        'uploaded_to_this_item' => __( 'Uploaded to this staff'),
        'filter_item_list'      => __( 'Filter staff list'),
        'items_list_navigation' => __( 'Staff list navigation'),
        'items_list'            => __( 'Staff list'),
        'featured_image'        => __( 'Staff featured image'),
        'set_featured_image'    => __( 'Set staff featured image'),
        'remove_featured_image' => __( 'Remove staff featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staff' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-archive',
        'supports'           => array( 'title'),
    );

    register_post_type( 'school-staff', $args );

}
add_action( 'init', 'school_register_custom_post_types' );

// Register Custom Taxonomies

function school_register_taxonomies() {
    // Add Staff Terms taxonomy
    $labels = array(
        'name'              => _x( 'Staff Terms', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Terms', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Terms' ),
        'all_items'         => __( 'All Staff Terms' ),
        'parent_item'       => __( 'Parent Staff Terms' ),
        'parent_item_colon' => __( 'Parent Staff Terms:' ),
        'edit_item'         => __( 'Edit Staff Terms' ),
        'view_item'         => __( 'View Staff Terms' ),
        'update_item'       => __( 'Update Staff Terms' ),
        'add_new_item'      => __( 'Add New Staff Terms' ),
        'new_item_name'     => __( 'New Staff Terms Name' ),
        'menu_name'         => __( 'Staff Terms' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-terms' ),
    );
    register_taxonomy( 'school-staff-terms', array( 'school-staff' ), $args );

}
add_action( 'init', 'school_register_taxonomies');

//This flushes the permalinks when switching themes
function fwd_rewrite_flush() {
    fwd_register_custom_post_types();
    fwd_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_rewrite_flush' );