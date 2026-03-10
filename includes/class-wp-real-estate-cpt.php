<?php
class WP_Real_Estate_CPT {
    public function init() {
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
    }

    public function register_post_types() {
        // Property CPT
        $property_labels = array(
            'name'               => _x( 'Properties', 'post type general name', 'wp-real-estate' ),
            'singular_name'      => _x( 'Property', 'post type singular name', 'wp-real-estate' ),
            'menu_name'          => _x( 'Properties', 'admin menu', 'wp-real-estate' ),
            'add_new'            => _x( 'Add New', 'property', 'wp-real-estate' ),
            'add_new_item'       => __( 'Add New Property', 'wp-real-estate' ),
            'edit_item'          => __( 'Edit Property', 'wp-real-estate' ),
            'new_item'           => __( 'New Property', 'wp-real-estate' ),
            'all_items'          => __( 'All Properties', 'wp-real-estate' ),
            'view_item'          => __( 'View Property', 'wp-real-estate' ),
            'search_items'       => __( 'Search Properties', 'wp-real-estate' ),
            'not_found'          => __( 'No properties found.', 'wp-real-estate' ),
            'not_found_in_trash' => __( 'No properties found in Trash.', 'wp-real-estate' )
        );

        $property_args = array(
            'labels'             => $property_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'property' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-building',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'show_in_rest'       => true,
        );

        register_post_type( 'property', $property_args );

        // Agent CPT
        $agent_labels = array(
            'name'               => _x( 'Agents', 'post type general name', 'wp-real-estate' ),
            'singular_name'      => _x( 'Agent', 'post type singular name', 'wp-real-estate' ),
            'menu_name'          => _x( 'Agents', 'admin menu', 'wp-real-estate' ),
            'add_new'            => _x( 'Add New', 'agent', 'wp-real-estate' ),
            'add_new_item'       => __( 'Add New Agent', 'wp-real-estate' ),
            'edit_item'          => __( 'Edit Agent', 'wp-real-estate' ),
            'new_item'           => __( 'New Agent', 'wp-real-estate' ),
            'all_items'          => __( 'All Agents', 'wp-real-estate' ),
            'view_item'          => __( 'View Agent', 'wp-real-estate' ),
            'search_items'       => __( 'Search Agents', 'wp-real-estate' ),
            'not_found'          => __( 'No agents found.', 'wp-real-estate' ),
            'not_found_in_trash' => __( 'No agents found in Trash.', 'wp-real-estate' )
        );

        $agent_args = array(
            'labels'             => $agent_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'agent' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 6,
            'menu_icon'          => 'dashicons-businessman',
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'show_in_rest'       => true,
        );

        register_post_type( 'agent', $agent_args );
    }

    public function register_taxonomies() {
        // Property Type
        $type_labels = array(
            'name'              => _x( 'Property Types', 'taxonomy general name', 'wp-real-estate' ),
            'singular_name'     => _x( 'Property Type', 'taxonomy singular name', 'wp-real-estate' ),
            'search_items'      => __( 'Search Property Types', 'wp-real-estate' ),
            'all_items'         => __( 'All Property Types', 'wp-real-estate' ),
            'parent_item'       => __( 'Parent Property Type', 'wp-real-estate' ),
            'parent_item_colon' => __( 'Parent Property Type:', 'wp-real-estate' ),
            'edit_item'         => __( 'Edit Property Type', 'wp-real-estate' ),
            'update_item'       => __( 'Update Property Type', 'wp-real-estate' ),
            'add_new_item'      => __( 'Add New Property Type', 'wp-real-estate' ),
            'new_item_name'     => __( 'New Property Type Name', 'wp-real-estate' ),
            'menu_name'         => __( 'Property Types', 'wp-real-estate' ),
        );

        $type_args = array(
            'hierarchical'      => true,
            'labels'            => $type_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'property-type' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'property_type', array( 'property' ), $type_args );

        // Property Status
        $status_labels = array(
            'name'              => _x( 'Property Statuses', 'taxonomy general name', 'wp-real-estate' ),
            'singular_name'     => _x( 'Property Status', 'taxonomy singular name', 'wp-real-estate' ),
            'menu_name'         => __( 'Property Statuses', 'wp-real-estate' ),
        );

        $status_args = array(
            'hierarchical'      => true,
            'labels'            => $status_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'property-status' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'property_status', array( 'property' ), $status_args );

        // Location
        $location_labels = array(
            'name'              => _x( 'Locations', 'taxonomy general name', 'wp-real-estate' ),
            'singular_name'     => _x( 'Location', 'taxonomy singular name', 'wp-real-estate' ),
            'menu_name'         => __( 'Locations', 'wp-real-estate' ),
        );

        $location_args = array(
            'hierarchical'      => true,
            'labels'            => $location_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'property-location' ),
            'show_in_rest'      => true,
        );
        register_taxonomy( 'property_location', array( 'property' ), $location_args );
    }
}
