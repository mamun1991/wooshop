<?php get_header(); ?>

<!-- Top Navigation Bar -->

<main class="flex-1">
  <!-- Split Screen Hero Section -->
  <section class="max-w-[1440px] mx-auto px-6 md:px-20 py-12 md:py-20" data-scroll-animate>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="flex flex-col gap-8 order-2 lg:order-1">
        <div class="flex flex-col gap-4">
          <span class="text-primary font-bold tracking-widest uppercase text-sm">Season 2024 Collection</span>
          <h1 class="text-slate-900 dark:text-slate-100 text-5xl md:text-7xl font-black leading-tight tracking-tight">
            Elevate Your <br /><span class="text-primary">Daily Rituals</span>
          </h1>
          <p class="text-slate-600 dark:text-slate-400 text-lg md:text-xl max-w-lg leading-relaxed">
            Discover curated essentials for the modern lifestyle. Vibrant, energetic, and uniquely designed to match your pace.
          </p>
        </div>
        <div class="flex flex-wrap gap-4">
          <button class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-lg hover:brightness-110 transition-all shadow-lg shadow-primary/25">
            Shop Now
          </button>
          <button class="border-2 border-slate-200 dark:border-slate-800 px-10 py-4 rounded-xl font-bold text-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
            View Lookbook
          </button>
        </div>
        <div class="flex items-center gap-4 pt-4 border-t border-slate-200 dark:border-slate-800">
          <div class="flex -space-x-3">
            <div class="h-10 w-10 rounded-full border-2 border-background-light bg-slate-300" data-alt="Profile picture of a happy customer"></div>
            <div class="h-10 w-10 rounded-full border-2 border-background-light bg-slate-400" data-alt="Profile picture of a satisfied shopper"></div>
            <div class="h-10 w-10 rounded-full border-2 border-background-light bg-slate-500" data-alt="Profile picture of a community member"></div>
          </div>
          <p class="text-sm font-medium text-slate-500">Joined by 10k+ trendsetters</p>
        </div>
      </div>
      <div class="order-1 lg:order-2">
        <div class="relative">
          <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary/20 rounded-full blur-3xl"></div>
          <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-primary/30 rounded-full blur-3xl"></div>
          <div class="relative w-full aspect-[4/5] bg-slate-200 dark:bg-slate-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="w-full h-full bg-center bg-cover" data-alt="A stylish woman in vibrant modern clothing in an urban setting" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBbpH4ZZ_bTdGsnG9ot1E54nVrChNY9RDlcpDZ7M0EaYzzJJyBUgZcvWbvXflXQGPMRCi5egLqMyH-n2wIPwkGTE8Yj_B1dLWfMnF88VVsjC_B2J4RkgWnkPzhrDgu9DkjehgUgXp63LuJbVtYVxWq_0qgVx_TqIsIZ07JSzZncwEONaVW9fUpIJGHVInjExwNTE7PRHQJv58EvSxDb593YXVaSontUERLggvc8UWZ2KwH1w66Xg_rj35FGGYNPe5JSYHSmaNxrzMU")'></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Premium Trust & Social Proof Section -->
  <section class="py-16 bg-slate-50 dark:bg-slate-900/30 border-y border-slate-200 dark:border-slate-800">
    <div class="max-w-[1440px] mx-auto px-6 md:px-20">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Trust Badge 1 -->
        <div class="flex flex-col items-center text-center gap-3 p-6 rounded-2xl hover:bg-white dark:hover:bg-slate-800/50 transition-all duration-300">
          <div class="w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-xl">verified</span>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 dark:text-white">Certified Premium</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Quality assured & tested</p>
          </div>
        </div>

        <!-- Trust Badge 2 -->
        <div class="flex flex-col items-center text-center gap-3 p-6 rounded-2xl hover:bg-white dark:hover:bg-slate-800/50 transition-all duration-300">
          <div class="w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 dark:text-white">Free Shipping</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">On orders over $50</p>
          </div>
        </div>

        <!-- Trust Badge 3 -->
        <div class="flex flex-col items-center text-center gap-3 p-6 rounded-2xl hover:bg-white dark:hover:bg-slate-800/50 transition-all duration-300">
          <div class="w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-xl">replay</span>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 dark:text-white">30-Day Returns</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">Hassle-free guarantee</p>
          </div>
        </div>

        <!-- Trust Badge 4 -->
        <div class="flex flex-col items-center text-center gap-3 p-6 rounded-2xl hover:bg-white dark:hover:bg-slate-800/50 transition-all duration-300">
          <div class="w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-xl">favorite</span>
          </div>
          <div>
            <h3 class="font-bold text-slate-900 dark:text-white">Lifetime Support</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">We're here for you</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Luxury Collections Section -->
  <section class="py-24 bg-gradient-to-b from-white to-slate-50 dark:from-slate-900 dark:to-slate-900/50 relative overflow-hidden" data-scroll-animate>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 right-1/3 w-96 h-96 bg-primary/10 dark:bg-primary/20 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-40 left-1/4 w-80 h-80 bg-blue-400/10 dark:bg-blue-400/20 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-[1440px] mx-auto px-6 md:px-20 relative z-10">
      <div class="text-center mb-16">
        <h2 class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white mb-4" style="font-family: 'Georgia', serif;">Curated Collections</h2>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Explore our hand-picked collections designed for every lifestyle and occasion</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        // Get product categories
        $categories = get_terms(array(
          'taxonomy' => 'product_cat',
          'hide_empty' => true,
          'number' => 3,
          'orderby' => 'count',
          'order' => 'DESC'
        ));

        // Define gradient colors and badges for each category
        $gradient_colors = array(
          'from-blue-500 to-cyan-500',
          'from-purple-500 to-pink-500',
          'from-amber-500 to-orange-500',
          'from-green-500 to-emerald-500',
          'from-red-500 to-pink-500',
          'from-indigo-500 to-purple-500'
        );

        $badges = array(
          'Limited Edition',
          'Eco-Friendly',
          'Best Sellers',
          'New Arrivals',
          'Premium',
          'Exclusive'
        );

        $index = 0;
        foreach ($categories as $category) {
          $shop_page_url = wc_get_page_permalink('shop');
          $category_link = add_query_arg('product_cat', $category->slug, $shop_page_url);
          $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
          $image_url = wp_get_attachment_url($thumbnail_id);
          
          // Fallback to a default unsplash image if no thumbnail
          if (!$image_url) {
            $default_images = array(
              'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800',
              'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800',
              'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800',
              'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=800',
              'https://images.unsplash.com/photo-1469022563149-aa64dbd37dae?w=800',
              'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800'
            );
            $image_url = $default_images[$index % count($default_images)];
          }

          // Get category description
          $description = $category->description ?: 'Discover premium items in this collection';

          // Get product count
          $product_count = $category->count;
        ?>

        <!-- Dynamic Collection Card -->
        <div class="group relative rounded-3xl overflow-hidden h-96 cursor-pointer" data-scroll-animate>
          <!-- Gradient Background -->
          <div class="absolute inset-0 bg-gradient-to-br <?php echo $gradient_colors[$index % count($gradient_colors)]; ?> opacity-80 group-hover:opacity-90 transition-all duration-500"></div>
          
          <!-- Category Image with Zoom Effect -->
          <div class="absolute inset-0 bg-center bg-cover group-hover:scale-110 transition-transform duration-700" 
            style='background-image: url("<?php echo esc_url($image_url); ?>")'></div>
          
          <!-- Dark Overlay -->
          <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-all duration-500"></div>
          
          <!-- Content -->
          <div class="relative h-full flex flex-col justify-end p-8 text-white">
            <!-- Badge -->
            <div class="inline-block mb-3">
              <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full">
                <?php echo $badges[$index % count($badges)]; ?>
              </span>
            </div>
            
            <!-- Category Name -->
            <h3 class="text-3xl font-black mb-2">
              <?php echo esc_html($category->name); ?>
            </h3>
            
            <!-- Description -->
            <p class="text-white/80 mb-4 group-hover:text-white transition-all line-clamp-2">
              <?php echo esc_html($description); ?>
            </p>

            <!-- Product Count & CTA -->
            <div class="flex items-center justify-between">
              <span class="text-sm font-semibold text-white/70">
                <?php 
                  echo sprintf(
                    esc_html(_n('%d Product', '%d Products', $product_count, 'woocommerce')), 
                    $product_count
                  ); 
                ?>
              </span>
              <a href="<?php echo esc_url($category_link); ?>" class="flex items-center gap-2 text-white font-bold opacity-0 group-hover:opacity-100 transition-all transform group-hover:translate-x-2 duration-300">
                <span>Explore</span>
                <span class="material-symbols-outlined">arrow_forward</span>
              </a>
            </div>
          </div>

          <!-- Floating Badge on Hover (Optional Enhancement) -->
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-100 scale-75">
            <div class="bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-full text-xs font-bold border border-white/20">
              ⭐ Featured
            </div>
          </div>
        </div>

        <?php 
          $index++;
        } 
        ?>
      </div>

      <!-- View All Collections CTA -->
      <div class="mt-16 text-center">
        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" 
          class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-primary to-blue-500 hover:from-primary/90 hover:to-blue-600 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
          <span>Browse All Collections</span>
          <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
      </div>
    </div>
</section>

  <!-- Trending Now Section -->
  <section class="py-24 bg-gradient-to-b from-white via-slate-50/50 to-white dark:from-slate-900 dark:via-slate-900/80 dark:to-slate-900 relative overflow-hidden" data-scroll-animate>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 right-1/3 w-96 h-96 bg-gradient-to-br from-primary/10 to-blue-500/5 dark:from-primary/20 dark:to-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute -bottom-40 left-1/4 w-80 h-80 bg-gradient-to-tr from-purple-400/10 to-pink-400/5 dark:from-purple-400/20 dark:to-pink-400/10 rounded-full blur-3xl animation-pulse"></div>
    </div>

    <div class="max-w-[1440px] mx-auto px-6 md:px-20 relative z-10">
      <div class="flex items-end justify-between mb-16 flex-col md:flex-row gap-6">
        <div class="max-w-2xl">
          <div class="inline-block mb-4">
            <div class="flex items-center gap-2 bg-gradient-to-r from-primary/10 to-blue-500/10 dark:from-primary/20 dark:to-blue-500/20 text-primary dark:text-primary/90 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-primary/20 dark:border-primary/30">
              <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
              Trending This Week
            </div>
          </div>
          <h2 class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white mb-4 leading-tight" style="font-family: 'Georgia', serif;">
            What's <span class="bg-gradient-to-r from-primary via-blue-500 to-cyan-500 bg-clip-text text-transparent animate-gradient">Trending</span>
          </h2>
          <p class="text-lg text-slate-600 dark:text-slate-300 max-w-lg">Discover the most coveted pieces everyone is adding to their cart this week. Limited availability on trending items.</p>
        </div>
        <a class="group flex items-center gap-3 text-primary font-bold text-lg hover:gap-5 transition-all whitespace-nowrap" href="<?= esc_url(wc_get_page_permalink('shop')) ?>">
          <span>View all trending</span>
          <span class="material-symbols-outlined group-hover:translate-x-2 group-hover:scale-110 transition-all duration-300">trending_up</span>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <?php
        $featured_products = wc_get_products(array(
          'limit' => 8,
          'status' => 'publish',
          'featured' => true,
        ));

        $index = 0;
        foreach ($featured_products as $product) {
          $image_url = wp_get_attachment_url($product->get_image_id());
          $rating = $product->get_average_rating();
          $sales = $product->get_total_sales();
          $index++;
        ?>

          <div class="product-card snap-start group h-full flex flex-col"
            data-product-id="<?php echo esc_attr($product->get_id()); ?>"
            data-product-name="<?php echo esc_attr($product->get_name()); ?>"
            data-product-price="<?php echo esc_attr($product->get_price()); ?>"
            data-product-image="<?php echo esc_url($image_url); ?>"
            style="animation-delay: <?php echo ($index * 0.15); ?>s;">

            <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-slate-200 to-slate-100 dark:from-slate-800 dark:to-slate-700 shadow-xl group-hover:shadow-2xl transition-shadow duration-300">
              <div class="w-full h-full bg-center bg-cover transition-transform duration-700 group-hover:scale-110"
                style='background-image: url("<?php echo esc_url($image_url); ?>")'></div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

              <div class="absolute top-4 left-4 z-20">
                <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md text-slate-900 dark:text-white px-4 py-2 rounded-full text-xs font-bold flex items-center gap-1.5 shadow-lg border border-white/30 dark:border-slate-700/30">
                  <span class="text-lg animate-bounce">🔥</span>
                  <span>Trending</span>
                </div>
              </div>

              <?php if ($sales > 0): ?>
                <div class="absolute top-4 right-4 z-20">
                  <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                    <?php echo $sales; ?> sold
                  </div>
                </div>
              <?php endif; ?>

              <div class="absolute bottom-4 right-4 z-20 flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                <button @click="addToCart(<?= $product->get_id() ?>)"
                  class="h-14 w-14 bg-gradient-to-r from-primary to-blue-500 hover:from-primary/90 hover:to-blue-600 text-white rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition-all duration-300 hover:shadow-2xl cursor-pointer group/btn">
                  <span class="material-symbols-outlined text-2xl group-hover/btn:scale-125 transition-transform">add_shopping_cart</span>
                </button>
                <a href="<?php echo esc_url($product->get_permalink()); ?>"
                  class="h-14 w-14 bg-white/90 dark:bg-slate-800/90 hover:bg-white dark:hover:bg-slate-700 text-slate-900 dark:text-white rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition-all duration-300 hover:shadow-2xl cursor-pointer backdrop-blur-sm border border-white/20 dark:border-slate-700/20">
                  <span class="material-symbols-outlined text-xl">visibility</span>
                </a>
              </div>

              <button class="absolute bottom-4 left-4 z-20 h-12 w-12 bg-white/80 dark:bg-slate-800/80 rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 hover:scale-110 hover:bg-red-50 dark:hover:bg-red-900/20 cursor-pointer backdrop-blur-sm border border-white/20 dark:border-slate-700/20 text-slate-400 hover:text-red-500 group-hover:translate-y-1 transition-colors"
                title="Add to wishlist">
                <span class="material-symbols-outlined">favorite</span>
              </button>
            </div>

            <div class="flex-grow flex flex-col">
              <div class="flex items-center gap-2 mb-3">
                <div class="flex gap-0.5">
                  <?php for ($i = 0; $i < 5; $i++): ?>
                    <span class="material-symbols-outlined text-sm <?php echo ($i < floor($rating)) ? 'text-yellow-400 fill-current' : 'text-slate-300 dark:text-slate-600'; ?>">
                      star
                    </span>
                  <?php endfor; ?>
                </div>
                <span class="text-xs text-slate-500 dark:text-slate-400 font-semibold"><?php echo round($rating, 1); ?></span>
              </div>
              <a href="<?php echo esc_url($product->get_permalink()); ?>"
                class="font-bold text-lg text-slate-900 dark:text-white hover:text-primary transition-colors duration-300 mb-3 line-clamp-2 leading-snug group-hover:text-primary">
                <?php echo esc_html($product->get_name()); ?>
              </a>
              <div class="flex items-baseline gap-3 mt-auto">
                <p class="text-2xl font-black text-slate-900 dark:text-white">
                  $<?php echo esc_attr($product->get_price()); ?>
                </p>
                <?php if ($product->is_on_sale()): ?>
                  <p class="text-sm text-slate-400 dark:text-slate-500 line-through font-semibold">
                    $<?php echo esc_attr($product->get_regular_price()); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="mt-20 text-center">
        <div class="inline-block">
          <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>"
            class="group relative inline-flex items-center justify-center px-12 py-5 font-bold text-lg text-white bg-gradient-to-r from-primary via-blue-500 to-cyan-500 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-blue-500/80 to-cyan-500/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <span class="relative flex items-center gap-3">
              See All Trending Items
              <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </span>
          </a>
        </div>
        <p class="mt-6 text-sm text-slate-600 dark:text-slate-400">✨ New trending items added daily • Limited stock available</p>
      </div>
    </div>
  </section>

  <!-- Popular Products Section -->
  <section class="py-24 bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-900/80 relative overflow-hidden" data-scroll-animate>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 dark:bg-primary/10 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-400/5 dark:bg-blue-400/10 rounded-full blur-3xl"></div>
      <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-purple-400/3 dark:bg-purple-400/5 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="max-w-[1440px] mx-auto px-6 md:px-20 relative z-10">
      <div class="flex items-end justify-between mb-16">
        <div class="max-w-2xl">
          <div class="inline-block mb-4">
            <span class="text-sm font-bold text-primary tracking-widest uppercase bg-primary/10 dark:bg-primary/20 px-4 py-2 rounded-full">⭐ Most Loved</span>
          </div>
          <h2 class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white leading-tight mb-3" style="font-family: 'Georgia', serif;">
            Popular <span class="bg-gradient-to-r from-primary via-blue-500 to-purple-500 bg-clip-text text-transparent">Products</span>
          </h2>
          <p class="text-lg text-slate-600 dark:text-slate-300">Discover what our community loves most. Handpicked bestsellers that customers return for.</p>
        </div>
        <a class="group text-primary font-bold flex items-center gap-2 hover:gap-4 transition-all text-lg" href="<?= esc_url(wc_get_page_permalink('shop')) ?>">
          View all
          <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6">
        <?php
        $popular_products = wc_get_products(array(
          'limit' => 8,
          'status' => 'publish',
          'orderby' => 'popularity',
          'order' => 'DESC',
        ));

        $index = 0;
        foreach ($popular_products as $product) {
          $image_url = wp_get_attachment_url($product->get_image_id());
          $rating = $product->get_average_rating();
          $review_count = $product->get_review_count();
          $index++;
        ?>

          <div class="product-card group h-full flex flex-col"
            data-product-id="<?php echo esc_attr($product->get_id()); ?>"
            data-product-name="<?php echo esc_attr($product->get_name()); ?>"
            data-product-price="<?php echo esc_attr($product->get_price()); ?>"
            data-product-image="<?php echo esc_url($image_url); ?>"
            style="animation-delay: <?php echo ($index * 0.1); ?>s;">

            <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-6 bg-gradient-to-br from-slate-200 to-slate-100 dark:from-slate-800 dark:to-slate-700">
              <div class="w-full h-full bg-center bg-cover transition-all duration-700 group-hover:scale-110"
                style='background-image: url("<?php echo esc_url($image_url); ?>")'>
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

              <div class="absolute top-4 left-4">
                <div class="bg-white/95 dark:bg-slate-900/95 text-slate-900 dark:text-white px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1.5 backdrop-blur-sm border border-white/20 shadow-lg">
                  <span>🔥</span> Popular
                </div>
              </div>

              <?php if ($product->is_on_sale()):
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
                $discount = round(((($regular_price - $sale_price) / $regular_price) * 100));
              ?>
                <div class="absolute top-4 right-4">
                  <div class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg animate-pulse">
                    -<?php echo $discount; ?>%
                  </div>
                </div>
              <?php endif; ?>

              <button @click="addToCart(<?= $product->get_id() ?>)"
                class="add-to-cart-btn absolute bottom-4 right-4 h-14 w-14 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 hover:scale-110 hover:bg-gradient-to-r hover:from-primary hover:to-blue-500 hover:text-white hover:shadow-2xl cursor-pointer border border-white/20 dark:border-slate-700/20 backdrop-blur-sm"
                title="Add to cart">
                <span class="material-symbols-outlined text-2xl">add_shopping_cart</span>
              </button>

              <button class="absolute top-4 bottom-auto right-4 h-11 w-11 bg-white/80 dark:bg-slate-800/80 rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0 hover:scale-110 hover:bg-primary/20 cursor-pointer backdrop-blur-sm border border-white/20 dark:border-slate-700/20 text-slate-400 hover:text-red-500 group-hover:translate-y-1"
                title="Add to wishlist">
                <span class="material-symbols-outlined">favorite</span>
              </button>
            </div>

            <div class="flex flex-col flex-grow">
              <div class="text-xs font-semibold text-primary/70 dark:text-primary/80 uppercase tracking-wide mb-2">New Arrival</div>
              <a href="<?php echo esc_url($product->get_permalink()); ?>"
                class="font-bold text-lg text-slate-900 dark:text-white group-hover:text-primary transition-colors duration-300 mb-2 line-clamp-2 leading-snug">
                <?php echo esc_html($product->get_name()); ?>
              </a>
              <div class="flex items-center gap-3 mb-4">
                <div class="flex items-center gap-1">
                  <?php for ($i = 0; $i < 5; $i++): ?>
                    <span class="material-symbols-outlined text-lg <?php echo ($i < floor($rating)) ? 'text-yellow-400 fill-current' : 'text-slate-300 dark:text-slate-600'; ?>">
                      star
                    </span>
                  <?php endfor; ?>
                </div>
                <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">(<?php echo $review_count; ?>)</span>
              </div>
              <div class="flex items-center gap-3 mb-4 mt-auto">
                <p class="text-2xl font-black text-slate-900 dark:text-white">
                  $<?php echo esc_attr($product->get_price()); ?>
                </p>
                <?php if ($product->is_on_sale()): ?>
                  <p class="text-sm text-slate-400 dark:text-slate-500 line-through">
                    $<?php echo esc_attr($product->get_regular_price()); ?>
                  </p>
                <?php endif; ?>
              </div>
              <div class="flex items-center gap-2 text-xs font-semibold">
                <div class="w-2 h-2 rounded-full <?php echo ($product->get_stock_quantity() > 5) ? 'bg-green-500' : 'bg-orange-500'; ?>"></div>
                <span class="text-slate-600 dark:text-slate-400">
                  <?php echo ($product->get_stock_quantity() > 5) ? 'In Stock' : 'Low Stock'; ?>
                </span>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="mt-20 text-center">
        <a href="<?= esc_url(wc_get_page_permalink('shop')) ?>"
          class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-primary to-blue-500 hover:from-primary/90 hover:to-blue-600 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
          <span>Explore More</span>
          <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Premium Benefits Section -->
  <section class="py-24 bg-white dark:bg-slate-900/50 relative overflow-hidden" data-scroll-animate>
    <div class="max-w-[1440px] mx-auto px-6 md:px-20">
      <div class="text-center mb-16">
        <h2 class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white mb-4" style="font-family: 'Georgia', serif;">Why Choose Us</h2>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Experience luxury shopping with premium benefits and unmatched customer service</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Benefit 1 -->
        <div class="p-8 rounded-3xl border border-slate-200 dark:border-slate-700 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group">
          <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
            <span class="material-symbols-outlined text-white text-3xl">diamond</span>
          </div>
          <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">Premium Quality</h3>
          <p class="text-slate-600 dark:text-slate-400 mb-4">Handpicked, rigorously tested products that meet the highest standards of excellence and durability.</p>
          <div class="flex items-center gap-2 text-primary font-bold">
            <span>Learn more</span>
            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>

        <!-- Benefit 2 -->
        <div class="p-8 rounded-3xl border border-slate-200 dark:border-slate-700 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group">
          <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
            <span class="material-symbols-outlined text-white text-3xl">eco</span>
          </div>
          <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">Sustainable Impact</h3>
          <p class="text-slate-600 dark:text-slate-400 mb-4">Every purchase supports our commitment to environmental responsibility and ethical manufacturing practices.</p>
          <div class="flex items-center gap-2 text-primary font-bold">
            <span>Learn more</span>
            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>

        <!-- Benefit 3 -->
        <div class="p-8 rounded-3xl border border-slate-200 dark:border-slate-700 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group">
          <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
            <span class="material-symbols-outlined text-white text-3xl">verified_user</span>
          </div>
          <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">Exclusive Membership</h3>
          <p class="text-slate-600 dark:text-slate-400 mb-4">Join our VIP club for early access to new collections, exclusive discounts, and personalized recommendations.</p>
          <div class="flex items-center gap-2 text-primary font-bold">
            <span>Learn more</span>
            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>

        <!-- Benefit 4 -->
        <div class="p-8 rounded-3xl border border-slate-200 dark:border-slate-700 hover:border-primary/50 hover:shadow-lg transition-all duration-300 group">
          <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
            <span class="material-symbols-outlined text-white text-3xl">headset_mic</span>
          </div>
          <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">24/7 Support</h3>
          <p class="text-slate-600 dark:text-slate-400 mb-4">Our expert team is always ready to help. Connect with us via chat, email, or phone anytime you need assistance.</p>
          <div class="flex items-center gap-2 text-primary font-bold">
            <span>Learn more</span>
            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-20 bg-gradient-to-b from-white to-slate-50 dark:from-slate-900 dark:to-slate-900/50" data-scroll-animate>
    <div class="max-w-[1440px] mx-auto px-6 md:px-20">
      <div class="text-center mb-16">
        <h2 class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white mb-4" style="font-family: 'Georgia', serif;">What Our <span class="bg-gradient-to-r from-primary to-blue-500 bg-clip-text text-transparent">Community Says</span></h2>
        <p class="text-lg text-slate-600 dark:text-slate-400">Trusted by thousands of satisfied customers worldwide</p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-white dark:bg-slate-800/50 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-lg hover:border-primary/30 transition-all duration-300 group">
          <div class="flex justify-center text-primary mb-4">
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
          </div>
          <p class="text-slate-600 dark:text-slate-400 italic mb-6 leading-relaxed">
            "The quality is unmatched. I've bought three items this month and each one has exceeded my expectations. Highly recommend!"
          </p>
          <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary to-blue-500 flex-shrink-0"></div>
            <div>
              <div class="font-bold text-slate-900 dark:text-slate-100">Sarah Jenkins</div>
              <div class="text-sm text-slate-500">Verified Buyer</div>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-white dark:bg-slate-800/50 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-lg hover:border-primary/30 transition-all duration-300 group">
          <div class="flex justify-center text-primary mb-4">
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star_half</span>
          </div>
          <p class="text-slate-600 dark:text-slate-400 italic mb-6 leading-relaxed">
            "Love the sustainable approach. It's rare to find a brand that combines aesthetic with real values so perfectly."
          </p>
          <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex-shrink-0"></div>
            <div>
              <div class="font-bold text-slate-900 dark:text-slate-100">David Chen</div>
              <div class="text-sm text-slate-500">Design Lead</div>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-white dark:bg-slate-800/50 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 hover:shadow-lg hover:border-primary/30 transition-all duration-300 group">
          <div class="flex justify-center text-primary mb-4">
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
            <span class="material-symbols-outlined fill-current">star</span>
          </div>
          <p class="text-slate-600 dark:text-slate-400 italic mb-6 leading-relaxed">
            "Fast shipping and amazing customer support. VibeLife has become my go-to for all lifestyle essentials!"
          </p>
          <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex-shrink-0"></div>
            <div>
              <div class="font-bold text-slate-900 dark:text-slate-100">Emma Rodriguez</div>
              <div class="text-sm text-slate-500">Lifestyle Blogger</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Newsletter Footer Section -->
  <section class="mx-6 md:mx-20 my-12" data-scroll-animate>
    <div class="bg-gradient-to-r from-primary via-blue-500 to-cyan-500 rounded-3xl p-8 md:p-16 text-center text-white relative overflow-hidden">
      <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
      <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>
      <div class="relative z-10 max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-black mb-4">Join the Vibe Tribe</h2>
        <p class="text-white/80 mb-8 text-lg">Subscribe for early access to new drops, exclusive discounts, and a weekly dose of inspiration.</p>
        <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
          <input class="flex-1 px-6 py-4 rounded-xl text-slate-900 border-none focus:ring-4 focus:ring-white/20 outline-none" placeholder="Enter your email" required="" type="email" />
          <button class="bg-slate-900 text-white font-bold px-8 py-4 rounded-xl hover:bg-slate-800 transition-all" type="submit">Subscribe</button>
        </form>
        <p class="mt-4 text-xs text-white/60">By subscribing, you agree to our Privacy Policy and Terms of Service.</p>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

<!-- Animations CSS -->
<style>
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

  @keyframes gradient {
    0%, 100% {
      background-position: 0% 50%;
    }
    50% {
      background-position: 100% 50%;
    }
  }

  .product-card {
    animation: slideInUp 0.6s ease-out forwards;
    opacity: 0;
  }

  .animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
  }

  [data-scroll-animate] {
    animation: slideInUp 0.8s ease-out forwards;
    opacity: 0;
  }
</style>