<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_text', 'Text Field' ),
        ) );    

        Container::make( 'theme_options', __( 'Social Media' ) )
            ->add_fields( array(
                Field::make( 'text', 'crb_facebook_url', __( 'Facebook URL' ) ),
                Field::make( 'text', 'crb_twitter_url', __( 'Twitter URL' ) ),
                Field::make( 'text', 'crb_instagram_url', __( 'Instagram URL' ) ),
            ) );

        Container::make('nav_menu_item', __('Menu Settings'))
            ->add_fields(array(
                Field::make('color', 'crb_color', __('Menu Color')),
            ));
}

add_action('after_setup_theme', 'crb_load');
function crb_load() {
    \Carbon_Fields\Carbon_Fields::boot();
}

add_filter('nav_menu_link_attributes', 'mytheme_menu_color', 10, 3);

function mytheme_menu_color($atts, $item, $args) {

    $color = carbon_get_nav_menu_item_meta($item->ID, 'crb_color');

    if ($color) {
        $atts['style'] = 'color:' . esc_attr($color);
    }

    return $atts;
}

function theme_assets() {
    wp_enqueue_style(
        'theme-css',
        get_template_directory_uri() . '/src/output.css',
        [],
        null
    );

    wp_enqueue_script(
        'theme-main',
        get_template_directory_uri() . '/src/main.js',
        [],
        null
    );

    // Alpine JS (local)
    wp_enqueue_script(
        'theme-alpine',
        get_template_directory_uri() . '/src/alpine.min.js',
        [],
        null,
        true
    );
    
     wp_localize_script('theme-main', 'siteConfig', [
        'storeApi' => home_url('/wp-json/wc/store'),
        'nonce' => wp_create_nonce('wc_store_api'),
        'ajaxUrl'  => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'theme_assets');

add_action('after_setup_theme', 'register_custom_menus');
function register_custom_menus() {
    // Register one or more custom menus
    register_nav_menus(array(
        'header_menu' => esc_html__('Header Menu', 'mytheme'),
        'footer_menu' => esc_html__('Footer Menu', 'mytheme'),
        'woocommerce_menu' => esc_html__('WooCommerce Menu', 'mytheme')
    ));
}

add_action('after_setup_theme', 'mytheme_setup');
function mytheme_setup() {
    add_theme_support('woocommerce');
}

function add_menu_link_class($atts, $item, $args) {

    if ($args->theme_location == 'header_menu') {
        $atts['class'] = 'text-slate-700 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);

function mytheme_customize_registers($wp_customize) {

    // Section
    $wp_customize->add_section('theme_options', array(
        'title' => __('Theme Options', 'mytheme'),
        'priority' => 30,
    ));

    // Logo
    $wp_customize->add_setting('site_logo');
    $wp_customize->add_control(new \WP_Customize_Image_Control(
        $wp_customize,
        'site_logo',
        array(
            'label' => __('Site Logo', 'mytheme'),
            'section' => 'theme_options',
            'settings' => 'site_logo',
        )
    ));

    // Mobile Number
    $wp_customize->add_setting('mobile_number');
    $wp_customize->add_control('mobile_number', array(
        'label' => __('Mobile Number', 'mytheme'),
        'section' => 'theme_options',
        'type' => 'text',
    ));

}
add_action('customize_register', 'mytheme_customize_registers');

add_action('pre_get_posts', function($query){
    if(!is_admin() && $query->is_main_query() && is_shop()){
        $query->set('posts_per_page', 10);
    }
});

// add_action('pre_get_posts', function($query){
//     if (!is_admin() && $query->is_main_query() && is_shop()) {
//         // Ensure paged uses query string
//         $query->set('paged', isset($_GET['paged']) ? intval($_GET['paged']) : 1);
//     }
// });

function mytheme_customize_register($wp_customize) {

    // ===========================
    // Header Settings
    // ===========================
    $wp_customize->add_section('header_settings', array(
        'title'    => __('Header Settings', 'mytheme'),
        'priority' => 20,
    ));

    // Header Logo
    $wp_customize->add_setting('header_logo');
    $wp_customize->add_control(
        new \WP_Customize_Image_Control(
            $wp_customize,
            'header_logo',
            array(
                'label'    => __('Header Logo', 'mytheme'),
                'section'  => 'header_settings',
                'settings' => 'header_logo',
            )
        )
    );

    // Header Text / Content
    $wp_customize->add_setting('header_content', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post', // allow HTML
    ));
    $wp_customize->add_control('header_content', array(
        'label'    => __('Header Content', 'mytheme'),
        'section'  => 'header_settings',
        'type'     => 'textarea',
    ));

    // ===========================
    // Footer Settings
    // ===========================
    $wp_customize->add_section('footer_settings', array(
        'title'    => __('Footer Settings', 'mytheme'),
        'priority' => 30,
    ));

    // Footer Text
    $wp_customize->add_setting('footer_content', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('footer_content', array(
        'label'    => __('Footer Content', 'mytheme'),
        'section'  => 'footer_settings',
        'type'     => 'textarea',
    ));

    // Footer Phone
    $wp_customize->add_setting('footer_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_phone', array(
        'label'    => __('Footer Phone', 'mytheme'),
        'section'  => 'footer_settings',
        'type'     => 'text',
    ));

}
add_action('customize_register', 'mytheme_customize_register');

add_action('wp_ajax_update_cart_item', 'theme_update_cart_item');
add_action('wp_ajax_nopriv_update_cart_item', 'theme_update_cart_item');

function theme_update_cart_item() {

    if ( ! isset($_POST['cart_item_key']) || ! isset($_POST['quantity']) ) {
        wp_send_json_error();
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity      = intval($_POST['quantity']);

    if ($quantity < 1) {
        WC()->cart->remove_cart_item($cart_item_key);
    } else {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
    }

    WC()->cart->calculate_totals();

    wp_send_json_success([
        'count' => WC()->cart->get_cart_contents_count()
    ]);
}











?>