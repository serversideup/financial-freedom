<template>
    <Head :title="'Settings'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Categories</h1>
        
        <Navigation/>


    </div>
    
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import Navigation from '../Partials/Navigation.vue';
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const bus = useEventBus('ff-notification-event-bus')

</script>