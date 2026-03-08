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
          <!-- Trending Now Horizontal Scroll -->
          <section class="py-16 bg-white dark:bg-slate-900/50" data-scroll-animate>
            <div class="max-w-[1440px] mx-auto px-6 md:px-20">
              <div class="flex items-end justify-between mb-10">
                <div>
                  <h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Trending Now</h2>
                  <p class="text-slate-500 mt-2">The pieces everyone is talking about this week.</p>
                </div>
                <a class="text-primary font-bold flex items-center gap-1 hover:underline" href="#">
                  View all <span class="material-symbols-outlined">arrow_forward</span>
                </a>
              </div>
              <div class="flex overflow-x-auto pb-8 gap-6 no-scrollbar snap-x">
                <!-- Product 1 -->
                 <?php
                  $featured_products = wc_get_products(array(
                      'limit' => 4,
                      'status' => 'publish',
                      'featured' => true,
                  ));

                  foreach ($featured_products as $product) {
                      $image_url = wp_get_attachment_url($product->get_image_id()); ?>
                <div class="product-card min-w-[280px] md:min-w-[300px] snap-start group" 
                    data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                    data-product-name="<?php echo esc_attr($product->get_name()); ?>"
                    data-product-price="<?php echo esc_attr($product->get_price()); ?>"
                    data-product-image="<?php echo esc_url($image_url); ?>">
                  <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-4 bg-slate-100 dark:bg-slate-800">
                    <div class="w-full h-full bg-center bg-cover transition-transform duration-500 group-hover:scale-110" data-alt="Eco-friendly insulated hydration bottle in matte blue" style='background-image: url("<?php echo esc_url($image_url); ?>")'></div>
                    <button class="add-to-cart-btn absolute bottom-4 right-4 h-12 w-12 bg-white rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-all translate-y-2 group-hover:translate-y-0 duration-300 hover:scale-110 hover:bg-primary hover:text-white cursor-pointer" title="Click to add to cart" @click="addToCart($event)">
                      <span class="material-symbols-outlined">add_shopping_cart</span>
                    </button>
                  </div>
                  <h3 class="font-bold text-lg text-slate-900 dark:text-slate-100"><?php echo esc_html($product->get_name()); ?></h3>
                  <p class="text-primary font-bold">$<?php echo esc_attr($product->get_price()); ?></p>
                </div>
                <?php } ?>
                
              </div>
            </div>
          </section>
          <!-- Testimonials Section -->
          <section class="py-20 bg-background-light dark:bg-background-dark" data-scroll-animate>
            <div class="max-w-[1440px] mx-auto px-6 md:px-20 text-center">
              <h2 class="text-3xl font-bold mb-12">What Our Community Says</h2>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white dark:bg-slate-800/50 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800">
                  <div class="flex justify-center text-primary mb-4">
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                  </div>
                  <p class="text-slate-600 dark:text-slate-400 italic mb-6 leading-relaxed">
                    "The quality is unmatched. I've bought three items this month and each one has exceeded my expectations."
                  </p>
                  <div class="font-bold text-slate-900 dark:text-slate-100">Sarah Jenkins</div>
                  <div class="text-sm text-slate-500">Verified Buyer</div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white dark:bg-slate-800/50 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800">
                  <div class="flex justify-center text-primary mb-4">
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star_half</span>
                  </div>
                  <p class="text-slate-600 dark:text-slate-400 italic mb-6 leading-relaxed">
                    "Love the sustainable approach. It's rare to find a brand that combines aesthetic with real values so well."
                  </p>
                  <div class="font-bold text-slate-900 dark:text-slate-100">David Chen</div>
                  <div class="text-sm text-slate-500">Design Lead</div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white dark:bg-slate-800/50 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800">
                  <div class="flex justify-center text-primary mb-4">
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                    <span class="material-symbols-outlined fill-1">star</span>
                  </div>
                  <p class="text-slate-600 dark:text-slate-400 italic mb-6 leading-relaxed">
                    "Fast shipping and amazing customer support. VibeLife has become my go-to for all my lifestyle essentials."
                  </p>
                  <div class="font-bold text-slate-900 dark:text-slate-100">Emma Rodriguez</div>
                  <div class="text-sm text-slate-500">Lifestyle Blogger</div>
                </div>
              </div>
            </div>
          </section>
          <!-- Newsletter Footer Section -->
          <section class="mx-6 md:mx-20 my-12" data-scroll-animate>
            <div class="bg-primary rounded-3xl p-8 md:p-16 text-center text-white relative overflow-hidden">
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

