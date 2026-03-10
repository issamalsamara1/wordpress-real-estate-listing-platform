<?php
get_header();

while ( have_posts() ) :
    the_post();

    $email = get_post_meta( get_the_ID(), '_wpre_agent_email', true );
    $phone = get_post_meta( get_the_ID(), '_wpre_agent_phone', true );
    ?>
    <div id="primary" class="content-area wpre-single-area">
        <main id="main" class="site-main">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'wpre-single-agent' ); ?>>
                <div class="wpre-agent-profile">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="wpre-agent-thumbnail">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="wpre-agent-info">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <ul class="wpre-agent-contact">
                            <?php if ( $email ) : ?>
                                <li><strong><?php _e( 'Email:', 'wp-real-estate' ); ?></strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
                            <?php endif; ?>
                            <?php if ( $phone ) : ?>
                                <li><strong><?php _e( 'Phone:', 'wp-real-estate' ); ?></strong> <?php echo esc_html( $phone ); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="entry-content">
                    <h3><?php _e('Biography', 'wp-real-estate'); ?></h3>
                    <?php the_content(); ?>
                </div>
            </article>
        </main>
    </div>
    <?php
endwhile;

get_footer();
