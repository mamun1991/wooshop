<?php 
    get_header(); 
    while ( have_posts() ) : the_post();
    global $product;
    endwhile;
?>

<main class="flex-1 px-6 md:px-20 py-8 max-w-[1440px] mx-auto w-full" data-scroll-animate>
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 mb-8 text-sm font-medium">
        <?php
                    if (function_exists('woocommerce_breadcrumb')) {
                        woocommerce_breadcrumb(array(
                            'delimiter'   => '<span class="mx-2 text-slate-400">/</span>',
                            'wrap_before' => '<div class="flex items-center">',
                            'wrap_after'  => '</div>',
                            'before'      => '',
                            'after'       => '',
                            'home'        => _x('Home', 'breadcrumb', 'mytheme'),
                        ));
                    }
                    ?>
    </nav>
    <!-- Product Hero Section -->

    <?php 
        $main_image_id = $product->get_image_id();
        $main_image = wp_get_attachment_image_url($main_image_id,'full');
        $gallery_ids = $product->get_gallery_image_ids(); 
        $gallery_ids = array_slice($gallery_ids, 0, 4);
        // array_unshift($gallery_ids, $main_image_id);
    ?>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Image Gallery Column -->
        <div class="lg:col-span-7 flex flex-col gap-4" x-data="{ activeImage: '<?php echo esc_url($main_image); ?>', zoom: false, x: 0, y: 0 }">
            <div
                class="w-full aspect-square bg-slate-200 dark:bg-slate-800 rounded-xl overflow-hidden relative"
                @mouseenter="zoom = true"
                @mouseleave="zoom = false"
                @mousemove="x = $event.offsetX; y = $event.offsetY"
            >
                <img :src="activeImage" class="w-full h-full object-cover transition-transform duration-200"
                    :style="zoom 
                        ? `transform: scale(2) translate(${50 - (x / $el.offsetWidth * 100)}%, ${50 - (y / $el.offsetHeight * 100)}%)` 
                        : 'transform: scale(1) translate(0,0)'"
                    alt="<?php the_title(); ?>"
                >
            </div>
            <div class="grid grid-cols-4 gap-4">
                <?php if ( $gallery_ids ) : ?>
                    <?php foreach ( $gallery_ids as $gallery_id ) : 
                        $image = wp_get_attachment_image_url($gallery_id,'full');
                        $thumb = wp_get_attachment_image_url($gallery_id,'thumbnail');
                    ?>
                        <div
                            @click="activeImage = '<?php echo esc_url($image); ?>'"
                            :class="activeImage === '<?php echo esc_url($image); ?>' ? 'border-primary shadow' : 'border-transparent'"
                            class="aspect-square rounded-lg border overflow-hidden cursor-pointer"
                        >
                            <img src="<?php echo esc_url($thumb); ?>" class="w-full h-full object-cover" >
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                        <p class="text-slate-500 dark:text-slate-400 col-span-4 text-center py-4">No additional images available.</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Product Details Column -->
        <div class="lg:col-span-5 flex flex-col">
            <div class="mb-6">
                <!-- <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest rounded-full mb-4">Luxe Essentials</span> -->
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-slate-100 leading-tight mb-2"><?php the_title(); ?></h1>
                <div class="flex items-center gap-4 mb-4">
                    <p class="text-3xl font-bold text-primary"><?php echo $product->get_price_html(); ?></p>
                    <div class="flex items-center text-yellow-500">
                        <span class="material-symbols-outlined fill-1">star</span>
                        <span class="material-symbols-outlined fill-1">star</span>
                        <span class="material-symbols-outlined fill-1">star</span>
                        <span class="material-symbols-outlined fill-1">star</span>
                        <span class="material-symbols-outlined text-slate-300">star</span>
                        <span class="ml-2 text-sm text-slate-500 font-medium">(124 Reviews)</span>
                    </div>
                </div>
                <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
                </p>
            </div>
            <!-- Options -->
            <div class="space-y-6 mb-8">
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-slate-100 mb-3">Color: <span class="text-slate-500 font-medium">Cognac Brown</span></h3>
                    <div class="flex gap-3">
                        <button class="size-10 rounded-full bg-[#8b4513] ring-2 ring-offset-2 ring-primary border border-black/10"></button>
                        <button class="size-10 rounded-full bg-[#2c2c2c] border border-black/10 hover:ring-2 hover:ring-offset-2 hover:ring-slate-300 transition-all"></button>
                        <button class="size-10 rounded-full bg-[#4a5d4e] border border-black/10 hover:ring-2 hover:ring-offset-2 hover:ring-slate-300 transition-all"></button>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-slate-100 mb-3">Size</h3>
                    <div class="flex gap-2">
                        <button class="px-6 py-2 rounded-lg border border-slate-200 dark:border-slate-800 font-medium hover:border-primary hover:text-primary transition-all">Standard 15L</button>
                        <button class="px-6 py-2 rounded-lg border-2 border-primary bg-primary/5 text-primary font-bold">Large 22L</button>
                    </div>
                </div>
            </div>
            <!-- CTA -->
            <div class="flex flex-col sm:flex-row gap-4 mb-10 product-card" 
                data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                data-product-name="<?php echo esc_attr($product->get_name()); ?>"
                data-product-price="<?php echo esc_attr($product->get_price()); ?>"
                data-product-image="<?php echo esc_url($main_image); ?>">
                <button class="flex-1 bg-primary hover:bg-primary/90 cursor-pointer text-white font-bold py-4 px-8 rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    Add to Cart
                </button>
                <button class="px-8 py-4 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all text-slate-600 dark:text-slate-400">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
            </div>
            <!-- Specifications Accordion -->
            <div class="border-t border-slate-200 dark:border-slate-800 divide-y divide-slate-200 dark:divide-slate-800">
                <details class="group py-4" open="">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none">
                        Details &amp; Materials
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="pt-4 text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        <?php echo apply_filters('the_content', $product->get_description()); ?>
                    </div>
                </details>
                <details class="group py-4">
                    <summary class="flex justify-between items-center font-bold cursor-pointer list-none">
                        Shipping &amp; Returns
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="pt-4 text-slate-600 dark:text-slate-400 text-sm">
                        <?php
                        global $product;
                        // Only show if product is shippable
                        if ( $product->needs_shipping() ) {
                            // echo '<div class="product-shipping mt-6 border-t border-slate-200 dark:border-slate-800 pt-4">';
                            // echo '<h3 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2">Shipping & Returns</h3>';
                            // Weight
                            if ( $product->has_weight() ) {
                                echo '<p class="text-slate-600 dark:text-slate-400 text-sm">Weight: ' . wc_format_weight( $product->get_weight() ) . '</p>';
                            }
                            // Dimensions
                            if ( $product->has_dimensions() ) {
                                echo '<p class="text-slate-600 dark:text-slate-400 text-sm">Dimensions: ' . wc_format_dimensions( $product->get_dimensions( false ) ) . '</p>';
                            }
                            // Shipping class (optional)
                            $shipping_class_id = $product->get_shipping_class_id();
                            if ( $shipping_class_id ) {
                                $shipping_class_name = get_term( $shipping_class_id, 'product_shipping_class' );
                                if ( $shipping_class_name ) {
                                    echo '<p class="text-slate-600 dark:text-slate-400 text-sm">Shipping Class: ' . esc_html( $shipping_class_name->name ) . '</p>';
                                }
                            }
                        }
                        ?>
                        <p class="text-slate-600 border-t border-slate-200 dark:border-slate-800 pt-2 mt-2 dark:text-slate-400 text-sm leading-relaxed">We offer free returns within 30 days of purchase. Products must be unused, in original packaging, and accompanied by a receipt or proof of purchase. Please contact our support team to initiate a return. </p>
                    </div>
                </details>
            </div>
        </div>
    </div>
    <!-- Complete the Look -->
    <section class="mt-24" data-scroll-animate>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-slate-900 dark:text-slate-100">Complete the Look</h2>
            <a class="text-primary font-bold hover:underline flex items-center gap-1" href="#">
                Shop all
                <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product Card -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-[4/5] bg-slate-100 dark:bg-slate-800 rounded-xl overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Matching leather wallet minimalist design" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUB18KTmSntZk0DvP1G7OrrLj88Z4up-mGLgUF9f1GRaZBjN4ezOGfUPzOtevv8SrowQ60YhLVf1c9pivL9TgxceXPStaE4l3NXYNkbUVX6V3-ydgoFEUFH0pQgg6RxUsnFfY2B6mjh7mffpr6BZ0SamCsT9-MfaWcjsRM9Or37HOpRFvwOEwn2NUCels_OHbUN6_WaBKdGD8gUqaoBxjKeOnZ9gSG6ZoHT8xW8sGLtM9IBvpERfRWe-NVoygwiCz8eL21q7VRTTY" />
                    <button class="absolute top-3 right-3 p-2 bg-white/80 dark:bg-black/80 rounded-full text-slate-900 dark:text-slate-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-sm">favorite</span>
                    </button>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-slate-100">Slim Leather Wallet</h3>
                    <p class="text-slate-500 text-sm mb-2">Essential Cognac</p>
                    <p class="text-primary font-bold">$79.00</p>
                </div>
            </div>
            <!-- Product Card -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-[4/5] bg-slate-100 dark:bg-slate-800 rounded-xl overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Minimalist luxury chronograph watch" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPGLC-oe_iRcOWjT0Q2_cS_WFsVb38gm3wLGsyAU_1q8tkNGDjBz6IpS5S-CluMrWcuqaSbnbwMbXYuyqM9MOoFBeqW8QpAXTThoFIRD9HKAYWY5DHVMkWSwUxgyM1WlQcT8mlY-mypQTQp5hHKkrCvQD6cuZt_rcYMVrfqDKaM-2f5z8lGhqST0_OUYHhHmBsaoq_BIBWlynT400C04brpaaFM7BE1tRthC5L4pPCYhEhiAWVq-J4oN9CDAMwKM6-VH5ydK9bKYI" />
                    <button class="absolute top-3 right-3 p-2 bg-white/80 dark:bg-black/80 rounded-full text-slate-900 dark:text-slate-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-sm">favorite</span>
                    </button>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-slate-100">Minimalist Chrono</h3>
                    <p class="text-slate-500 text-sm mb-2">Titanium / Black</p>
                    <p class="text-primary font-bold">$189.00</p>
                </div>
            </div>
            <!-- Product Card -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-[4/5] bg-slate-100 dark:bg-slate-800 rounded-xl overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Leather notebook cover with gold embossing" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXIjpPn7c1cTgAYrqmyyIYYbcSNdeEF_Y7DLBIacBXwuIj8JBikqPiTIdUgvh7PpdSvUoT6MTau36vyPkNxxLbHHoa_KQL6kk04gBTF3gmaUPzeCuRr-0OGrsBMPYV3S0R-vBV1a8LYhcKs2jlG7ubTmWNv1Qr7LtiWRAYbjYZ1DVa49y0FnpV-jbbuvMbleg2M66_O_N4V1DRUBgrr2609j1_qCj_Rwc3EIJFks5Wxlk-AqIRV9jH_a-uzcw8ajhczmh7uMBg1NE" />
                    <button class="absolute top-3 right-3 p-2 bg-white/80 dark:bg-black/80 rounded-full text-slate-900 dark:text-slate-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-sm">favorite</span>
                    </button>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-slate-100">Executive Folio</h3>
                    <p class="text-slate-500 text-sm mb-2">Grain Leather</p>
                    <p class="text-primary font-bold">$120.00</p>
                </div>
            </div>
            <!-- Product Card -->
            <div class="group flex flex-col gap-4">
                <div class="relative aspect-[4/5] bg-slate-100 dark:bg-slate-800 rounded-xl overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Brushed metal reusable water bottle" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKan_BT-titzD1EqnaZYGEO9Z2eAgCGe391jpAHS3kZ88p7R5jMU6Fwyv3-eG7LgYMC0xJtO63AHdxs1xTPYZSvo0_y8BDQTBXaMok6bYBR_jRHQibVE23Wt8Zm_moaBphgPP2VP26jGzUl2Ee5IVVI1_9Ppelcg1_r4cTajSO86Yuaoqz0xhNluRYw1JqJ2iqQUk9ObmYD--1_d54FjMrzkuQ3MZBMoR5X7MIYirdgSalICk3RWCYUrj3Sexu-URqEFGe7d46emw" />
                    <button class="absolute top-3 right-3 p-2 bg-white/80 dark:bg-black/80 rounded-full text-slate-900 dark:text-slate-100 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-sm">favorite</span>
                    </button>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-slate-100">Luxe Hydro Bottle</h3>
                    <p class="text-slate-500 text-sm mb-2">Brushed Steel</p>
                    <p class="text-primary font-bold">$45.00</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>