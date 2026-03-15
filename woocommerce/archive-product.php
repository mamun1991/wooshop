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
                        <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight tracking-widest">All Products</h1>
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

        <div class="sticky top-20 z-40 w-full bg-white border-b border-black/[0.08] shadow-sm backdrop-blur-xl">

        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-10 h-16">
            <div class="flex h-full items-center justify-between gap-6">

            <!-- ── LEFT: Filters ── -->
            <div x-data="{ category: false, price: false }" class="flex items-center gap-6">

                <!-- CATEGORY -->
                <div class="relative">
                <button
                    class="inline-flex items-center gap-1.5 text-[11px] font-normal tracking-[0.12em] uppercase text-slate-400 bg-transparent border-none py-2 cursor-pointer transition-colors duration-200 hover:text-blue-700 relative group whitespace-nowrap"
                    data-open="false"
                    @click="category = !category; price = false; $el.dataset.open = category">
                    All Categories
                    <span class="material-symbols-outlined text-sm text-slate-300 transition-all duration-300 group-hover:text-blue-600"
                        :class="category ? 'rotate-180 !text-blue-600' : ''">expand_more</span>
                    <span class="absolute bottom-1 left-0 h-px bg-blue-700 transition-all duration-300 w-0 group-hover:w-full"
                        :class="category ? '!w-full' : ''"></span>
                </button>

                <div class="absolute top-[calc(100%+18px)] left-[-20px] min-w-[230px] bg-white border border-black/[0.08] rounded-md p-2 shadow-xl z-[100] backdrop-blur-xl overflow-hidden"
                    x-show="category"
                    x-cloak
                    @click.outside="category = false"
                    x-transition:enter="transition-none"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 -translate-y-2">

                    <div class="h-px mb-2 bg-gradient-to-r from-blue-700 to-transparent opacity-25"></div>

                    <div class="px-3 pb-2.5 pt-1">
                    <span class="text-[10px] font-light tracking-[0.2em] uppercase text-blue-700 opacity-70">Browse by category</span>
                    </div>

                    <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>"
                    class="flex items-center justify-between px-3 py-2.5 rounded-sm text-[13px] font-light tracking-wide text-slate-400 no-underline transition-all duration-150 hover:bg-blue-50 hover:text-slate-800 hover:pl-[18px] relative
                            <?= empty($_GET['product_cat']) ? '!text-blue-700 bg-blue-50/70 before:absolute before:left-0 before:top-[20%] before:bottom-[20%] before:w-0.5 before:rounded-r before:bg-blue-700 before:content-[\'\']' : '' ?>">
                    <span>Everything</span>
                    </a>

                    <?php
                    $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => true]);
                    $active_cat = $_GET['product_cat'] ?? '';
                    foreach ($categories as $cat) :
                    $cat_link = esc_url(add_query_arg('product_cat', $cat->slug, wc_get_page_permalink('shop')));
                    $is_active = $active_cat === $cat->slug;
                    ?>
                    <a href="<?= $cat_link ?>"
                        class="flex items-center justify-between px-3 py-2.5 rounded-sm text-[13px] font-light tracking-wide text-slate-400 no-underline transition-all duration-150 hover:bg-blue-50 hover:text-slate-800 hover:pl-[18px] relative
                                <?= $is_active ? '!text-blue-700 bg-blue-50/70 before:absolute before:left-0 before:top-[20%] before:bottom-[20%] before:w-0.5 before:rounded-r before:bg-blue-700 before:content-[\'\']' : '' ?>">
                        <span><?= esc_html($cat->name) ?></span>
                        <span class="text-[11px] text-slate-300 min-w-[18px] text-right"><?= $cat->count ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
                </div>

                <div class="w-1 h-1 rounded-full bg-blue-700 opacity-25 shrink-0"></div>

                <!-- PRICE -->
                <div class="relative">
                <button
                    class="inline-flex items-center gap-1.5 text-[11px] font-normal tracking-[0.12em] uppercase text-slate-400 bg-transparent border-none py-2 cursor-pointer transition-colors duration-200 hover:text-blue-700 relative group whitespace-nowrap"
                    data-open="false"
                    @click="price = !price; category = false; $el.dataset.open = price">
                    Price Range
                    <span class="material-symbols-outlined text-sm text-slate-300 transition-all duration-300 group-hover:text-blue-600"
                        :class="price ? 'rotate-180 !text-blue-600' : ''">expand_more</span>
                    <span class="absolute bottom-1 left-0 h-px bg-blue-700 transition-all duration-300 w-0 group-hover:w-full"
                        :class="price ? '!w-full' : ''"></span>
                </button>

                <div class="absolute top-[calc(100%+18px)] left-[-20px] min-w-[230px] bg-white border border-black/[0.08] rounded-md p-2 shadow-xl z-[100] backdrop-blur-xl overflow-hidden"
                    x-show="price"
                    x-cloak
                    @click.outside="price = false"
                    x-transition:enter="transition-none"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 -translate-y-2">

                    <div class="h-px mb-2 bg-gradient-to-r from-blue-700 to-transparent opacity-25"></div>

                    <div class="px-3 pb-2.5 pt-1">
                    <span class="text-[10px] font-light tracking-[0.2em] uppercase text-blue-700 opacity-70">Filter by price</span>
                    </div>

                    <?php
                    $prices = [
                    ['min' => 0,   'max' => 50,  'label' => 'Under $50'],
                    ['min' => 50,  'max' => 100, 'label' => '$50 – $100'],
                    ['min' => 100, 'max' => 200, 'label' => '$100 – $200'],
                    ['min' => 200, 'max' => '',  'label' => '$200 & above'],
                    ];
                    foreach ($prices as $p) :
                    $price_args = $_GET;
                    $price_args['min_price'] = $p['min'];
                    if ($p['max'] !== '') $price_args['max_price'] = $p['max'];
                    else unset($price_args['max_price']);
                    $link = esc_url(add_query_arg($price_args, wc_get_page_permalink('shop')));

                    $active_min = $_GET['min_price'] ?? null;
                    $active_max = $_GET['max_price'] ?? null;
                    $is_active  = ($active_min == $p['min'] && ($p['max'] === '' ? !isset($_GET['max_price']) : $active_max == $p['max']));
                    ?>
                    <a href="<?= $link ?>"
                        class="flex items-center justify-between px-3 py-2.5 rounded-sm text-[13px] font-light tracking-wide text-slate-400 no-underline transition-all duration-150 hover:bg-blue-50 hover:text-slate-800 hover:pl-[18px] relative
                                <?= $is_active ? '!text-blue-700 bg-blue-50/70 before:absolute before:left-0 before:top-[20%] before:bottom-[20%] before:w-0.5 before:rounded-r before:bg-blue-700 before:content-[\'\']' : '' ?>">
                        <?= $p['label'] ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                </div>

            </div>

            <!-- ── RIGHT: Sort ── -->
            <div class="flex items-center gap-5">

                <div class="hidden sm:block w-px h-5 bg-gradient-to-b from-transparent via-black/10 to-transparent shrink-0"></div>

                <div class="flex items-center gap-3">
                <span class="hidden sm:inline text-[10px] tracking-[0.12em] uppercase text-slate-300 font-normal whitespace-nowrap">Sorted by</span>

                <form method="get">
                    <div class="relative inline-flex items-center">
                    <select
                        class="appearance-none bg-slate-50 border border-black/[0.08] rounded-sm text-slate-700 text-[11px] font-normal tracking-wide py-2 pl-3.5 pr-9 cursor-pointer transition-all duration-200 outline-none hover:border-blue-300 hover:bg-white focus:border-blue-300 focus:ring-2 focus:ring-blue-700/[0.06]"
                        name="orderby"
                        onchange="this.form.submit()">
                        <option value="date"       <?= selected($_GET['orderby'] ?? 'date', 'date') ?>>Latest</option>
                        <option value="price"      <?= selected($_GET['orderby'] ?? '', 'price') ?>>Price — Low</option>
                        <option value="price-desc" <?= selected($_GET['orderby'] ?? '', 'price-desc') ?>>Price — High</option>
                        <option value="popularity" <?= selected($_GET['orderby'] ?? '', 'popularity') ?>>Popular</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-2.5 text-sm text-blue-600 opacity-50 pointer-events-none">unfold_more</span>
                    </div>

                    <?php foreach ($_GET as $key => $value) :
                    if ($key !== 'orderby') : ?>
                        <input type="hidden" name="<?= esc_attr($key) ?>" value="<?= esc_attr($value) ?>">
                    <?php endif;
                    endforeach; ?>
                </form>
                </div>

            </div>

            </div>
        </div>
        </div>

        <!-- Product Grid -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24">

        <!-- Product Grid -->
        <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-5">
            <?php
            $paged = max(1, get_query_var('paged', 1));

            $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
            'paged'          => $paged,
            ];

            if (!empty($_GET['product_cat'])) {
            $args['tax_query'] = [[
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['product_cat'])
            ]];
            }

            $meta_query = [];
            if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
            $min = $_GET['min_price'] ?? 0;
            $max = $_GET['max_price'] ?? 999999;
            $meta_query[] = [
                'key'     => '_price',
                'value'   => [$min, $max],
                'compare' => 'BETWEEN',
                'type'    => 'NUMERIC'
            ];
            }
            if (!empty($meta_query)) $args['meta_query'] = $meta_query;

            if (!empty($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price':
                $args['meta_key'] = '_price';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'ASC';
                break;
                case 'price-desc':
                $args['meta_key'] = '_price';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'DESC';
                break;
                case 'popularity':
                $args['meta_key'] = 'total_sales';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'DESC';
                break;
                default:
                $args['orderby'] = 'date';
                $args['order']   = 'DESC';
            }
            }

            $loop = new \WP_Query($args);

            if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                global $product;
                $image_url = wp_get_attachment_url($product->get_image_id());
            ?>

            <!-- Product Card -->
            <div class="group relative flex flex-col cursor-pointer"
                data-product-id="<?= esc_attr($product->get_id()) ?>"
                data-product-name="<?= esc_attr($product->get_name()) ?>"
                data-product-price="<?= esc_attr($product->get_price()) ?>"
                data-product-image="<?= esc_url($image_url) ?>">

                <!-- Image Block -->
                <div class="relative aspect-[3/4] overflow-hidden bg-slate-50 mb-3">

                <!-- Image -->
                <div class="absolute inset-0 bg-center bg-cover transition-transform duration-700 ease-out group-hover:scale-[1.04]"
                    style="background-image:url('<?= esc_url($image_url) ?>')"></div>

                <!-- Top-left: New badge -->
                <div class="absolute top-3 left-3">
                    <span class="inline-block bg-white text-[9px] font-semibold tracking-[0.15em] uppercase text-slate-700 px-2.5 py-1 shadow-sm">
                    New
                    </span>
                </div>

                <!-- Top-right: Wishlist -->
                <button class="absolute top-3 right-3 w-8 h-8 bg-white flex items-center justify-center
                                opacity-0 group-hover:opacity-100 -translate-y-1 group-hover:translate-y-0
                                hover:bg-primary hover:text-white
                                transition-all duration-200 shadow-sm cursor-pointer">
                    <span class="material-symbols-outlined text-[16px]">favorite</span>
                </button>

                <!-- Bottom: Add to cart bar -->
                <div class="absolute bottom-0 left-0 right-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out">
                    <button @click="addToCart(<?= $product->get_id() ?>)"
                            class="add-to-cart-btn w-full bg-white hover:bg-primary hover:text-white text-slate-900
                                text-[10px] font-semibold tracking-[0.18em] uppercase
                                py-3 flex items-center justify-center gap-2
                                transition-colors duration-200 cursor-pointer">
                    <span class="material-symbols-outlined text-[15px]">add_shopping_cart</span>
                    Add to cart
                    </button>
                </div>
                </div>

                <!-- Info -->
                <div class="flex flex-col gap-0.5 px-0.5">
                <a href="<?php the_permalink() ?>"
                    class="text-[12px] font-medium tracking-wide text-slate-700 hover:text-primary transition-colors duration-150 leading-snug line-clamp-1">
                    <?php the_title() ?>
                </a>
                <p class="text-[13px] font-bold text-slate-900"><?php echo $product->get_price_html() ?></p>
                </div>

            </div>

            <?php
            endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <!-- Pagination -->
        <?php
        $max_pages = ceil($total_products / $args['posts_per_page']);
        $pagination_links = paginate_links([
            'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format'    => '?paged=%#%',
            'current'   => $paged,
            'total'     => $max_pages,
            'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
            'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
            'add_args'  => $_GET,
            'type'      => 'array',
        ]);

        if ($pagination_links) :
        ?>
            <div class="flex items-center justify-center gap-px mt-16 flex-wrap">

            <?php foreach ($pagination_links as $link) :

                // Current page
                if (strpos($link, 'current') !== false) :
                $link = preg_replace('/\s?current/', '', $link);
                echo '<span class="inline-flex items-center justify-center min-w-[44px] h-11 px-4 bg-primary text-white text-xs font-bold tracking-widest uppercase cursor-default">'
                    . $link . '</span>';
                continue;
                endif;

                // Dots
                if (strpos($link, 'dots') !== false) :
                echo '<span class="inline-flex items-center justify-center min-w-[44px] h-11 px-3 bg-slate-50 text-slate-300 text-xs border border-slate-100 cursor-default">'
                    . $link . '</span>';
                continue;
                endif;

                // Prev / Next arrows
                if (strpos($link, 'arrow_') !== false) :
                $link = preg_replace(
                    '/(<a\s+)/',
                    '$1class="inline-flex items-center justify-center w-11 h-11 bg-white border border-slate-200 text-slate-500 hover:bg-primary hover:text-white hover:border-primary transition-colors duration-150 text-sm" ',
                    $link, 1
                );
                echo $link;
                continue;
                endif;

                // Normal page number
                $link = preg_replace(
                '/(<a\s+)/',
                '$1class="inline-flex items-center justify-center min-w-[44px] h-11 px-4 bg-white border border-slate-200 text-slate-600 text-xs font-medium tracking-wider hover:bg-primary hover:text-white hover:border-primary transition-colors duration-150" ',
                $link, 1
                );
                echo $link;

            endforeach; ?>

            </div>
        <?php endif; ?>

        </div>
    </main>
</section>

<?php get_footer(); ?>