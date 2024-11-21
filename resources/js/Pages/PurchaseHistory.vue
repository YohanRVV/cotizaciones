<template>
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Historial de Compras</h1>
            <a
                href="/"
                class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600"
            >
                Regresar a Principal
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded shadow-md">
                <h2 class="text-lg font-semibold mb-4">Clientes</h2>
                <ul>
                    <li
                        v-for="client in clients"
                        :key="client.id"
                        class="cursor-pointer hover:text-indigo-500"
                        @click="fetchClientPurchases(client.id)"
                    >
                        {{ client.name }} ({{ client.purchases_count }} compras)
                    </li>
                </ul>
            </div>

            <div
                class="col-span-2 bg-white p-4 rounded shadow-md"
                v-if="selectedClient"
            >
                <h2 class="text-lg font-semibold mb-4">
                    Productos Comprados por {{ selectedClient.name }}
                </h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="p-2 border">Producto</th>
                            <th class="p-2 border">Cantidad Total</th>
                            <th class="p-2 border">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="purchase in purchases"
                            :key="purchase.product_name"
                        >
                            <td class="p-2 border">
                                {{ purchase.product_name }}
                            </td>
                            <td class="p-2 border">
                                {{ purchase.total_quantity }}
                            </td>
                            <td class="p-2 border">
                                ${{
                                    parseFloat(purchase.total_price).toFixed(2)
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right font-bold text-xl mt-4">
                    Total General: ${{ parseFloat(total).toFixed(2) }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        clients: Array,
    },
    data() {
        return {
            selectedClient: null,
            purchases: [],
            total: 0,
        };
    },
    methods: {
        async fetchClientPurchases(clientId) {
            try {
                const response = await axios.get(
                    `/purchase-history/${clientId}`
                );
                this.purchases = response.data.purchases;
                this.total = response.data.total;

                this.selectedClient = this.clients.find(
                    (client) => client.id === clientId
                );
            } catch (error) {
                console.error("Error al obtener compras del cliente:", error);
            }
        },
    },
};
</script>

<style>
.cursor-pointer:hover {
    text-decoration: underline;
}
</style>
