<template>
    <tr class="border-b border-[#1F242F]">
        <td class="py-4 pl-4 sm:pl-6">
            
        </td>
        <td class="py-4 px-2">
            <select v-model="form.transactions[transactionIndex].direction" class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 pl-3 pr-4">
                <option value=""></option>
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
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

const { form } = useImportTransactions();
</script>