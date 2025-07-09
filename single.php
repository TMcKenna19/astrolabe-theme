<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
    <section class="page-wrapper">
        <?php the_content(); ?> 
    </section>

<?php endwhile; endif; ?>