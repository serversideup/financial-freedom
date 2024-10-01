<template>
    <div class="rounded-xl flex flex-col border border-[#1F242F]">
        <div class="p-4 flex items-center justify-between border-b border-[#1F242F]">
            <span class="text-[#F5F5F6] font-medium text-xl font-sans">Recent Transactions</span>
        </div>
        <div class="flex flex-col w-full">
            <table class="w-full">
                <tbody>
                    <template v-for="(transactions, date) in groupedTransactions">
                        <tr class="bg-[#1F242F] text-[#ECECED] border-b border-[#1F242F]">
                            <td class="font-sans text-xs font-semibold text-[#94969C] pl-6 py-3" :colspan="4">
                                {{ formatDate( date ) }}
                            </td>
                        </tr>
                        <tr v-for="(transaction, transactionIndex) in transactions" 
                            :key="'transaction-'+transaction.id" class="border-b border-[#1F242F]">
                                <td class="pl-6 py-4 text-[#F5F5F6] font-sans text-sm">{{ transaction.merchant }}</td>
                                <td class="py-4 text-[#F5F5F6] font-sans text-sm">{{ currency.format( transaction.amount ) }}</td>
                                <td class="py-4 font-sans text-sm text-[#F5F5F6] font-medium">
                                    <span class="text-xs font-sans font-medium leading-[18px] px-[6px] py-[2px] inline-flex items-center border border-[#333741] rounded-md">
                                        <span :style="{ backgroundColor: getCategoryColor(transaction.category.group.color) }" class="w-2 h-2 rounded-full mr-1"></span>
                                        {{ transaction.category.name }}
                                    </span>
                                </td>
                                <td class="py-4 text-[#F5F5F6] font-sans text-sm">
                                    <Link :href="'/transactions/'+transaction.id" class="text-[#155EEF] font-medium">
                                        View
                                    </Link>
                                </td>
                        </tr>
                    </template>
                    
                    <tr v-if="transactions.data.length == 0">
                        <td colspan="4">
                            <div class="py-12 flex flex-col items-center justify-center">
                                <div class="flex items-center justify-center w-12 h-12 rounded-[10px] border border-[#333741]">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 10.9999L10.6422 15.8211C10.7734 15.8866 10.839 15.9194 10.9078 15.9324C10.9687 15.9438 11.0313 15.9438 11.0922 15.9324C11.161 15.9194 11.2266 15.8866 11.3578 15.8211L21 10.9999M1 15.9999L10.6422 20.8211C10.7734 20.8866 10.839 20.9194 10.9078 20.9324C10.9687 20.9438 11.0313 20.9438 11.0922 20.9324C11.161 20.9194 11.2266 20.8866 11.3578 20.8211L21 15.9999M1 5.99994L10.6422 1.17883C10.7734 1.11324 10.839 1.08044 10.9078 1.06753C10.9687 1.0561 11.0313 1.0561 11.0922 1.06753C11.161 1.08044 11.2266 1.11324 11.3578 1.17883L21 5.99994L11.3578 10.8211C11.2266 10.8866 11.161 10.9194 11.0922 10.9324C11.0313 10.9438 10.9687 10.9438 10.9078 10.9324C10.839 10.9194 10.7734 10.8866 10.6422 10.8211L1 5.99994Z" stroke="#CECFD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>

                                <span class="text-[#F5F5F6] font-sans font-semibold text-base mt-4">No transactions found</span>
                                <span class="mt-1 font-sans text-[#94969C] text-sm">Import or add transactions before you can view data.</span>

                                <div class="flex items-center justify-center space-x-3 mt-6">
                                    <Link href="/transactions/import" class="rounded-lg shadow-sm px-[14px] py-[10px] flex items-center text-semibold text-[#CECFD2] font-semibold border border-[#333741]">
                                        <div class="w-[20px] h-[20px] mr-1 flex items-center justify-center">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M17 8L12 3M12 3L7 8M12 3V15" stroke="#CECFD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        
                                        Import
                                    </Link>
                                    <button @click="promptAddTransaction" class="px-[14px] py-[10px] rounded-lg bg-[#155EEF] flex items-center text-[#F5F5F6] font-semibold">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-[6px]">
                                            <path d="M7.00033 1.16669V12.8334M1.16699 7.00002H12.8337" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Add Transaction
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="py-[14px] px-4">
                            <div class="w-full flex items-center justify-between">
                                <Link :href="transactions.prev_page_url ? transactions.prev_page_url : '#'" class="text-sm inline-flex items-center px-3 py-2 rounded-lg border border-[#333741] font-sans font-semibold text-[#CECFD2] bg-[#161B26]">
                                    <div class="w-5 h-5 flex items-center justify-center mr-1">
                                        <ArrowLeftIcon/>
                                    </div>
                                    
                                    Previous
                                </Link>

                                <div class="flex items-center">
                                    <Link
                                        v-for="link in paginationNumbers" 
                                        :href="link.url"
                                        v-text="link.label"
                                        class="w-8 h-8 flex items-center justify-center font-sans text-sm font-medium hover:text-[#ECECED]"
                                        :class="link.active 
                                            ? 'text-[#ECECED] bg-[#1F242F] rounded-lg' 
                                            : 'text-[#94969C]'">
                                    </Link>
                                </div>
                                

                                <Link :href="transactions.next_page_url ? transactions.next_page_url : '#'" class="text-sm inline-flex items-center px-3 py-2 rounded-lg border border-[#333741] font-sans font-semibold text-[#CECFD2] bg-[#161B26]">
                                    Next
                                    
                                    <div class="w-5 h-5 flex items-center justify-center ml-1">
                                        <ArrowRightIcon/>
                                    </div>
                                </Link>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script setup>
import ArrowLeftIcon from '@/Components/Icons/LeftArrowIcon.vue';
import ArrowRightIcon from '@/Components/Icons/RightArrowIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useFormatters } from '@/Composables/useFormatters';
import { 
    useCategoryColor 
} from '@/Composables/useCategoryColor.js';
import moment from 'moment';

const { currency } = useFormatters();

const {
    getCategoryColor
} = useCategoryColor();

const transactions = computed(() => usePage().props.transactions);

const groupedTransactions = computed(() => {
    return transactions.value.data.reduce((acc, transaction) => {
        if ( !acc[transaction.date] ) {
            acc[transaction.date] = [];
        }

        acc[transaction.date].push(transaction);

        return acc;
    }, {});
});

const paginationNumbers = computed(() => {
    return transactions.value.links 
        ? transactions.value.links.splice(1, transactions.value.links.length - 2) 
        : [];
});

const formatDate = (date) => {
    return moment(date).format('dddd, MMMM Do YYYY');
}
</script>