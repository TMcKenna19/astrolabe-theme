<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Header -->
<?php get_header()?>

<!-- Hero Slider Images -->
<?php
$feature_image = get_field('feature_image');
$feature_copy = get_field('feature_copy');
$hero_images = [
    get_theme_mod('hero_image_1'),
    get_theme_mod('hero_image_2'),
    get_theme_mod('hero_image_3'),
];
$hero_images = array_filter($hero_images);
?>

<!-- Hero -->
<?php if (!empty($hero_images)) : ?>
  <section class="hero">
    <div class="swiper hero-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($hero_images as $image) : ?>
          <div class="swiper-slide">
            <img src="<?php echo esc_url($image); ?>" alt="Hero Image">
            <div class="hero-overlay">
              <!-- Hero Text -->
              <div class="hero-text">
                <h1><?php echo get_theme_mod('hero_heading', 'Welcome to Our Site'); ?></h1>
                <p><?php echo get_theme_mod('hero_description', 'Your tagline or description goes here.'); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
<!-- Feature -->
<div class="feature-content">
    <?php
      if ($feature_image || $feature_copy): ?>
        <div class="feature-image">
          <img src="<?php echo esc_url($feature_image['url']); ?>" alt="<?php echo esc_attr($feature_image['alt']); ?>">
        </div>
    <?php endif; ?>
    <div class="feature-copy">
        <?php echo wp_kses_post($feature_copy); ?>
    </div>  
</div>
<!-- Latest Posts -->
<section class="latest-posts">
    <h2>Latest Reads</h2>
    <div class="latest-card-grid">
        <?php
        $latest_posts = new WP_Query(
            array(
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            )
        );

        if ($latest_posts->have_posts()) :
            while ($latest_posts->have_posts()) :
                $latest_posts->the_post();
                ?>
                <article class="latest-card-body">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="latest-card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                the_post_thumbnail(
                                    'medium_large',
                                    array(
                                        'loading' => 'lazy',
                                        'alt'     => the_title_attribute(
                                            array(
                                                'echo' => false,
                                            )
                                        ),
                                    )
                                );
                                ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <h4 class="latest-card-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                    <div class="more">
                      <a href="<?php the_permalink(); ?>" class="button">Read More</a>
                    </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p>No posts found.</p>
            <?php
        endif;
        ?>
    </div>
</section>
<!-- Secondary Text -->
<?php
$front_page_id   = get_option('page_on_front');
$secondary_text  = get_field('secondary_text', $front_page_id);
$secondary_image = get_field('secondary_image', $front_page_id);
?>

<section class="secondary-text-section">
  <?php if ($secondary_text || $secondary_image): ?>
    <div class="container">
      <div class="secondary-content"> <!-- Flex wrapper -->
        <div class="secondary-image">
          <img 
            src="<?php echo esc_url($secondary_image['url']); ?>" 
            alt="<?php echo esc_attr($secondary_image['alt'] ?: 'Secondary Image'); ?>" 
            loading="lazy"
          >
        </div>
        <div class="secondary-text">
          <?php echo wp_kses_post($secondary_text); ?>
          <div class="more">
            <a class="button-two" href="<?php echo esc_url( home_url( '/category/blog' ) ); ?>">Explore More</a>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>


<!-- Region Grid Menu -->
<section class="region-grid-section">
<h2 class="section-title">Where Shall We Go?</h2>
  <?php if (has_nav_menu('region-menu')) : ?>
    <div class="container">
      <nav class="region-nav-grid">
        <?php
          wp_nav_menu([
            'theme_location' => 'region-menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new Region_Menu_Card_Walker()
          ]);
        ?>
      </nav>
    </div>
  <?php endif; ?>
</section>

<!-- Front Page Text  -->
<?php
$front_page_id = get_option('page_on_front');
$front_page_image = get_field('front_page_image');
$front_page_img_copy = get_field('front_page_img_copy');
?>

<section class="front-page-section">
  <?php if (!empty($front_page_image || $front_page_img_copy)) : ?>
      <div class="container">
        <div class="front-page-image">
              <div class="front-page-image-wrapper" style="background-image: url('<?php echo esc_url($front_page_image['url']); ?>');">
                <div class="front-page-image-overlay"></div>
                <div class="front-page-image-copy">
                  <p><?php echo esc_html($front_page_img_copy); ?></p>
                </div>
              </div>
        </div>  
      </div>
    <?php endif; ?>
</section>

<!-- Category Grid Menu -->
<?php
if (has_nav_menu('category-menu')) : ?>
  <section class="category-grid-section">
    <div class="container">
      <nav class="category-nav-grid">
        <?php
          wp_nav_menu([
            'theme_location' => 'category-menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new Category_Menu_Card_Walker(),
          ]);
        ?>
      </nav>
    </div>
  </section>
<?php endif; ?>
</section>
<?php get_footer(); ?>
</body>
</html>
