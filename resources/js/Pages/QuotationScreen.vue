<template>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Pantalla de Cotización</h1>
            <a
               href="/purchase-history"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                Ver Historial de Compras
            </a>
        </div>

        <ClientSelector
            :clients="clients"
            :selected-client="selectedClient"
            @select-client="selectClient"
            @create-client="openCreateClientModal"
        />

        <div v-if="selectedClient">
            <ProductList
                :products="products"
                @add-to-cart="addToCart"
                @create-product="openCreateProductModal"
            />
        </div>

        <div v-if="cart.length > 0" class="fixed bottom-4 right-4">
            <button
                @click="toggleCartModal"
                class="bg-indigo-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-indigo-600"
            >
                Ver Carrito ({{ cart.length }} productos)
            </button>
        </div>

        <transition name="fade">
            <div
                v-if="isCartModalOpen"
                class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
            >
                <div class="bg-white rounded-lg w-3/4 max-w-3xl shadow-lg">
                    <div
                        class="flex justify-between items-center border-b px-6 py-4"
                    >
                        <h2 class="text-2xl font-bold">Tu Carrito</h2>
                        <button
                            @click="toggleCartModal"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            ✖
                        </button>
                    </div>
                    <div class="p-6">
                        <CartTable
                            :cart="cart"
                            :total="total"
                            :selected-client="selectedClient"
                            @remove-from-cart="removeFromCart"
                            @save-purchase="savePurchase"
                        />
                        <button
                            @click="showClearCartDialog"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-4"
                        >
                            Vaciar Carrito
                        </button>
                    </div>
                </div>
            </div>
        </transition>

        <DialogModal
            ref="dialog"
            :title="dialogTitle"
            :message="dialogMessage"
            :showCancel="dialogShowCancel"
            @confirm="dialogConfirm"
            @cancel="dialogCancel"
        />

        <CreateClientModal
            ref="createClientModal"
            @client-created="addClient"
        />

        <CreateProductModal
            ref="createProductModal"
            @product-created="addProduct"
            @notify="handleNotification"
        />
    </div>
</template>

<script>
import CartManager from "../Components/CartManager";
import ProductList from "../Components/ProductList.vue";
import ClientSelector from "../Components/ClientSelector.vue";
import CartTable from "../Components/CartTable.vue";
import DialogModal from "../Components/DialogModal.vue";
import CreateClientModal from "../Components/CreateClientModal.vue";
import CreateProductModal from "../Components/CreateProductModal.vue";
import axios from "axios";

export default {
    props: ["clients", "products"],
    mixins: [CartManager],
    components: {
        ProductList,
        ClientSelector,
        CartTable,
        DialogModal,
        CreateClientModal,
        CreateProductModal,
    },
    data() {
        return {
            isCartModalOpen: false,
            dialogTitle: "",
            dialogMessage: "",
            dialogShowCancel: true,
            selectedClient: null,
        };
    },
    methods: {
        selectClient(client) {
            this.selectedClient = client;
        },
        openCreateClientModal() {
            this.$refs.createClientModal.open();
        },
        openCreateProductModal() {
            this.$refs.createProductModal.open();
        },
        addClient(newClient) {
            this.clients.push(newClient);
        },
        addProduct(newProduct) {
            this.products.push(newProduct);
        },
        toggleCartModal() {
            this.isCartModalOpen = !this.isCartModalOpen;
        },
        showClearCartDialog() {
            this.dialogTitle = "Vaciar Carrito";
            this.dialogMessage =
                "¿Estás seguro de que deseas vaciar el carrito?";
            this.dialogShowCancel = true;
            this.$refs.dialog.open();
        },
        dialogConfirm() {
            this.clearCart();
        },
        dialogCancel() {
            console.log("Acción cancelada.");
        },
        clearCart() {
            this.cart = [];
        },
        async savePurchase() {
            try {
                const response = await axios.post("/purchases", {
                    client_id: this.selectedClient.id,
                    cart: this.cart,
                });

                this.handleNotification({
                    type: "success",
                    title: "Compra realizada",
                    message: "La compra se ha guardado exitosamente.",
                });

                this.cart = [];
                this.isCartModalOpen = false;
            } catch (error) {
                this.handleNotification({
                    type: "error",
                    title: "Error al realizar la compra",
                    message:
                        error.response?.data?.message ||
                        "Ocurrió un error inesperado al realizar la compra.",
                });
            }
        },
        handleNotification(notification) {
            this.dialogTitle = notification.title || "Notificación";
            this.dialogMessage = notification.message || "Algo sucedió.";
            this.dialogShowCancel = false;
            this.$refs.dialog.open();
        },
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
