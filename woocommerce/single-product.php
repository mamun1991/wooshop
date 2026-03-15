<?php
get_header();
while (have_posts()) : the_post();
    global $product;
endwhile;
?>

<main class="flex-1 w-full bg-white dark:bg-slate-950">
    <!-- Breadcrumbs -->
    <nav class="max-w-[1440px] mx-auto px-6 md:px-20 py-6 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
        <?php
        if (function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb(array(
                'delimiter'   => '<span class="mx-2">/</span>',
                'wrap_before' => '',
                'wrap_after'  => '',
                'before'      => '',
                'after'       => '',
                'home'        => _x('Home', 'breadcrumb', 'mytheme'),
            ));
        }
        ?>
    </nav>

    <!-- Hero Section -->
    <?php
    $main_image_id = $product->get_image_id();
    $main_image = wp_get_attachment_image_url($main_image_id, 'full');
    $gallery_ids = $product->get_gallery_image_ids();
    $gallery_ids = array_slice($gallery_ids, 0, 8);
    ?>

    <div class="relative overflow-hidden py-0">
        <!-- Animated Background -->
        <!-- <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 dark:bg-primary/10 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute -bottom-40 left-20 w-80 h-80 bg-blue-500/20 dark:bg-blue-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-purple-500/20 dark:bg-purple-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        </div> -->

        <div class="max-w-[1440px] mx-auto px-6 md:px-20 py-16 md:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                <!-- ENHANCED Image Section -->
                <div class="flex flex-col gap-6 order-2 lg:order-1" x-data="{ 
                    activeImage: '<?php echo esc_url($main_image); ?>',
                    zoomActive: false,
                    zoomX: 0,
                    zoomY: 0,
                    lensX: 0,
                    lensY: 0,
                    lensSize: 150
                }">
                    <!-- Main Image Container with Advanced Zoom -->
                    <div class="relative group perspective">
                        <!-- Glow Effect -->
                        <!-- <div class="absolute -inset-8 bg-gradient-to-r from-primary via-blue-500 to-purple-500 rounded-3xl blur-2xl opacity-0 group-hover:opacity-40 transition-opacity duration-500 -z-10"></div> -->

                        <div
                            class="relative w-full aspect-square bg-gradient-to-br from-slate-100 via-white to-slate-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-gray-300 backdrop-blur-xl"
                            @mouseenter="zoomActive = true"
                            @mouseleave="zoomActive = false"
                            @mousemove="
                                let rect = $el.getBoundingClientRect();
                                let x = $event.clientX - rect.left;
                                let y = $event.clientY - rect.top;
                                zoomX = (x / rect.width) * 100;
                                zoomY = (y / rect.height) * 100;
                                lensX = x - (lensSize / 2);
                                lensY = y - (lensSize / 2);
                            ">
                            <!-- Main Image -->
                            <img :src="activeImage"
                                class="w-full h-full object-cover transition-all duration-200"
                                :class="zoomActive ? 'cursor-zoom-out' : 'cursor-zoom-in'"
                                alt="<?php the_title(); ?>">

                            <!-- Zoom Lens Indicator -->
                            <div
                                x-show="zoomActive"
                                class="absolute border-2 border-primary/60 bg-white/10 backdrop-blur-sm rounded-lg pointer-events-none"
                                :style="`width: ${lensSize}px; height: ${lensSize}px; left: ${lensX}px; top: ${lensY}px;`"
                                @click.stop></div>

                            <!-- Zoomed View Overlay -->
                            <div
                                x-show="zoomActive"
                                class="absolute inset-0 opacity-0 transition-opacity duration-200"
                                :style="zoomActive ? 'opacity: 1' : 'opacity: 0'">
                                <img :src="activeImage"
                                    class="w-full h-full object-cover"
                                    :style="`
                                        transform: scale(3);
                                        transform-origin: ${zoomX}% ${zoomY}%;
                                    `"
                                    alt="<?php the_title(); ?>">
                            </div>
                            <div class="absolute bottom-2 left-6 z-10 animate-bounce">
                                <?php if ($product->is_in_stock()): ?>
                                    <div class="bg-gradient-to-r from-green-400 to-emerald-500 text-white px-6 py-3 rounded-full text-sm font-black tracking-wider shadow-xl inline-block">
                                        ✨ In Stock
                                    </div>
                                <?php else: ?>
                                    <div class="bg-gradient-to-r from-red-400 to-rose-500 text-white px-6 py-3 rounded-full text-sm font-black tracking-wider shadow-xl inline-block">
                                        Out of Stock
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- IMPROVED: Gallery with Grid View -->
                    <div class="space-y-3">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Gallery</p>
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                            <?php if ($gallery_ids) : ?>
                                <?php foreach ($gallery_ids as $idx => $gallery_id) :
                                    $image = wp_get_attachment_image_url($gallery_id, 'full');
                                    $thumb = wp_get_attachment_image_url($gallery_id, 'thumbnail');
                                ?>
                                    <div
                                        @click="activeImage = '<?php echo esc_url($image); ?>'"
                                        :class="activeImage === '<?php echo esc_url($image); ?>' ? 'ring-4 ring-primary shadow-xl scale-105 border-transparent' : 'opacity-70 hover:opacity-100 hover:scale-110 border-slate-200 dark:border-slate-700'"
                                        class="aspect-square rounded-2xl overflow-hidden cursor-pointer transition-all duration-300 group flex-shrink-0 border-2 hover:shadow-lg"
                                        style="animation-delay: <?php echo $idx * 0.05; ?>s;"
                                        :title="activeImage === '<?php echo esc_url($image); ?>' ? 'Current image' : 'Click to view'">
                                        <img src="<?php echo esc_url($thumb); ?>" class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-300" />
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="flex flex-col gap-8 order-1 lg:order-2" x-data="{qty : 1}">
                    <!-- Top Section -->
                    <div class="space-y-6">
                        <!-- Category Badges -->
                        <div class="flex items-center gap-3 flex-wrap">
                            <?php
                            $categories = wp_get_post_terms($product->get_id(), 'product_cat');
                            if (!empty($categories)) {
                                foreach (array_slice($categories, 0, 2) as $cat) {
                                    echo '<span class="px-4 py-2 bg-gradient-to-r from-primary/20 to-blue-500/20 text-primary font-black text-xs uppercase tracking-widest rounded-full border border-primary/30 backdrop-blur-sm">' . esc_html($cat->name) . '</span>';
                                }
                            }
                            ?>
                            <span class="px-4 py-2 bg-gradient-to-r from-yellow-400/20 to-orange-400/20 text-yellow-600 dark:text-yellow-400 font-black text-xs uppercase tracking-widest rounded-full border border-yellow-400/30 backdrop-blur-sm">⭐ Premium</span>
                        </div>
                        <div class="space-y-6 relative">
                            <div>
                                <h1 class="text-5xl md:text-7xl lg:text-8xl font-black leading-tight mb-4 text-slate-900" style="font-family: 'Georgia', serif; letter-spacing: -0.02em;">
                                    <?php the_title(); ?>
                                </h1>
                            </div>

                            <p class="text-lg md:text-xl text-slate-700 leading-relaxed font-medium max-w-2xl">
                                <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Price & Rating Section -->
                    <div class="bg-gradient-to-br from-white/80 via-slate-50/80 to-white/50 dark:from-slate-900/80 dark:via-slate-800/80 dark:to-slate-900/50 backdrop-blur-xl rounded-2xl p-6 border border-white/40 dark:border-slate-700/40 shadow-xl">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                            <!-- Price -->
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2 font-black">Pricing</p>
                                <div class="flex items-baseline gap-4">
                                    <p class="text-5xl font-black text-primary"><?php echo $product->get_price_html(); ?></p>
                                    <?php if ($product->is_on_sale()): ?>
                                        <p class="text-lg text-slate-400 dark:text-slate-500 line-through font-bold">
                                            <?php echo wc_price($product->get_regular_price()); ?>
                                        </p>
                                        <?php
                                        $regular = $product->get_regular_price();
                                        $sale = $product->get_sale_price();
                                        $discount = round(((($regular - $sale) / $regular) * 100));
                                        ?>
                                        <span class="bg-gradient-to-r from-red-500 to-rose-500 text-white px-4 py-2 rounded-full text-sm font-black">
                                            -<?php echo $discount; ?>%
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-2">
                                    <?php
                                    $rating = $product->get_average_rating();
                                    for ($i = 0; $i < 5; $i++):
                                    ?>
                                        <span class="material-symbols-outlined text-2xl <?php echo ($i < floor($rating)) ? 'fill-current text-yellow-400' : 'text-slate-300 dark:text-slate-600'; ?>">star</span>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">
                                    <span class="text-lg"><?php echo round($rating, 1); ?></span>
                                    <span class="text-slate-500 dark:text-slate-400">• <?php echo $product->get_review_count(); ?> Reviews</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Product Attributes -->
                    <div class="space-y-6">
                        <!-- Colors -->
                        <?php
                        $colors = get_post_meta($product->get_id(), '_product_colors', true);
                        if (!$colors) {
                            $colors = array('8b4513', '2c2c2c', '4a5d4e', '8b7355', 'c41e3a', '1a5490');
                        }
                        ?>
                        <div x-data="{ selectedColor: '<?php echo esc_attr($colors[0]); ?>' }">
                            <h3 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">palette</span>
                                Color Selection
                            </h3>
                            <div class="flex gap-4 flex-wrap">
                                <?php foreach ($colors as $color): ?>
                                    <button
                                        @click="selectedColor = '<?php echo esc_attr($color); ?>'"
                                        :class="selectedColor === '<?php echo esc_attr($color); ?>' ? 'ring-4 ring-offset-2 ring-primary dark:ring-offset-slate-950 scale-110 shadow-2xl' : 'hover:scale-125 shadow-lg'"
                                        class="w-14 h-14 rounded-full border-2 border-white dark:border-slate-700 transition-all duration-300 cursor-pointer hover:shadow-xl"
                                        style="background-color: #<?php echo esc_attr($color); ?>;"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Sizes -->
                        <?php
                        $sizes = array('Small', 'Medium', 'Large', 'XL', 'XXL');
                        ?>
                        <div x-data="{ selectedSize: '' }">
                            <h3 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">straighten</span>
                                Size Guide
                            </h3>
                            <div class="flex flex-wrap gap-3">
                                <?php foreach ($sizes as $size): ?>
                                    <button
                                        @click="selectedSize = '<?php echo esc_attr($size); ?>'"
                                        :class="selectedSize === '<?php echo esc_attr($size); ?>' ? 'bg-gradient-to-r from-primary to-blue-500 text-white shadow-xl scale-105 border-transparent' : 'border-2 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white hover:border-primary hover:shadow-lg'"
                                        class="px-6 py-3 rounded-xl font-bold transition-all duration-300 cursor-pointer hover:scale-110 backdrop-blur-sm">
                                        <?php echo esc_html($size); ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">shopping_cart</span>
                                Quantity
                            </h3>
                            <div class="flex items-center gap-4 bg-gradient-to-r from-slate-100 to-slate-50 w-fit px-2 py-2 rounded-2xl border-2 border-slate-200">
                                <button @click="qty = qty > 1 ? qty - 1 : 1" class="p-3 hover:bg-white rounded-xl transition-all hover:text-primary cursor-pointer">
                                    <span class="material-symbols-outlined">remove</span>
                                </button>
                                <span class="text-2xl font-black text-slate-900 w-8 text-center" x-text="qty"></span>
                                <button @click="qty = qty + 1" class="p-3 hover:bg-white rounded-xl transition-all hover:text-primary cursor-pointer">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 product-card"
                        data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                        data-product-name="<?php echo esc_attr($product->get_name()); ?>"
                        data-product-price="<?php echo esc_attr($product->get_price()); ?>"
                        data-product-image="<?php echo esc_url($main_image); ?>">

                        <button @click="addToCart(<?= $product->get_id() ?>, qty)" class="flex-1 bg-primary hover:bg-primary/90 text-white font-black py-5 px-8 rounded-2xl transition-all shadow-2xl hover:shadow-3xl flex items-center justify-center gap-3 group cursor-pointer text-lg uppercase tracking-wider transform hover:scale-105 active:scale-95">
                            <span class="material-symbols-outlined text-2xl group-hover:animate-bounce">shopping_bag</span>
                            Add to Cart
                        </button>

                        <button @click="addToWishlist(<?= $product->get_id() ?>)" class="px-8 py-5 rounded-2xl border-2 border-primary bg-primary/10 dark:bg-primary/20 hover:bg-primary/20 dark:hover:bg-primary/30 hover:shadow-xl transition-all text-primary font-black group cursor-pointer text-lg uppercase tracking-wider transform hover:scale-105 active:scale-95">
                            <span class="material-symbols-outlined text-2xl group-hover:fill-current group-hover:scale-110 transition-all">favorite</span>
                        </button>
                    </div>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-4 gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                        <div class="text-center p-4 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-950/20 dark:to-emerald-950/20 hover:shadow-lg transition-all group cursor-pointer border border-green-200/50 dark:border-green-800/50">
                            <span class="material-symbols-outlined text-3xl text-green-600 dark:text-green-400 block mb-2 group-hover:scale-110 transition-transform">verified</span>
                            <p class="text-xs font-black text-slate-900 dark:text-white">100% Authentic</p>
                        </div>
                        <div class="text-center p-4 rounded-xl bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-950/20 dark:to-cyan-950/20 hover:shadow-lg transition-all group cursor-pointer border border-blue-200/50 dark:border-blue-800/50">
                            <span class="material-symbols-outlined text-3xl text-blue-600 dark:text-blue-400 block mb-2 group-hover:scale-110 transition-transform">local_shipping</span>
                            <p class="text-xs font-black text-slate-900 dark:text-white">Free Ship</p>
                        </div>
                        <div class="text-center p-4 rounded-xl bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-950/20 dark:to-pink-950/20 hover:shadow-lg transition-all group cursor-pointer border border-purple-200/50 dark:border-purple-800/50">
                            <span class="material-symbols-outlined text-3xl text-purple-600 dark:text-purple-400 block mb-2 group-hover:scale-110 transition-transform">shield</span>
                            <p class="text-xs font-black text-slate-900 dark:text-white">Safe Return</p>
                        </div>
                        <div class="text-center p-4 rounded-xl bg-gradient-to-br from-purple-50 to-pink-50 hover:shadow-lg transition-all group cursor-pointer border border-purple-200/50">
                            <span class="material-symbols-outlined text-3xl text-purple-600 block mb-2 group-hover:scale-110 transition-transform">award_star</span>
                            <p class="text-xs font-black text-slate-900">Highly Rated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Sections -->
    <div class="max-w-[1440px] mx-auto px-6 md:px-20 py-20 border-t border-slate-200 dark:border-slate-800">
        <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-12" style="font-family: 'Georgia', serif;">Product Information</h2>

        <div class="space-y-4 max-w-4xl">
            <!-- Details -->
            <details class="group border-2 border-slate-200 dark:border-slate-800 rounded-2xl p-6 cursor-pointer hover:border-primary hover:shadow-xl transition-all duration-300 bg-white dark:bg-slate-900/50">
                <summary class="flex justify-between items-center font-black text-slate-900 dark:text-white list-none text-lg">
                    <span class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-primary">description</span>
                        Product Details
                    </span>
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform duration-300 text-2xl">expand_more</span>
                </summary>
                <div class="pt-6 text-slate-600 dark:text-slate-400 space-y-3 mt-4 border-t-2 border-slate-200 dark:border-slate-800">
                    <?php echo apply_filters('the_content', $product->get_description()); ?>
                </div>
            </details>

            <!-- Specifications -->
            <details class="group border-2 border-slate-200 dark:border-slate-800 rounded-2xl p-6 cursor-pointer hover:border-primary hover:shadow-xl transition-all duration-300 bg-white dark:bg-slate-900/50">
                <summary class="flex justify-between items-center font-black text-slate-900 dark:text-white list-none text-lg">
                    <span class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-primary">straighten</span>
                        Specifications
                    </span>
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform duration-300 text-2xl">expand_more</span>
                </summary>
                <div class="pt-6 text-slate-600 dark:text-slate-400 space-y-2 mt-4 border-t-2 border-slate-200 dark:border-slate-800">
                    <?php
                    global $product;
                    if ($product->needs_shipping()) {
                        if ($product->has_weight()) {
                            echo '<p class="font-bold text-slate-900 dark:text-white">Weight: <span class="font-normal text-slate-600 dark:text-slate-400">' . wc_format_weight($product->get_weight()) . '</span></p>';
                        }
                        if ($product->has_dimensions()) {
                            echo '<p class="font-bold text-slate-900 dark:text-white">Dimensions: <span class="font-normal text-slate-600 dark:text-slate-400">' . wc_format_dimensions($product->get_dimensions(false)) . '</span></p>';
                        }
                    }
                    ?>
                </div>
            </details>

            <!-- Shipping -->
            <details class="group border-2 border-slate-200 dark:border-slate-800 rounded-2xl p-6 cursor-pointer hover:border-primary hover:shadow-xl transition-all duration-300 bg-white dark:bg-slate-900/50">
                <summary class="flex justify-between items-center font-black text-slate-900 dark:text-white list-none text-lg">
                    <span class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-primary">local_shipping</span>
                        Shipping & Returns
                    </span>
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform duration-300 text-2xl">expand_more</span>
                </summary>
                <div class="pt-6 text-slate-600 dark:text-slate-400 space-y-3 mt-4 border-t-2 border-slate-200 dark:border-slate-800">
                    <p><strong class="text-slate-900 dark:text-white">✈️ Free Worldwide Shipping</strong> on orders over $50</p>
                    <p><strong class="text-slate-900 dark:text-white">📦 Fast Delivery</strong> 3-7 business days</p>
                    <p><strong class="text-slate-900 dark:text-white">↩️ Easy Returns</strong> within 30 days, full refund</p>
                </div>
            </details>
        </div>
    </div>

    <!-- ENHANCED: Customer Reviews Section -->
    <div class="max-w-[1440px] mx-auto px-6 md:px-20 py-20 border-t border-slate-200 dark:border-slate-800">
        <div class="mb-12">
            <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-4" style="font-family: 'Georgia', serif;">Customer Reviews</h2>
            <p class="text-slate-600 dark:text-slate-400">See what customers love about this product</p>
        </div>

        <!-- Reviews Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <!-- Average Rating -->
            <div class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-800/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mb-3">Average Rating</p>
                <div class="flex items-center gap-3">
                    <div class="text-5xl font-black text-primary"><?php echo round($product->get_average_rating(), 1); ?></div>
                    <div class="flex flex-col">
                        <div class="flex gap-1">
                            <?php
                            $rating = $product->get_average_rating();
                            for ($i = 0; $i < 5; $i++):
                            ?>
                                <span class="material-symbols-outlined text-lg <?php echo ($i < floor($rating)) ? 'fill-current text-yellow-400' : 'text-slate-300 dark:text-slate-600'; ?>">star</span>
                            <?php endfor; ?>
                        </div>
                        <span class="text-xs text-slate-500 dark:text-slate-400 mt-1">Based on <?php echo $product->get_review_count(); ?> reviews</span>
                    </div>
                </div>
            </div>

            <!-- 5 Stars -->
            <div class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-800/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mb-3">5 Stars</p>
                <div class="flex items-center gap-3">
                    <div class="flex gap-1">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <span class="material-symbols-outlined text-lg fill-current text-yellow-400">star</span>
                        <?php endfor; ?>
                    </div>
                    <span class="text-2xl font-black text-slate-900 dark:text-white">67%</span>
                </div>
                <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full mt-3">
                    <div class="h-full bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full" style="width: 67%"></div>
                </div>
            </div>

            <!-- 4 Stars -->
            <div class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-800/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mb-3">4 Stars</p>
                <div class="flex items-center gap-3">
                    <div class="flex gap-1">
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <span class="material-symbols-outlined text-lg fill-current text-yellow-400">star</span>
                        <?php endfor; ?>
                        <span class="material-symbols-outlined text-lg text-slate-300 dark:text-slate-600">star</span>
                    </div>
                    <span class="text-2xl font-black text-slate-900 dark:text-white">25%</span>
                </div>
                <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full mt-3">
                    <div class="h-full bg-gradient-to-r from-blue-400 to-blue-500 rounded-full" style="width: 25%"></div>
                </div>
            </div>

            <!-- 3 Stars -->
            <div class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-800/50 rounded-2xl p-8 border border-slate-200 dark:border-slate-700">
                <p class="text-sm text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mb-3">3 Stars</p>
                <div class="flex items-center gap-3">
                    <div class="flex gap-1">
                        <?php for ($i = 0; $i < 3; $i++): ?>
                            <span class="material-symbols-outlined text-lg fill-current text-yellow-400">star</span>
                        <?php endfor; ?>
                        <span class="material-symbols-outlined text-lg text-slate-300 dark:text-slate-600">star</span>
                        <span class="material-symbols-outlined text-lg text-slate-300 dark:text-slate-600">star</span>
                    </div>
                    <span class="text-2xl font-black text-slate-900 dark:text-white">8%</span>
                </div>
                <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full mt-3">
                    <div class="h-full bg-gradient-to-r from-green-400 to-green-500 rounded-full" style="width: 8%"></div>
                </div>
            </div>
        </div>

        <!-- Individual Reviews -->
        <div class="space-y-6 mb-12">
            <?php
            $args = array(
                'post_id' => get_the_ID(),
                'status' => 'approve',
                // 'type' => 'review',
                'number' => 5,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $comments = get_comments($args);

            if ($comments) {
                foreach ($comments as $comment) {
                    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
                    $verified = get_comment_meta($comment->comment_ID, 'verified', true);
            ?>
                    <!-- Review Card -->
                    <div class="bg-gradient-to-br from-white to-slate-50 dark:from-slate-900 dark:to-slate-800/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-primary/50 transition-all duration-300">
                        <!-- Review Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <!-- Author & Date -->
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-blue-500 flex items-center justify-center text-white font-black text-sm">
                                        <?php echo strtoupper(substr($comment->comment_author, 0, 1)); ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white"><?php echo esc_html($comment->comment_author); ?></p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            <?php echo human_time_diff(strtotime($comment->comment_date), current_time('timestamp')); ?> ago
                                        </p>
                                    </div>
                                </div>

                                <!-- Rating Stars -->
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-0.5">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <span class="material-symbols-outlined text-sm <?php echo ($i < $rating) ? 'fill-current text-yellow-400' : 'text-slate-300 dark:text-slate-600'; ?>">star</span>
                                        <?php endfor; ?>
                                    </div>
                                    <?php if ($verified): ?>
                                        <span class="ml-2 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold rounded-full flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">verified</span>
                                            Verified
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Helpful Buttons -->
                            <div class="flex gap-2">
                                <button class="p-2 hover:bg-white dark:hover:bg-slate-700 rounded-lg transition-all text-slate-600 dark:text-slate-400 hover:text-primary">
                                    <span class="material-symbols-outlined text-lg">thumb_up</span>
                                </button>
                                <button class="p-2 hover:bg-white dark:hover:bg-slate-700 rounded-lg transition-all text-slate-600 dark:text-slate-400 hover:text-red-500">
                                    <span class="material-symbols-outlined text-lg">thumb_down</span>
                                </button>
                            </div>
                        </div>

                        <!-- Review Title & Content -->
                        <div>
                            <?php if ($comment->comment_title): ?>
                                <h4 class="font-bold text-slate-900 dark:text-white mb-2"><?php echo esc_html($comment->comment_title); ?></h4>
                            <?php endif; ?>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3">
                                <?php echo esc_html($comment->comment_content); ?>
                            </p>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="text-center text-slate-500 dark:text-slate-400 py-8">No reviews yet. Be the first to review!</p>';
            }
            ?>
        </div>
    </div>

    <!-- Related Products -->
    <section class="max-w-[1440px] mx-auto px-6 md:px-20 py-20 border-t border-slate-200 dark:border-slate-800">
        <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-12" style="font-family: 'Georgia', serif;">You Might Also Like</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            global $product;
            $related_ids = wc_get_related_products($product->get_id(), 4);

            if ($related_ids) :
                $index = 0;
                foreach ($related_ids as $related_id) :
                    $related = wc_get_product($related_id);
                    if (!$related || !$related->is_visible()) continue;

                    $rel_image = wp_get_attachment_url($related->get_image_id());
                    $rel_rating = $related->get_average_rating();
                    $rel_price = $related->get_price_html();
                    $index++;
            ?>
                    <div class="group" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <a href="<?php echo esc_url($related->get_permalink()); ?>" class="relative block aspect-[3/4] mb-4 rounded-2xl overflow-hidden bg-gradient-to-br from-slate-200 to-slate-100 dark:from-slate-800 dark:to-slate-900">
                            <img src="<?php echo esc_url($rel_image); ?>" alt="<?php echo esc_attr($related->get_name()); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <button class="w-full bg-gradient-to-r from-primary to-blue-500 text-white font-black py-3 rounded-xl hover:shadow-xl transition-all">
                                    Quick View
                                </button>
                            </div>

                            <div class="absolute top-4 right-4 bg-gradient-to-r from-primary to-blue-500 text-white px-4 py-2 rounded-full font-black opacity-0 group-hover:opacity-100 transition-opacity shadow-xl">
                                <?php echo $rel_price; ?>
                            </div>
                        </a>

                        <div class="space-y-3">
                            <h3 class="font-black text-slate-900 dark:text-white group-hover:text-primary transition-colors line-clamp-2 text-lg">
                                <?php echo esc_html($related->get_name()); ?>
                            </h3>

                            <div class="flex items-center justify-between">
                                <div class="flex gap-1">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <span class="material-symbols-outlined text-sm <?php echo ($i < floor($rel_rating)) ? 'fill-current text-yellow-400' : 'text-slate-300 dark:text-slate-600'; ?>">star</span>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-xs font-bold text-slate-500 dark:text-slate-400"><?php echo $related->get_review_count(); ?></span>
                            </div>

                            <button @click="addToCart(<?php echo $related_id; ?>)" class="w-full bg-gradient-to-r from-primary to-blue-500 text-white font-black py-3 rounded-xl hover:shadow-xl transition-all cursor-pointer uppercase tracking-wider group-hover:scale-105 active:scale-95">
                                Add to Cart
                            </button>
                        </div>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<style>
    @keyframes blob {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .group {
        animation: slideInUp 0.8s ease-out forwards;
        opacity: 0;
    }

    details summary::-webkit-details-marker {
        display: none;
    }

    details[open] summary {
        color: var(--primary-color, #3b82f6);
    }

    @media (prefers-reduced-motion: no-preference) {
        html {
            scroll-behavior: smooth;
        }
    }

    /* Smooth gallery scroll */
    .scroll-smooth {
        scroll-behavior: smooth;
    }
</style>