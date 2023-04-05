<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import toast from "@/Stores/toast";
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import BaseButton from '@/Components/BaseButton.vue';
import PaginationLinks from '@/Components/PaginationLinks.vue';
import { mdiShapePlus } from '@mdi/js';
import SectionTitleLineWithButton from '@/Components/SectionTitleLineWithButton.vue';
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue';
import CardBox from '@/Components/CardBox.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const nameRef = ref(null);
const emailRef = ref(null);
const roleRef = ref(null);
const passwordRef = ref(null);

const confirmingUserCreation = ref(false);

const props = defineProps({
    users: {
        type: Object,
        default: {}
    },
    roles: {
        type: Object,
        default: {}
    }
});

const form = useForm({
    name: '',
    email: '',
    role: '',
    password: ''
});


const createUser = () => {
    form.post(route('users:create'), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            closeModal();
            toast.add({
                message: "User Added !"
            });
        },
        onError: () => nameRef.value.focus(),
        onFinish: () => form.reset(),
    });
};

const showAddUserModal = () => {
    confirmingUserCreation.value = true;
};

const closeModal = () => {
    confirmingUserCreation.value = false;
    form.reset();
};

</script>

<template>
    <LayoutAuthenticated>

        <Head title="User List" />
        <div class="py-10 mx-6">
            <SectionTitleLineWithButton :icon="mdiShapePlus" title="Users List">
                <BaseButton label="Add" color="contrast" small rounded-full
                    @click.prevent="confirmingUserCreation = true;" />
            </SectionTitleLineWithButton>
        </div>
        <CardBox has-table class="mx-2">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in props.users.data" :key="index">
                        <td>{{ ++index }}</td>
                        <td data-label="Name">{{ user.name }}</td>
                        <td data-label="Email">{{ user.email }}</td>
                        <td data-label="User Type">{{ user.role }}</td>
                        <td data-label="Action">
                            <div class="mt-4">
                                <button
                                    class="border-2 outline-none hover:bg-green-600 border-green-600 rounded mx-2 px-2 py-1 hover:text-white mb-3">Edit</button>
                                <button
                                    class="border-2 outline-none hover:bg-red-600 border-red-600 rounded mx-2 px-2 py-1 hover:text-white">Permission</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </CardBox>
        <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800 text-xs">
            <pagination-links :links="props.users.links" />
        </div>
        <Modal :show="confirmingUserCreation" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Add User
                </h2>

                <div class="mt-6">
                    <InputLabel for="username" value="text" class="sr-only" />
                    <TextInput id="name" ref="nameRef" v-model="form.name" type="text" class="mt-1 block w-full"
                        placeholder="Username" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="email" value="text" class="sr-only" />

                    <TextInput id="email" ref="emailRef" v-model="form.email" type="text" class="mt-1 block w-full"
                        placeholder="Email" />

                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="password" value="text" class="sr-only" />
                    <TextInput id="password" ref="passwordRef" v-model="form.password" type="password"
                        class="mt-1 block w-full" placeholder="Password" />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
                <div class="mt-6">
                    <select v-model="form.role" class="mt-1 block w-full border-1 border-gray-300 rounded">
                        <option v-for="role in props.roles" :value="role.role">
                            {{ role.role }}
                        </option>
                    </select>
                    <InputError :message="form.errors.user_type" class="mt-2" />
                </div>
                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click.prevent="closeModal"> Cancel </SecondaryButton>
                    <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click.prevent="createUser">
                        Add
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </LayoutAuthenticated>
</template>
