<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-xl border border-[#1F242F]">
                    <table class="min-w-full divide-y divide-[#1F242F]">
                        <thead class="bg-[#161B26]">
                            <tr>
                                <th scope="col" class="py-2 pl-4 pr-3 text-left text-xs font-medium text-[#94969C] sm:pl-6">Type</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Category</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Merchant</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Amount</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">Date</th>
                                <th scope="col" class="relative py-2 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <ImportRow v-for="(transaction, index) in transactions" 
                                :key="index" 
                                :transaction="transaction"/>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useImportTransactions } from '@/Composables/useImportTransactions';
import ImportRow from './ImportRow.vue';

const { account, transactions } = useImportTransactions();


</script>