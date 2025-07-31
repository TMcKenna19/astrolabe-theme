<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <div class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">Posted on <?php echo get_the_date(); ?></span>
                        <span class="byline"> by <?php the_author(); ?></span>
                    </div>
                </div>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <div class="post-categories">
                        Categories: <?php the_category(', '); ?>
                    </div>
                    <div class="post-tags">
                        <?php the_tags('Tags: ', ', ', ''); ?>
                    </div>
                </footer>
            </article>

            <?php
            // Comments section
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
