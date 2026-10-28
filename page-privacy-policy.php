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

<section class="page-wrapper">
    <div class="container">
        <div class="privacy-policy-content">
            <!-- <h5> <?php the_title();?> </h5> -->
            <?php get_template_part('includes/section', 'content'); ?>
        </div>
    </div>
</section>

<?php get_footer()?>
</body>
</html>