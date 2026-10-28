<!-- blog archive -->
<div class="blog-archive">
    <div class="blog-card-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="blog-card-body">
                    <div class="blog-card-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    </div>
                    <h4>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                    <div class="blog-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="more">
                        <a href="<?php the_permalink(); ?>" class="button">Read More</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="no-posts">
                <p>No posts found.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="pagination">
        <?php
            global $wp_query;
            $big = 999999999; // need an unlikely integer

            echo paginate_links( array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'current'   => max( 1, get_query_var( 'paged' ) ),
                'total'     => $wp_query->max_num_pages,
                'prev_text' => __( '« Prev' ),
                'next_text' => __( 'Next »' ),
            ) );
        ?>
    </div>
</div>

   
