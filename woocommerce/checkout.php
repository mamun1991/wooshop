<?php
get_header();

// Fix null deprecation for checkout get_value()
add_filter( 'woocommerce_checkout_get_value', function( $value ) {
    return $value ?? '';
});

// Redirect if cart is empty
if ( WC()->cart->is_empty() ) {
    wp_redirect( wc_get_cart_url() );
    exit;
}

// Handle form submission
if ( isset( $_POST['place_order'] ) ) {
    $nonce = $_POST['woocommerce-process-checkout-nonce'] ?? '';
    if ( ! wp_verify_nonce( $nonce, 'woocommerce-process_checkout' ) ) {
        wc_add_notice( 'Security check failed.', 'error' );
    } else {
        WC()->checkout()->process_checkout();
    }
}

$checkout   = WC()->checkout();
$cart       = WC()->cart;
$cart_items = $cart->get_cart();
$subtotal   = $cart->get_subtotal();
$shipping   = $cart->get_shipping_total();
$tax        = $cart->get_taxes_total();
$total      = $cart->get_total( 'edit' );
?>

<main class="max-w-7xl mx-auto w-full mt-20 px-6 md:px-10 py-8 lg:py-12" data-scroll-animate>

    <?php wc_print_notices(); ?>

    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 mb-8 text-sm font-medium">
        <a class="text-primary hover:underline" href="<?= esc_url( wc_get_cart_url() ) ?>">Cart</a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-900 dark:text-white">Information &amp; Payment</span>
    </nav>

    <form name="checkout" method="post" id="checkout"
          action="<?= esc_url( wc_get_checkout_url() ) ?>"
          enctype="multipart/form-data">

        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        <input type="hidden" name="payment_method" id="payment_method_input" value="bacs" />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- ── LEFT: Forms ── -->
            <div class="lg:col-span-7 space-y-12">

                <!-- Shipping Address -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold tracking-tight">Shipping Address</h2>
                        <?php if ( ! is_user_logged_in() ) : ?>
                            <p class="text-sm text-slate-500">
                                Already have an account?
                                <a class="text-primary font-semibold" href="<?= esc_url( wc_get_page_permalink( 'myaccount' ) ) ?>">Log in</a>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- First Name -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_first_name">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input id="billing_first_name" name="billing_first_name" type="text"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_first_name' ) ?? '' ) ?>"
                                   placeholder="e.g. Jane"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- Last Name -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_last_name">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input id="billing_last_name" name="billing_last_name" type="text"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_last_name' ) ?? '' ) ?>"
                                   placeholder="e.g. Doe"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_email">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input id="billing_email" name="billing_email" type="email"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_email' ) ?? '' ) ?>"
                                   placeholder="you@example.com"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- Phone -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_phone">
                                Phone <span class="text-red-500">*</span>
                            </label>
                            <input id="billing_phone" name="billing_phone" type="tel"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_phone' ) ?? '' ) ?>"
                                   placeholder="+1 555 000 0000"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_address_1">
                                Address <span class="text-red-500">*</span>
                            </label>
                            
                            <input id="billing_address_1" name="billing_address_1" type="text"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_address_1' ) ?? '' ) ?>"
                                   placeholder="House number and street name"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- City -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_city">
                                City <span class="text-red-500">*</span>
                            </label>
                            <input type="hidden" name="billing_state" value="Tangail" />
                            <input id="billing_city" name="billing_city" type="text"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_city' ) ?? '' ) ?>"
                                   placeholder="San Francisco"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- Postal Code -->
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_postcode">
                                Postal Code <span class="text-red-500">*</span>
                            </label>
                            <input id="billing_postcode" name="billing_postcode" type="text"
                                   value="<?= esc_attr( $checkout->get_value( 'billing_postcode' ) ?? '' ) ?>"
                                   placeholder="94103"
                                   class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" />
                        </div>

                        <!-- Country -->
                        <div class="md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="billing_country">
                                Country <span class="text-red-500">*</span>
                            </label>
                            <select id="billing_country" name="billing_country"
                                    class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white h-12 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none">
                                <?php
                                $current_country = $checkout->get_value( 'billing_country' ) ?? '';
                                foreach ( WC()->countries->get_allowed_countries() as $code => $name ) : ?>
                                    <option value="<?= esc_attr( $code ) ?>"
                                        <?= selected( $current_country, $code, false ) ?>>
                                        <?= esc_html( $name ) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Order Notes -->
                        <div class="md:col-span-2 flex flex-col gap-2">
                            <label class="text-sm font-medium text-slate-700 dark:text-slate-300" for="order_comments">
                                Order Notes <span class="text-slate-400 text-xs">(optional)</span>
                            </label>
                            <textarea id="order_comments" name="order_comments" rows="3"
                                      placeholder="Special instructions for your order..."
                                      class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none resize-none"><?= esc_textarea( $checkout->get_value( 'order_comments' ) ?? '' ) ?></textarea>
                        </div>

                    </div>
                </section>

                <!-- Delivery Method -->
                <section data-scroll-animate>
                    <h2 class="text-2xl font-bold tracking-tight mb-6">Delivery Method</h2>
                    <?php
                    $packages = WC()->shipping()->get_packages();
                    if ( ! empty( $packages ) ) :
                        foreach ( $packages as $i => $package ) :
                            $chosen = WC()->session->get( 'chosen_shipping_methods' )[ $i ] ?? '';
                            if ( ! empty( $package['rates'] ) ) :
                                echo '<div class="space-y-3">';
                                foreach ( $package['rates'] as $rate_id => $rate ) :
                                    $checked = ( $chosen === $rate_id || ( empty( $chosen ) && $rate_id === array_key_first( $package['rates'] ) ) );
                    ?>
                                    <label class="flex items-center justify-between p-4 border-2 rounded-xl cursor-pointer transition-colors
                                                  <?= $checked ? 'border-primary bg-primary/5' : 'border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50' ?>">
                                        <div class="flex items-center gap-3">
                                            <input type="radio"
                                                   name="shipping_method[<?= $i ?>]"
                                                   value="<?= esc_attr( $rate_id ) ?>"
                                                   class="text-primary focus:ring-primary"
                                                   <?= checked( $checked, true, false ) ?> />
                                            <div>
                                                <p class="font-semibold text-slate-900 dark:text-white"><?= esc_html( $rate->get_label() ) ?></p>
                                                <p class="text-sm text-slate-500">
                                                    <?= $rate->get_cost() == 0 ? 'Free shipping' : '1-5 business days' ?>
                                                </p>
                                            </div>
                                        </div>
                                        <span class="font-bold <?= $rate->get_cost() == 0 ? 'text-green-600' : '' ?>">
                                            <?= $rate->get_cost() == 0 ? 'Free' : wc_price( $rate->get_cost() ) ?>
                                        </span>
                                    </label>
                    <?php
                                endforeach;
                                echo '</div>';
                            endif;
                        endforeach;
                    else :
                    ?>
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-4 border-2 border-primary bg-primary/5 rounded-xl cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <input checked type="radio" name="shipping_method[0]" value="free_shipping"
                                           class="text-primary focus:ring-primary" />
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">Standard Shipping</p>
                                        <p class="text-sm text-slate-500">3-5 business days</p>
                                    </div>
                                </div>
                                <span class="font-bold text-green-600">Free</span>
                            </label>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Payment Method -->
                <section data-scroll-animate>
                    <h2 class="text-2xl font-bold tracking-tight mb-6">Payment Method</h2>
                    <div class="border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden bg-white dark:bg-slate-900 shadow-sm">

                        <?php
                        $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
                        $first = true;
                        foreach ( $available_gateways as $gateway_id => $gateway ) :
                            $is_first = $first;
                            $first    = false;
                        ?>
                            <div class="<?= ! $is_first ? 'border-t border-slate-100 dark:border-slate-800' : '' ?>">
                                <label class="p-4 flex items-center justify-between cursor-pointer select-none
                                              <?= $is_first ? 'border-b border-slate-100 dark:border-slate-800' : '' ?>"
                                       for="payment_method_<?= esc_attr( $gateway_id ) ?>">
                                    <div class="flex items-center gap-3">
                                        <input type="radio"
                                               id="payment_method_<?= esc_attr( $gateway_id ) ?>"
                                               name="payment_method"
                                               value="<?= esc_attr( $gateway_id ) ?>"
                                               class="text-primary focus:ring-primary payment-method-radio"
                                               <?= $is_first ? 'checked' : '' ?>
                                               onchange="
                                                   document.getElementById('payment_method_input').value = this.value;
                                                   document.querySelectorAll('.gateway-fields').forEach(el => el.classList.add('hidden'));
                                                   const f = document.getElementById('fields_<?= esc_attr( $gateway_id ) ?>');
                                                   if(f) f.classList.remove('hidden');
                                               " />
                                        <span class="font-semibold"><?= esc_html( $gateway->get_title() ) ?></span>
                                    </div>
                                    <?php if ( $gateway->get_icon() ) : ?>
                                        <span class="flex items-center"><?= $gateway->get_icon() ?></span>
                                    <?php else : ?>
                                        <span class="material-symbols-outlined text-slate-400">
                                            <?= $gateway_id === 'paypal' ? 'account_balance_wallet' : 'credit_card' ?>
                                        </span>
                                    <?php endif; ?>
                                </label>

                                <?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
                                    <div id="fields_<?= esc_attr( $gateway_id ) ?>"
                                         class="gateway-fields p-6 bg-slate-50 dark:bg-slate-800/20 <?= ! $is_first ? 'hidden' : '' ?>">
                                        <?php $gateway->payment_fields(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        <?php endforeach; ?>

                        <?php if ( empty( $available_gateways ) ) : ?>
                            <div class="p-6 text-slate-500 text-sm">
                                No payment methods available. Please contact us for assistance.
                            </div>
                        <?php endif; ?>

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

            <!-- ── RIGHT: Order Summary ── -->
            <div class="lg:col-span-5">
                <div class="sticky top-28 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-8 shadow-sm">
                    <h2 class="text-xl font-bold mb-6">Order Summary</h2>

                    <!-- Cart Items -->
                    <div class="space-y-6 mb-8">
                        <?php foreach ( $cart_items as $cart_item_key => $cart_item ) :
                            $_product  = $cart_item['data'];
                            $qty       = $cart_item['quantity'];
                            $image_url = wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' );
                        ?>
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="size-20 rounded-xl bg-slate-100 dark:bg-slate-800 overflow-hidden border border-slate-200 dark:border-slate-700">
                                        <?php if ( $image_url ) : ?>
                                            <img src="<?= esc_url( $image_url ) ?>"
                                                 alt="<?= esc_attr( $_product->get_name() ) ?>"
                                                 class="w-full h-full object-cover" />
                                        <?php else : ?>
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <span class="material-symbols-outlined text-3xl">image</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <span class="absolute -top-2 -right-2 bg-slate-800 text-white text-[10px] font-bold px-2 py-0.5 rounded-full"><?= $qty ?></span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-sm leading-snug"><?= esc_html( $_product->get_name() ) ?></h3>
                                    <?php
                                    $variation_data = $cart_item['variation'] ?? [];
                                    if ( ! empty( $variation_data ) ) :
                                        $attrs = [];
                                        foreach ( $variation_data as $key => $val ) {
                                            if ( $val ) $attrs[] = ucfirst( str_replace( 'attribute_pa_', '', $key ) ) . ': ' . $val;
                                        }
                                    ?>
                                        <p class="text-xs text-slate-500 mt-1"><?= esc_html( implode( ' / ', $attrs ) ) ?></p>
                                    <?php endif; ?>
                                    <p class="text-sm font-bold mt-2"><?= wc_price( $cart_item['line_total'] ) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Promo Code -->
                    <div class="flex gap-2 mb-2">
                        <input id="coupon_code" name="coupon_code" type="text"
                               class="flex-1 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 h-11 px-4 text-sm outline-none focus:border-primary transition-all"
                               placeholder="Promo code" />
                        <button type="button" onclick="applyCoupon()"
                                class="px-6 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white text-sm font-semibold hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                            Apply
                        </button>
                    </div>
                    <div id="coupon_message" class="hidden text-sm mb-4 px-3 py-2 rounded-lg"></div>

                    <!-- Applied Coupons -->
                    <?php foreach ( $cart->get_coupons() as $code => $coupon ) : ?>
                        <div class="flex justify-between text-sm text-green-600 mb-2 px-1">
                            <span>Coupon: <strong><?= esc_html( $code ) ?></strong></span>
                            <span>-<?= wc_price( $cart->get_coupon_discount_amount( $code ) ) ?></span>
                        </div>
                    <?php endforeach; ?>

                    <!-- Price Breakdown -->
                    <div class="space-y-3 border-t border-slate-100 dark:border-slate-800 pt-6 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Subtotal</span>
                            <span class="font-medium"><?= wc_price( $subtotal ) ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Shipping</span>
                            <span class="font-medium">
                                <?= $shipping > 0 ? wc_price( $shipping ) : '<span class="text-green-600">Free</span>' ?>
                            </span>
                        </div>
                        <?php if ( $tax > 0 ) : ?>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Tax</span>
                                <span class="font-medium"><?= wc_price( $tax ) ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-between text-lg font-black border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                            <span>Total</span>
                            <span class="text-primary"><?= wc_price( $total ) ?></span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="place_order" id="place_order"
                            class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-5 rounded-xl text-lg shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 group cursor-pointer">
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
    </form>
</main>

<script>
function applyCoupon() {
    const code = document.getElementById('coupon_code').value.trim();
    const msg  = document.getElementById('coupon_message');
    if ( ! code ) return;

    msg.className = 'text-sm mb-4 px-3 py-2 rounded-lg bg-slate-100 text-slate-500';
    msg.textContent = 'Applying...';
    msg.classList.remove('hidden');

    fetch('<?= esc_url( admin_url('admin-ajax.php') ) ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'apply_coupon',
            coupon:  code,
            nonce:  '<?= wp_create_nonce('apply-coupon') ?>'
        })
    })
    .then( r => r.json() )
    .then( data => {
        if ( data.success ) {
            msg.className = 'text-sm mb-4 px-3 py-2 rounded-lg bg-green-50 text-green-700';
            msg.textContent = data.data.message || 'Coupon applied!';
            setTimeout( () => location.reload(), 800 );
        } else {
            msg.className = 'text-sm mb-4 px-3 py-2 rounded-lg bg-red-50 text-red-600';
            msg.textContent = data.data.message || 'Invalid coupon code.';
        }
    })
    .catch( () => {
        msg.className = 'text-sm mb-4 px-3 py-2 rounded-lg bg-red-50 text-red-600';
        msg.textContent = 'Something went wrong. Please try again.';
    });
}
</script>

<?php get_footer(); ?>