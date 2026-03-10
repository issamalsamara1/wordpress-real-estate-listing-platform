<?php
class WP_Real_Estate_Meta_Boxes {
    public function init() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
    }

    public function add_meta_boxes() {
        add_meta_box(
            'property_details_meta',
            __( 'Property Details', 'wp-real-estate' ),
            array( $this, 'render_property_meta_box' ),
            'property',
            'normal',
            'high'
        );

        add_meta_box(
            'agent_details_meta',
            __( 'Agent Details', 'wp-real-estate' ),
            array( $this, 'render_agent_meta_box' ),
            'agent',
            'normal',
            'high'
        );
    }

    public function render_property_meta_box( $post ) {
        wp_nonce_field( 'wpre_save_meta_box_data', 'wpre_meta_box_nonce' );

        $price = get_post_meta( $post->ID, '_wpre_property_price', true );
        $address = get_post_meta( $post->ID, '_wpre_property_address', true );
        $bedrooms = get_post_meta( $post->ID, '_wpre_property_bedrooms', true );
        $bathrooms = get_post_meta( $post->ID, '_wpre_property_bathrooms', true );
        $sqft = get_post_meta( $post->ID, '_wpre_property_sqft', true );

        ?>
        <p>
            <label for="wpre_property_price"><strong><?php _e( 'Price ($)', 'wp-real-estate' ); ?></strong></label><br>
            <input type="number" id="wpre_property_price" name="wpre_property_price" value="<?php echo esc_attr( $price ); ?>" class="widefat" />
        </p>
        <p>
            <label for="wpre_property_address"><strong><?php _e( 'Address', 'wp-real-estate' ); ?></strong></label><br>
            <input type="text" id="wpre_property_address" name="wpre_property_address" value="<?php echo esc_attr( $address ); ?>" class="widefat" />
        </p>
        <p>
            <label for="wpre_property_bedrooms"><strong><?php _e( 'Bedrooms', 'wp-real-estate' ); ?></strong></label><br>
            <input type="number" id="wpre_property_bedrooms" name="wpre_property_bedrooms" value="<?php echo esc_attr( $bedrooms ); ?>" class="widefat" />
        </p>
        <p>
            <label for="wpre_property_bathrooms"><strong><?php _e( 'Bathrooms', 'wp-real-estate' ); ?></strong></label><br>
            <input type="number" step="0.5" id="wpre_property_bathrooms" name="wpre_property_bathrooms" value="<?php echo esc_attr( $bathrooms ); ?>" class="widefat" />
        </p>
        <p>
            <label for="wpre_property_sqft"><strong><?php _e( 'Square Footage', 'wp-real-estate' ); ?></strong></label><br>
            <input type="number" id="wpre_property_sqft" name="wpre_property_sqft" value="<?php echo esc_attr( $sqft ); ?>" class="widefat" />
        </p>
        <?php
    }

    public function render_agent_meta_box( $post ) {
        wp_nonce_field( 'wpre_save_meta_box_data', 'wpre_meta_box_nonce' );

        $email = get_post_meta( $post->ID, '_wpre_agent_email', true );
        $phone = get_post_meta( $post->ID, '_wpre_agent_phone', true );

        ?>
        <p>
            <label for="wpre_agent_email"><strong><?php _e( 'Email Address', 'wp-real-estate' ); ?></strong></label><br>
            <input type="email" id="wpre_agent_email" name="wpre_agent_email" value="<?php echo esc_attr( $email ); ?>" class="widefat" />
        </p>
        <p>
            <label for="wpre_agent_phone"><strong><?php _e( 'Phone Number', 'wp-real-estate' ); ?></strong></label><br>
            <input type="text" id="wpre_agent_phone" name="wpre_agent_phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
        </p>
        <?php
    }

    public function save_meta_boxes( $post_id ) {
        if ( ! isset( $_POST['wpre_meta_box_nonce'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['wpre_meta_box_nonce'], 'wpre_save_meta_box_data' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( isset( $_POST['post_type'] ) && 'property' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

            $fields = array(
                'wpre_property_price' => '_wpre_property_price',
                'wpre_property_address' => '_wpre_property_address',
                'wpre_property_bedrooms' => '_wpre_property_bedrooms',
                'wpre_property_bathrooms' => '_wpre_property_bathrooms',
                'wpre_property_sqft' => '_wpre_property_sqft',
            );

            foreach ( $fields as $post_key => $meta_key ) {
                if ( isset( $_POST[ $post_key ] ) ) {
                    update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $post_key ] ) );
                }
            }
        }

        if ( isset( $_POST['post_type'] ) && 'agent' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

            $fields = array(
                'wpre_agent_email' => '_wpre_agent_email',
                'wpre_agent_phone' => '_wpre_agent_phone',
            );

            foreach ( $fields as $post_key => $meta_key ) {
                if ( isset( $_POST[ $post_key ] ) ) {
                    update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $post_key ] ) );
                }
            }
        }
    }
}
