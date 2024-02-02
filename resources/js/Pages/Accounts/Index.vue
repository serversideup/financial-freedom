<template>
    <Head :title="'Accounts'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between mb-6">
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

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6" v-if="hasAccounts">
            <NetWorth :transactions="[]"/>

            <div class="grid grid-cols-1 gap-6 md:col-span-3">
                <CashAccountsTable
                    v-if="cashAccounts.length > 0"/>
                <CreditCardsTable
                    v-if="creditCards.length > 0"/>
                <LoansTable
                    v-if="loans.length > 0"/>
            </div>

            <div class="md:col-span-2">
                <AccountSummary/>
            </div>
        </div>

        <EmptyState v-else/>
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
import AccountSummary from './Partials/AccountSummary.vue';
import AddAccountModal from './Partials/AddAccountModal.vue';
import CashAccountsTable from './Partials/CashAccountsTable.vue';
import CreditCardsTable from './Partials/CreditCardsTable.vue';
import LoansTable from './Partials/LoansTable.vue';
import EmptyState from './Partials/EmptyState.vue';
import NetWorth from './Partials/NetWorth.vue';
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const cashAccounts = computed(() => usePage().props.cashAccounts);
const creditCards = computed(() => usePage().props.creditCards);
const loans = computed(() => usePage().props.loans);
const hasAccounts = computed(() => cashAccounts.value.length > 0 || creditCards.value.length > 0);

const promptBus = useEventBus('ff-prompt-event-bus')

const addAccount = () => {
    promptBus.emit('prompt-add-account');
}

</script>