<template>
    <div>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-4 mt-5">
                <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" v-if="account.institution" :src="account.institution.logo" alt="" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="#" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true" />
                            <p class="text-sm font-medium text-gray-900">
                                {{ account.name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ account.description }}
                            </p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-4 mt-5">
                <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                    <div class="flex-1 min-w-0">
                        <a href="#" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true" />
                            <p class="text-sm font-medium text-gray-900">
                                New Account Balance
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                $300.00
                            </p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-2 mt-5">
                <div class="overflow-hidden mt-1 flex flex-col items-center justify-center">
                    <button type="button" v-on:click="addTransactionRule()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add Rule
                    </button>
                </div>
            </div>

            <div class="col-span-2 mt-5">
                <div class="overflow-hidden mt-1 flex flex-col items-center justify-center">
                    <div class="w-full flex items-center justify-center mb-1">
                        <input type="checkbox" value="yes" v-model="accountBalanceSync" class="mr-1"/> Sync account balance
                    </div>
                    <button type="button" v-on:click="importTransactions()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Import
                    </button>
                </div>
            </div>

            <div class="col-span-12 mt-5">
                <div class="flex flex-col shadow">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-3 py-3">

                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Direction
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-xs">
                                                Category
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr colspan="8" v-if="loading" class="p-6 text-center">
                                            Loading...
                                        </tr>
                                        <import-row
                                            v-for="(transaction, key) in pendingTransactions"
                                            v-bind:key="'transaction-'+key"
                                            :index="key"
                                            :transaction="transaction"
                                            :categories="categories"
                                            :sync-balances="accountBalanceSync"/>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Papa from 'papaparse';
    import moment from 'moment';

    import { EventBus } from '@/event-bus.js';
    import { mapState } from 'vuex';
    import { FormatCSVImport } from '@/Mixins/formatCSVImport.js';
    
    import TransactionsAPI from '@/api/transactions.js';
    // import Tags from '../../../../Components/Transactions/Tags.vue';
    import ImportRow from './ImportRow.vue';

    export default {
        props: ['categories', 'rules'],

        data(){
            return {
                loading: false,
                pendingTransactions: [],
                startDate: moment(),
                endDate: 0,
                accountBalanceSync: false
            }
        },

        computed: {
            ...mapState('transactions/importProcess', {
                transactions: state => state.transactions,
                account: state => state.account
            })
        },

        components: {
            ImportRow
        },

        mixins: [
            FormatCSVImport
        ],

        watch: {
            transactions(){
                this.loadTransactions();
            }
        },

        mounted(){
            EventBus.on('remove-transaction', function( key ){
                this.pendingTransactions.splice( key, 1 );
            }.bind(this));

            EventBus.on('transaction-persisted', function( key ){
                this.pendingTransactions[key].imported = true;
            }.bind(this) );

            EventBus.on('new-rule-added', function( rule ){
                this.applyNewRule( rule );
            }.bind(this));
        },

        methods: {
            loadTransactions(){
                this.loading = true;
                Papa.parse(this.transactions, {
                    header: true,
                    skipEmptyLines: true,
                    complete: function(results) {
                        this.formatCSVImport( results.data );
                        this.checkForDuplicates();
                        this.loading = false;
                    }.bind(this)
                });
            },

            importTransactions(){
                TransactionsAPI.import( this.account, this.pendingTransactions )
                    .then(function( response ){
                        this.$inertia.visit('/transactions');
                    }.bind(this));
            },

            checkForDuplicates(){
                this.findStartAndEndDates();
                this.loadPotentialTransactions();
            },

            findStartAndEndDates(){
                for( let i = 0; i < this.pendingTransactions.length; i++ ){
                    let transactionDate = moment( this.pendingTransactions[i].date );

                    if( transactionDate.format('X') < moment( this.startDate ).format('X') ){
                        this.startDate = moment( this.pendingTransactions[i].date );
                    }

                    if( transactionDate.format('X') > moment( this.endDate ).format('X') ){
                        this.endDate = moment( this.pendingTransactions[i].date );
                    }
                }
            },

            loadPotentialTransactions(){
                let params = {};

                params.start_date = moment( this.startDate ).format('YYYY-MM-DD');
                params.end_date = moment( this.endDate ).format('YYYY-MM-DD');

                TransactionsAPI.index( params )
                    .then( function( response ){
                        this.compareTransactions( response.data );
                    }.bind(this));
            },

            compareTransactions( existingTransactions ){
                for( let i = 0; i < this.pendingTransactions.length; i++ ){
                    for( let k = 0; k < existingTransactions.length; k++ ){
                        if( this.validateUnique( this.pendingTransactions[i], existingTransactions[k] ) ){
                            this.pendingTransactions[i].potential_duplicate = existingTransactions[k];
                            break;
                        }
                    }
                }
            },

            validateUnique( transaction, existingTransaction ){
                if( ( moment( transaction.date ).format('YYYY-MM-DD') 
                    == moment( existingTransaction.date ).format( 'YYYY-MM-DD') )
                    && ( Math.abs( parseFloat( transaction.amount ) ) == existingTransaction.amount ) ){
                        return true;
                }else{
                    return false;
                }
            },

            addTransactionRule(){
                console.log('asdf');
                EventBus.emit('prompt-add-rule');
            },

            applyNewRule( rule ){
                this.pendingTransactions.forEach( function( transaction, index ){
                    if( transaction.name.search( rule.find ) > -1 ){
                        transaction.name = rule.replace;
                        transaction.category = rule.category ? rule.category : '';
                    }
                });
            }
        }
    }
</script>