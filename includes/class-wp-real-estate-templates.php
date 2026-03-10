<?php
class WP_Real_Estate_Templates {
    public function init() {
        add_filter( 'template_include', array( $this, 'load_templates' ) );
    }

    public function load_templates( $template ) {
        if ( is_singular( 'property' ) ) {
            $plugin_template = WPRE_PLUGIN_DIR . 'templates/single-property.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }

        if ( is_post_type_archive( 'property' ) || is_tax( array( 'property_type', 'property_status', 'property_location' ) ) ) {
            $plugin_template = WPRE_PLUGIN_DIR . 'templates/archive-property.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }

        if ( is_singular( 'agent' ) ) {
            $plugin_template = WPRE_PLUGIN_DIR . 'templates/single-agent.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }

        if ( is_post_type_archive( 'agent' ) ) {
            $plugin_template = WPRE_PLUGIN_DIR . 'templates/archive-agent.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }

        return $template;
    }
}
