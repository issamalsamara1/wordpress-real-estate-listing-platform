<?php
// Search Form Template
$property_types = get_terms( array( 'taxonomy' => 'property_type', 'hide_empty' => false ) );
$property_locations = get_terms( array( 'taxonomy' => 'property_location', 'hide_empty' => false ) );
$property_statuses = get_terms( array( 'taxonomy' => 'property_status', 'hide_empty' => false ) );
?>
<form role="search" method="get" class="wpre-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="hidden" name="post_type" value="property" />

    <div class="wpre-search-fields">
        <!-- Keyword -->
        <div class="wpre-search-field">
            <input type="text" name="s" placeholder="<?php esc_attr_e( 'Search keywords...', 'wp-real-estate' ); ?>" value="<?php echo get_search_query(); ?>" />
        </div>

        <!-- Property Type -->
        <div class="wpre-search-field">
            <select name="property_type">
                <option value=""><?php _e( 'All Types', 'wp-real-estate' ); ?></option>
                <?php foreach ( $property_types as $type ) : ?>
                    <option value="<?php echo esc_attr( $type->slug ); ?>" <?php selected( get_query_var( 'property_type' ), $type->slug ); ?>>
                        <?php echo esc_html( $type->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Location -->
        <div class="wpre-search-field">
            <select name="property_location">
                <option value=""><?php _e( 'All Locations', 'wp-real-estate' ); ?></option>
                <?php foreach ( $property_locations as $location ) : ?>
                    <option value="<?php echo esc_attr( $location->slug ); ?>" <?php selected( get_query_var( 'property_location' ), $location->slug ); ?>>
                        <?php echo esc_html( $location->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Status -->
        <div class="wpre-search-field">
            <select name="property_status">
                <option value=""><?php _e( 'All Statuses', 'wp-real-estate' ); ?></option>
                <?php foreach ( $property_statuses as $status ) : ?>
                    <option value="<?php echo esc_attr( $status->slug ); ?>" <?php selected( get_query_var( 'property_status' ), $status->slug ); ?>>
                        <?php echo esc_html( $status->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Submit -->
        <div class="wpre-search-submit">
            <button type="submit" class="wpre-btn"><?php _e( 'Search', 'wp-real-estate' ); ?></button>
        </div>
    </div>
</form>
