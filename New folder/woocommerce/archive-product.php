<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="bg-white dark:bg-slate-900/50">
    <main class="flex-1">
        <!-- Breadcrumbs & Hero Title -->
        <div class="bg-white dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-800">
            <div class="mx-auto max-w-[1440px] px-4 py-4 sm:px-6 lg:px-8">
                <nav class="flex justify-end text-sm font-medium" aria-label="Breadcrumb">
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
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight tracking-widest">All Products</h1>
                        <!-- <p class="mt-2 text-slate-600 dark:text-slate-400 max-w-xl">Curated premium essentials designed for modern living. Quality meets aesthetic excellence in every piece.</p> -->
                    </div>
                    <?php
                        if (is_product_category()) {
                            global $wp_query;
                            $total_products = $wp_query->found_posts;
                        } else {
                            $total_products = wp_count_posts('product')->publish;
                        }
                    ?>
                    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                        <span class="font-semibold text-slate-900 dark:text-white"><?=  $total_products ?></span> Products found
                    </div>
                </div>
            </div>
        </div>
        <!-- Toolbar / Filters -->
        <div class="sticky top-[73px] z-40 w-full border-b border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-background-dark/95 backdrop-blur shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-4">
                <div x-data="{ category:false, price:false }" class="flex flex-wrap items-center gap-2">
                    <!-- CATEGORY FILTER -->
                    <div class="relative">
                        <button @click="category = !category; price=false"
                            class="flex items-center gap-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-2 text-xs font-bold uppercase tracking-wider hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                            Category
                            <span class="material-symbols-outlined text-base">expand_more</span>
                        </button>
                        <div x-show="category" @click.outside="category=false"
                            x-transition
                            class="absolute z-50 mt-2 w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-lg p-2">
                            <?php
                            $categories = get_terms([
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true
                            ]);
                            foreach ($categories as $cat) :
                            ?>
                                <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                                class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- PRICE FILTER -->
                    <div class="relative">
                        <button @click="price = !price; category=false"
                            class="flex items-center gap-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-2 text-xs font-bold uppercase tracking-wider hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                            Price Range
                            <span class="material-symbols-outlined text-base">expand_more</span>
                        </button>
                        <div x-show="price" @click.outside="price=false"
                            x-transition
                            class="absolute z-50 mt-2 w-56 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-lg p-2">
                            <a href="?min_price=0&max_price=50"
                            class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                            $0 – $50
                            </a>
                            <a href="?min_price=50&max_price=100"
                            class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                            $50 – $100
                            </a>
                            <a href="?min_price=100&max_price=200"
                            class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                            $100 – $200
                            </a>
                            <a href="?min_price=200"
                            class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                            $200+
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-500 hidden sm:inline">
                        Sort by:
                    </span>
                    <form method="get" class="relative">
                        <select name="orderby"
                            onchange="this.form.submit()"
                            class="rounded-lg border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-800 py-2 pl-4 pr-10 text-sm font-semibold focus:ring-primary focus:border-primary border-none">
                            <option value="date" <?php selected($_GET['orderby'] ?? '', 'date'); ?>>
                                Newest Arrivals
                            </option>
                            <option value="price" <?php selected($_GET['orderby'] ?? '', 'price'); ?>>
                                Price: Low to High
                            </option>
                            <option value="price-desc" <?php selected($_GET['orderby'] ?? '', 'price-desc'); ?>>
                                Price: High to Low
                            </option>
                            <option value="popularity" <?php selected($_GET['orderby'] ?? '', 'popularity'); ?>>
                                Most Popular
                            </option>
                        </select>
                        <?php
                        // Keep other query parameters (filters, category, price)
                        foreach ($_GET as $key => $value) {
                            if ($key !== 'orderby') {
                                echo '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($value).'">';
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Product Grid -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-5 xl:grid-cols-5">
                <!-- Product Card 1 -->
                <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $args = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 10, // products per page
                        'paged' => $paged,
                    ];

                    $loop = new \WP_Query($args);
                    get_pagenum_link();
                    ?>

                    <?php if ( woocommerce_product_loop() ) : ?>
                    <?php while ( have_posts() ) : the_post(); global $product; 

                    $image_url = wp_get_attachment_url($product->get_image_id());
                    ?>

                    <div class="product-card group"
                        data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                        data-product-name="<?php echo esc_attr($product->get_name()); ?>"
                        data-product-price="<?php echo esc_attr($product->get_price()); ?>"
                        data-product-image="<?php echo esc_url($image_url); ?>">
                        <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-4 bg-slate-100 dark:bg-slate-800">
                            <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110"
                                style='background-image:url("<?php echo esc_url($image_url); ?>")'>
                            </div>
                            <button
                                @click="addToCart(<?php echo $product->get_id(); ?>)"
                                class="add-to-cart-btn absolute bottom-4 right-4 h-12 w-12 bg-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0 duration-300 hover:scale-110 hover:bg-primary hover:text-white cursor-pointer"
                                title="Click to add to cart">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                        <a href="<?php the_permalink(); ?>"
                            class="font-bold text-lg text-slate-900 hover:text-primary dark:text-slate-100">
                            <?php the_title(); ?>
                        </a>
                        <p class="text-primary font-bold">
                            <?php echo $product->get_price_html(); ?>
                        </p>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="mt-16 flex items-center justify-center gap-4">
            <!-- Pagination -->
            <?php
        // Tailwind-style pagination for custom WP_Query
        $total_pages = $loop->max_num_pages;
        if ($total_pages > 1):
            $pages_to_show = 2; // pages before/after current
            $ellipsis_shown = false;

            // Previous button
            $prev_disabled = ($paged == 1) ? 'disabled opacity-50' : '';
            $prev_link = get_pagenum_link($paged - 1);
            echo '<a href="'.esc_url($prev_link).'" class="flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 p-2 hover:bg-slate-100 dark:hover:bg-slate-800 '.$prev_disabled.'">
                    <span class="material-symbols-outlined">chevron_left</span>
                  </a>';

            // Page numbers
            echo '<div class="flex items-center gap-2">';
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == 1 || $i == $total_pages || ($i >= $paged - $pages_to_show && $i <= $paged + $pages_to_show)) {
                    $active_class = ($i == $paged) ? 'bg-primary text-white font-bold' : 'hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold';
                    echo '<a href="'.get_pagenum_link($i).'" class="flex size-10 items-center justify-center rounded-lg '.$active_class.'">'.$i.'</a>';
                    $ellipsis_shown = false;
                } else {
                    if (!$ellipsis_shown) {
                        echo '<span class="px-2 text-slate-400">...</span>';
                        $ellipsis_shown = true;
                    }
                }
            }
            echo '</div>';

            // Next button
            $next_disabled = ($paged == $total_pages) ? 'disabled opacity-50' : '';
            $next_link = get_pagenum_link($paged + 1);
            echo '<a href="'.esc_url($next_link).'" class="flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 p-2 hover:bg-slate-100 dark:hover:bg-slate-800 '.$next_disabled.'">
                    <span class="material-symbols-outlined">chevron_right</span>
                  </a>';
        endif;

        // Reset post data
        wp_reset_postdata();
        ?>
        </div>
        </div>
    </main>
</section>

<?php get_footer(); ?>