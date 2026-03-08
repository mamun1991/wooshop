<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');
function crb_load() {
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_text', 'Text Field' ),
            Field::make( 'complex', 'crb_slider', __( 'Slider Images' ) )
            ->add_fields( array(
                Field::make( 'image', 'photo', __( 'Slide Image' ) ),
            ) )
        ) );    

        Container::make( 'theme_options', __( 'Social Media' ) )
            ->add_fields( array(
                Field::make( 'text', 'crb_facebook_url', __( 'Facebook URL' ) ),
                Field::make( 'text', 'crb_twitter_url', __( 'Twitter URL' ) ),
                Field::make( 'text', 'crb_instagram_url', __( 'Instagram URL' ) ),
                Field::make( 'text', 'crb_linkedin_url', __( 'LinkedIn URL' ) ),
                Field::make( 'text', 'crb_youtube_url', __( 'YouTube URL' ) ),
            ) );

        Container::make('nav_menu_item', __('Menu Settings'))
            ->add_fields(array(
                Field::make('color', 'crb_color', __('Menu Color')),
            ));
}

add_filter('nav_menu_link_attributes', 'mytheme_menu_color', 10, 3);
function mytheme_menu_color($atts, $item, $args) {

    if (!isset($item->ID)) {
        return $atts;
    }

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

    // Alpine JS (local)
    wp_enqueue_script(
        'theme-alpine',
        get_template_directory_uri() . '/src/alpine.min.js',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'theme-main',
        get_template_directory_uri() . '/src/main.js',
        ['theme-alpine'],
        null,
        true
    );

    wp_enqueue_script(
        'alpine-cart',
        get_template_directory_uri() . '/src/alpinecart.js',
        ['theme-alpine'], // <-- dependency fixed
        null,
        true
    );

    // Pass AJAX URL to Alpine cart
    wp_localize_script('alpine-cart', 'wooCartSettings', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'theme_assets');

add_action('after_setup_theme', 'mytheme_setup');
function mytheme_setup() {
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'register_custom_menus');
function register_custom_menus() {
    // Register one or more custom menus
    register_nav_menus(array(
        'header_menu' => esc_html__('Header Menu', 'mytheme'),
        'footer_menu' => esc_html__('Footer Menu', 'mytheme'),
        'woocommerce_menu' => esc_html__('WooCommerce Menu', 'mytheme')
    ));
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

// Remove default WooCommerce pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

add_action('pre_get_posts', function($query){
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive('product') ) {
        $query->set('posts_per_page', 10);
    }
});

//================================================================

// --- WooCommerce AJAX handlers ---
// Get cart items
add_action('wp_ajax_get_cart', 'custom_get_cart');
add_action('wp_ajax_nopriv_get_cart', 'custom_get_cart');
function custom_get_cart() {
    $items = [];
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        $items[] = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'price' => (float) $product->get_price(),
            'quantity' => $cart_item['quantity'],
            'image' => wp_get_attachment_image_url($product->get_image_id(), 'thumbnail')
        ];
    }
    wp_send_json(['items' => $items]);
}

// Add item to cart
add_action('wp_ajax_add_to_cart_custom', 'custom_add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart_custom', 'custom_add_to_cart');
function custom_add_to_cart() {
    $product_id = intval($_POST['product_id']);
    $quantity   = intval($_POST['quantity']);
    WC()->cart->add_to_cart($product_id, $quantity);

    // Return updated cart
    $items = [];
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        $items[] = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'price' => (float) $product->get_price(),
            'quantity' => $cart_item['quantity'],
            'image' => wp_get_attachment_image_url($product->get_image_id(), 'thumbnail')
        ];
    }
    wp_send_json(['items' => $items]);
}

// Remove item from cart
add_action('wp_ajax_remove_cart_item', 'custom_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'custom_remove_cart_item');
function custom_remove_cart_item() {
    $product_id = intval($_POST['product_id']);
    foreach (WC()->cart->get_cart() as $key => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            WC()->cart->remove_cart_item($key);
            break;
        }
    }

    // Return updated cart
    $items = [];
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        $items[] = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'price' => (float) $product->get_price(),
            'quantity' => $cart_item['quantity'],
            'image' => wp_get_attachment_image_url($product->get_image_id(), 'thumbnail')
        ];
    }
    wp_send_json(['items' => $items]);
}


add_filter('woocommerce_add_to_cart_fragments', function($fragments) {
    ob_start();
    ?>
    <span id="cartCount" class="absolute -top-2 -right-2 bg-white text-primary text-xs w-5 h-5 flex items-center justify-center rounded-full">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['#cartCount'] = ob_get_clean();
    return $fragments;
});

function my_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'my_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('add_to_cart_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

function add_product_to_cart_ajax() {
    check_ajax_referer('add_to_cart_nonce', 'nonce');

    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if($product_id > 0){
        $added = WC()->cart->add_to_cart($product_id, $quantity);

        if($added){
            // Build cart HTML
            ob_start();
            foreach(WC()->cart->get_cart() as $cart_item){
                $product = $cart_item['data'];
                echo '<div class="flex items-center gap-4">
                        <img src="'.wp_get_attachment_url($product->get_image_id()).'" class="w-16 h-16 object-cover rounded" alt="'.$product->get_name().'">
                        <div>
                            <p class="font-bold">'.$product->get_name().'</p>
                            <p class="text-sm text-primary font-semibold">$'.$product->get_price().'</p>
                        </div>
                      </div>';
            }
            $cart_contents = ob_get_clean();

            wp_send_json_success(array(
                'cart_contents' => $cart_contents,
                'cart_total' => WC()->cart->get_cart_total()
            ));
        }
    }

    wp_send_json_error();
}
add_action('wp_ajax_add_product_to_cart', 'add_product_to_cart_ajax');
add_action('wp_ajax_nopriv_add_product_to_cart', 'add_product_to_cart_ajax');

























?>