<template>
    <div>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-9 mt-5">
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
                                                Name
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Description
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-md">
                                                Category
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Direction
                                            </th>
                                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="( pendingTransaction, key ) in pendingTransactions"
                                            v-bind:class="{
                                                'bg-white': key % 2 == 0,
                                                'bg-gray-50': key % 2 == 1
                                            }"
                                            v-bind:key="'pending-transaction-'+key">
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex items-center justify-between h-10">
                                                        <input type="checkbox" v-model="pendingTransactions[key].import"/>
                                                        <span v-if="pendingTransactions[key].potential_duplicate != null" v-on:click="viewDuplicate( pendingTransactions[key], key )" class="ml-1 cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <input class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" v-model="pendingTransactions[key].name"/>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <input class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" v-model="pendingTransactions[key].description"/>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 max-w-md">
                                                    <category-select v-model="pendingTransactions[key].category"/>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">
                                                    <span v-bind:class="{
                                                            'text-red-800' : pendingTransaction.direction == 'outflow',
                                                            'text-green-800' : pendingTransaction.direction == 'inflow'
                                                        }">
                                                            {{ pendingTransaction.amount }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <select id="type" v-model="pendingTransactions[key].direction" v-on:change="invertAmount( key )" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                        <option value=""></option>
                                                        <option value="inflow">Inflow</option>
                                                        <option value="outflow">Outflow</option>
                                                    </select>
                                                </td>
                                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ pendingTransaction.date }}
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-3 mt-5">
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

                <dl class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">
                            New Account Balance
                        </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                            <!-- <div class="flex items-baseline text-2xl font-semibold text-blue-600">
                                {{ item.stat }}
                                <span class="ml-2 text-sm font-medium text-gray-500"> from {{ item.previousStat }} </span>
                            </div>

                            <div :class="[item.changeType === 'increase' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800', 'inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium md:mt-2 lg:mt-0']">
                                <ArrowSmUpIcon v-if="item.changeType === 'increase'" class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500" aria-hidden="true" />
                                <ArrowSmDownIcon v-else class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-red-500" aria-hidden="true" />
                                <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>
                                {{ item.change }}
                            </div> -->
                        </dd>
                    </div>
                </dl>



                <div class="overflow-hidden mt-5 max-w-md mx-auto">
                    <div class="px-4 py-5 sm:p-6 flex items-center justify-center">
                        <button type="button" v-on:click="importTransactions()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Import
                        </button>
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
    import { USBankChecking } from '@/Mixins/imports/usbank/checking.js';
    
    import TransactionsAPI from '@/api/transactions.js';
    import CategorySelect from '@/Components/Global/CategorySelect';
    // import Tags from '../../../../Components/Transactions/Tags.vue';

    export default {
        data(){
            return {
                loading: false,
                pendingTransactions: [],
                startDate: moment(),
                endDate: 0
            }
        },

        components: {
            CategorySelect
        },

        computed: {
            ...mapState('transactions/importProcess', {
                transactions: state => state.transactions,
                account: state => state.account
            })
        },

        mixins: [
            USBankChecking
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
        },

        methods: {
            loadTransactions(){
                // @todo check for duplicates
                Papa.parse(this.transactions, {
                    header: true,
                    skipEmptyLines: true,
                    complete: function(results) {
                        this.formatTransactions( results.data );
                        this.checkForDuplicates();
                    }.bind(this)
                });
            },

            invertAmount( key ){
                if( this.pendingTransactions[key].direction == 'outflow' ){
                    this.pendingTransactions[key].amount = parseFloat( Math.abs( this.pendingTransactions[key].amount ) * -1 ).toFixed(2);
                }else{
                    this.pendingTransactions[key].amount = parseFloat( Math.abs( this.pendingTransactions[key].amount ) ).toFixed(2);
                }
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

            viewDuplicate( transaction, key ){
                EventBus.emit( 'view-potential-duplicate', {
                    transaction: transaction,
                    key: key
                 } );
            }
        }
    }
</script>