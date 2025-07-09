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

<?php if (!empty($hero_images)): ?>
<section class="hero">
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">
      <?php foreach ($hero_images as $image): ?>
        <div class="swiper-slide">
          <img src="<?php echo esc_url($image); ?>" alt="Hero Image">
          <div class="hero-overlay">
            <!-- Nav Menu -->
            <nav class="hero-nav">
              <?php
              wp_nav_menu([
                  'theme_location' => 'top-menu',
                  'container' => false,
                  'menu_class' => 'nav-menu'
              ]);
              ?>
            </nav>
            <!-- Hero Content -->
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

<section class="page-wrapper">
  <div class="container">
    <div class="front-page-content">
      <?php get_template_part('includes/section', 'content'); ?>
      <a class="button" href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">Learn More</a>
    </div>
  </div>
</section>
<section> 
<?php
  $test = get_post_meta( get_the_ID(), 'secondary_text', true );
  if ( $test ) : ?>
    <section>
      <div class="secondary-text">
        <?php echo wpautop( esc_html( $test ) ); ?>
      </div>
      <div class="blog-categories-menu">
        <nav class="category-nav-grid">
          <?php
            wp_nav_menu([
              'theme_location' => 'category-menu',
              'container' => false,
              'items_wrap' => '%3$s', // strip <ul> wrapper
              'walker' => new Category_Menu_Card_Walker()
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
