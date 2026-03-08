<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?php bloginfo('name'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <?php wp_head(); ?>
    <!-- <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script> -->
  </head>
  <body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 overflow-x-hidden">
    <div class="relative flex h-auto min-h-screen w-full flex-col">
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-6 md:px-20 py-4 bg-background-light dark:bg-background-dark sticky top-0 z-50">
          <div class="flex items-center gap-8">
            <div class="flex items-center gap-2 text-primary">
              <span class="material-symbols-outlined text-3xl">flare</span>
              <a href="<?php echo bloginfo('url'); ?>" class="text-slate-900 dark:text-slate-100 text-xl font-bold leading-tight tracking-tight">VibeLife</a>
            </div>
            <?php
              wp_nav_menu(array(
                  'theme_location' => 'header_menu',
                  'container' => 'nav',
                  'container_class' => 'hidden lg:flex items-center gap-8',
                  'menu_class' => 'flex items-center gap-8',
              ));
            ?>
          </div>
          <div class="flex flex-1 justify-end gap-4 md:gap-6 items-center">
            <label class="hidden md:flex flex-col min-w-40 h-10 max-w-64">
              <div class="flex w-full flex-1 items-stretch rounded-lg h-full bg-slate-200/50 dark:bg-slate-800/50">
                <div class="text-slate-500 flex items-center justify-center pl-4">
                  <span class="material-symbols-outlined text-xl">search</span>
                </div>
                <input class="form-input flex w-full min-w-0 flex-1 border-none bg-transparent focus:ring-0 h-full placeholder:text-slate-500 px-4 pl-2 text-sm" placeholder="Search products..." value="" />
              </div>
            </label>
            <div class="flex gap-2">
              <button @click="isCartOpen = true" class="relative flex items-center justify-center rounded-lg h-10 w-10 bg-slate-200/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-primary/20 transition-colors">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" ><?php echo WC()->cart->get_cart_contents_count(); ?></span>
              </button>
              <button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-200/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-primary/20 transition-colors">
                <span class="material-symbols-outlined">person</span>
              </button>
            </div>
          </div>
        </header>

        <!-- Floating Cart Button -->
        <div x-data="{ isCartOpen: false }" class="relative">

          <!-- Overlay -->
          <div x-show="isCartOpen"
              x-transition.opacity
              class="fixed inset-0 bg-opacity-30 z-40"
              @click="isCartOpen = false"></div>

          <!-- Floating Add-to-Cart Button -->
          <button 
              @click="isCartOpen = !isCartOpen"
              :class="isCartOpen ? 'translate-x-[-24rem]' : 'translate-x-0'"
              class="fixed bottom-6 right-2 z-50 h-14 w-14 bg-primary text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-700 cursor-pointer">
              <span class="material-symbols-outlined text-2xl">shopping_cart</span>
          </button>

          <!-- Cart Drawer -->
          <div x-show="isCartOpen"
              x-transition:enter="transition transform duration-700"
              x-transition:enter-start="translate-x-full"
              x-transition:enter-end="translate-x-0"
              x-transition:leave="transition transform duration-700"
              x-transition:leave-start="translate-x-0"
              x-transition:leave-end="translate-x-full"
              class="fixed right-0 top-0 h-screen w-96 bg-white shadow-2xl z-50 flex flex-col rounded-l-2xl overflow-hidden">

              <!-- Drawer Header -->
              <div class="p-6 flex justify-between items-center border-b border-gray-200 bg-white">
                  <h2 class="text-2xl font-bold tracking-wide text-gray-800">Your Cart</h2>
                  <button @click="isCartOpen = false"
                      class="text-gray-500 hover:text-red-500 text-3xl font-bold transition-colors">✕</button>
              </div>

              <!-- Drawer Content -->
              <div id="cartItems" class="flex-1 overflow-y-auto divide-y divide-gray-200 p-4 space-y-4">
                  <h2 class="font-bold text-xl mb-4">Your Cart</h2>
                  <div id="cartItems">
                      <?php 
                        if ( function_exists('woocommerce_mini_cart') ) {
                            woocommerce_mini_cart();
                        }
                      ?>
                  </div>
                  <p id="cartTotal" class="font-bold mt-4"><?php echo WC()->cart->get_cart_total(); ?></p>
              </div>

              <!-- Drawer Footer -->
              <div class="p-6 border-t border-gray-200 bg-white sticky bottom-0 flex flex-col gap-3">
                  <div class="flex justify-between items-center">
                      <span class="text-lg font-semibold text-gray-700">Total</span>
                      <span class="text-xl font-bold text-gray-900" id="cartTotal">$0.00</span>
                  </div>
                  <a href="<?php echo wc_get_cart_url(); ?>"
                      class="block w-full bg-primary text-white text-center py-3 rounded-lg shadow hover:bg-primary/90 transition">
                      View Cart
                  </a>
                  <a href="<?php echo wc_get_checkout_url(); ?>"
                      class="block w-full border border-gray-300 text-center py-3 rounded-lg hover:bg-gray-50 transition">
                      Checkout
                  </a>
              </div>

          </div>
      </div>
