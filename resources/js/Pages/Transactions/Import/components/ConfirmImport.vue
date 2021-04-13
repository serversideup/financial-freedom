<template>
    <div>
        <div class="flex flex-col mt-5 shadow">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-md">
                                        Tags
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Direction
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input type="checkbox" v-model="pendingTransactions[key].import"/>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <input class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"  v-model="pendingTransactions[key].name"/>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"  v-model="pendingTransactions[key].description"/>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-md">
                                            <tags
                                                :unique="'pending-transaction-'+key+'-tag'"
                                                :existing="pendingTransactions[key].tags"/>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">
                                            <span v-bind:class="{
                                                    'text-red-800' : pendingTransaction.direction == 'outflow',
                                                    'text-green-800' : pendingTransaction.direction == 'inflow'
                                                }">
                                                    {{ pendingTransaction.amount }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <select id="type" v-model="pendingTransactions[key].direction" v-on:change="invertAmount( key )" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                <option value=""></option>
                                                <option value="inflow">Inflow</option>
                                                <option value="outflow">Outflow</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ pendingTransaction.date }}
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-hidden mt-5 max-w-md mx-auto">
            <div class="px-4 py-5 sm:p-6 flex items-center justify-center">
                <button type="button" v-on:click="importTransactions()" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Import
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import Papa from 'papaparse';
    import { mapState } from 'vuex';
    import { USBankChecking } from '../../../../Mixins/imports/usbank/checking.js';

    import TransactionsAPI from '../../../../api/transactions.js';
    import Tags from '../../../../Components/Transactions/Tags.vue';

    export default {
        data(){
            return {
                loading: false,
                pendingTransactions: []
            }
        },

        components: {
            Tags
        },

        computed: {
            ...mapState('transactionsImport', {
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

        methods: {
            loadTransactions(){
                Papa.parse(this.transactions, {
                    header: true,
                    skipEmptyLines: true,
                    complete: function(results) {
                        this.formatTransactions( results.data );
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
            }
        }
    }
</script>