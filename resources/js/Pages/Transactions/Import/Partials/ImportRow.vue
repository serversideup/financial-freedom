<template>
    <tr class="border-b border-[#1F242F]"
        v-show="!filters.matched && form.transactions[transactionIndex].matched_rule ? false : true"
        :class="{
            'bg-gray-50/10': form.transactions[transactionIndex].matched_rule
        }">
        <td class="py-4 pl-4 sm:pl-6">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6">
                    <button @click="removeTransaction( transactionIndex )">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 9L9 15M9 9L15 15M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="w-6 h-6">
                    <button v-show="form.transactions[transactionIndex].potential_duplicate" v-on:click="viewDuplicate( transactionIndex )" class="cursor-pointer">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9998 8.99999V13M11.9998 17H12.0098M10.6151 3.89171L2.39019 18.0983C1.93398 18.8863 1.70588 19.2803 1.73959 19.6037C1.769 19.8857 1.91677 20.142 2.14613 20.3088C2.40908 20.5 2.86435 20.5 3.77487 20.5H20.2246C21.1352 20.5 21.5904 20.5 21.8534 20.3088C22.0827 20.142 22.2305 19.8857 22.2599 19.6037C22.2936 19.2803 22.0655 18.8863 21.6093 18.0983L13.3844 3.89171C12.9299 3.10654 12.7026 2.71396 12.4061 2.58211C12.1474 2.4671 11.8521 2.4671 11.5935 2.58211C11.2969 2.71396 11.0696 3.10655 10.6151 3.89171Z" stroke="#FFAB08" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </td>
        <td class="py-4 px-2">
            <select v-model="form.transactions[transactionIndex].direction" class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 pl-3 pr-4">
                <option value=""></option>
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
                <option value="transfer">Transfer</option>
                <option value="payment">Payment</option>
            </select>
        </td>
        <td class="py-4 px-2">
            <Combobox v-model="form.transactions[transactionIndex].category">
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
        </td>
        <td class="py-4 px-2">
            <TextInput type="text" class="block font-sans text-base" v-model="form.transactions[transactionIndex].name"/>
        </td>
        <td class="py-4 px-2">
            <span :class="form.transactions[transactionIndex].direction == 'credit' ? 'text-green-500' : 'text-red-500'">{{ form.transactions[transactionIndex].amount }}</span>
        </td>
        <td class="py-4 px-2">
            <span class="text-[#CECFD2]">{{ form.transactions[transactionIndex].date }}</span>
        </td>
        <td class="py-4 px-2">

        </td>
    </tr>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import { usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
import { 
    computed, 
    ref
} from 'vue';

import { 
    useImportTransactions 
} from '@/Composables/useImportTransactions';

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

const {
    getCategoryColor
} = useCategoryColor();

const props = defineProps({
    transactionIndex: Number
});

const promptBus = useEventBus('ff-prompt-event-bus')

const categoryQuery = ref('');

const groups = computed(() => usePage().props.groups);
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

const { 
    filters,
    form,
    removeTransaction
} = useImportTransactions();

const viewDuplicate = (transactionIndex) => {
    promptBus.emit('prompt-check-duplicate', transactionIndex);
}
</script>