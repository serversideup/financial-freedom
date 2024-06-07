<template>
    <Modal @close="closeModal" :show="show" :max-width="'2xl'">
        <form class="flex flex-col w-full" @submit.prevent="submit">
            <div class="flex items-center justify-between w-full">
                <TransactionsIcon class="flex-shrink-0 text-[#CECFD2]"/>
                
                <button type="button" @click="closeModal">
                    <ModalCloseIcon/>
                </button>
            </div>

            <span class="font-sans text-lg font-semibold text-[#F5F5F6] mt-4">Add Transaction</span>
            <span class="font-sans text-sm text-[#94969C]">Create a new transaction for an account.</span>

            <div class="flex flex-col mt-5">
                <InputLabel value="Account"/>
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
                <InputError class="mt-2" :message="form.errors.account" />
            </div>

            <div class="flex flex-col mt-4">
                <div class="flex flex-col">
                    <InputLabel value="Merchant"/>
                    <TextInput v-model="form.merchant" placeholder="Where did this transaction take place?" class="mt-1"/>
                    <InputError class="mt-2" :message="form.errors.merchant" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex flex-col">
                    <InputLabel value="Direction"/>
                    <select v-model="form.direction" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 pl-3 pr-4">
                        <option value=""></option>
                        <option value="debit">Debit</option>
                        <option value="credit">Credit</option>
                        <option value="transfer">Transfer</option>
                        <option value="payment">Payment</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.direction" />
                </div>

                <div class="flex flex-col">
                    <InputLabel value="Amount"/>
                    <PrefixTextInput v-model="form.amount" class="mt-1">
                        <span>$</span>
                    </PrefixTextInput>
                    <InputError class="mt-2" :message="form.errors.amount" />
                </div>

                <div class="flex flex-col">
                    <InputLabel value="Date"/>
                    <TextInput v-model="form.date" placeholder="When did this transaction take place?" class="mt-1"/>
                    <InputError class="mt-2" :message="form.errors.date" />
                </div>

                <div class="flex flex-col">
                    <InputLabel value="Category"/>
                    <Combobox v-model="form.category">
                        <div class="relative mt-1">
                            <ComboboxInput 
                                @change="categoryQuery = $event.target.value"
                                :displayValue="(category) => category ? category.name : ''" 
                                class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
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
                    <InputError class="mt-2" :message="form.errors.category" />
                </div>
            </div>

            <div class="pt-8 flex items-center justify-end">
                <button type="button" @click="closeModal" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                    Cancel
                </button>
                <button class="ml-3 bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                    Create
                </button>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import TransactionsIcon from '@/Components/Icons/TransactionsIcon.vue';
import ModalCloseIcon from '@/Components/Icons/ModalCloseIcon.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrefixTextInput from '@/Components/PrefixTextInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'
import { computed, ref } from 'vue';
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
const promptBus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')
const show = ref(false);

const listener = ( event ) => {
    if( event == 'prompt-add-transaction' ){
        show.value = true;
    }
}
promptBus.on(listener);

const form = useForm({
    account: null,
    merchant: '',
    date: '',
    amount: '',
    direction: 'debit',
    category: null,
});

const closeModal = () => {
    form.clearErrors();
    form.reset();
    show.value = false;
}

const submit = () => {
    form.post(`/transactions`, {
        preserveScroll: true,
        onSuccess: () => {
            show.value = false;
            form.reset();
            notifyBus.emit('notify', {
                title: 'Transaction Added',
                body: 'A transaction has been added to your account.',
                type: 'success'
            });
        }
    })
}

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