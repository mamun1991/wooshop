
<?php
/**
 * Cart Page
 *
 * @package WooCommerce\Templates
 * @version x.x.x
 */



defined( 'ABSPATH' ) || exit;
get_header();

$cart       = WC()->cart;
$cart_items = $cart->get_cart();
$cart_count = $cart->get_cart_contents_count();
?>

<main class="flex-grow px-6 md:px-10 lg:px-40 py-12">

    <?php wc_print_notices(); ?>

    <!-- Breadcrumbs -->

    <nav class="flex items-center gap-2 mb-8 text-sm text-slate-500">
        <a class="hover:text-primary" href="<?= esc_url( home_url('/') ) ?>">Home</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-slate-900 dark:text-slate-100 font-medium">Your Bag</span>
    </nav>

    <?php if ( $cart->is_empty() ) : ?>
        <!-- Empty Cart -->
        <div class="flex flex-col items-center justify-center py-24 gap-6 text-center">
            <span class="material-symbols-outlined text-6xl text-slate-300">shopping_bag</span>
            <h2 class="text-2xl font-black text-slate-900 dark:text-white">Your bag is empty</h2>
            <p class="text-slate-500">Looks like you haven't added anything yet.</p>
            <a href="<?= esc_url( wc_get_page_permalink('shop') ) ?>"
               class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary/90 transition-colors">
                Continue Shopping
            </a>
        </div>

    <?php else : ?>

        <form id="wc-cart-form" action="<?= esc_url( wc_get_cart_url() ) ?>" method="post">
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <!-- ── LEFT: Cart Items ── -->
                <div class="lg:col-span-8">
                    <div class="flex items-baseline justify-between border-b border-slate-200 dark:border-slate-800 pb-6 mb-8">
                        <h2 class="text-3xl font-black tracking-tight">Your Shopping Bag</h2>
                        <span class="text-slate-500 font-medium"><?= $cart_count ?> Item<?= $cart_count !== 1 ? 's' : '' ?></span>
                    </div>

                    <?php foreach ( $cart_items as $cart_item_key => $cart_item ) :
                        $_product    = $cart_item['data'];
                        $product_id  = $cart_item['product_id'];
                        $qty         = $cart_item['quantity'];
                        $image_url   = wp_get_attachment_image_url( $_product->get_image_id(), 'woocommerce_thumbnail' );
                        $product_url = $_product->get_permalink();
                        $line_total  = $cart_item['line_total'];

                        // Variation attributes
                        $meta = [];
                        foreach ( $cart_item['variation'] ?? [] as $key => $val ) {
                            if ( $val ) $meta[] = ucfirst( str_replace( 'attribute_pa_', '', $key ) ) . ': ' . $val;
                        }
                    ?>
                        <div class="flex flex-col md:flex-row gap-6 py-8 border-b border-slate-200 dark:border-slate-800 cart-item"
                             data-key="<?= esc_attr( $cart_item_key ) ?>">

                            <!-- Product Image -->
                            <a href="<?= esc_url( $product_url ) ?>"
                               class="w-full md:w-48 aspect-square rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0">
                                <?php if ( $image_url ) : ?>
                                    <img class="h-full w-full object-cover hover:scale-105 transition-transform duration-300"
                                         src="<?= esc_url( $image_url ) ?>"
                                         alt="<?= esc_attr( $_product->get_name() ) ?>" />
                                <?php else : ?>
                                    <div class="h-full w-full flex items-center justify-center text-slate-300">
                                        <span class="material-symbols-outlined text-4xl">image</span>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <div class="flex-grow flex flex-col justify-between">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <a href="<?= esc_url( $product_url ) ?>">
                                            <h3 class="text-lg font-bold hover:text-primary transition-colors">
                                                <?= esc_html( $_product->get_name() ) ?>
                                            </h3>
                                        </a>
                                        <?php if ( ! empty( $meta ) ) : ?>
                                            <p class="text-sm text-slate-500 mt-1"><?= esc_html( implode( ' | ', $meta ) ) ?></p>
                                        <?php endif; ?>
                                        <?php if ( ! $_product->is_in_stock() ) : ?>
                                            <p class="text-xs text-red-500 font-semibold mt-1">Out of Stock</p>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-lg font-bold line-price" data-key="<?= esc_attr( $cart_item_key ) ?>">
                                        <?= wc_price( $line_total ) ?>
                                    </span>
                                </div>

                                <div class="flex items-center justify-between mt-6">
                                    <!-- Quantity -->
                                    <div class="flex items-center bg-slate-100 dark:bg-slate-800 rounded-lg p-1">
                                        <button type="button"
                                                class="flex h-8 w-8 items-center justify-center rounded-md hover:bg-white dark:hover:bg-slate-700 transition-all qty-minus"
                                                data-key="<?= esc_attr( $cart_item_key ) ?>"
                                                data-min="1">
                                            <span class="material-symbols-outlined text-lg">remove</span>
                                        </button>
                                        <input type="number"
                                               name="cart[<?= esc_attr( $cart_item_key ) ?>][qty]"
                                               value="<?= $qty ?>"
                                               min="1"
                                               max="<?= $_product->get_max_purchase_quantity() > 0 ? $_product->get_max_purchase_quantity() : 99 ?>"
                                               class="qty-input w-12 text-center font-bold bg-transparent border-none outline-none"
                                               data-key="<?= esc_attr( $cart_item_key ) ?>"
                                               data-price="<?= esc_attr( $_product->get_price() ) ?>" />
                                        <button type="button"
                                                class="flex h-8 w-8 items-center justify-center rounded-md hover:bg-white dark:hover:bg-slate-700 transition-all qty-plus"
                                                data-key="<?= esc_attr( $cart_item_key ) ?>"
                                                data-max="<?= $_product->get_max_purchase_quantity() > 0 ? $_product->get_max_purchase_quantity() : 99 ?>">
                                            <span class="material-symbols-outlined text-lg">add</span>
                                        </button>
                                    </div>

                                    <!-- Remove -->
                                    <button type="button"
                                            class="remove-item flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-red-500 transition-colors"
                                            data-key="<?= esc_attr( $cart_item_key ) ?>"
                                            data-nonce="<?= wp_create_nonce('remove-cart-item') ?>">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                    <!-- Continue Shopping -->
                    <div class="mt-8">
                        <a href="<?= esc_url( wc_get_page_permalink('shop') ) ?>"
                           class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-base">arrow_back</span>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- ── RIGHT: Summary ── -->
                <div class="lg:col-span-4">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-200 dark:border-slate-800 shadow-sm sticky top-32">
                        <h3 class="text-xl font-bold mb-6">Order Summary</h3>

                        <div class="space-y-4 text-sm mb-8" id="cart-totals">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-semibold" id="cart-subtotal"><?= $cart->get_cart_subtotal() ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Estimated Shipping</span>
                                <span class="font-semibold">
                                    <?php
                                    $shipping_total = $cart->get_shipping_total();
                                    echo $shipping_total > 0 ? wc_price( $shipping_total ) : '<span class="text-green-600">Free</span>';
                                    ?>
                                </span>
                            </div>
                            <?php if ( $cart->get_taxes_total() > 0 ) : ?>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Estimated Tax</span>
                                    <span class="font-semibold"><?= wc_price( $cart->get_taxes_total() ) ?></span>
                                </div>
                            <?php endif; ?>

                            <?php foreach ( $cart->get_coupons() as $code => $coupon ) : ?>
                                <div class="flex justify-between text-green-600">
                                    <span>Coupon: <strong><?= esc_html( $code ) ?></strong>
                                        <button type="button" class="remove-coupon ml-1 text-red-400 hover:text-red-600 text-xs"
                                                data-coupon="<?= esc_attr( $code ) ?>">✕</button>
                                    </span>
                                    <span>-<?= wc_price( $cart->get_coupon_discount_amount( $code ) ) ?></span>
                                </div>
                            <?php endforeach; ?>

                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-end">
                                <span class="text-lg font-bold">Total</span>
                                <span class="text-2xl font-black text-primary" id="cart-total"><?= $cart->get_total() ?></span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <a href="<?= esc_url( wc_get_checkout_url() ) ?>"
                               class="w-full bg-primary text-white py-4 rounded-xl font-bold text-base hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                                Proceed to Checkout
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                            <div class="flex items-center gap-2 justify-center text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-6">
                                <span class="material-symbols-outlined text-sm">lock</span>
                                Secure Checkout SSL Encryption
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-800">
                            <p class="text-sm font-semibold mb-4">Promotional Code</p>
                            <div class="flex gap-2">
                                <input id="coupon_code" type="text"
                                       class="flex-grow bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm px-4 h-10 focus:ring-1 focus:ring-primary outline-none"
                                       placeholder="Enter code" />
                                <button type="button" id="apply-coupon"
                                        class="px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                    Apply
                                </button>
                            </div>
                            <div id="coupon-message" class="hidden mt-2 text-xs px-3 py-2 rounded-lg"></div>
                        </div>
                    </div>

                    <!-- Help Links -->
                    <div class="mt-6 px-4 space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
                            <div>
                                <h4 class="text-sm font-bold">Free Returns</h4>
                                <p class="text-xs text-slate-500">Return within 30 days for an exchange or full refund.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-xl">support_agent</span>
                            <div>
                                <h4 class="text-sm font-bold">Luxe Concierge</h4>
                                <p class="text-xs text-slate-500">Need help? Our specialists are available 24/7.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    <?php endif; ?>
</main>

<script>
const ajaxUrl = '<?= esc_url( admin_url('admin-ajax.php') ) ?>';

// ── Quantity +/- buttons ──
document.querySelectorAll('.qty-minus, .qty-plus').forEach( btn => {
    btn.addEventListener('click', function() {
        const key   = this.dataset.key;
        const input = document.querySelector(`.qty-input[data-key="${key}"]`);
        let qty     = parseInt( input.value );
        const min   = parseInt( this.dataset.min || 1 );
        const max   = parseInt( this.dataset.max || 99 );

        if ( this.classList.contains('qty-minus') ) qty = Math.max( min, qty - 1 );
        if ( this.classList.contains('qty-plus')  ) qty = Math.min( max, qty + 1 );

        input.value = qty;
        updateCartItem( key, qty );
    });
});

// ── Qty input direct change ──
document.querySelectorAll('.qty-input').forEach( input => {
    input.addEventListener('change', function() {
        updateCartItem( this.dataset.key, parseInt( this.value ) );
    });
});

// ── Update cart item via AJAX ──
function updateCartItem( key, qty ) {
    fetch( ajaxUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action:   'update_cart_item',
            key:      key,
            qty:      qty,
            nonce:    '<?= wp_create_nonce("update-cart-item") ?>'
        })
    })
    .then( r => r.json() )
    .then( data => {
        if ( data.success ) {
            // Update line price
            const lineEl = document.querySelector(`.line-price[data-key="${key}"]`);
            if ( lineEl ) lineEl.innerHTML = data.data.line_total;

            // Update totals
            document.getElementById('cart-subtotal').innerHTML = data.data.subtotal;
            document.getElementById('cart-total').innerHTML    = data.data.total;

            // Update item count in header
            document.querySelectorAll('.cart-count').forEach( el => {
                el.textContent = data.data.count;
            });
        }
    });
}

// ── Remove item ──
document.querySelectorAll('.remove-item').forEach( btn => {
    btn.addEventListener('click', function() {
        const key   = this.dataset.key;
        const row   = this.closest('.cart-item');
        row.style.opacity = '0.4';
        row.style.pointerEvents = 'none';

        fetch( ajaxUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'remove_cart_item',
                key:    key,
                nonce:  this.dataset.nonce
            })
        })
        .then( r => r.json() )
        .then( data => {
            if ( data.success ) {
                row.remove();
                document.getElementById('cart-subtotal').innerHTML = data.data.subtotal;
                document.getElementById('cart-total').innerHTML    = data.data.total;
                document.querySelectorAll('.cart-count').forEach( el => {
                    el.textContent = data.data.count;
                });
                if ( data.data.count === 0 ) location.reload();
            } else {
                row.style.opacity = '1';
                row.style.pointerEvents = 'auto';
            }
        });
    });
});

// ── Apply coupon ──
document.getElementById('apply-coupon').addEventListener('click', function() {
    const code = document.getElementById('coupon_code').value.trim();
    const msg  = document.getElementById('coupon-message');
    if ( ! code ) return;

    msg.className   = 'mt-2 text-xs px-3 py-2 rounded-lg bg-slate-100 text-slate-500';
    msg.textContent = 'Applying...';
    msg.classList.remove('hidden');

    fetch( ajaxUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            action: 'apply_coupon',
            coupon:  code,
            nonce:  '<?= wp_create_nonce("apply-coupon") ?>'
        })
    })
    .then( r => r.json() )
    .then( data => {
        if ( data.success ) {
            msg.className   = 'mt-2 text-xs px-3 py-2 rounded-lg bg-green-50 text-green-700';
            msg.textContent = data.data.message || 'Coupon applied!';
            setTimeout( () => location.reload(), 800 );
        } else {
            msg.className   = 'mt-2 text-xs px-3 py-2 rounded-lg bg-red-50 text-red-600';
            msg.textContent = data.data.message || 'Invalid coupon.';
        }
    });
});

// ── Remove coupon ──
document.querySelectorAll('.remove-coupon').forEach( btn => {
    btn.addEventListener('click', function() {
        fetch( ajaxUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'remove_coupon',
                coupon:  this.dataset.coupon,
                nonce:  '<?= wp_create_nonce("remove-coupon") ?>'
            })
        })
        .then( r => r.json() )
        .then( data => {
            if ( data.success ) location.reload();
        });
    });
});
</script>

<?php get_footer(); ?>