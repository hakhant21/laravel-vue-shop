<script setup>
    import { router, usePage } from '@inertiajs/vue3';
    import { onMounted, onUnmounted, ref } from 'vue';
    import ToastItem from './ToastItem.vue';
    import toast from "@/Stores/toast"

    const props = defineProps({
        message: String
    })

    const items = ref(toast.items)

    const page = usePage();

    onUnmounted(() => {
        router.on('finish', () => {
            if(usePage().props.value.toast) {
                toast.add({
                    message: page.props.value.toast
                })
            }
        })
    })

    const remove = (index) => {
        toast.remove(index)
    }
    

</script>
<template>
   <TransitionGroup 
   tag="div"
   enter-from-class="translate-x-full opacity-0"
   enter-active-class="duration-500"
   leave-active-class="duration-500"
   leave-to-class="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-50 w-max h-auto space-y-5">
        <ToastItem v-for="(item,index) in items"
            :key="item.key"
            :message="item.message" 
            :duration="3000"
            @remove="remove(index)"
        />
    </TransitionGroup>
</template>