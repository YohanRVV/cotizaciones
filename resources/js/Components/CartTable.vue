<template>
    <div>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2 border">Producto</th>
                    <th class="p-2 border">Cantidad</th>
                    <th class="p-2 border">Precio</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in cart" :key="index">
                    <td class="p-2 border">{{ item.name }}</td>
                    <td class="p-2 border">
                        <input
                            type="number"
                            v-model.number="item.quantity"
                            min="1"
                            :max="item.stock"
                            class="w-16 p-1 border rounded"
                        />
                    </td>
                    <td class="p-2 border">
                        ${{ parseFloat(item.price).toFixed(2) }}
                    </td>
                    <td class="p-2 border">
                        ${{ (item.quantity * item.price).toFixed(2) }}
                    </td>
                    <td class="p-2 border">
                        <button
                            @click="$emit('remove-from-cart', index)"
                            class="text-red-500 hover:text-red-700"
                        >
                            Quitar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-4 text-right text-xl font-bold">
            Total General: ${{ parseFloat(total).toFixed(2) }}
        </div>
        <div class="mt-6 text-right">
            <button
                @click="$emit('save-purchase')"
                class="bg-green-500 text-white px-6 py-3 rounded shadow hover:bg-green-600"
            >
                Guardar
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["cart", "total", "selectedClient"],
};
</script>
