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

        <FloatingActions v-show="step == 'review-transactions'"/>
        <AddRuleSlideout :apply="true"/>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import AddRuleSlideout from './Partials/AddRuleSlideout.vue';
import FloatingActions from './Partials/FloatingActions.vue';
import SelectAccount from './Partials/SelectAccount.vue';
import UploadFile from './Partials/UploadFile.vue';
import MapFields from './Partials/MapFields.vue';
import ImportStep from './Partials/ImportStep.vue';
import ImportTable from './Partials/ImportTable.vue';
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const {
    step,
    account, 
    rules,
    applyRules
} = useImportTransactions();

const functionBus = useEventBus('ff-function-event-bus');

const listener = ( event, data ) => {
    if( event == 'apply-rules' ){
        updateRules();
        applyRules();
    }
}

functionBus.on(listener);

const cashAccounts = computed(() => usePage().props.cashAccounts);
const creditCards = computed(() => usePage().props.creditCards);
const loans = computed(() => usePage().props.loans);

const updateRules = () => {
    switch( account.value.type ){
        case 'cash-account':
            let cashAccount = cashAccounts.value.find( cashAccount => cashAccount.id == account.value.id );
            rules.value = cashAccount.rules;
            break;
        case 'credit-card':
            let creditCard = creditCards.value.find( creditCard => creditCard.id == account.value.id );
            rules.value = creditCard.rules;
            break;
        case 'loan':
            let loan = loans.value.find( loan => loan.id == account.value.id );
            rules.value = loan.rules;
            break;
    }
}
</script>