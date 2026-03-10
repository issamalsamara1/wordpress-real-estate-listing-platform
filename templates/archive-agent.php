<?php
get_header(); ?>

<div id="primary" class="content-area wpre-archive-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title"><?php _e( 'Agents', 'wp-real-estate' ); ?></h1>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="wpre-agents-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    $phone = get_post_meta( get_the_ID(), '_wpre_agent_phone', true );
                    ?>
                    <div class="wpre-agent-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="wpre-agent-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="wpre-agent-info">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if ( $phone ) : ?>
                                <p class="wpre-meta">
                                    <span><?php echo esc_html( $phone ); ?></span>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <div class="wpre-pagination">
                <?php the_posts_pagination(); ?>
            </div>
            
        <?php else : ?>
            <p><?php _e( 'No agents found.', 'wp-real-estate' ); ?></p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer();
