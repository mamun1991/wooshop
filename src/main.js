
console.log("Tailwind + Alpine loaded!");

// Scroll-triggered section animations with Intersection Observer
const observerOptions = {
  threshold: 0.05,
  rootMargin: '0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-in');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Wait for DOM to be fully loaded
window.addEventListener('load', () => {
  setTimeout(() => {
    const animatedSections = document.querySelectorAll('[data-scroll-animate]');
    console.log('Found sections to animate:', animatedSections.length);
    animatedSections.forEach((section) => {
      observer.observe(section);
      // Trigger animation immediately if already in viewport
      if (section.getBoundingClientRect().top < window.innerHeight) {
        section.classList.add('animate-in');
        observer.unobserve(section);
      }
    });
  }, 100);
});

// Alpine.js Shopping Cart Component
// document.addEventListener('alpine:init', () => {
//   Alpine.data('shoppingCart', () => ({
//     items: [],
//     isCartOpen: false,
//     showCartButton: false,
//     toastMessage: '',
//     showToast: false,

//     init() {
//       this.loadCart();
//       // show floating cart button when the user scrolls down
//       window.addEventListener('scroll', () => {
//         this.showCartButton = window.scrollY > 150;
//       });
//     },

//     loadCart() {
//       this.items = JSON.parse(localStorage.getItem('cart')) || [];
//     },

//     saveCart() {
//       localStorage.setItem('cart', JSON.stringify(this.items));
//     },

//     addToCart(e) {
//       const productCard = e.target.closest('.product-card');
//       if (!productCard) return;

//       const product = {
//         id: productCard.dataset.productId,
//         name: productCard.dataset.productName,
//         price: parseFloat(productCard.dataset.productPrice),
//         image: productCard.dataset.productImage,
//       };

//       const existingItem = this.items.find(item => item.id === product.id);
      
//       if (existingItem) {
//         existingItem.quantity += 1;
//       } else {
//         this.items.push({ ...product, quantity: 1 });
//       }

//       this.saveCart();
//       this.showNotification(`${product.name} added to cart!`);
//     },

//     removeFromCart(productId) {
//       this.items = this.items.filter(item => item.id !== productId);
//       this.saveCart();
//     },

//     updateQuantity(productId, newQuantity) {
//       const item = this.items.find(item => item.id === productId);
//       if (item) {
//         if (newQuantity <= 0) {
//           this.removeFromCart(productId);
//         } else {
//           item.quantity = newQuantity;
//           this.saveCart();
//         }
//       }
//     },

//     get cartTotal() {
//       return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
//     },

//     get totalItems() {
//       return this.items.reduce((sum, item) => sum + item.quantity, 0);
//     },

//     openCart() {
//       this.isCartOpen = true;
//     },

//     closeCart() {
//       this.isCartOpen = false;
//     },

//     showNotification(message) {
//       this.toastMessage = message;
//       this.showToast = true;

//       setTimeout(() => {
//         this.showToast = false;
//       }, 3000);
//     }
//   }));
// });

document.addEventListener('alpine:init', () => {

Alpine.data('wooCart', () => ({

    cart: [],
    totals: {},
    cartCount: 0,
    cartOpen: false,
    loading: false,
    showToast: false,
    toastMessage: '',

    init(){
        this.fetchCart();
    },

    // Fetch cart info from WC
    async fetchCart(){

        this.loading = true;

        try {
            const res = await fetch(siteConfig.storeApi + '/cart'); // GET /cart still works
            const data = await res.json();

            this.cart = data.items;
            this.cartCount = data.items_count;
            this.totals = data.totals;
        } catch(err) {
            console.error(err);
        }

        this.loading = false;
    },

    // Add product to cart
    async addToCart(productId, quantity = 1){

        this.loading = true;

        try {
            const formData = new URLSearchParams();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            const res = await fetch(`${siteConfig.homeUrl}/?wc-ajax=add_to_cart`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            });

            const data = await res.json();

            if(data && data.fragments){
                // Refresh cart after add
                await this.fetchCart();
                const lastItem = this.cart[this.cart.length - 1];
                const productName = lastItem?.name || 'Product';
                
                this.cartOpen = false;
                this.showNotification(`${productName} added to cart!`);
            }

        } catch(err) {
            console.error(err);
        }

        this.loading = false;
    },

    // Remove item from cart
    async removeItem(cartKey){

        this.loading = true;

        try {
            const formData = new URLSearchParams();
            formData.append('cart_item_key', cartKey);

            const res = await fetch(`${siteConfig.homeUrl}/?wc-ajax=remove_from_cart`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData.toString()
            });

            await this.fetchCart();

        } catch(err) {
            console.error(err);
        }

        this.loading = false;
    },

    // Update quantity
    async updateQty(cartKey, qty){

        if(qty < 0) return

        this.loading = true

        try{

            const formData = new URLSearchParams()
            formData.append('action', 'update_cart_item')
            formData.append('cart_item_key', cartKey)
            formData.append('quantity', qty)

            await fetch(siteConfig.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData.toString()
            })

            await this.fetchCart()

        }catch(err){
            console.error(err)
        }

        this.loading = false
    },

    showNotification(message) {
      this.toastMessage = message;
      this.showToast = true;

      setTimeout(() => {
        this.showToast = false;
      }, 3000);
    }

}));
});
