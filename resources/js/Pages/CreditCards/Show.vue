<template>
    <Head :title="creditCard.name+' - Credit Cards'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between mb-6">
            <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">{{ creditCard.name }}</h1>
            <div class="flex items-center space-x-3">
                <button @click="addTransaction" class="px-[14px] py-[10px] rounded-lg bg-[#155EEF] flex items-center text-[#F5F5F6] font-semibold">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-[6px]">
                        <path d="M7.00033 1.16669V12.8334M1.16699 7.00002H12.8337" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Add Transaction
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6" >
            
        </div>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import { computed } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const creditCard = computed(() => usePage().props.creditCard);
const promptBus = useEventBus('ff-prompt-event-bus')

</script>