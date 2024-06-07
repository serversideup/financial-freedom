<template>
    <Head :title="'Transactions'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between mb-6">
            <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Transactions</h1>
            <div class="flex items-center space-x-3">
                <Link href="/transactions/import" class="rounded-lg shadow-sm px-[14px] py-[10px] flex items-center text-semibold text-[#CECFD2] font-semibold border border-[#333741]">
                    <div class="w-[20px] h-[20px] mr-1 flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M17 8L12 3M12 3L7 8M12 3V15" stroke="#CECFD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    
                    Import
                </Link>

                <button @click="addTransaction" class="px-[14px] py-[10px] rounded-lg bg-[#155EEF] flex items-center text-[#F5F5F6] font-semibold">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-[6px]">
                        <path d="M7.00033 1.16669V12.8334M1.16699 7.00002H12.8337" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Add Transaction
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-8">
                <TransactionsTable/>
            </div>
            <div class="col-span-4">
                <Filters/>
            </div>
        </div>

        <AddTransactionModal/>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import AddTransactionModal from './Partials/AddTransactionModal.vue';
import Filters from './Partials/Filters.vue';
import TransactionsTable from './Partials/TransactionsTable.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')

const addTransaction = () => {
    promptBus.emit('prompt-add-transaction');
}
</script>