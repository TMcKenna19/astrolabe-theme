<?php 
// *****************
// Load Style Sheets
// *****************
function load_css() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style('bootstrap');
    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all' );
    wp_enqueue_style('main');
}
add_action('wp_enqueue_scripts', 'load_css');

// ***************
// Load Javascript
// ***************
function load_js() {
    wp_enqueue_script('jquery');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true);
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js');

// ************************************
// Add preconnect tags for Google Fonts
// ************************************
function add_google_fonts_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'add_google_fonts_preconnect', 1 );

// *****************************************
// Enqueue Google Fonts and theme stylesheet
// *****************************************
function mytheme_enqueue_styles() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
        false
    );

    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

// ************
// Theme Option
// ************
add_theme_support('menus');
add_theme_support('post-thumbnails');

// ***********
// Top Nav Bar 
// ***********
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location'
    )
);

// ****************
// Footer Nav Links
// ****************
function register_footer_menus() {
    register_nav_menus( array(
        'footer_left'  => __( 'Footer Left Menu' ),
        'footer_right' => __( 'Footer Right Menu' ),
    ));
}
add_action( 'init', 'register_footer_menus' );



// ************************************************
// Header Image (gives option for image in nav bar)
// ************************************************
function mytheme_custom_header_setup() {
    add_theme_support( 'custom-header', array(
        'width'         => 1200, // Change to your preferred size
        'height'        => 400,
        'flex-width'    => true,
        'flex-height'   => true,
        'header-text'   => true,
    ));
}
add_action( 'after_setup_theme', 'mytheme_custom_header_setup' );



// ************************
// Front Page Hero Carousel
// ************************
function theme_enqueue_scripts() {
    // Swiper CSS & JS
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);

    // Optional: Your own script to initialize Swiper
    wp_enqueue_script('theme-swiper-init', get_template_directory_uri() . '/js/swiper-init.js', ['swiper-js'], null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

// ****************************
// Hero Carousel admin settings 
// ****************************
function theme_customize_register($wp_customize) {
    // Add section for Hero Images
    $wp_customize->add_section('hero_section', [
        'title'       => __('Hero Images', 'your-theme-textdomain'),
        'priority'    => 30,
        'description' => __('Upload images for the homepage hero carousel.', 'your-theme-textdomain'),
    ]);

    // Add 3 image controls
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("hero_image_$i", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "hero_image_{$i}_control",
            [
                'label'    => __("Hero Image $i", 'your-theme-textdomain'),
                'section'  => 'hero_section',
                'settings' => "hero_image_$i",
            ]
        ));
    }
}
add_action('customize_register', 'theme_customize_register');

// ********************
// Front Page Hero Text
// ******************** 
function mytheme_customize_register($wp_customize) {
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'mytheme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_heading', array('default' => 'Welcome to Our Site'));
    $wp_customize->add_setting('hero_description', array('default' => 'Your tagline or description goes here.'));

    $wp_customize->add_control('hero_heading', array(
        'label' => __('Hero Heading', 'mytheme'),
        'section' => 'hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_control('hero_description', array(
        'label' => __('Hero Description', 'mytheme'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'mytheme_customize_register');

    
// **************
// Secondary Text
// ************** 
add_post_type_support( 'page', 'custom-fields' );

// *********************************
// Front Page Blog Category Nav Menu
// *********************************
function register_custom_menus() {
    register_nav_menus([
      'category-menu' => __( 'Category Menu' ), // <--- Category Menu
      'region-menu'   => __( 'Region Menu' ), // <--- Region Menu 
    ]);
}
add_action('init', 'register_custom_menus');

// ******************************************
// Custom Walker Class for Category Card Menu
// ******************************************
class Category_Menu_Card_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // No submenus needed
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // No submenus
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Get ACF background image for this menu item
        $background_image = get_field('background_image', $item);
        $bg_style = '';

        if ($background_image && isset($background_image['url'])) {
            $bg_style = 'style="background-image: url(' . esc_url($background_image['url']) . ');"';
        }

        // Start anchor tag and assign .category-card class and background image style
        $output .= '<a href="' . esc_url($item->url) . '" class="category-card" ' . $bg_style . '>';
        $output .= '<span class="category-title">' . esc_html($item->title) . '</span>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        // Close anchor tag
        $output .= '</a>';
    }
}

// ***********
// Region Menu
// ***********
class Region_Menu_Card_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {}

    function end_lvl(&$output, $depth = 0, $args = null) {}

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $background_image = get_field('background_image', $item);
        $bg_style = '';

        if ($background_image && isset($background_image['url'])) {
            $bg_style = 'style="background-image: url(' . esc_url($background_image['url']) . ');"';
        }

        $output .= '<a href="' . esc_url($item->url) . '" class="region-card" ' . $bg_style . '>';
        $output .= '<span class="region-title">' . esc_html($item->title) . '</span>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</a>';
    }
}

// *******************
// About Page Carousel
// *******************
function theme_customize_about_images($wp_customize) {
    $wp_customize->add_section('about_section', [
        'title'       => __('About Page Images', 'your-theme-textdomain'),
        'priority'    => 35,
        'description' => __('Upload images for the About page carousel.', 'your-theme-textdomain'),
    ]);

    for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting("about_image_$i", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "about_image_{$i}_control",
            [
                'label'    => __("About Image $i", 'your-theme-textdomain'),
                'section'  => 'about_section',
                'settings' => "about_image_$i",
            ]
        ));
    }
}
add_action('customize_register', 'theme_customize_about_images');

// *******************************
// Blog card custom excerpt length
// *******************************
function custom_excerpt_length( $length ) {
    return 30; // Change to desired word count
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );

function custom_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

// **********************
// Postcard social links 
// **********************
function register_postcard_social_links_menu() {
    register_nav_menu('postcard_links', __( 'Postcard Links' ));
}
add_action('init', 'register_postcard_social_links_menu');

// ***********************
// Footer Social Link Img
// ***********************  
class Image_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        // Get ACF image for this menu item
        $image_id = get_post_meta($item->ID, 'footer_soc', true);
        $image_url = wp_get_attachment_url($image_id);

        // Prepare link attributes
        $attributes  = ' href="' . esc_url($item->url) . '"';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

        // Start list item
        $output .= '<li class="' . esc_attr(implode(' ', $item->classes)) . '">';

        // Output the link with image or text
        $output .= '<a' . $attributes . '>';
        if ($image_url) {
            $output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '">';
        } else {
            $output .= esc_html($item->title);
        }
        $output .= '</a>';
    }
}





?>
