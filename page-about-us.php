<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<?php 
$about_hero_image = get_field('about_hero_image');
$about_hero_text = get_field('about_hero_text');
$about_image = get_field('about_image');
$about_copy_image = get_field('about_copy_image');
$about_copy_image_text = get_field('about_copy_image_text');
$about_image_one = get_field('about_image_one');
$about_image_one_copy = get_field('about_image_one_copy');
$about_image_two = get_field('about_image_two');
$about_image_two_copy = get_field('about_image_two_copy');
$about_profile_image_one = get_field('about_profile_image_one');
$about_profile_copy_one = get_field('about_profile_copy_one');
$about_profile_image_two = get_field('about_profile_image_two');
$about_profile_copy_two = get_field('about_profile_copy_two');
$about_profile_image_three = get_field('about_profile_image_three');
$about_profile_copy_three = get_field('about_profile_copy_three');
$about_image_three = get_field('about_image_three');
$about_image_three_copy = get_field('about_image_three_copy');
$about_image_four = get_field('about_image_four');
$about_image_four_copy = get_field('about_image_four_copy');
$about_group_images_copy = get_field('group_images_copy');
$group_image_one = get_field('group_image_one');
$group_image_two = get_field('group_image_two');
$group_image_three = get_field('group_image_three');
$about_group_images = [
[
  'image' => $group_image_one,
  'class' => 'group-image-one',
],
[
  'image' => $group_image_two,
  'class' => 'group-image-two'
],
[
  'image' => $group_image_three,
  'class' => 'group-image-three'
]
];
?>

<div class="about-page">
  <div class="container">
    <div class="about-hero">
        <?php if ($about_hero_image || $about_hero_text): ?>
          <div class="about-hero-wrapper" style="background-image: url('<?php echo esc_url($about_hero_image['url']); ?>');">
            <div class="about-hero-overlay"></div>
            <div class="about-hero-text">
              <h1><?php echo esc_html($about_hero_text); ?></h1>
            </div>
          </div>
        <?php endif; ?>
    </div>  
    <div class="about-content">
      <?php
      if ($about_image): ?>
        <div class="about-image">
          <img src="<?php echo esc_url($about_image['url']); ?>" alt="<?php echo esc_attr($about_image['alt']); ?>">
        </div>
      <?php endif; ?>
      <div class="about-text">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            the_content();
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </div>
  <!-- Swiper -->
  <?php
    $about_images = [];

    for ($i = 1; $i <= 10; $i++) {
        $img = get_theme_mod("about_image_$i");
        if (!empty($img)) {
            $about_images[] = $img;
        }
    }
    ?>

  <?php if (!empty($about_images)) : ?>
    <div class="about-carousel">
      <div class="swiper about-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($about_images as $image) : ?>
            <div class="swiper-slide">
              <img src="<?php echo esc_url($image); ?>" alt="About Image">
            </div>
          <?php endforeach; ?>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  <?php endif; ?>
  <?php if (!empty($about_copy_image || $about_copy_image_text)) : ?>
    <div class="container">
      <div class="about-copy-image">
            <div class="about-copy-image-wrapper" style="background-image: url('<?php echo esc_url($about_copy_image['url']); ?>');">
              <div class="about-copy-image-overlay"></div>
              <div class="about-copy-image-text">
                <p><?php echo esc_html($about_copy_image_text); ?></p>
              </div>
            </div>
      </div>  
    </div>
  <?php endif; ?>
  <div class="about-image-one-content">
    <?php
    if ($about_image_one || $about_image_one_copy): ?>
      <div class="about-image-one-copy">
        <p> <?php echo esc_html($about_image_one_copy)?> </p>
      </div>
      <div class="about-image-one">
        <img src="<?php echo esc_url($about_image_one['url']); ?>" alt="<?php echo esc_attr($about_image_one['alt']); ?>">
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="about-image-two-content">
    <?php
      if ($about_image_two || $about_image_two_copy): ?>
        <div class="about-image-two">
          <img src="<?php echo esc_url($about_image_two['url']); ?>" alt="<?php echo esc_attr($about_image_two['alt']); ?>">
        </div>
        <div class="about-image-two-copy">
          <p> <?php echo esc_html($about_image_two_copy)?> </p>
        </div>
    <?php endif; ?>
  </div>
  <!-- Profile -->
  <div class="profile-content">
    <div class="profile">
      <?php
        if ($about_profile_image_one || $about_profile_copy_one): ?>
          <div class="profile-one-image">
            <img src="<?php echo esc_url($about_profile_image_one['url']); ?>" alt="<?php echo esc_attr($about_profile_image_one['alt']); ?>">
          </div>
          <div class="profile-one-copy">
            <p><?php echo esc_html($about_profile_copy_one)?></p>
          </div>
      <?php endif; ?>
    </div>
    <div class="profile">
      <?php
        if ($about_profile_image_two || $about_profile_copy_two): ?>
          <div class="profile-two-copy">
            <p><?php echo esc_html($about_profile_copy_two)?></p>
          </div>
          <div class="profile-two-image">
            <img src="<?php echo esc_url($about_profile_image_two['url']); ?>" alt="<?php echo esc_attr($about_profile_image_two['alt']); ?>">
          </div>
      <?php endif; ?>
    </div>
    <div class="profile">
      <?php
        if ($about_profile_image_three || $about_profile_copy_three): ?>
          <div class="profile-three-image">
            <img src="<?php echo esc_url($about_profile_image_three['url']); ?>" alt="<?php echo esc_attr($about_profile_image_three['alt']); ?>">
          </div>
          <div class="profile-three-copy">
            <p><?php echo esc_html($about_profile_copy_three)?></p>
          </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- about image three / four -->
  <div class="group-three-four">
    <div class="about-image-three-content">
      <?php if (!empty($about_image_three || $about_image_three_copy)) : ?>
        <div class="about-image-three">
          <img src="<?php echo esc_url($about_image_three['url']); ?>" alt="<?php echo esc_attr($about_image_three['alt']); ?>">
        </div>
        <div class="about-image-three-copy">
          <p><?php echo esc_html($about_image_three_copy)?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="about-image-four-content">
      <?php if (!empty($about_image_four || $about_image_four_copy)) : ?>
        <div class="about-image-four-copy">
          <p><?php echo esc_html($about_image_four_copy)?></p>
        </div>
        <div class="about-image-four">
          <img src="<?php echo esc_url($about_image_four['url']); ?>" alt="<?php echo esc_attr($about_image_four['alt']); ?>">
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="about-group-images-content">
    <div class="about-group-images-copy">
      <?php if (!empty($about_group_images_copy)) : ?>
        <div class="about-group-images-copy">
          <p><?php echo esc_html($about_group_images_copy); ?></p>
        </div>
      <?php endif; ?>
    </div>
    <div class="about-group-images">
      <?php foreach ($about_group_images as $group_item) : ?>
        <div class="<?php echo esc_attr($group_item['class']); ?>">
          <img
            src="<?php echo esc_url($group_item['image']['url']); ?>"
            alt="<?php echo esc_attr($group_item['image']['alt']); ?>"
          >
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
</body>
</html>



