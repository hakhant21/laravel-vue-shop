<script setup>
import { usePage } from '@inertiajs/vue3';
import LayoutGuest from '@/Layouts/LayoutGuest.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import LayoutAuthenticated from '@/Layouts/LayoutAuthenticated.vue'

const user = usePage().props.auth.user;
</script>

<template>
    <div v-if="user.role == ''">
        <LayoutGuest>
            <slot />
        </LayoutGuest>
    </div>
    <div v-if="user.role == 'admin'">
        <LayoutAuthenticated>
            <slot />
        </LayoutAuthenticated>
    </div>
    <div v-if="user.role == 'vendor'">
        <LayoutAuthenticated>
            <slot />
        </LayoutAuthenticated>
    </div>
    <div v-if="user.role == 'user'">
        <AuthenticatedLayout>
            <slot />
        </AuthenticatedLayout>
    </div>
</template>
