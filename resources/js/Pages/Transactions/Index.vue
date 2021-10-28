<template>
    <app-layout>
        <div>
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Transactions
                    </h2>
                </div>
            </div>
        </div>

        <h3 class="text-lg leading-4 font-medium text-gray-900 mt-5">
            {{ dateRange }}
        </h3>

        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <total-spent/>

            <total-income/>
        </dl>

        <div class="flex mt-5">
            <div class="flex flex-col w-full">
                <transactions-table
                    :columns="['select', 'amount', 'date', 'account', 'name', 'category', 'edit']"
                    :buttons="['filter', 'add']"
                    :allow-searching="true"
                    :categories="categories">

                    <template v-slot:buttons>
                        <button type="button" v-on:click="download()" class="relative inline-flex items-center px-4 py-3 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <!-- Heroicon name: download -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span class="ml-1">Download</span>
                        </button>

                        <button type="button" class="-ml-px relative inline-flex items-center px-4 py-3 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <!-- Heroicon name: refresh -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span class="ml-1">Sync</span>
                        </button>

                        <Link :href="'/transactions/import'" class="-ml-px relative inline-flex items-center px-4 py-3 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <!-- Heroicon name: folder -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="ml-1">Import</span>
                        </Link>
                    </template>
                </transactions-table>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { FormatMoney } from '../../Mixins/formatMoney';
    import { mapState } from 'vuex';
    import { Link } from '@inertiajs/inertia-vue3';
    import AppLayout from './../../Layouts/AppLayout'
    import TotalSpent from './Index/TotalSpent';
    import TotalIncome from './Index/TotalIncome';
    import moment from 'moment';
    import TransactionsTable from '../../Components/Transactions/TransactionsTable';
    

    export default {
        props: ['categories'],

        components: {
            AppLayout,
            TotalSpent,
            TotalIncome,
            TransactionsTable,
            Link
        },

        mixins: [
            FormatMoney
        ],

        computed: {
            ...mapState('transactions/table', {
                transactions: state => state.transactions,
                startDate: state => state.startDate,
                endDate: state => state.endDate
            }),

            dateRange(){
                if( this.startDate && this.endDate ){
                    return moment( this.startDate ).format('LL')+' - '+moment( this.endDate ).format('LL');
                }else{
                    return '';
                }
            }
        },

        methods: {
            download(){
                
            }
        }
    }
</script>
