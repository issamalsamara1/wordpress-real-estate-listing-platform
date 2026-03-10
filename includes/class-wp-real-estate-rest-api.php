<?php
class WP_Real_Estate_REST_API {
    public function init() {
        add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
        add_filter( 'rest_property_query', array( $this, 'filter_rest_property_query' ), 10, 2 );
    }

    public function register_rest_routes() {
        register_rest_field( 'property', 'property_meta', array(
            'get_callback' => array( $this, 'get_property_meta' ),
            'schema'       => null,
        ) );
    }

    public function get_property_meta( $object, $field_name, $request ) {
        return array(
            'price'     => get_post_meta( $object['id'], '_wpre_property_price', true ),
            'address'   => get_post_meta( $object['id'], '_wpre_property_address', true ),
            'bedrooms'  => get_post_meta( $object['id'], '_wpre_property_bedrooms', true ),
            'bathrooms' => get_post_meta( $object['id'], '_wpre_property_bathrooms', true ),
            'sqft'      => get_post_meta( $object['id'], '_wpre_property_sqft', true ),
        );
    }

    public function filter_rest_property_query( $args, $request ) {
        if ( isset( $request['min_price'] ) || isset( $request['max_price'] ) ) {
            $meta_query = array();
            
            if ( isset( $request['min_price'] ) ) {
                $meta_query[] = array(
                    'key'     => '_wpre_property_price',
                    'value'   => intval( $request['min_price'] ),
                    'compare' => '>=',
                    'type'    => 'NUMERIC'
                );
            }
            
            if ( isset( $request['max_price'] ) ) {
                $meta_query[] = array(
                    'key'     => '_wpre_property_price',
                    'value'   => intval( $request['max_price'] ),
                    'compare' => '<=',
                    'type'    => 'NUMERIC'
                );
            }

            $args['meta_query'] = $meta_query;
        }

        return $args;
    }
}
