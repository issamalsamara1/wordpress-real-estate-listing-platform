<?php
get_header(); ?>

<div id="primary" class="content-area wpre-archive-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <?php
            if ( is_tax() ) {
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
            } else {
                echo '<h1 class="page-title">' . __( 'Properties', 'wp-real-estate' ) . '</h1>';
            }
            ?>
        </header>
        
        <div class="wpre-search-wrapper">
            <?php echo do_shortcode('[wpre_search_form]'); ?>
        </div>

        <?php if ( have_posts() ) : ?>
            <div class="wpre-properties-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
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
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
                <?php endwhile; ?>
            </div>
            
            <div class="wpre-pagination">
                <?php
                the_posts_pagination( array(
                    'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'wp-real-estate' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'wp-real-estate' ) . '</span>',
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wp-real-estate' ) . ' </span>',
                ) );
                ?>
            </div>
            
        <?php else : ?>
            <p><?php _e( 'No properties found.', 'wp-real-estate' ); ?></p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer();
