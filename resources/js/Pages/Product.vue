<script setup lang="ts">
import type { Product } from '@/types/Product';
import { Head, usePage } from '@inertiajs/vue3';
import { computed, ref, watchEffect } from 'vue';

const page = usePage();
const isLoading = ref(true);

const product = computed(
    () =>
        (page.props.product as Product) || {
            id: 0,
            user_id: 0,
            user: { id: 0, name: 'Unknown', email: '' },
            name: 'Unknown Product',
            description: 'No description available.',
            price: 0,
            stock: 0,
        },
);

watchEffect(() => {
    if (product.value && product.value.id !== 0) {
        setTimeout(() => {
            isLoading.value = false;
        }, 500);
    }
});

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/';
    }
};
</script>

<template>
    <Head title="Product" />
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-100 p-6"
    >
        <div
            v-if="isLoading"
            class="w-full max-w-lg animate-pulse rounded-lg bg-white p-6 shadow-lg"
        >
            <div
                class="mb-4 h-10 w-24 animate-pulse rounded-md bg-gray-200"
            ></div>

            <div class="h-8 w-3/4 animate-pulse rounded-md bg-gray-300"></div>
            <div
                class="mt-2 h-6 w-full animate-pulse rounded-md bg-gray-200"
            ></div>

            <div class="mt-4">
                <div
                    class="h-6 w-1/4 animate-pulse rounded-md bg-gray-300"
                ></div>
                <div
                    class="mt-2 h-6 w-1/6 animate-pulse rounded-md bg-gray-200"
                ></div>
            </div>

            <div class="mt-6">
                <div
                    class="h-6 w-1/3 animate-pulse rounded-md bg-gray-300"
                ></div>
                <div
                    class="mt-2 h-6 w-1/4 animate-pulse rounded-md bg-gray-200"
                ></div>
                <div
                    class="mt-2 h-6 w-1/2 animate-pulse rounded-md bg-gray-200"
                ></div>
            </div>
        </div>
        <div v-else class="w-full max-w-lg rounded-lg bg-white p-6 shadow-lg">
            <button
                @click="goBack"
                class="mb-4 rounded-md bg-gray-300 px-4 py-2 text-gray-700 transition hover:bg-gray-400"
            >
                ← Back
            </button>

            <h1 class="text-3xl font-bold text-gray-900">
                🛍 {{ product.name }}
            </h1>
            <p class="mt-2 text-lg text-gray-700">{{ product.description }}</p>

            <div class="mt-4">
                <p class="text-xl font-semibold text-green-600">
                    Price: ${{ product.price }}
                </p>
                <p class="text-md text-gray-600">Stock: {{ product.stock }}</p>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-900">
                    Seller Information
                </h2>
                <p class="text-md text-gray-700">👤 {{ product.user.name }}</p>
                <p class="text-md text-gray-500">📧 {{ product.user.email }}</p>
            </div>
        </div>
    </div>
</template>
