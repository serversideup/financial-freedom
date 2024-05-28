<template>
    <div class="rounded-xl flex flex-col border border-[#1F242F]">
        <div class="p-4 flex items-center justify-between border-b border-[#1F242F]">
            <span class="text-[#F5F5F6] font-medium text-xl font-sans">Filters</span>
            <button class="text-sm text-[#F5F5F6] underline">Clear</button>
        </div>
        
        <div class="p-4 flex flex-col space-y-3">
            <div class="flex flex-col">
                <InputLabel value="Search" />
                <TextInput 
                    class="mt-1" 
                    placeholder="Search transactions" 
                    v-model="filters.search" />
            </div>

            <div class="flex flex-col">
                <InputLabel value="Accounts" />
                <Combobox v-model="filters.account">
                    <div class="relative mt-1">
                        <ComboboxInput 
                            @change="accountQuery = $event.target.value"
                            :displayValue="(account) => account ? account.name : ''" 
                            class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
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
            </div>

            <div class="flex flex-col">
                <InputLabel value="Category" />
                <Combobox v-model="filters.category">
                    <div class="relative">
                        <ComboboxInput 
                            @change="categoryQuery = $event.target.value"
                            :displayValue="(category) => category ? category.name : ''" 
                            class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <ChevronDownIcon class="h-5 w-5 text-[#6C727F]"/>
                        </ComboboxButton>
                    </div>
                    <TransitionRoot
                        leave="transition ease-in duration-100"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                        @after-leave="categoryQuery = ''">

                        <ComboboxOptions
                            class="absolute mt-1 max-h-60 w-72 overflow-auto rounded-md bg-[#161B26] border border-[#1F242F] py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm z-50">
                            <div
                                v-if="filteredGroups.length === 0 && categoryQuery !== ''"
                                class="relative cursor-default text-[#CECFD2] select-none px-4 py-2">
                                    No category found.
                            </div>
                            <template v-for="group in filteredGroups">
                                <ComboboxOption
                                    :disabled="true">
                                        <li class="pl-2 py-2 text-[#CECFD2] cursor-default select-none font-semibold">
                                            {{ group.name }}
                                        </li>
                                </ComboboxOption>
                                <ComboboxOption
                                    v-for="category in group.categories"
                                    as="template"
                                    :key="category.id"
                                    :value="category"
                                    v-slot="{ selected, active }">
                                        <li 
                                            :class="{
                                                'bg-[#1F242F]': active,
                                            }" 
                                            class="px-2 py-2 text-[#CECFD2] flex items-center cursor-pointer select-none pl-5 pr-4">
                                                <span :style="{ backgroundColor: getCategoryColor(category.color) }" class="w-2 h-2 rounded-full mr-1"></span>
                                                {{ category.name }}
                                        </li>
                                </ComboboxOption>
                            </template>
                            
                        </ComboboxOptions>
                    </TransitionRoot>
                </Combobox>
            </div>

            <div class="flex flex-col">
                <InputLabel value="Type" />
                
            </div>

            <div class="flex flex-col">
                <InputLabel value="Date Range" />
                
            </div>
        </div>
    </div>
</template>

<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { computed, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'
import { 
    useCategoryColor 
} from '@/Composables/useCategoryColor.js';

const cashAccounts = computed(() => usePage().props.cashAccounts);
const creditCards = computed(() => usePage().props.creditCards);
const loans = computed(() => usePage().props.loans);
const groups = computed(() => usePage().props.groups);

const filters = useForm({
    search: '',
    account: '',
    category: ''
})

/**
 * Account Filters
 */
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

/**
 * Category Filters
 */
 const {
    getCategoryColor
} = useCategoryColor();

const categoryQuery = ref('');
const filteredGroups = computed(() => {
    let filteredGroups = groups.value.map(group => {
        return {
            ...group,
            categories: group.categories.filter(category => {
                return category.name.toLowerCase().includes(categoryQuery.value.toLowerCase());
            })
        }
    });

    return filteredGroups.filter(group => group.categories.length > 0);
});

</script>