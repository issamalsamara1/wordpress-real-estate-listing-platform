<?php
/**
 * Plugin Name: WP Real Estate Platform
 * Description: A complete WordPress real estate platform with properties, agents, advanced search, and more.
 * Version: 1.0.0
 * Author: WP Real Estate
 * Text Domain: wp-real-estate
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'WPRE_VERSION', '1.0.0' );
define( 'WPRE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPRE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include core classes
require_once WPRE_PLUGIN_DIR . 'includes/class-wp-real-estate.php';
require_once WPRE_PLUGIN_DIR . 'includes/class-wp-real-estate-cpt.php';
require_once WPRE_PLUGIN_DIR . 'includes/class-wp-real-estate-meta-boxes.php';
require_once WPRE_PLUGIN_DIR . 'includes/class-wp-real-estate-templates.php';
require_once WPRE_PLUGIN_DIR . 'includes/class-wp-real-estate-shortcodes.php';
require_once WPRE_PLUGIN_DIR . 'includes/class-wp-real-estate-rest-api.php';

function wpre_init_plugin() {
    $wpre = new WP_Real_Estate();
    $wpre->init();
}
add_action( 'plugins_loaded', 'wpre_init_plugin' );
