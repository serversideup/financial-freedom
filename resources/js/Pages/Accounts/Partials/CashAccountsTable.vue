<template>
    <div class="rounded-xl border border-[#1F242F] flex flex-col md:col-span-5">
        <div class="p-4 flex flex-col border-b border-[#1F242F]">
            <span class="text-[#94969C] font-medium text-sm font-sans">Cash</span>
            <span class="text-[#F5F5F6] font-bold text-2xl font-sans">{{ currency.format( total ) }}</span>
        </div>
        <Link :href="'/cash-accounts/'+cashAccount.id" v-for="(cashAccount, cashAccountIndex) in cashAccounts"
            class="p-6 flex items-center justify-between"
            :class="{
                'border-b border-[#1F242F]' : cashAccountIndex !== cashAccounts.length - 1
            }">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 mr-2">
                        <img src="/img/ui/institution-placeholder.png"/>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[#F5F5F6] font-semibold text-base">
                            {{ cashAccount.name }}
                        </span>
                        <span class="text-[#94969C] font-sans text-sm capitalize">
                            {{ cashAccount.type }}
                        </span>
                    </div>
                </div>

                <span class="text-[#F5F5F6] font-semibold text-base">
                    {{ currency.format( cashAccount.balance ) }}
                </span>
        </Link>
    </div>
</template>

<script setup>
import { useFormatters } from '@/Composables/useFormatters';
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const { currency } = useFormatters();

const cashAccounts = computed(() => usePage().props.cashAccounts);
const total = computed(() => {
    return cashAccounts.value.reduce((acc, account) => {
        return parseFloat( acc ) + parseFloat( account.balance );
    }, 0);
});
</script>