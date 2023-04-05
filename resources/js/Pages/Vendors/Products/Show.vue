<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';

</script>

<template>
    <Head title="Vendor Products" />
    <LayoutAuthenticated>
        <div class="max-w-5xl mx-auto flex justify-between mb-4 my-6">
            <h2 class="dark:text-white text-gray-600 font-bold text-lg">Products Details</h2>
            <Link :href="route('vendors:products:index')"
                class="py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400  bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
                Go back
            </Link>
        </div>
    </LayoutAuthenticated>
</template>
