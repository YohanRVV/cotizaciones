<template>
    <div class="bg-white p-6 rounded shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Seleccionar Cliente que comprará los productos</h2>
        <div class="flex gap-4">
            <select
                v-model="selectedClient"
                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                @change="selectClient"
            >
                <option value="" disabled>Selecciona un cliente</option>
                <option
                    v-for="client in clients"
                    :key="client.id"
                    :value="client"
                >
                    {{ client.name }}
                </option>
            </select>
            <button
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                @click="$emit('create-client')"
            >
                Crear Cliente
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["clients"],
    data() {
        return {
            selectedClient: null,
        };
    },
    methods: {
        selectClient() {
            this.$emit("select-client", this.selectedClient);
        },
    },
};
</script>
