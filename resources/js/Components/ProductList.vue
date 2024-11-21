<template>
    <div>
        <div class="grid grid-cols-3 gap-4">
            <div
                v-for="product in products"
                :key="product.id"
                class="bg-white shadow-md rounded-lg p-4"
            >
                <h3 class="text-lg font-bold">{{ product.name }}</h3>
                <p class="text-sm text-gray-600">{{ product.description }}</p>
                <p class="text-lg font-semibold mt-2">
                    Precio: ${{ parseFloat(product.price).toFixed(2) }}
                </p>
                <p class="text-sm text-gray-600">Stock: {{ product.stock }}</p>
                <button
                    @click="$emit('add-to-cart', product)"
                    class="bg-indigo-500 text-white px-4 py-2 mt-4 rounded hover:bg-indigo-600"
                >
                    Agregar al Carrito
                </button>
            </div>
        </div>
        <div class="mt-6 text-center">
            <button
                @click="openCreateProductModal"
                class="bg-green-500 text-white px-6 py-3 rounded shadow hover:bg-green-600"
            >
                Crear Nuevo Producto
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["products"],
    methods: {
        openCreateProductModal() {
            this.$emit("create-product");
        },
    },
};
</script>
