<?php
class WP_Real_Estate_Shortcodes {
    public function init() {
        add_shortcode( 'wpre_properties', array( $this, 'properties_shortcode' ) );
        add_shortcode( 'wpre_search_form', array( $this, 'search_form_shortcode' ) );
    }

    public function properties_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'posts_per_page' => 10,
        ), $atts );

        $args = array(
            'post_type'      => 'property',
            'posts_per_page' => intval( $atts['posts_per_page'] ),
            'post_status'    => 'publish',
        );

        $query = new WP_Query( $args );

        ob_start();

        if ( $query->have_posts() ) {
            echo '<div class="wpre-properties-grid">';
            while ( $query->have_posts() ) {
                $query->the_post();
                $price = get_post_meta( get_the_ID(), '_wpre_property_price', true );
                $bedrooms = get_post_meta( get_the_ID(), '_wpre_property_bedrooms', true );
                ?>
                <div class="wpre-property-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="wpre-property-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="wpre-property-info">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php if ( $price ) : ?>
                            <p class="wpre-price">$<?php echo esc_html( number_format( $price ) ); ?></p>
                        <?php endif; ?>
                        <p class="wpre-meta">
                            <?php if ( $bedrooms ) : ?>
                                <span><i class="dashicons dashicons-admin-home"></i> <?php echo esc_html( $bedrooms ); ?> Beds</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __( 'No properties found.', 'wp-real-estate' ) . '</p>';
        }

        return ob_get_clean();
    }

    public function search_form_shortcode() {
        ob_start();
        $plugin_template = WPRE_PLUGIN_DIR . 'templates/search-properties.php';
        if ( file_exists( $plugin_template ) ) {
            include $plugin_template;
        }
        return ob_get_clean();
    }
}
