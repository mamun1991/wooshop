<?php get_header(); ?>
        <main class="max-w-7xl mx-auto w-full px-6 md:px-10 py-8 lg:py-12" data-scroll-animate>
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 mb-8 text-sm font-medium">
                <a class="text-primary hover:underline" href="#">Cart</a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-900 dark:text-white">Information &amp; Payment</span>
            </nav>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Left Column: Checkout Forms -->
                <div class="lg:col-span-7 space-y-12">
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold tracking-tight">Shipping Address</h2>
                            <p class="text-sm text-slate-500">Already have an account? <a class="text-primary font-semibold" href="#">Log in</a></p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">First Name</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="e.g. Jane" type="text" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Last Name</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="e.g. Doe" type="text" />
                            </div>
                            <div class="md:col-span-2 flex flex-col gap-2">
                                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Address</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="House number and street name" type="text" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">City</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="San Francisco" type="text" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Postal Code</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="94103" type="text" />
                            </div>
                        </div>
                    </section>
                    <section data-scroll-animate>
                        <h2 class="text-2xl font-bold tracking-tight mb-6">Delivery Method</h2>
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-4 border-2 border-primary bg-primary/5 rounded-xl cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <input checked="" class="text-primary focus:ring-primary" name="delivery" type="radio" />
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">Express Delivery</p>
                                        <p class="text-sm text-slate-500">1-2 business days</p>
                                    </div>
                                </div>
                                <span class="font-bold">$25.00</span>
                            </label>
                            <label class="flex items-center justify-between p-4 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <input class="text-primary focus:ring-primary" name="delivery" type="radio" />
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">Standard Shipping</p>
                                        <p class="text-sm text-slate-500">3-5 business days</p>
                                    </div>
                                </div>
                                <span class="font-bold text-green-600">Free</span>
                            </label>
                        </div>
                    </section>
                    <section data-scroll-animate>
                        <h2 class="text-2xl font-bold tracking-tight mb-6">Payment Method</h2>
                        <div class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden bg-white dark:bg-slate-900 shadow-sm">
                            <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <input checked="" class="text-primary focus:ring-primary" name="payment" type="radio" />
                                    <span class="font-semibold">Credit Card</span>
                                </div>
                                <div class="flex gap-2">
                                    <span class="material-symbols-outlined text-slate-400">credit_card</span>
                                </div>
                            </div>
                            <div class="p-6 bg-slate-50 dark:bg-slate-800/20 space-y-4">
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-medium">Card Number</label>
                                    <div class="relative">
                                        <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="0000 0000 0000 0000" type="text" />
                                        <span class="material-symbols-outlined absolute right-3 top-3 text-slate-400">lock</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-2">
                                        <label class="text-sm font-medium">Expiry Date</label>
                                        <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="MM / YY" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label class="text-sm font-medium">CVV</label>
                                        <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="123" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 flex items-center gap-3">
                                <input class="text-primary focus:ring-primary" name="payment" type="radio" />
                                <span class="font-semibold">PayPal</span>
                                <span class="material-symbols-outlined text-slate-400 ml-auto">account_balance_wallet</span>
                            </div>
                        </div>
                    </section>
                    <!-- Trust Badges -->
                    <div class="flex flex-wrap items-center gap-8 pt-4 grayscale opacity-60">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">verified_user</span>
                            <span class="text-xs font-bold uppercase tracking-widest">Secure SSL</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
                            <span class="text-xs font-bold uppercase tracking-widest">Insured Shipping</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">workspace_premium</span>
                            <span class="text-xs font-bold uppercase tracking-widest">Luxury Warranty</span>
                        </div>
                    </div>
                </div>
                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-5">
                    <div class="sticky top-28 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-8 shadow-sm">
                        <h2 class="text-xl font-bold mb-6">Order Summary</h2>
                        <!-- Product List -->
                        <div class="space-y-6 mb-8">
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="size-20 rounded-xl bg-slate-100 dark:bg-slate-800 overflow-hidden border border-slate-200 dark:border-slate-700">
                                        <img alt="Product Image" class="w-full h-full object-cover" data-alt="Minimalist luxury designer watch on a white background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXYT1plDV8jA3_-grD3ON9ghIbOlEaI-xY4J7eA9ISSHy5tESOxMNchRuGU2XuEf6m_ayxT66NjOGVtfDadd3DAnttA2ctbE_X4oHFgK4kZAUbCDI8H06OzlQ4ZaMckGgelbQNaIPJd2j3_YWLHm63QTrQ7Ldd0iq2GyowLxiHAHg8KCGl5_mDZt5oEvtx3D2M84zcnSVYtfEBGSQtIU4UIIUP5KSyZHOLpFqQpD9jlL7MOdoT92YKZSqbYGmPsRsheNM2mY2fZQs" />
                                    </div>
                                    <span class="absolute -top-2 -right-2 bg-slate-800 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">1</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-sm leading-snug">Luxe Chronograph Matte Black Edition</h3>
                                    <p class="text-xs text-slate-500 mt-1">42mm / Midnight Silver</p>
                                    <p class="text-sm font-bold mt-2">$850.00</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="size-20 rounded-xl bg-slate-100 dark:bg-slate-800 overflow-hidden border border-slate-200 dark:border-slate-700">
                                        <img alt="Product Image" class="w-full h-full object-cover" data-alt="Premium leather designer handbag in tan color" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyO174o5e8Oc8B4ZV8SNWZkHrXxjpsphnmvPV0k1QiD_VUUasXGcjHKifpG0mbubpCcZuLzlmiTC4Ig5cyHwwRReqN5j0ezwWax2G2Cqvp-jAWjVtIF6nfjOFmekQCrwv_PA2k-cop4K4XJLXFHk5Gg_u-5I8y_cdfbcueGHRWxFybBsslXHEpzTzMgjr8jZ7_YpFxBXPLjnwwGu5rfIij9DMBAregb2Yyv8wfXMjCd2_g39ZBCkEgnQqfWzkH82S8QEnRLDEcgPk" />
                                    </div>
                                    <span class="absolute -top-2 -right-2 bg-slate-800 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">1</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-sm leading-snug">Heritage Leather Weekend Bag</h3>
                                    <p class="text-xs text-slate-500 mt-1">Large / Saddle Tan</p>
                                    <p class="text-sm font-bold mt-2">$1,200.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Promo Code -->
                        <div class="flex gap-2 mb-8">
                            <input class="flex-1 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 h-11 px-4 text-sm outline-none focus:border-primary transition-all" placeholder="Promo code" type="text" />
                            <button class="px-6 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white text-sm font-semibold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">Apply</button>
                        </div>
                        <!-- Price Breakdown -->
                        <div class="space-y-3 border-t border-slate-100 dark:border-slate-800 pt-6 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-medium">$2,050.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Shipping</span>
                                <span class="font-medium">$25.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Estimated Tax</span>
                                <span class="font-medium">$164.00</span>
                            </div>
                            <div class="flex justify-between text-lg font-black border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                <span>Total</span>
                                <span class="text-primary">$2,239.00</span>
                            </div>
                        </div>
                        <!-- CTA Button -->
                        <button class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-5 rounded-xl text-lg shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 group">
                            <span>Complete Purchase</span>
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                        <p class="text-center text-xs text-slate-400 mt-6 flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-xs">encrypted</span>
                            End-to-end encrypted transaction
                        </p>
                    </div>
                </div>
            </div>
        </main>
        <?php get_footer(); ?>