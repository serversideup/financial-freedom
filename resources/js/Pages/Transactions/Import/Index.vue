<template>
    <Head :title="'Transactions'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between mb-6">
            <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Import Transactions</h1>
        </div>

        <ImportStep/>

        <div class="grid grid-cols-5 gap-6 mt-6">
            <div class="col-span-5">
                <SelectAccount v-if="step == 'select-account'"/>
                <UploadFile v-if="step == 'upload-file'"/>
                <MapFields v-if="step == 'map-fields'"/>
                <ImportTable v-if="step == 'review-transactions'"/>
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
import SelectAccount from './Partials/SelectAccount.vue';
import UploadFile from './Partials/UploadFile.vue';
import MapFields from './Partials/MapFields.vue';
import ImportStep from './Partials/ImportStep.vue';
import ImportTable from './Partials/ImportTable.vue';
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { Head, Link } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const {
    step, 
    file 
} = useImportTransactions();

</script>