<template>
    <div class="rounded-xl flex flex-col border border-[#1F242F]">
        <div class="p-4 flex flex-col border-b border-[#1F242F]">
            <span class="text-[#F5F5F6] font-medium text-xl font-sans">Summary</span>
        </div>
        
        <div class="p-4 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[#F5F5F6] font-medium text-sm font-sans">Assets</span>
                <span class="text-[#F5F5F6] font-bold font-sans">{{ currency.format( assets ) }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[#F5F5F6] font-medium text-sm font-sans">Liabilities</span>
                <span class="text-[#F5F5F6] font-bold font-sans">{{ currency.format( liabilities ) }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useFormatters } from '@/Composables/useFormatters';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const { currency } = useFormatters();

const cashAccounts = computed(() => usePage().props.cashAccounts);
const creditCards = computed(() => usePage().props.creditCards);

const assets = computed(() => {
    return cashAccounts.value.reduce((acc, account) => {
        return parseFloat( acc ) + parseFloat( account.balance );
    }, 0);
});

const liabilities = computed(() => {
    return creditCards.value.reduce((acc, account) => {
        return parseFloat( acc ) + parseFloat( account.balance );
    }, 0);
});
</script>