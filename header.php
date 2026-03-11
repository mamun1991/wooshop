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

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 overflow-x-hidden" x-data="wooCart()" x-init="init()">
    <div class="relative flex h-auto min-h-screen w-full flex-col">
        <div class="layout-container flex w-full grow flex-col fixed z-50">
            <!-- <div x-data="wooCart()" x-init="init()"> -->
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
                        <button class="relative flex items-center justify-center rounded-lg h-10 w-10 bg-slate-200/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-primary/20 transition-colors" @click="cartOpen = true">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <span class="absolute -top-2 -right-2 bg-primary text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" x-show="cartCount > 0" x-text="cartCount"></span>
                        </button>
                        <button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-200/50 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-primary/20 transition-colors">
                            <span class="material-symbols-outlined">person</span>
                        </button>
                    </div>
                </div>
            </header>
        </div>

        <!-- Cart Sidebar Modal -->


        <div class="relative">
            <!-- Backdrop -->
            <div
                x-show="cartOpen"
                x-transition:enter="transition-opacity duration-800"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-800"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-40"
                @click="cartOpen = false">
            </div>

            <!-- Cart Button + Drawer Container (moves together) -->
            <div
                :class="cartOpen ? 'translate-x-0' : 'translate-x-full'"
                class="fixed bottom-0 right-0 z-50 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] h-screen flex items-end">

                <!-- Cart Drawer -->
                <div
                    class="h-screen w-96 flex flex-col"
                    style="background: #fafaf9; border-left: 1px solid #e5e5e3;">

                    <!-- Header -->
                    <div class="flex items-center justify-between px-6 py-5 border-b border-stone-200">
                        <div>
                            <h2 class="text-base font-semibold tracking-tight text-neutral-900" style="font-family: 'Georgia', serif;">Your Cart</h2>
                            <p class="text-xs text-neutral-400 mt-0.5" x-text="cartCount + ' item' + (cartCount !== 1 ? 's' : '')"></p>
                        </div>
                        <button
                            @click="cartOpen = false"
                            class="h-8 w-8 rounded-full bg-stone-100 hover:bg-stone-200 flex items-center justify-center text-neutral-500 hover:text-neutral-800 transition-all text-sm">
                            ✕
                        </button>
                    </div>

                    <!-- Scrollable Items Area -->
                    <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4" style="scrollbar-width: thin; scrollbar-color: #d4d4d0 transparent;">

                        <!-- Empty State -->
                        <template x-if="cart.length === 0">
                            <div class="flex flex-col items-center justify-center h-full py-20 text-center">
                                <div class="h-16 w-16 rounded-2xl bg-stone-100 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-2xl text-stone-400">shopping_cart</span>
                                </div>
                                <p class="text-sm font-medium text-neutral-600">Your cart is empty</p>
                                <p class="text-xs text-neutral-400 mt-1">Add something you love</p>
                            </div>
                        </template>

                        <!-- Cart Items -->
                        <template x-for="item in cart" :key="item.key">
                            <div class="flex gap-4 p-3 rounded-2xl bg-white border border-stone-100 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <img
                                    :src="item.images[0].src"
                                    class="w-20 h-20 object-cover rounded-xl flex-shrink-0"
                                    style="background:#f0efed;">
                                <div class="flex-1 min-w-0 flex flex-col justify-between py-0.5">
                                    <div>
                                        <p class="text-sm font-semibold text-neutral-900 leading-tight truncate" x-text="item.name"></p>
                                        <p class="text-sm text-neutral-500 mt-0.5" x-html="(item.prices.price / 100).toFixed(2)"></p>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <div class="flex items-center gap-2 bg-stone-100 rounded-xl px-2 py-1">
                                            <button
                                                @click="updateQty(item.key, item.quantity - 1)"
                                                class="h-6 w-6 rounded-lg flex items-center justify-center text-neutral-600 hover:bg-white hover:shadow-sm transition-all text-sm font-bold">
                                                −
                                            </button>
                                            <span class="text-sm font-semibold text-neutral-800 w-4 text-center" x-text="item.quantity"></span>
                                            <button
                                                @click="updateQty(item.key, item.quantity + 1)"
                                                class="h-6 w-6 rounded-lg flex items-center justify-center text-neutral-600 hover:bg-white hover:shadow-sm transition-all text-sm font-bold">
                                                +
                                            </button>
                                        </div>
                                        <!-- Remove -->
                                        <button
                                            @click="removeItem(item.key)"
                                            class="text-xs cursor-pointer text-rose-400 hover:text-rose-600 transition-colors font-medium">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Footer: Pinned to Bottom -->
                    <div class="px-6 py-5 border-t border-stone-200 bg-white space-y-4">
                        <!-- Divider -->
                        <div class="border-t border-dashed border-stone-200"></div>
                        <!-- Total -->
                        <div class="flex justify-between items-center">
                            <span class="text-base font-semibold text-neutral-900" style="font-family:'Georgia',serif;">Total</span>
                            <span x-html="(totals.total_price / 100).toFixed(2)" class="text-base font-bold text-neutral-900"></span>
                        </div>

                        <a href="/checkout"
                            class="flex items-center justify-center gap-2 w-full bg-primary hover:bg-opacity-90 hover:brightness-90 hover:scale-95 text-white text-sm font-semibold py-4 rounded-2xl transition-colors duration-500 shadow-md hover:shadow-lg">
                            <span>Proceed to Checkout</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                        <!-- Trust note -->
                        <p class="text-center text-[11px] text-neutral-400">🔒 Secure checkout &nbsp;·&nbsp; Free returns</p>
                    </div>
                </div>

                <!-- Cart Button (inside the sliding container) -->
                <button
                    @click="cartOpen = !cartOpen"
                    class="absolute bottom-6 -left-20 h-14 w-14 bg-primary text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-300 cursor-pointer z-50">
                    <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                    <span
                        class="absolute -top-1 -right-1 bg-white text-primary text-xs border border-gray-200 font-bold rounded-full h-5 w-5 flex items-center justify-center"
                        x-show="cartCount > 0"
                        x-text="cartCount">
                    </span>
                </button>
            </div>
        </div>
        <!-- <div class="fixed inset-0 bg-black/50 z-40 transition-opacity duration-700" x-show="isCartOpen" @click="closeCart()"></div> -->

        <div
        class="fixed bottom-4 right-4 bg-primary text-white px-4 py-2 rounded-full shadow-xl z-50 flex items-center gap-3 max-w-xs ring-1 ring-primary/20"
        x-show="showToast"
        x-transition:enter="transition transform ease-out duration-600"
        x-transition:enter-start="opacity-0 translate-y-4 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition transform ease-in duration-600"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-90">
        <span class="material-symbols-outlined text-lg">check_circle</span>
        <span class="flex-1 text-sm font-medium" x-text="toastMessage"></span>
        <button class="text-white opacity-70 hover:opacity-100 focus:outline-none" @click="showToast=false">
            <span class="material-symbols-outlined">close</span>
        </button>
        </div>