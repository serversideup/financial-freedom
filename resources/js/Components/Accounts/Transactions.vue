<template>
    <div>
        <div class="mb-3 md:flex md:items-center md:justify-end">
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                <button v-on:click="promptAddTransaction()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Add Transaction
                </button>
                <button v-on:click="promptFilterTransactions()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>

                    Filter Transactions
                </button>
            </span>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
            <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
                Transactions
            </div>
            <div class="overflow-x-auto overflow-y-scroll h-96 sm:-mx-6 lg:-mx-8">
                <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Tags
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-show="loading">
                                    <td colspan="7" class="text-center font-sans p-10">
                                        <img class="inline-block" src="/img/ui/loading.svg"/>
                                    </td>
                                </tr>
                                <tr v-show="!loading && transactions.length == 0">
                                    <td colspan="7" class="text-center font-sans p-10">
                                        No transactions have been entered for the filters provided.
                                    </td>
                                </tr>
                                <tr v-for="transaction in transactions"
                                    v-bind:key="'transaction-'+transaction.id"
                                    v-show="!loading && transactions.length > 0">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                        <div class="flex justify-between items-center">
                                            <span>
                                                <span class="font-medium" v-if="transaction.direction == 'outflow'">-</span>{{ formatMoney( transaction.amount ) }}
                                                USD
                                            </span>
                                            <span v-if="transaction.direction == 'outflow'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 capitalize">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                expense
                                                <span class="ml-1" v-if="transaction.receipt_url != null">🧾</span>
                                            </span>
                                            <span v-if="transaction.direction == 'inflow'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                income
                                            </span>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{ formatDate( transaction.date ) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{ transaction.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        <div v-if="!transaction.is_split">
                                            <span v-for="(tag, key) in transaction.tags"
                                                v-bind:key="'transaction-'+transaction.id+'-tag-'+key"
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                                                v-bind:class="[
                                                    'bg-'+tag.color+'-100', 'text-'+tag.color+'-800'
                                                ]">
                                                    {{ tag.name }}
                                            </span>
                                        </div>

                                        <div v-if="transaction.is_split">
                                            <span v-for="(tag, key) in getTransactionSplitTags( transaction )"
                                                v-bind:key="'transaction-'+transaction.id+'-tag-'+key"
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                                                v-bind:class="[
                                                    'bg-'+tag.color+'-100', 'text-'+tag.color+'-800'
                                                ]">
                                                    {{ tag.name }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <add-transaction
            :account="account"/>
    </div>
</template>

<script>
import { FormatMoney } from '../../Mixins/formatMoney';
import { EventBus } from '../../event-bus.js';
import CheckingAccountsAPI from '../../api/checkingAccounts.js';
import CashAccountsAPI from '../../api/cashAccounts.js';
import SavingsAccountAPI from '../../api/savingsAccounts.js';
import CreditCardsAPI from '../../api/creditCards.js';
import LoansAPI from '../../api/loans.js';
import moment from 'moment';
import AddTransaction from './AddTransaction.vue';

export default {
    props: ['account'],

    data(){
        return {
            loading: false,
            transactions: [],
            start_date: '',
            end_date: ''
        }
    },

    components: {
        AddTransaction
    },

    mounted(){
        this.setCurrentMonth();
        this.setStartDate();
        this.setEndDate();
        this.loadTransactions();
    },

    mixins: [
        FormatMoney
    ],

    methods: {
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

        loadTransactions(){
            switch( this.account.account_type ){
                case 'checking':
                    CheckingAccountsAPI.transactions( this.account.id, {
                        start_date: moment( this.currentMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                        end_date: moment( this.currentMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                    }).then( function( response ){
                        this.transactions = response.data;
                    }.bind(this));
                break;
                case 'credit-card':
                    CreditCardsAPI.transactions( this.account.id, {
                        start_date: moment( this.currentMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                        end_date: moment( this.currentMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                    }).then( function( response ){
                        this.transactions = response.data;
                    }.bind(this));
                break;
                case 'cash':
                    CashAccountsAPI.transactions( this.account.id, {
                        start_date: moment( this.currentMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                        end_date: moment( this.currentMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                    }).then( function( response ){
                        this.transactions = response.data;
                    }.bind(this));
                break;
                case 'savings':
                    SavingsAccountAPI.transactions( this.account.id, {
                        start_date: moment( this.currentMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                        end_date: moment( this.currentMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                    }).then( function( response ){
                        this.transactions = response.data;
                    }.bind(this));
                break;
                case 'loan':
                    LoansAPI.transactions( this.account.id, {
                        start_date: moment( this.currentMonth, 'MMM YYYY' ).startOf('month').format('YYYY-MM-DD'),
                        end_date: moment( this.currentMonth, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
                    }).then( function( response ){
                        this.transactions = response.data;
                    }.bind(this));
                break;
            }
        },

        formatDate( date ){
            return moment( date, 'YYYY-MM-DD' ).format('L');
        },

        promptAddTransaction(){
            EventBus.$emit('prompt-add-transaction');
        },

        promptFilterTransactions(){

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