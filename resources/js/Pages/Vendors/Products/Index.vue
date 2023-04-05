<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';

const props = defineProps({
    products: {
        type: Object,
        default: {}
    }
})
console.log(props.products);

</script>

<template>
    <Head title="Vendor Products" />
    <LayoutAuthenticated>
        <div class="max-w-5xl mx-auto flex justify-between mb-4 my-6">
            <h2 class="dark:text-white text-gray-600 font-bold text-lg">Products Lists</h2>
            <Link :href="route('vendors:products:create')"
                class="py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400  bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
            Add</Link>
        </div>
        <div class="max-w-5xl mx-auto shadow-lg py-4 rounded-lg">
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
                           <div class="flex justify-evenly">
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
                            <Link :href="route('vendors:products:show', product.id)"
                                class="mx-1 py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400
                                bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
                                View
                            </Link>
                            <Link :href="route('vendors:products:edit', product.id)"
                                class="py-1 px-4 rounded-lg dark:bg-warning-500 dark:hover:bg-warning-400
                                bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
                                Edit
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </LayoutAuthenticated>
</template>
