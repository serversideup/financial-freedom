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
        <div class="flex items-center justify-between mt-5">
            <div class="flex flex-col items-center">
                <span class="relative z-0 inline-flex shadow-sm">
                    <button type="button" v-on:click="viewPreviousMonth()" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous">
                        <!-- Heroicon name: chevron-left -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button type="button" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <span class="font-sans text-astronaut-500">{{ currentMonth ? currentMonth.format('MMM YYYY') : '' }}</span>
                    </button>
                    <button type="button" v-on:click="viewNextMonth()" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                        <!-- Heroicon name: chevron-right -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            </div>

            <div class="relative rounded-md shadow-sm">
                <input id="search" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="Search...">
            </div>

            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                
            </span>
        </div>
        <div class="flex mt-5">
            <div class="flex flex-col w-full">
                <transactions-table
                    :columns="['select', 'amount', 'date', 'account', 'name', 'tags', 'edit']"
                    :buttons="['filter', 'add']">

                    <template v-slot:buttons>
                        <button type="button" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <!-- Heroicon name: download -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span class="ml-1">Download</span>
                        </button>

                        <button type="button" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <!-- Heroicon name: refresh -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span class="ml-1">Sync</span>
                        </button>

                        <inertia-link :href="'/transactions/import'" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <!-- Heroicon name: folder -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="ml-1">Import</span>
                        </inertia-link>
                    </template>
                </transactions-table>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import TotalSpent from './Index/TotalSpent';
    import TotalIncome from './Index/TotalIncome';
    import TransactionsAPI from '../../api/transactions.js';
    import { FormatMoney } from '../../Mixins/formatMoney';
    import { EventBus } from '../../event-bus';
    import { mapState } from 'vuex';
    import moment from 'moment';
    import TransactionsTable from '../../Components/Transactions/TransactionsTable';

    export default {
        components: {
            AppLayout,
            TotalSpent,
            TotalIncome,
            TransactionsTable
        },

        mixins: [
            FormatMoney
        ],

        data(){
            return {
                currentMonth: '',
                startDate: null,
                endDate: null,
                selectedTransactions: []
            }
        },

        computed: {
            ...mapState('transactions', {
                transactions: state => state.transactions,
                loading: state => state.loading
            }),

            dateRange(){
                if( this.startDate && this.endDate ){
                    return moment( this.startDate ).format('LL')+' - '+moment( this.endDate ).format('LL');
                }else{
                    return '';
                }
            }
        },

        mounted(){
            this.initialize();
            this.bindEvents();
        },

        methods: {
            initialize(){
                this.setCurrentMonth();
                this.setStartDate();
                this.setEndDate();
                this.loadTransactions();
            },

            bindEvents(){
                EventBus.$on('load-transactions', function(){

                }.bind(this));
            },

            setCurrentMonth(){
                this.currentMonth = moment();
            },

            setStartDate( date = null ){
                if( date ){
                    this.startDate = moment( date );
                }else{
                    this.startDate = moment( this.currentMonth, 'MMM YYYY' ).startOf('month');
                }
            },

            setEndDate( date = null ){
                if( date ){
                    this.endDate = moment( date );
                }else{
                    this.endDate = moment( this.currentMonth, 'MMM YYYY' ).endOf('month');
                }
            },

            promptAddTransaction(){
                EventBus.$emit('prompt-add-transaction');
            },

            formatDate( date ){
                return moment( date, 'YYYY-MM-DD' ).format('L');
            },

            viewPreviousMonth(){
                let previousMonth = moment( this.currentMonth ).subtract(1, 'month');
                this.$store.commit( 'transactions/setLoading', true );

                TransactionsAPI.index( {
                    start_date: moment( previousMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                    end_date: moment( previousMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                }).then( function( response ){
                    this.currentMonth = moment( previousMonth );
                    this.startDate = moment( this.currentMonth, 'MMM YYYY').startOf('month').format('YYYY-MM-DD');
                    this.endDate = moment( this.currentMonth, 'MMM YYYY').endOf('month').format('YYYY-MM-DD');

                    this.$store.commit( 'transactions/setTransactions', response.data );
                    this.$store.commit( 'transactions/setLoading', false );
                }.bind(this));
            },

            viewNextMonth(){
                let nextMonth = moment( this.currentMonth ).add(1, 'month');
                this.$store.commit( 'transactions/setLoading', true );

                TransactionsAPI.index( {
                    start_date: moment( nextMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                    end_date: moment( nextMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                }).then( function( response ){
                    this.currentMonth = moment( nextMonth );
                    this.startDate = moment( this.currentMonth, 'MMM YYYY').startOf('month').format('YYYY-MM-DD');
                    this.endDate = moment( this.currentMonth, 'MMM YYYY').endOf('month').format('YYYY-MM-DD');
                    
                    this.$store.commit( 'transactions/setTransactions', response.data );
                    this.$store.commit( 'transactions/setLoading', false );
                }.bind(this));
            },

            loadTransactions(){
                this.$store.commit( 'transactions/setLoading', true );

                TransactionsAPI.index( {
                    start_date: moment( this.currentMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                    end_date: moment( this.currentMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                }).then( function( response ){
                    this.$store.commit( 'transactions/setTransactions', response.data );
                    this.$store.commit( 'transactions/setLoading', false );
                }.bind(this));
            },

            getTransactionSplitTags( transaction ){
                let tags = [];

                transaction.splits.forEach( function( split ){
                    split.tags.forEach( function( tag ){
                        tags.push( tag );
                    } );
                } );

                return tags;
            }
        }
    }
</script>
