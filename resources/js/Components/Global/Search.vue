<template>
    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
            </svg>
        </div>
        <input id="search_field" 
               v-model="term" 
               class="block border-0 w-full h-full pl-8 pr-3 py-2 rounded-md text-gray-900 placeholder-gray-500 outline-none focus:ring-0 focus:placeholder-gray-400 focus:shadow-none sm:text-sm" 
               placeholder="Search" 
               type="search"
               @keyup="search"/>

        <div class="absolute max-w-lg bg-white shadow-md w-full rounded-b-lg flex flex-col max-h-80 overflow-y-scroll">
            <div v-if="results.transactions.length > 0"
                 class="flex flex-col w-full">
                    <span class="p-2 text-gray-500 text-xs uppercase bg-gray-50 border-t border-b border-gray-200">Transactions</span>
                    <transaction-result v-for="(transaction, index) in results.transactions"
                        :key="'transaction-search-result-'+index"
                        :transaction="transaction"/>

            </div>
        </div>
    </div>
</template>

<script>
const debounce = require('lodash.debounce')
import SearchAPI from '@/api/search.js';
import TransactionResult from './Search/TransactionResult.vue';

export default {
    data(){
        return {
            term: '',
            results: {
                transactions: [],
                cashAccounts: [],
                creditCards: [],
                loans: [],
                checkingAccounts: [],
                savingsAccounts: []
            }
        }
    },

    components: {
        TransactionResult
    },

    methods: {
        search: debounce( async function( e ){
            const noSearchKeys = ['ArrowDown', 'ArrowUp', 'Enter'];

            if( !noSearchKeys.includes( e.key ) && this.term.length >=3 ){
                SearchAPI.index(this.term)
                        .then( function( response ){
                            this.results = response.data;
                        }.bind(this));
            }
        }, 300 )
    }
}
</script>