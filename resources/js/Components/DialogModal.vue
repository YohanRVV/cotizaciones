<template>
    <div
        v-if="isVisible"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">{{ title }}</h3>
            </div>
            <div class="p-4">
                <p>{{ message }}</p>
            </div>
            <div class="flex justify-end p-4 border-t">
                <button
                    v-if="showCancel"
                    @click="cancel"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 mr-2"
                >
                    Cancelar
                </button>
                <button
                    @click="confirm"
                    class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600"
                >
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "Notificación",
        },
        message: {
            type: String,
            default: "Algo sucedió.",
        },
        showCancel: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            isVisible: false,
        };
    },
    methods: {
        open(notification) {
            if (notification) {
                this.title = notification.title || this.title;
                this.message = notification.message || this.message;
            }
            this.isVisible = true;
        },
        close() {
            this.isVisible = false;
        },
        confirm() {
            this.$emit("confirm");
            this.close();
        },
        cancel() {
            this.$emit("cancel");
            this.close();
        },
    },
};
</script>
