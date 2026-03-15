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
                // Define all platform styles & icons in one place
                $platform_config = array(
                    'facebook'  => array(
                        'bg'         => '#3b82f6',
                        'bg_hover'   => '#2563eb',
                        'shadow'     => 'rgba(59, 130, 246, 0.3)',
                        'shadow_hover' => 'rgba(59, 130, 246, 0.6)',
                        'icon'       => 'thumb_up',
                        'label'      => 'Facebook',
                    ),
                    'instagram' => array(
                        'bg'         => '#ec4899',
                        'bg_hover'   => '#be185d',
                        'shadow'     => 'rgba(236, 72, 153, 0.3)',
                        'shadow_hover' => 'rgba(236, 72, 153, 0.6)',
                        'icon'       => 'photo_camera',
                        'label'      => 'Instagram',
                    ),
                    'twitter'   => array(
                        'bg'         => '#374151',
                        'bg_hover'   => '#1f2937',
                        'shadow'     => 'rgba(55, 65, 81, 0.3)',
                        'shadow_hover' => 'rgba(55, 65, 81, 0.6)',
                        'icon'       => 'mail',
                        'label'      => 'Twitter / X',
                    ),
                    'linkedin'  => array(
                        'bg'         => '#2563eb',
                        'bg_hover'   => '#1d4ed8',
                        'shadow'     => 'rgba(37, 99, 235, 0.3)',
                        'shadow_hover' => 'rgba(37, 99, 235, 0.6)',
                        'icon'       => 'work',
                        'label'      => 'LinkedIn',
                    ),
                    'youtube'   => array(
                        'bg'         => '#ef4444',
                        'bg_hover'   => '#dc2626',
                        'shadow'     => 'rgba(239, 68, 68, 0.3)',
                        'shadow_hover' => 'rgba(239, 68, 68, 0.6)',
                        'icon'       => 'play_circle',
                        'label'      => 'YouTube',
                    ),
                    'tiktok'    => array(
                        'bg'         => '#000000',
                        'bg_hover'   => '#1a1a1a',
                        'shadow'     => 'rgba(0, 0, 0, 0.3)',
                        'shadow_hover' => 'rgba(0, 0, 0, 0.6)',
                        'icon'       => 'music_note',
                        'label'      => 'TikTok',
                    ),
                    'pinterest' => array(
                        'bg'         => '#e11d48',
                        'bg_hover'   => '#be123c',
                        'shadow'     => 'rgba(225, 29, 72, 0.3)',
                        'shadow_hover' => 'rgba(225, 29, 72, 0.6)',
                        'icon'       => 'push_pin',
                        'label'      => 'Pinterest',
                    ),
                );

                $social_links = carbon_get_theme_option( 'crb_social_links' );
                ?>

              <div class="flex gap-4">
                <?php if ( ! empty( $social_links ) ) : ?>
                    <?php foreach ( $social_links as $link ) :
                        $platform = $link['platform'];
                        $url      = $link['url'];

                        // Skip if URL is empty or platform not configured
                        if ( empty( $url ) || ! isset( $platform_config[ $platform ] ) ) continue;

                        $config = $platform_config[ $platform ];
                    ?>
                        <a  class="relative h-10 w-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1"
                            style="background-color: <?php echo $config['bg']; ?>; box-shadow: 0 10px 15px -3px <?php echo $config['shadow']; ?>;"
                            href="<?php echo esc_url( $url ); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            title="<?php echo esc_attr( $config['label'] ); ?>"
                            onmouseover="this.style.backgroundColor='<?php echo $config['bg_hover']; ?>'; this.style.boxShadow='0 10px 15px -3px <?php echo $config['shadow_hover']; ?>';"
                            onmouseout="this.style.backgroundColor='<?php echo $config['bg']; ?>'; this.style.boxShadow='0 10px 15px -3px <?php echo $config['shadow']; ?>';"
                        >
                            <span class="material-symbols-outlined text-xs text-white" style="pointer-events: none; user-select: none;">
                                <?php echo esc_html( $config['icon'] ); ?>
                            </span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
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