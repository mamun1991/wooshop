<?php
if (!defined('ABSPATH')) exit;
get_header();
?>

<section class="bg-white dark:bg-slate-900/50">
    <main class="flex-1">
        <!-- Breadcrumbs & Hero -->
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
                        <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight tracking-widest">All Products In</h1>
                    </div>
                    <?php
                        global $wp_query;
                        $total_products = $wp_query->found_posts ?? wp_count_posts('product')->publish;
                    ?>
                    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                        <span class="font-semibold text-slate-900 dark:text-white"><?= $total_products ?></span> Products found
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
                                $cat_link = esc_url(add_query_arg('product_cat', $cat->slug, wc_get_page_permalink('shop')));
                            ?>
                                <a href="<?= $cat_link ?>"
                                class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                                    <?= esc_html($cat->name) ?>
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
                            <?php
                            $prices = [
                                ['min' => 0, 'max' => 50],
                                ['min' => 50, 'max' => 100],
                                ['min' => 100, 'max' => 200],
                                ['min' => 200, 'max' => '']
                            ];
                            foreach ($prices as $p) :
                                $price_args = $_GET;
                                $price_args['min_price'] = $p['min'];
                                if ($p['max'] !== '') $price_args['max_price'] = $p['max'];
                                else unset($price_args['max_price']);
                                $link = add_query_arg($price_args, wc_get_page_permalink('shop'));
                            ?>
                                <a href="<?= esc_url($link) ?>"
                                class="block px-3 py-2 text-sm rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                                    <?php
                                        if ($p['max'] === '') echo '$' . $p['min'] . '+';
                                        else echo '$' . $p['min'] . ' – $' . $p['max'];
                                    ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- SORTING -->
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-500 hidden sm:inline">Sort by:</span>
                    <form method="get" class="relative">
                        <select name="orderby"
                            onchange="this.form.submit()"
                            class="rounded-lg border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-800 py-2 pl-4 pr-10 text-sm font-semibold focus:ring-primary focus:border-primary border-none">
                            <option value="date" <?= selected($_GET['orderby'] ?? '', 'date') ?>>Newest Arrivals</option>
                            <option value="price" <?= selected($_GET['orderby'] ?? '', 'price') ?>>Price: Low to High</option>
                            <option value="price-desc" <?= selected($_GET['orderby'] ?? '', 'price-desc') ?>>Price: High to Low</option>
                            <option value="popularity" <?= selected($_GET['orderby'] ?? '', 'popularity') ?>>Most Popular</option>
                        </select>
                        <?php
                        // Keep all other filters
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
                <?php
                // PAGED
                $paged = max(1, get_query_var('paged', 1));

                $args = [
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => 10,
                    'paged' => $paged,
                ];

                // CATEGORY
                if (!empty($_GET['product_cat'])) {
                    $args['tax_query'] = [[
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field($_GET['product_cat'])
                    ]];
                }

                // PRICE
                $meta_query = [];
                if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
                    $min = $_GET['min_price'] ?? 0;
                    $max = $_GET['max_price'] ?? 999999;
                    $meta_query[] = [
                        'key' => '_price',
                        'value' => [$min, $max],
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    ];
                }
                if (!empty($meta_query)) $args['meta_query'] = $meta_query;

                // SORT
                if (!empty($_GET['orderby'])) {
                    switch ($_GET['orderby']) {
                        case 'price': $args['meta_key'] = '_price'; $args['orderby'] = 'meta_value_num'; $args['order'] = 'ASC'; break;
                        case 'price-desc': $args['meta_key'] = '_price'; $args['orderby'] = 'meta_value_num'; $args['order'] = 'DESC'; break;
                        case 'popularity': $args['meta_key'] = 'total_sales'; $args['orderby'] = 'meta_value_num'; $args['order'] = 'DESC'; break;
                        default: $args['orderby'] = 'date'; $args['order'] = 'DESC';
                    }
                }

                $loop = new \WP_Query($args);

                if ($loop->have_posts()) :
                    while ($loop->have_posts()) : $loop->the_post(); global $product;
                    $image_url = wp_get_attachment_url($product->get_image_id());
                ?>
                    <div class="product-card group" data-product-id="<?= esc_attr($product->get_id()) ?>" data-product-name="<?= esc_attr($product->get_name()) ?>" data-product-price="<?= esc_attr($product->get_price()) ?>" data-product-image="<?= esc_url($image_url) ?>">
                        <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-4 bg-slate-100 dark:bg-slate-800">
                            <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110" style="background-image:url('<?= esc_url($image_url) ?>')"></div>
                            <button @click="addToCart(<?= $product->get_id() ?>)" class="add-to-cart-btn absolute bottom-4 right-4 h-12 w-12 bg-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0 duration-300 hover:scale-110 hover:bg-primary hover:text-white cursor-pointer">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                        <a href="<?php the_permalink() ?>" class="font-bold text-lg text-slate-900 hover:text-primary dark:text-slate-100"><?php the_title() ?></a>
                        <p class="text-primary font-bold"><?php echo $product->get_price_html() ?></p>
                    </div>
                <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <?php
                    $max_pages = ceil($total_products / $args['posts_per_page']);
                    // Use $max_pages in paginate_links
                    // Get pagination links
                        $pagination_links = paginate_links([
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => $paged,
                            'total' => $max_pages,
                            'prev_text' => '<span class="material-symbols-outlined">chevron_left</span>',
                            'next_text' => '<span class="material-symbols-outlined">chevron_right</span>',
                            'add_args' => $_GET,
                            'type' => 'array', // get array of links
                        ]);

                        if ($pagination_links) :
                        ?>
                        <div class="flex justify-center mt-12 gap-2 flex-wrap">
                            <?php foreach ($pagination_links as $link) : ?>
                                <?php
                                // Default classes for <a> links
                                $a_classes = 'px-4 py-2 rounded-lg border border-slate-200 text-slate-800 bg-white hover:bg-primary hover:text-white transition-all shadow-sm';

                                // Current page styling
                                if (strpos($link, 'current') !== false) {
                                    $a_classes = 'px-4 py-2 rounded-lg bg-primary text-white font-semibold shadow-lg cursor-default';
                                    // Remove the original "current" class to prevent conflicts
                                    $link = preg_replace('/\s?current/', '', $link);
                                    // Wrap in span so it’s not clickable
                                    echo '<span class="' . $a_classes . '">' . $link . '</span>';
                                    continue;
                                }

                                // Dots styling (non-clickable)
                                if (strpos($link, 'dots') !== false) {
                                    $a_classes = 'px-4 py-2 rounded-lg text-gray-400 cursor-default bg-white border border-slate-200';
                                    echo '<span class="' . $a_classes . '">' . $link . '</span>';
                                    continue;
                                }

                                // Normal link
                                // Inject classes directly into <a> tag
                                $link = preg_replace('/(<a\s+)/', '$1class="' . $a_classes . '" ', $link, 1);
                                echo $link;
                                ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
            </div>

        </div>
    </main>
</section>

<?php get_footer(); ?>