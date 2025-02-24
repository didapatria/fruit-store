<script setup lang="ts">
import { Error } from '@/types/Error';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const errorMessage = computed(
    () => (page.props.th as Error)?.message || 'An unexpected error occurred.',
);

const status = computed(() => (page.props.th as Error)?.status || 500);
</script>

<template>
    <Head title="Error" />
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-100 p-6"
    >
        <h1 class="text-5xl font-bold text-red-600">{{ status }}</h1>
        <p class="mt-4 text-lg text-gray-700">{{ errorMessage }}</p>
        <a
            href="/"
            class="mt-6 rounded-md bg-green-600 px-4 py-2 text-white transition hover:bg-green-700"
        >
            Go to Homepage
        </a>
    </div>
</template>
