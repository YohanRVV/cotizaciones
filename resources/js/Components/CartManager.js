export default {
    data() {
        return {
            cart: [],
        };
    },
    computed: {
        total() {
            return this.cart
                .reduce((sum, item) => sum + item.quantity * item.price, 0)
                .toFixed(2);
        },
    },
    methods: {
        addToCart(product) {
            const cartItem = this.cart.find((item) => item.id === product.id);
            if (cartItem) {
                if (cartItem.quantity < product.stock) {
                    cartItem.quantity++;
                } else {
                    this.dialogTitle = "Stock Insuficiente";
                    this.dialogMessage =
                        "No puedes agregar más de este producto.";
                    this.dialogShowCancel = false;
                    this.$refs.dialog.open();
                }
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }
        },
        removeFromCart(index) {
            this.cart.splice(index, 1);
        },
    },
};
