<script setup>
import toast from "@/Stores/toast";
import { useStyleStore } from '@/Stores/style';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';

const styleStore = useStyleStore();

const props = defineProps({
    product: {
        type: Object,
        default: {}
    },
    colors: {
        type: Array,
        default: []
    },
    sizes: {
        type: Array,
        default: []
    }
});

const form = useForm({
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    stock: props.product.stock,
    quantity: props.product.quantity,
    image: '',
    color: props.product.color,
    size: props.product.size,
});

const updateProduct = () => {
    form.put(route('vendors:products:update', props.product.id), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            toast.add({
                message: "Product updated successfully..."
            });
        },
        onError: () => form.name.focus(),
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Vendor Products" />
    <LayoutAuthenticated>
        <div class="max-w-5xl mx-auto flex justify-between mb-4 my-6">
            <h2 class="dark:text-white text-gray-600 font-bold text-lg">Edit Product</h2>
            <Link :href="route('vendors:products:index')"
                class="py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400  bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
            Go back
            </Link>
        </div>
        <div class="max-w-xl mx-auto shadow-xl rounded-lg px-6 py-8">
            <form @submit.prevent="updateProduct">
                <div class="mb-4">
                    <InputLabel for="name" value="Product Name" class="dark:text-white" />

                    <TextInput id="name" v-model="form.name" type="text" :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800" autocomplete="name" />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="name" value="Product Description" class="dark:text-white" />

                    <TextInput id="description" v-model="form.description" type="text" :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800" autocomplete="description" />

                    <InputError :message="form.errors.description" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="price" value="Product Price" class="dark:text-white" />

                    <input id="price" v-model="form.price" type="number" min="0" :class="styleStore.darkMode"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full dark:text-gray-800"
                        autocomplete="price" />

                    <InputError :message="form.errors.price" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="stock" value="Product Stock" class="dark:text-white" />

                    <input id="stock" v-model="form.stock" type="number" min="0" step="any" :class="styleStore.darkMode"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full dark:text-gray-800"
                        autocomplete="stock" />

                    <InputError :message="form.errors.stock" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="quantity" value="Product Quantity" class="dark:text-white" />

                    <input id="quantity" v-model="form.quantity" type="number" min="0" :class="styleStore.darkMode"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full dark:text-gray-800"
                        autocomplete="quantity" />

                    <InputError :message="form.errors.quantity" class="mt-2" />
                </div>

                <div class="mb-4">
                    <InputLabel for="image" value="Product Image" class="dark:text-white" />
                    <input id="image" @input="form.image = $event.target.files[0]" type="file" :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-100 border" autocomplete="image" />
                    <InputError :message="form.errors.image" class="mt-2" />
                </div>

                <div class="flex justify-between">
                    <div class="mb-4">
                        <InputLabel for="color" value="Product Color" class="dark:text-white" />
                        <div class="flex mt-2">
                            <div v-for="color, index in props.colors" :key="index">
                                <InputLabel for="index" :value="color" class="dark:text-white mr-2" />
                                <input type="checkbox" id="color" v-model="form.color" :value="color"
                                    :checked="props.colors.filter(color => color == form.color)"
                                    :class="styleStore.darkMode" autocomplete="color" class="mr-3" />
                            </div>
                        </div>
                        <InputError :message="form.errors.color" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="size" value="Product Size" class="dark:text-white" />
                        <div class="flex mt-2">
                            <div v-for="size, index in props.sizes" :key="index">
                                <InputLabel for="index" :value="size" class="dark:text-white mr-2" />
                                <input type="checkbox" id="size" v-model="form.size" :value="size"
                                    :checked="props.sizes.filter(size => size == form.size)" :class="styleStore.darkMode"
                                    autocomplete="size" class="mr-2" />
                            </div>
                        </div>
                        <InputError :message="form.errors.size" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center gap-4 justify-end">
                    <PrimaryButton :class="styleStore.darkMode"
                        class="dark:bg-white dark:text-slate-800 dark:hover:bg-gray-100 dark:hover:text-slate-500"
                        :disabled="form.processing">
                        Save
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </LayoutAuthenticated>
</template>
