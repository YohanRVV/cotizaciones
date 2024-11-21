<template>
    <div
        v-if="isVisible"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Crear Producto</h3>
            </div>

            <div class="p-4">
                <form @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Nombre
                        </label>
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            placeholder="Nombre del producto"
                            class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Descripción
                        </label>
                        <textarea
                            v-model="form.description"
                            id="description"
                            placeholder="Descripción del producto"
                            class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label
                            for="price"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Precio
                        </label>
                        <input
                            v-model="form.price"
                            type="number"
                            step="0.01"
                            id="price"
                            placeholder="Precio del producto"
                            class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label
                            for="stock"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Stock
                        </label>
                        <input
                            v-model="form.stock"
                            type="number"
                            id="stock"
                            placeholder="Stock disponible"
                            class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
                            required
                        />
                    </div>
                </form>
            </div>

            <div class="flex justify-end p-4 border-t">
                <button
                    @click="close"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 mr-2"
                >
                    Cancelar
                </button>
                <button
                    @click="submitForm"
                    class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600"
                >
                    Guardar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isVisible: false,
            form: {
                name: "",
                description: "",
                price: 0,
                stock: 0,
            },
        };
    },
    methods: {
        open() {
            this.resetForm();
            this.isVisible = true;
        },
        close() {
            this.isVisible = false;
        },
        resetForm() {
            this.form = {
                name: "",
                description: "",
                price: 0,
                stock: 0,
            };
        },
        async submitForm() {
            try {
                const response = await axios.post("/products", this.form);
                this.$emit("product-created", response.data.product);

                this.$emit("notify", {
                    type: "success",
                    title: "Producto Creado",
                    message: "El producto se ha creado exitosamente.",
                });

                this.close();
            } catch (error) {
                console.error(error);

                this.$emit("notify", {
                    type: "error",
                    title: "Error al Crear Producto",
                    message: "Hubo un problema al crear el producto.",
                });
            }
        },
    },
};
</script>
