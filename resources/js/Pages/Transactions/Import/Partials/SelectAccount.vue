<template>
    <div class="flex flex-col max-w-md">
        <label class="text-[#CECFD2] font-sans font-medium text-sm">Select Account</label>
        <select v-model="form.account" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
            <option value="" disabled>Select an account</option>
            <option 
                v-for="account in cashAccounts" 
                :key="account.id" 
                :value="account">
                    {{ account.name }}
            </option>
            <option 
                v-for="creditCard in creditCards" 
                :key="creditCard.id" 
                :value="creditCard">
                    {{ creditCard.name }}
            </option>
            <option 
                v-for="loan in loans" 
                :key="loan.id" 
                :value="loan">
                    {{ loan.name }}
            </option>
        </select>
        <div class="mt-5">
            <button @click="next()" class="bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                Next &rarr;
            </button>
        </div>
    </div>
</template>

<script setup>
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const cashAccounts = computed(() => usePage().props.cashAccounts);
const creditCards = computed(() => usePage().props.creditCards);
const loans = computed(() => usePage().props.loans);

const { 
    form, 
    rules,
    step 
} = useImportTransactions();

const next = () => {
    if (form.account) {
        rules.value = form.account.rules;
        step.value = 'upload-file';
    }
}
</script>