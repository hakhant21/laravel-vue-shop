<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useStyleStore } from '@/Stores/style';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const styleStore = useStyleStore();

const form = useForm({
    name: "",
    description: "",
    price: "",
    stock: "",
    quantity: "",
    image: "",
    color: [],
    size: [],
});

const createProduct = () => {
    form.post(route('vendors:products:store'));
}

</script>

<template>
    <Head title="Vendor Products" />
    <LayoutAuthenticated>
        <div class="max-w-5xl mx-auto flex justify-between mb-4 my-6">
            <h2 class="dark:text-white text-gray-600 font-bold text-lg">Create Product Form</h2>
            <Link :href="route('vendors:products:index')"
                class="py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400  bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
            Go back</Link>
        </div>
        <div class="max-w-xl mx-auto shadow-xl rounded-lg px-6 py-8">
            <form @submit.prevent="createProduct">
                <div class="mb-4">
                    <InputLabel for="name" value="Product Name" class="dark:text-white" />

                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800"
                        autocomplete="name"
                    />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="name" value="Product Description" class="dark:text-white" />

                    <TextInput
                        id="description"
                        v-model="form.description"
                        type="text"
                        :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800"
                        autocomplete="description"
                    />
                    <InputError :message="form.errors.description" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="price" value="Product Price" class="dark:text-white" />

                    <TextInput
                        id="price"
                        v-model="form.price"
                        type="number"
                        min="0"
                        :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800"
                        autocomplete="price"
                    />
                    <InputError :message="form.errors.price" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="stock" value="Product Stock" class="dark:text-white" />

                    <TextInput
                        id="stock"
                        v-model="form.stock"
                        type="number"
                        min="0"
                        :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800"
                        autocomplete="stock"
                    />
                    <InputError :message="form.errors.stock" class="mt-2" />
                </div>
                <div class="mb-4">
                    <InputLabel for="quantity" value="Product Quantity" class="dark:text-white" />

                    <TextInput
                        id="quantity"
                        v-model="form.quantity"
                        type="number"
                        min="0"
                        :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-800"
                        autocomplete="quantity"
                    />
                    <InputError :message="form.errors.quantity" class="mt-2" />
                </div>

                <div class="mb-4">
                    <InputLabel for="image" value="Product Image" class="dark:text-white" />

                    <TextInput
                        id="image"
                        @input="form.image = $event.target.files[0]"
                        type="file"
                        :class="styleStore.darkMode"
                        class="mt-1 block w-full dark:text-gray-100 border"
                        autocomplete="image"
                    />
                    <InputError :message="form.errors.image" class="mt-2" />
                </div>

                <div class="flex items-center gap-4 justify-end">
                    <PrimaryButton :class="styleStore.darkMode" class="dark:bg-white dark:text-slate-800 dark:hover:bg-gray-100 dark:hover:text-slate-500" :disabled="form.processing">
                        Save
                    </PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </div>
    </LayoutAuthenticated>
</template>
