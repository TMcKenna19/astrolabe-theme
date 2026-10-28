<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_header()?>
<?php 
$contact_hero_image = get_field('contact_hero_image');
$contact_hero_text = get_field('contact_hero_text');
$postcard_image = get_field('postcard_image');
$postcard_image_text = get_field('postcard_image_text');

?>
<div class="contact-page">
  <div class="container">
    <div class="contact-hero">
        <?php if ($contact_hero_image): ?>
          <div class="contact-hero-wrapper" style="background-image: url('<?php echo esc_url($contact_hero_image['url']); ?>');">
            <div class="contact-hero-overlay"></div>
            <div class="contact-hero-text">
              <h1><?php echo esc_html($contact_hero_text); ?></h1>
            </div>
          </div>
        <?php endif; ?>
    </div>
    <div class="contact-copy">
        <div>
            <?php get_template_part('includes/section', 'content'); ?>
        </div>
    </div>
    <div class="postcard">
      <?php if ($postcard_image): ?>
        <div class="postcard-wrapper">
          <img src="<?php echo esc_url($postcard_image['url']); ?>" alt="Postcard Image">
          <div class="postcard-image-text">
            <p><?php echo esc_html($postcard_image_text); ?></p>
          </div>
        </div>
      <?php endif; ?>
      <div class="contact-social-list">
          <?php
          wp_nav_menu(array(
              'theme_location' => 'postcard_links',
              'container' => 'nav',
              'container_class' => 'postcard-links-nav',
              'menu_class' => 'postcard-links-menu',
          ));
          ?>
    </div>
    </div>
    
  </div>
</div>

<?php get_footer()?>
</body>
</html>