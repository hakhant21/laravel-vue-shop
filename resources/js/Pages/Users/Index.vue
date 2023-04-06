<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import toast from "@/Stores/toast";
import _ from 'lodash';
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
const passwordRef =ref(null);
const selectedRole = ref(null)

const confirmingUserCreation = ref(false);
const confirmShowEditModal = ref(false);

const props = defineProps({
    users: {
        type: Object,
        default: {}
    },
    roles: {
        type: Object,
        default: {}
    },
    sub_roles: {
        type: Object,
        default: {}
    },
    vendors: {
        type: Object,
        default: {}
    }
});

const form = useForm({
    name: '',
    email: '',
    role:'',
    password:'',
    sub_role:'',
    vendor_name:''
});

const formEdit = useForm({
    user_id:'',
    sub_role:'',
    vendor_id:''

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

const editUser = () => {
    formEdit.post(route('users:update',{
        user: formEdit.user_id
    }), {
        preserveScroll: true,
        onSuccess: () => {
            closeEditModal()
            toast.add({
                message: "Successful update !"
            })
        },
    });
};
const showAddUserModal = () => {
    confirmingUserCreation.value = true;
};

const closeModal = () => {
    confirmingUserCreation.value = false;
    form.reset();
};


const showEditModal = (user) => {
    formEdit.user_id = user.data.id;
    formEdit.vendor_id = _.map(user.data.uservendor,'id').join(',');
    formEdit.sub_role = _.map(user.data.vendor,'sub_role').join(',');
    confirmShowEditModal.value = true;
    
};

const closeEditModal = () => {
    confirmShowEditModal.value = false;
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
                        <th >No</th>
                        <th >Name</th>
                        <th >Email</th>
                        <th >Role</th>
                        <th >Sub Role</th>
                        <th>Vendor Name</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user,index) in props.users.data" :key="index">
                                    <td>{{ ++index }}</td>     
                                    <td data-label="Name">{{ user.data.name }} </td>
                                    <td data-label="Email">{{ user.data.email }}</td>
                                    <td data-label="Role">{{ user.data.role }}</td>
                                    <td data-label="Sub Role" >{{ _.map(user.data.vendor,'sub_role').join(',') }}</td>
                                 
                                    <td data-label="Vendor Name">{{ _.map(user.data.uservendor,'name').join(',') }}</td>
                                    <td data-label="Action">
                                        <div class="mt-4">
                                            <button @click.prevent="showEditModal(user)" class="border-2 outline-none hover:bg-green-600 border-green-600 rounded mx-2 px-2 py-1 hover:text-white mb-3">Edit</button>
                                            <button  class="border-2 outline-none hover:bg-red-600 border-red-600 rounded mx-2 px-2 py-1 hover:text-white">Permission</button>
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
                    <InputLabel for="username" value="User Name"  />
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
                        <TextInput
                            id="password"
                            ref="passwordRef"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            placeholder="Password"
                        />
                        <InputError :message="form.errors.password" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <InputLabel for="Role" value="text" class="sr-only" />
                            <select  v-model="form.role" class="capitalize mt-1 block w-full border-1 border-gray-300 rounded">
                                <option  class="capitalize"
                                    v-for="role in props.roles"
                                    :value="role.role" 
                                >
                                <span class="capitalize">{{ role.role }}</span>
                                </option>
                            </select>
                            <InputError :message="form.errors.role" class="mt-2" />
                        </div>
                        
                        <div v-if="form.role === 'vendor'">
                            <div class="mt-6">
                                <select v-model="form.vendor_name" class="capitalize mt-1 block w-full border-1 border-gray-300 rounded">
                                    <option 
                                        v-for="vendor in props.vendors"
                                        :value="vendor.id" class="capitalize"
                                    >
                                    <span class="capitalize">{{ vendor.name }}</span>

                                    </option>
                                </select>
                                <InputError :message="form.errors.user_type" class="mt-2" />
                            </div>
                            <div class="mt-6">
                                <select v-model="form.sub_role" class="capitalize mt-1 block w-full border-1 border-gray-300 rounded">
                                    <option 
                                        v-for="sub_role in props.sub_roles"
                                        :value="sub_role.sub_role" class="capitalize"
                                    >
                                    <span class="capitalize">{{ sub_role.sub_role }}</span>

                                    </option>
                                </select>
                                <InputError :message="formEdit.errors.sub_role" class="mt-2" />
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end">
                            <SecondaryButton @click.prevent="closeModal"> Cancel </SecondaryButton>
                            <PrimaryButton
                                class="ml-3"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                @click.prevent="createUser"
                            >
                                Add
                            </PrimaryButton>
                        </div>
                    </div>
        </Modal>
        <Modal :show="confirmShowEditModal"  @close="closeEditModal">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Edit User
                        </h2>
                        <div class="mt-6">
                            <InputLabel for="Vendor Name" value="text" class="sr-only" />
                            <select v-model="formEdit.vendor_id" class="mt-1 block w-full border-gray-300 rounded">
                                <option 
                                        v-for="vendor in props.vendors"
                                        :value="vendor.id"  class="capitalize"
                                    >
                                    <span class="capitalize">{{ vendor.name }}</span>

                                </option>
                            </select>
                        </div>
                        <div class="mt-6">
                            <InputLabel for="Sub Role" value="text" class="sr-only" />
                            <select v-model="formEdit.sub_role" class="mt-1 block w-full border-gray-300 rounded">
                                <option 
                                        v-for="sub_role in props.sub_roles"
                                        :value="sub_role.sub_role" class="capitalize"
                                    >
                                    <span class="capitalize">{{ sub_role.sub_role }}</span>

                                </option>
                            </select>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <SecondaryButton @click.prevent="closeEditModal"> Cancel </SecondaryButton>

                            <PrimaryButton
                                class="ml-3"
                                :class="{ 'opacity-25': formEdit.processing }"
                                :disabled="formEdit.processing"
                    
                                @click="editUser"
                            >
                                Update
                            </PrimaryButton>
                        </div>
                    </div>
                </Modal> 
    </LayoutAuthenticated>
</template>
