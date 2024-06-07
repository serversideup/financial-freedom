<template>
    <div class="flex items-center justify-end">
        <span class="isolate inline-flex rounded-md shadow-sm">
            <button type="button" @click="filters.matched = !filters.matched" class="relative inline-flex items-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold text-[#CECFD2] border border-[#333741] focus:z-10"
            :class="{
                'bg-gray-50/10': !filters.matched
            }">
                <EyeIcon v-show="filters.matched" class="-ml-0.5 h-5 w-5 text-[#CECFD2]" aria-hidden="true" />
                <EyeSlashIcon v-show="!filters.matched" class="-ml-0.5 h-5 w-5 text-[#CECFD2]" aria-hidden="true" />
                <span v-show="!filters.matched">Show transactions that match rule</span>
                <span v-show="filters.matched">Hide transactions that match rule</span>
            </button>
        </span>
    </div>
    
    <div class="px-4 sm:px-6 lg:px-8 pb-32">
        <div class="-mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-xl border border-[#1F242F]">
                    <table class="min-w-full divide-y divide-[#1F242F]">
                        <thead class="bg-[#161B26]">
                            <tr>
                                <th scope="col" class="py-2 pl-4 pr-3 text-left text-xs font-medium text-[#94969C] sm:pl-6"></th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Type</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Category</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Name</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Amount</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Date</th>
                                <th scope="col" class="relative py-2 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <ImportRow 
                                v-for="(transaction, transactionIndex) in form.transactions" 
                                :key="transactionIndex" 
                                :transaction-index="transactionIndex"/>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ImportRow from './ImportRow.vue';
import { 
    useImportTransactions 
} from '@/Composables/useImportTransactions';
import {
    EyeIcon,
    EyeSlashIcon
} from '@heroicons/vue/20/solid';

const { 
    filters,
    form 
} = useImportTransactions();


</script>