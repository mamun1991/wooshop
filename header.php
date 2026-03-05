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
  </head>
  <body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 overflow-x-hidden" x-data="shoppingCart()" @load="init()">
    <div class="relative flex h-auto min-h-screen w-full flex-col">
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-6 md:px-20 py-4 bg-background-light dark:bg-background-dark sticky top-0 z-50">
          <div class="flex items-center gap-8">
            <div class="flex items-center gap-2 text-primary">
              <span class="material-symbols-outlined text-3xl">flare</span>
              <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold leading-tight tracking-tight">VibeLife</h2>
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
              <button class="relative flex items-center justify-center rounded-lg h-10 w-10 bg-slate-200/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-primary/20 transition-colors" @click="openCart()">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" x-show="totalItems > 0" x-text="totalItems"></span>
              </button>
              <button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-200/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-primary/20 transition-colors">
                <span class="material-symbols-outlined">person</span>
              </button>
            </div>
          </div>
        </header>

        <!-- Cart Sidebar Modal -->
        <div
          class="fixed right-0 top-0 h-screen w-96 bg-background-light dark:bg-background-dark border-l border-slate-200 dark:border-slate-800 shadow-lg z-50"
          x-show="isCartOpen"
          x-transition:enter="transition-transform ease-out duration-500"
          x-transition:enter-start="translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition-transform ease-in duration-500"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="translate-x-full"
        >
          <div class="flex flex-col h-full">
            <!-- Cart Header -->
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 px-6 py-4">
              <h3 class="text-lg font-bold">Shopping Cart</h3>
              <button class="flex items-center justify-center rounded-lg h-10 w-10 text-slate-900 hover:opacity-90 transition-opacity" @click="closeCart()" title="Close cart">
                <span class="material-symbols-outlined">close</span>
              </button>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
              <template x-if="items.length === 0">
                <p class="text-center text-slate-500 py-8">Your cart is empty</p>
              </template>
              
              <template x-for="item in items" :key="item.id">
                <div class="flex gap-4 bg-slate-50 dark:bg-slate-800 p-4 rounded-lg">
                  <div class="w-20 h-20 bg-slate-200 dark:bg-slate-700 rounded-lg overflow-hidden flex-shrink-0">
                    <div class="w-full h-full bg-center bg-cover" :style="'background-image: url(' + item.image + ')'"></div>
                  </div>
                  <div class="flex-1 flex flex-col justify-between">
                    <div>
                      <h4 class="font-semibold text-slate-900 dark:text-slate-100" x-text="item.name"></h4>
                      <p class="text-primary font-bold text-sm" x-text="'$' + item.price.toFixed(2)"></p>
                    </div>
                    <div class="flex items-center gap-2">
                      <button class="flex items-center justify-center w-6 h-6 bg-slate-200 dark:bg-slate-700 rounded hover:bg-slate-300 dark:hover:bg-slate-600" @click="updateQuantity(item.id, item.quantity - 1)">
                        <span class="text-sm">−</span>
                      </button>
                      <span class="w-8 text-center font-semibold" x-text="item.quantity"></span>
                      <button class="flex items-center justify-center w-6 h-6 bg-slate-200 dark:bg-slate-700 rounded hover:bg-slate-300 dark:hover:bg-slate-600" @click="updateQuantity(item.id, item.quantity + 1)">
                        <span class="text-sm">+</span>
                      </button>
                      <button class="ml-auto text-slate-500 hover:text-primary transition-colors" @click="removeFromCart(item.id)">
                        <span class="material-symbols-outlined text-lg">close</span>
                      </button>
                    </div>
                  </div>
                </div>
              </template>
            </div>

            <!-- Cart Footer -->
            <div class="border-t border-slate-200 dark:border-slate-800 px-6 py-4 space-y-3">
              <div class="flex justify-between items-center font-bold text-lg">
                <span>Total:</span>
                <span class="text-primary" x-text="'$' + cartTotal.toFixed(2)"></span>
              </div>
              <button class="w-full bg-primary text-white rounded-lg py-3 font-semibold hover:opacity-90 transition-opacity">
                Proceed to Checkout
              </button>
            </div>
          </div>
        </div>

        <!-- Cart Overlay -->
        <div class="fixed inset-0 bg-black/50 z-40 transition-opacity duration-300" x-show="isCartOpen" @click="closeCart()"></div>

        <!-- Floating Cart Button (appears on scroll) -->
        <button
          class="fixed bottom-4 right-4 h-14 w-14 bg-primary text-white rounded-full shadow-xl flex items-center justify-center z-50"
          x-show="showCartButton || isCartOpen"
          @click="openCart()"
          x-transition:enter="transition transform ease-out duration-300"
          x-transition:enter-start="opacity-0 scale-50"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition transform ease-in duration-300"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-50"
        >
          <span class="material-symbols-outlined text-2xl">shopping_cart</span>
          <span class="absolute -top-1 -right-1 bg-white text-primary text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" x-show="totalItems > 0" x-text="totalItems" x-transition.scale></span>
        </button>

        <!-- Toast Notification -->
        <div
          class="fixed bottom-4 right-4 bg-primary text-white px-4 py-2 rounded-full shadow-xl z-50 flex items-center gap-3 max-w-xs ring-1 ring-primary/20"
          x-show="showToast"
          x-transition:enter="transition transform ease-out duration-300"
          x-transition:enter-start="opacity-0 translate-y-4 scale-90"
          x-transition:enter-end="opacity-100 translate-y-0 scale-100"
          x-transition:leave="transition transform ease-in duration-300"
          x-transition:leave-start="opacity-100 translate-y-0 scale-100"
          x-transition:leave-end="opacity-0 translate-y-4 scale-90"
        >
          <span class="material-symbols-outlined text-lg">check_circle</span>
          <span class="flex-1 text-sm font-medium" x-text="toastMessage"></span>
          <button class="text-white opacity-70 hover:opacity-100 focus:outline-none" @click="showToast=false">
            <span class="material-symbols-outlined">close</span>
          </button>
        </div>
