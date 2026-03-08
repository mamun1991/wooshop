<!-- Main Footer -->
        </div>
    </div>
    <footer class="bg-background-light dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 py-12 px-6 md:px-20" data-scroll-animate>
          <div class="max-w-[1440px] mx-auto grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-10">
            <div class="col-span-2 lg:col-span-2">
              <div class="flex items-center gap-2 text-primary mb-6">
                <span class="material-symbols-outlined text-2xl">flare</span>
                <h2 class="text-slate-900 dark:text-slate-100 text-lg font-bold">VibeLife</h2>
              </div>
              <p class="text-slate-500 dark:text-slate-400 max-w-sm mb-8">
                Modern lifestyle essentials for the conscious individual. Designed with energy, crafted with care.
              </p>
              <?php
                $facebook  = carbon_get_theme_option('crb_facebook_url');
                $twitter   = carbon_get_theme_option('crb_twitter_url');
                $instagram = carbon_get_theme_option('crb_instagram_url');
                $linkedin  = carbon_get_theme_option('crb_linkedin_url');
                $youtube   = carbon_get_theme_option('crb_youtube_url');
              ?>
              <div class="flex gap-4">
                <?php if ( ! empty( $facebook ) ) { ?>
                  <a class="relative h-10 w-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1" style="background-color: #3b82f6; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);" href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" title="Facebook" onmouseover="this.style.backgroundColor='#2563eb'; this.style.boxShadow='0 10px 15px -3px rgba(59, 130, 246, 0.6);'" onmouseout="this.style.backgroundColor='#3b82f6'; this.style.boxShadow='0 10px 15px -3px rgba(59, 130, 246, 0.3)';">
                    <span class="material-symbols-outlined text-xs text-white" style="pointer-events: none; user-select: none;">thumb_up</span>
                  </a>
                <?php } ?>
                <?php if ( ! empty( $instagram ) ) { ?>
                  <a class="relative h-10 w-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1" style="background-color: #ec4899; box-shadow: 0 10px 15px -3px rgba(236, 72, 153, 0.3);" href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" title="Instagram" onmouseover="this.style.backgroundColor='#be185d'; this.style.boxShadow='0 10px 15px -3px rgba(236, 72, 153, 0.6);'" onmouseout="this.style.backgroundColor='#ec4899'; this.style.boxShadow='0 10px 15px -3px rgba(236, 72, 153, 0.3)';">
                    <span class="material-symbols-outlined text-xs text-white" style="pointer-events: none; user-select: none;">photo_camera</span>
                  </a>
                <?php } ?>
                <?php if ( ! empty( $twitter ) ) { ?>
                  <a class="relative h-10 w-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1" style="background-color: #374151; box-shadow: 0 10px 15px -3px rgba(55, 65, 81, 0.3);" href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" title="Twitter" onmouseover="this.style.backgroundColor='#1f2937'; this.style.boxShadow='0 10px 15px -3px rgba(55, 65, 81, 0.6);'" onmouseout="this.style.backgroundColor='#374151'; this.style.boxShadow='0 10px 15px -3px rgba(55, 65, 81, 0.3)';">
                    <span class="material-symbols-outlined text-xs text-white" style="pointer-events: none; user-select: none;">mail</span>
                  </a>
                <?php } ?>
                <?php if ( ! empty( $linkedin ) ) { ?>
                  <a class="relative h-10 w-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1" style="background-color: #2563eb; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);" href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn" onmouseover="this.style.backgroundColor='#1d4ed8'; this.style.boxShadow='0 10px 15px -3px rgba(37, 99, 235, 0.6);'" onmouseout="this.style.backgroundColor='#2563eb'; this.style.boxShadow='0 10px 15px -3px rgba(37, 99, 235, 0.3)';">
                    <span class="material-symbols-outlined text-xs text-white" style="pointer-events: none; user-select: none;">work</span>
                  </a>
                <?php } ?>
                <?php if ( ! empty( $youtube ) ) { ?>
                  <a class="relative h-10 w-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1" style="background-color: #ef4444; box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);" href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener noreferrer" title="YouTube" onmouseover="this.style.backgroundColor='#dc2626'; this.style.boxShadow='0 10px 15px -3px rgba(239, 68, 68, 0.6);'" onmouseout="this.style.backgroundColor='#ef4444'; this.style.boxShadow='0 10px 15px -3px rgba(239, 68, 68, 0.3)';">
                    <span class="material-symbols-outlined text-xs text-white" style="pointer-events: none; user-select: none;">play_circle</span>
                  </a>
                <?php } ?>
              </div>
            </div>
            <div>
              <h4 class="font-bold mb-6">Shop</h4>
              <ul class="space-y-4 text-slate-500 dark:text-slate-400 text-sm">
                <li><a class="hover:text-primary" href="#">All Products</a></li>
                <li><a class="hover:text-primary" href="#">Best Sellers</a></li>
                <li><a class="hover:text-primary" href="#">New Arrivals</a></li>
                <li><a class="hover:text-primary" href="#">Sale</a></li>
              </ul>
            </div>
            <div>
              <h4 class="font-bold mb-6">Support</h4>
              <ul class="space-y-4 text-slate-500 dark:text-slate-400 text-sm">
                <li><a class="hover:text-primary" href="#">Contact Us</a></li>
                <li><a class="hover:text-primary" href="#">Shipping Info</a></li>
                <li><a class="hover:text-primary" href="#">Returns</a></li>
                <li><a class="hover:text-primary" href="#">FAQs</a></li>
              </ul>
            </div>
            <div>
              <h4 class="font-bold mb-6">Company</h4>
              <ul class="space-y-4 text-slate-500 dark:text-slate-400 text-sm">
                <li><a class="hover:text-primary" href="#">About Us</a></li>
                <li><a class="hover:text-primary" href="#">Sustainability</a></li>
                <li><a class="hover:text-primary" href="#">Journal</a></li>
                <li><a class="hover:text-primary" href="#">Careers</a></li>
              </ul>
            </div>
          </div>
          <div class="max-w-[1440px] mx-auto pt-12 mt-12 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 text-xs">© 2024 VibeLife Inc. All rights reserved.</p>
            <div class="flex gap-6 text-xs text-slate-500">
              <a class="hover:underline" href="#">Privacy Policy</a>
              <a class="hover:underline" href="#">Terms of Service</a>
              <a class="hover:underline" href="#">Cookie Policy</a>
            </div>
          </div>
        </footer>
    <script>
      function carousel() {
        return {
          currentSlide: 0,
          autoPlayInterval: null,
          slides: [
            {
              image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBbpH4ZZ_bTdGsnG9ot1E54nVrChNY9RDlcpDZ7M0EaYzzJJyBUgZcvWbvXflXQGPMRCi5egLqMyH-n2wIPwkGTE8Yj_B1dLWfMnF88VVsjC_B2J4RkgWnkPzhrDgu9DkjehgUgXp63LuJbVtYVxWq_0qgVx_TqIsIZ07JSzZncwEONaVW9fUpIJGHVInjExwNTE7PRHQJv58EvSxDb593YXVaSontUERLggvc8UWZ2KwH1w66Xg_rj35FGGYNPe5JSYHSmaNxrzMU',
              alt: 'A stylish woman in vibrant modern clothing in an urban setting'
            },
            {
              image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCSq9hUycFqB6ZU7zKH6JfNJZTgEiRb77T1xWuKEfpzRUBpvHlErRU6_J8-XITHlrGv4YzSfxQo5fCiIDft6gwHGc2KxGZDJwKxUO9vHGoKwUnjyE6x_HL5Lus5DFfGY3SgXG8N0iF_z8Mn1mmr2afd-sKJTt95f0E1vppI3OdVoS975CyZxRPKgU5Qe6OoIRCTtvBd1ihrFS3iMTk_di9_f_hxW_q7sFCSYZ7dN7JU7QdlV48tjTLBthOEudr0BmjPQUnWpje1Ww4',
              alt: 'Eco-friendly insulated hydration bottle in matte blue'
            },
            {
              image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDTto13eooUrREk-Oz0asuaXwR5TE_u9_HOfsbO3jP9kE_errhOj8aqvl29tNR5kPSWmfVVkRw_j0Y920u_JPaU6RWLb1p8KKOSDyHX_o7n1RFFN4lfocjoxkCDglRf5Q4BUqq_SJJjV66y_2YKwq5noFXwFjHiADcQKuS943OzxCSLtPzovnSAh0LUUft6tQRL6sMXvLTsikBjVW1YDTTD2H7l2vjwsO0LR_2sFdyxtr3rA6ZAHdhxO0-YKkRDao44EAikZ8TuJps',
              alt: 'Minimalist urban backpack in charcoal grey'
            },
            {
              image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAer_sQJBn6J62pHQ3IVWbfjkfbfJ57CW3yfrvKstEcBJsWUMDktLg83T6Y6Af0SClV7SrcJNM90s2EWozSMz-XjpOXXG4PLurpB8NWzCm3ma-bjGgH37ueesamC0pFF8_o_Dl_jAxqChFhOLjYAKHb3hYnyF6Kg_QxuNuwxfNC3Dpg_faIaZhcXd1PR0EJnBhG2KVMQqDXyt0MOibhdK8bTODJN9gdAaM7LCjl8cAyeMTRrbr09BWTp4blt1P8JyIqEpF4YhWILQ4',
              alt: 'Modern studio desk lamp with adjustable arm'
            },
            {
              image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCkplv3hxNqyrrlNirdvMWoKV5d0TMk1bcHMjvTkzvcqyqQ02EiHt8FO-j9jvqhJqImpq4jjVRjpnwVFfjbwBMy31vl-xuc3mVojCymeddaVygvCTY00-Gxckd6Qxip-PyKyXOGrSoUG7egLpJAWJmZK84wWkxQ702dh4MUlHoc-1wM0PR0omQL5BsTEiwy74NYkJlA8Dn7y86USXex3BFfe1qCqRavJZNRDFpC7NY-GG6zWO3nrsD-4Pn5OAIfJviSkriCRDU4JX4',
              alt: 'Luxury scented candle in a dark glass jar'
            }
          ],
          init() {
            this.startAutoPlay();
          },
          next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            this.resetAutoPlay();
          },
          prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            this.resetAutoPlay();
          },
          goToSlide(index) {
            this.currentSlide = index;
            this.resetAutoPlay();
          },
          startAutoPlay() {
            this.autoPlayInterval = setInterval(() => {
              this.next();
            }, 5000);
          },
          resetAutoPlay() {
            clearInterval(this.autoPlayInterval);
            this.startAutoPlay();
          }
        }
      }
    </script>
    <style>
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      .fill-1 {
        font-variation-settings: 'FILL' 1;
      }
      .material-symbols-outlined {
        font-size: 20px !important;
      }
    </style>
    <?php wp_footer(); ?>
  </body>
</html>