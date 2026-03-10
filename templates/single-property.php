<?php
get_header();

while ( have_posts() ) :
    the_post();

    $price = get_post_meta( get_the_ID(), '_wpre_property_price', true );
    $address = get_post_meta( get_the_ID(), '_wpre_property_address', true );
    $bedrooms = get_post_meta( get_the_ID(), '_wpre_property_bedrooms', true );
    $bathrooms = get_post_meta( get_the_ID(), '_wpre_property_bathrooms', true );
    $sqft = get_post_meta( get_the_ID(), '_wpre_property_sqft', true );
    ?>
    <div id="primary" class="content-area wpre-single-area">
        <main id="main" class="site-main">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'wpre-single-property' ); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    <?php if ( $price ) : ?>
                        <div class="wpre-property-price">
                            <h2>$<?php echo esc_html( number_format( $price ) ); ?></h2>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="wpre-property-gallery">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <div class="wpre-property-details">
                    <ul class="wpre-details-list">
                        <?php if ( $address ) : ?><li><strong><?php _e( 'Address:', 'wp-real-estate' ); ?></strong> <?php echo esc_html( $address ); ?></li><?php endif; ?>
                        <?php if ( $bedrooms ) : ?><li><strong><?php _e( 'Bedrooms:', 'wp-real-estate' ); ?></strong> <?php echo esc_html( $bedrooms ); ?></li><?php endif; ?>
                        <?php if ( $bathrooms ) : ?><li><strong><?php _e( 'Bathrooms:', 'wp-real-estate' ); ?></strong> <?php echo esc_html( $bathrooms ); ?></li><?php endif; ?>
                        <?php if ( $sqft ) : ?><li><strong><?php _e( 'Square Footage:', 'wp-real-estate' ); ?></strong> <?php echo esc_html( number_format( $sqft ) ); ?> sqft</li><?php endif; ?>
                    </ul>
                </div>

                <div class="entry-content">
                    <h3><?php _e('Description', 'wp-real-estate'); ?></h3>
                    <?php the_content(); ?>
                </div>
            </article>
        </main>
    </div>
    <?php
endwhile;

get_footer();
