<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useStyleStore } from '@/Stores/style';
import MainLayout from '@/Layouts/MainLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const styleStore = useStyleStore();

const form = useForm({
    name: ""
})

</script>

<template>
    <Head title="Vendor Products" />
    <MainLayout>
        <div class="max-w-5xl mx-auto flex justify-between mb-4 my-6">
            <h2 class="dark:text-white text-gray-600 font-bold text-lg">Create Product Form</h2>
            <Link :href="route('vendors:products:index')"
                class="py-1 px-4 rounded-lg dark:bg-indigo-500 dark:hover:bg-indigo-400  bg-slate-600 hover:bg-slate-500 text-slate-50 hover:text-slate-100">
            Go back</Link>
        </div>
        <div class="max-w-sm mx-auto">
            <form>
                <div>
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

                </div>
            </form>
        </div>
    </MainLayout>
</template>
