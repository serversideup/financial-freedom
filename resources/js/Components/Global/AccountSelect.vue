<template>
    <Listbox as="div" v-model="selected" class="relative">
        <ListboxButton class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default mt-1 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <span class="flex items-center">
                <img v-if="selected.institution" :src="selected.institution.logo" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
                <span class="block truncate ml-3" v-if="selected != ''">{{ selected.name }}</span>
                <span class="block truncate text-gray-500" v-if="selected == ''">N/A</span>
            </span>
            <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </span>
        </ListboxButton>

        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                <ListboxOption as="template"
                    :disabled="true">
                        <li class="text-gray-900 cursor-default select-none relative py-2 pl-1 pr-9">
                            <span class="ml-3 block font-semibold truncate">Credit Cards</span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template" 
                    v-for="account in accounts.credit_cards" 
                    :key="account.id" 
                    :value="account" 
                    v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-blue-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                            <div class="flex items-center">
                                <img v-if="account.institution" :src="account.institution.logo" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                    {{ account.name }}
                                </span>
                            </div>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-blue-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template"
                    :disabled="true">
                        <li class="text-gray-900 cursor-default select-none relative py-2 pl-1 pr-9">
                            <span class="ml-3 block font-semibold truncate">Checking Accounts</span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template" 
                    v-for="account in accounts.checking_accounts" 
                    :key="account.id" 
                    :value="account" 
                    v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-blue-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                            <div class="flex items-center">
                                <img v-if="account.institution" :src="account.institution.logo" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                    {{ account.name }}
                                </span>
                            </div>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-blue-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template"
                    :disabled="true">
                        <li class="text-gray-900 cursor-default select-none relative py-2 pl-1 pr-9">
                            <span class="ml-3 block font-semibold truncate">Savings Accounts</span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template" 
                    v-for="account in accounts.savings_accounts" 
                    :key="account.id" 
                    :value="account" 
                    v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-blue-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                            <div class="flex items-center">
                                <img v-if="account.institution" :src="account.institution.logo" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                    {{ account.name }}
                                </span>
                            </div>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-blue-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template"
                    :disabled="true">
                        <li class="text-gray-900 cursor-default select-none relative py-2 pl-1 pr-9">
                            <span class="ml-3 block font-semibold truncate">Cash Accounts</span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template" 
                    v-for="account in accounts.cash_accounts" 
                    :key="account.id" 
                    :value="account" 
                    v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-blue-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                            <div class="flex items-center">
                                <img v-if="account.institution" :src="account.institution.logo" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                    {{ account.name }}
                                </span>
                            </div>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-blue-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template"
                    :disabled="true">
                        <li class="text-gray-900 cursor-default select-none relative py-2 pl-1 pr-9">
                            <span class="ml-3 block font-semibold truncate">Loans</span>
                        </li>
                </ListboxOption>

                <ListboxOption as="template" 
                    v-for="account in accounts.loans" 
                    :key="account.id" 
                    :value="account" 
                    v-slot="{ active, selected }">
                        <li :class="[active ? 'text-white bg-blue-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                            <div class="flex items-center">
                                <img v-if="account.institution" :src="account.institution.logo" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" />
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                    {{ account.name }}
                                </span>
                            </div>

                            <span v-if="selected" :class="[active ? 'text-white' : 'text-blue-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                </ListboxOption>
            </ListboxOptions>
        </transition>
    </Listbox>
</template>

<script>
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'


export default {
    props: [
        'accounts'
    ],

    data(){
        return {
            selected: '',
        }
    },

    mounted(){
        
    },

    methods: {

    },

    components: {
        Listbox,
        ListboxButton,
        ListboxLabel,
        ListboxOption,
        ListboxOptions,
        CheckIcon,
        SelectorIcon,
    }
}
</script>