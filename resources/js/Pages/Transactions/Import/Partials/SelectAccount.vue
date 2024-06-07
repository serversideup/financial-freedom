<template>
    <div class="flex flex-col max-w-md pl-px">
        <InputLabel value="Select Account"/>
        <Combobox v-model="form.account">
            <div class="relative mt-1">
                <ComboboxInput 
                    @change="accountQuery = $event.target.value"
                    :displayValue="(account) => account ? account.name : ''" 
                    class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <ChevronDownIcon class="h-5 w-5 text-[#6C727F]"/>
                </ComboboxButton>
            </div>
            <TransitionRoot
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
                @after-leave="accountQuery = ''">

                <ComboboxOptions
                    class="absolute mt-1 max-h-60 w-72 overflow-auto rounded-md bg-[#161B26] border border-[#1F242F] py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm z-50">
                    <div
                        v-if="filteredAccounts.length === 0 && accountQuery !== ''"
                        class="relative cursor-default text-[#CECFD2] select-none px-4 py-2">
                            No account found.
                    </div>
                    <template v-for="(accountType, accountTypeKey) in filteredAccounts">
                        <ComboboxOption
                            :disabled="true">
                                <li class="pl-2 py-2 text-[#CECFD2] cursor-default select-none font-semibold">
                                    {{ findAccountTypeName(accountTypeKey) }}
                                </li>
                        </ComboboxOption>
                        <ComboboxOption
                            v-for="account in accountType"
                            as="template"
                            :key="account.id"
                            :value="account"
                            v-slot="{ selected, active }">
                                <li 
                                    :class="{
                                        'bg-[#1F242F]': active,
                                    }" 
                                    class="px-2 py-2 text-[#CECFD2] flex items-center cursor-pointer select-none pl-5 pr-4">
                                        {{ account.name }}
                                </li>
                        </ComboboxOption>
                    </template>
                </ComboboxOptions>
            </TransitionRoot>
        </Combobox>
        
        <div class="mt-5">
            <button @click="next()" class="bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                Next &rarr;
            </button>
        </div>
    </div>
</template>

<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'

const cashAccounts = computed(() => usePage().props.cashAccounts);
const creditCards = computed(() => usePage().props.creditCards);
const loans = computed(() => usePage().props.loans);

const { 
    form, 
    rules,
    step 
} = useImportTransactions();

const accountQuery = ref('');
const filteredAccounts = computed(() => {
    let filteredAccounts = {};
    let filteredCashAccounts = [];

    if (accountQuery.value) {
        filteredCashAccounts = cashAccounts.value.filter(account => account.name.toLowerCase().includes(accountQuery.value.toLowerCase()));
    } else {
        filteredCashAccounts = cashAccounts.value;
    }

    if( filteredCashAccounts.length > 0 ) {
        filteredAccounts.cash = filteredCashAccounts;
    }

    let filteredCreditCards = [];

    if (accountQuery.value) {
        filteredCreditCards = creditCards.value.filter(account => account.name.toLowerCase().includes(accountQuery.value.toLowerCase()));
    } else {
        filteredCreditCards = creditCards.value;
    }

    if( filteredCreditCards.length > 0 ) {
        filteredAccounts.credit_cards = filteredCreditCards;
    }

    let filteredLoans = [];

    if (accountQuery.value) {
        filteredLoans = loans.value.filter(account => account.name.toLowerCase().includes(accountQuery.value.toLowerCase()));
    } else {
        filteredLoans = loans.value;
    }

    if( filteredLoans.length > 0 ) {
        filteredAccounts.loans = filteredLoans;
    }

    return filteredAccounts;
});

const findAccountTypeName = (key) => {
    switch(key) {
        case 'cash':
            return 'Cash Accounts';
        break;
        case 'credit_cards':
            return 'Credit Cards';
        break;
        case 'loans':
            return 'Loans';
        break;
    }
}
const next = () => {
    if (form.account) {
        rules.value = form.account.rules;
        step.value = 'upload-file';
    }
}
</script>