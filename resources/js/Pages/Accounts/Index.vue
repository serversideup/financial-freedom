<template>
    <Head :title="'Accounts'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between">
            <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Accounts</h1>
            <div class="flex items-center space-x-3">
                <button @click="addAccount" class="px-[14px] py-[10px] rounded-lg bg-[#155EEF] flex items-center text-[#F5F5F6] font-semibold">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-[6px]">
                        <path d="M7.00033 1.16669V12.8334M1.16699 7.00002H12.8337" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Add Account
                </button>
            </div>
        </div>
    </div>

    <AddAccountModal/>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import AddAccountModal from './Partials/AddAccountModal.vue';
import { Head } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')

const addAccount = () => {
    promptBus.emit('prompt-add-account');
}

</script>