<script setup lang="ts">
import type { PaginationLinks } from '@/types/Pagination';
import type { Product } from '@/types/Product';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref, watchEffect } from 'vue';

const page = usePage();
const isLoading = ref(true);

const products = computed(
    () =>
        page.props.products as {
            data: Product[];
            links: PaginationLinks[];
            current_page: number;
            per_page: number;
        },
);

watchEffect(() => {
    if (products.value.data.length >= 0) {
        setTimeout(() => {
            isLoading.value = false;
        }, 500);
    }
});

const getRandomWidth = (min: number, max: number) => {
    return `${Math.floor(Math.random() * (max - min + 1)) + min}px`;
};

const cleanLabel = (label: string) => {
    return label.replace(/&raquo;/g, '»').replace(/&laquo;/g, '«');
};
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-50 p-6"
    >
        <h1 class="mb-4 text-2xl font-bold text-gray-900">
            🍏 Welcome to the Fruit Store! 🍊
        </h1>

        <div
            class="w-full max-w-lg overflow-x-auto rounded-lg bg-white p-4 shadow-lg"
        >
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            No
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            Name
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            Price
                        </th>
                    </tr>
                </thead>

                <tbody v-if="isLoading">
                    <tr v-for="n in 10" :key="n" class="border-b">
                        <td class="border border-gray-300 px-4 py-2">
                            <div
                                class="aspect-square h-6 w-6 animate-pulse rounded-md bg-gray-200"
                            ></div>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div
                                class="h-6 animate-pulse rounded-md bg-gray-200"
                                :style="{ width: getRandomWidth(80, 160) }"
                            ></div>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div
                                class="h-6 animate-pulse place-self-end rounded-md bg-gray-200"
                                :style="{ width: getRandomWidth(30, 50) }"
                            ></div>
                        </td>
                    </tr>
                </tbody>

                <tbody v-else-if="products.data.length > 0">
                    <tr
                        v-for="(product, index) in products.data"
                        :key="product.id"
                        class="border-b"
                    >
                        <td class="border border-gray-300 px-4 py-2">
                            {{
                                (products.current_page - 1) *
                                    products.per_page +
                                index +
                                1
                            }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ product.name }}
                        </td>
                        <td
                            class="border border-gray-300 px-4 py-2 text-right font-semibold text-green-600"
                        >
                            {{ '$ ' + product.price }}
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr colspan="3" class="border-b">
                        <td class="px-4 py-2 text-lg text-gray-500">
                            No products available.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="products.links.length > 3" class="mt-6 flex space-x-2">
            <Link
                v-for="(link, index) in products.links"
                :key="index"
                :href="link.url || '#'"
                :class="[
                    'rounded-md border px-4 py-2',
                    link.active
                        ? 'bg-green-600 text-white'
                        : 'bg-gray-200 text-gray-700',
                    !link.url ? 'cursor-not-allowed opacity-50' : '',
                ]"
            >
                {{ cleanLabel(link.label) }}
            </Link>
        </div>
    </div>
</template>
