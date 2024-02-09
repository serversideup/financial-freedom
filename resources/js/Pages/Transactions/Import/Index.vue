<template>
    <Head :title="'Transactions'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between mb-6">
            <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Import Transactions</h1>
        </div>

        <div class="grid grid-cols-5 gap-6">
            <div class="col-span-3">
                <EmptyState v-if="!file"/>
                <ImportTable v-else/>
            </div>
            <div class="col-span-2">
                <div class="rounded-xl flex flex-col border border-[#1F242F]">
                    <div class="p-4 flex flex-col border-b border-[#1F242F]">
                        <span class="text-[#F5F5F6] font-medium text-xl font-sans">Account</span>
                    </div>
                    
                    <div class="p-4 flex flex-col">
                        
                    </div>
                </div>
            </div>
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
import EmptyState from './Partials/EmptyState.vue';
import ImportTable from './Partials/ImportTable.vue';
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { Head, Link } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const { file } = useImportTransactions();

const addTransaction = () => {
    
}
</script>