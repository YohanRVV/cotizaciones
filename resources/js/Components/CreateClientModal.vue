<template>
    <div>
        <!-- Form Modal -->
        <div
            v-if="isVisible"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg shadow-lg w-1/3">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-semibold">Crear Cliente</h3>
                </div>
                <div class="p-4">
                    <form @submit.prevent="submitForm">
                        <div class="mb-4">
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                                >Nombre</label
                            >
                            <input
                                v-model="form.name"
                                type="text"
                                id="name"
                                class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                                >Email</label
                            >
                            <input
                                v-model="form.email"
                                type="email"
                                id="email"
                                class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="address"
                                class="block text-sm font-medium text-gray-700"
                                >Dirección</label
                            >
                            <input
                                v-model="form.address"
                                type="text"
                                id="address"
                                class="mt-1 block w-full p-2 border rounded focus:ring-indigo-500 focus:border-indigo-500"
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

        <!-- Notification Modal -->
        <div
            v-if="notificationVisible"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg shadow-lg w-1/3">
                <div class="p-4 border-b">
                    <h3 class="text-lg font-semibold">
                        {{ notificationTitle }}
                    </h3>
                </div>
                <div class="p-4">
                    <p>{{ notificationMessage }}</p>
                </div>
                <div class="flex justify-end p-4 border-t">
                    <button
                        @click="closeNotification"
                        class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600"
                    >
                        Cerrar
                    </button>
                </div>
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
            notificationVisible: false,
            notificationTitle: "",
            notificationMessage: "",
            form: {
                name: "",
                email: "",
                address: "",
            },
        };
    },
    methods: {
        open() {
            this.isVisible = true;
        },
        close() {
            this.isVisible = false;
        },
        closeNotification() {
            this.notificationVisible = false;
        },
        async submitForm() {
            try {
                const response = await axios.post("/clients", this.form);
                this.$emit("client-created", response.data.client);
                this.showNotification("Éxito", "Cliente creado correctamente.");
                this.close();
            } catch (error) {
                console.error(error);
                this.showNotification(
                    "Error",
                    "Hubo un problema al crear el cliente. Por favor, intenta nuevamente."
                );
            }
        },
        showNotification(title, message) {
            this.notificationTitle = title;
            this.notificationMessage = message;
            this.notificationVisible = true;
        },
    },
};
</script>
