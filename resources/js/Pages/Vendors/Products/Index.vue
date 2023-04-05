<script setup>
import { Head, Link } from '@inertiajs/vue3';
import CardBox from '@/Components/CardBox.vue';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';

const props = defineProps({
    products: {
        type: Object,
        default: {}
    }
});
</script>

<template>
    <Head title="Vendor Products" />
    <LayoutAuthenticated>
        <div class="max-w-6xl mx-auto flex justify-between mb-4 my-6 px-3">
            <h2 class="dark:text-white text-gray-600 font-bold text-lg">Products Lists</h2>
            <Link :href="route('vendors:products:create')"
                class="py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400  bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
            Add
            </Link>
        </div>
        <CardBox has-table class="mx-2">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products.data">
                        <td class="text-center">{{ product.id }}</td>
                        <td class="text-center">
                            <div class="flex justify-center">
                                <img class="w-12 h-12 rounded-lg" :src="product.image" :alt="product.name">
                            </div>
                        </td>
                        <td class="text-center">
                            {{ product.name }}
                        </td>
                        <td class="text-center">
                            {{ product.description }}
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center items-center">
                                <div>
                                    <Link :href="route('vendors:products:show', product.id)"
                                        class="text-center outline-none hover:bg-green-600 border-green-600 rounded px-2 py-1 hover:text-white">
                                    View
                                    </Link>
                                </div>
                                <div>
                                    <Link :href="route('vendors:products:edit', product.id)"
                                        class="text-center outline-none hover:bg-yellow-600 border-yellow-600 rounded px-2 py-1 hover:text-white">
                                    Edit
                                    </Link>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </CardBox>
    </LayoutAuthenticated>
</template>
