<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>


<?php
$hero_images = [
    get_theme_mod('hero_image_1'),
    get_theme_mod('hero_image_2'),
    get_theme_mod('hero_image_3'),
];

$hero_images = array_filter($hero_images);
?>

<?php if (!empty($hero_images)) : ?>
  <section class="hero">
    <div class="swiper hero-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($hero_images as $image) : ?>
          <div class="swiper-slide">
            <img src="<?php echo esc_url($image); ?>" alt="Hero Image">
            <div class="hero-overlay">
              <!-- Nav Menu -->
              <nav class="hero-nav">
                <?php
                wp_nav_menu([
                    'theme_location' => 'top-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu'
                ]);
                ?>
              </nav>
              <!-- Hero Text -->
              <div class="hero-text">
                <h1><?php echo get_theme_mod('hero_heading', 'Welcome to Our Site'); ?></h1>
                <p><?php echo get_theme_mod('hero_description', 'Your tagline or description goes here.'); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div> <!-- .swiper-wrapper -->
    </div> <!-- .swiper -->
  </section>
<?php endif; ?>

<!-- Home page text  -->
<section class="page-wrapper">
  <div class="container">
    <div class="front-page-content">
      <?php get_template_part('includes/section', 'content'); ?>
      <a class="button" href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">Learn More</a>
    </div>
  </div>
</section>
<!-- Secondary Text -->
<?php
$front_page_id     = get_option('page_on_front');
$secondary_text    = get_field('secondary_text', $front_page_id);
$secondary_image   = get_field('secondary_image', $front_page_id);

if ($secondary_text || $secondary_image): ?>
  <section class="secondary-text-section">
    <div class="container">
      <div class="secondary-content"> <!-- Flex wrapper -->
        
        <?php if (!empty($secondary_image)): ?>
          <div class="secondary-image">
            <img 
              src="<?php echo esc_url($secondary_image['url']); ?>" 
              alt="<?php echo esc_attr($secondary_image['alt'] ?: 'Secondary Image'); ?>" 
              loading="lazy"
            >
          </div>
        <?php endif; ?>

        <?php if (!empty($secondary_text)): ?>
          <div class="secondary-text">
            <?php echo wp_kses_post($secondary_text); ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>
<?php endif; ?>

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
<!-- latest posts -->
<section class="latest-posts">
  <h2 class="section-title">The Latest</h2>
  <!-- <p>
    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
      See all <em>posts</em>
    </a>
  </p> -->

  <div class="post-grid">
    <?php
    $latest_posts = new WP_Query(array(
        'posts_per_page' => 4,
        'post_status' => 'publish'
    ));

    if ($latest_posts->have_posts()) :
        while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
            <div class="post-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large'); ?>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    ?>
  </div>
</section>


<?php get_footer(); ?>
</body>
</html>
