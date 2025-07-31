   <!-- blog archive -->
   <div class="blog-card-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="blog-card-body">
                    <div class="blog-card-image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <h4><?php the_title(); ?></h4>
                    <div class="blog-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="button"> Read More</a>
                </div>
            <?php endwhile; ?>
            <div class="pagination">
                <?php
                global $wp_query;

                $big = 999999999; // need an unlikely integer

                echo paginate_links( array(
                    'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'  => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total'   => $wp_query->max_num_pages,
                    'prev_text' => __('« Prev'),
                    'next_text' => __('Next »'),
                ) );
                ?>
            </div>

        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
