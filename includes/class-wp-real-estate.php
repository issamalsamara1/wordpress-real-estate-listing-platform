<?php
class WP_Real_Estate {
    public function init() {
        $cpt = new WP_Real_Estate_CPT();
        $cpt->init();

        $meta_boxes = new WP_Real_Estate_Meta_Boxes();
        $meta_boxes->init();

        $templates = new WP_Real_Estate_Templates();
        $templates->init();

        $shortcodes = new WP_Real_Estate_Shortcodes();
        $shortcodes->init();

        $rest_api = new WP_Real_Estate_REST_API();
        $rest_api->init();

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'wpre-style', WPRE_PLUGIN_URL . 'assets/css/wp-real-estate.css', array(), WPRE_VERSION );
        wp_enqueue_script( 'wpre-script', WPRE_PLUGIN_URL . 'assets/js/wp-real-estate.js', array('jquery'), WPRE_VERSION, true );
        wp_localize_script( 'wpre-script', 'wpre_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ));
    }
}
