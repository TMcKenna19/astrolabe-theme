<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>

    <?php wp_head();?>
</head>
<body>

<header>
    <!-- Option to add header image  -->
    <?php if ( get_header_image() ) : ?>
            <div class="header-image">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php header_image(); ?>" 
                         width="<?php echo get_custom_header()->width; ?>" 
                         height="<?php echo get_custom_header()->height; ?>" 
                         alt="<?php bloginfo( 'name' ); ?>" />
                </a>
            </div>
    <?php endif; ?>

    <div class='container'>
        <?php 
        wp_nav_menu(
            array(
                'theme_location' => 'top-menu',
                'menu_class' => 'top-bar'
            )
        );
        ?>
    </div>
</header>
    
