<template>
    <app-layout>
        <div v-if="loaded">
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 flex items-center w-full sm:text-3xl sm:leading-9 sm:truncate">
                        <img :src="creditCard.institution.logo" class="h-8 w-8 mr-2 rounded-full"/> {{ creditCard.name }}
                    </h2>
                </div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    <button class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>

                        Add Transaction
                    </button>
                    <button v-on:click="promptEdit()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-3 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>

                        Edit Account
                    </button>
                </span>
            </div>
        </div>
        <div class="mt-5" v-if="loaded">
            <stats
                :account="creditCard"
                :type="'credit-card'"
                :fields="[
                    'current_balance',
                    'amount_changed',
                    'transactions_changed'
                ]"/>

            <div class="grid grid-cols-2 gap-4 mt-5">
                <transactions-table
                    :account="creditCard"
                    :columns="['amount', 'date', 'name', 'category']"
                    :buttons="['filter', 'add']"/>
            </div>
        </div>

        <edit/>
    </app-layout>
</template>

<script>
    import CreditCardsAPI from '../../api/creditCards.js';
    import AppLayout from './../../Layouts/AppLayout'
    import { EventBus } from '../../event-bus.js';
    import Edit from '../../Components/Accounts/CreditCard/Edit.vue';
    import Stats from '../../Components/Accounts/Stats.vue';
    import TransactionsTable from '../../Components/Transactions/TransactionsTable.vue';

    export default {
        props: ['id'],

        data(){
            return {
                loaded: false,
                creditCard: {}
            }
        },

        components: {
            AppLayout,
            Edit,
            Stats,
            TransactionsTable
        },

        mounted(){
            this.bindEvents();
            this.loadCreditCard();
        },

        methods: {
            bindEvents(){
                EventBus.on('credit-card-updated', function(){
                    this.loadCreditCard();
                }.bind(this) );
            },

            promptEdit(){
                EventBus.emit('prompt-edit-account', this.creditCard);
            },

            loadCreditCard(){
                CreditCardsAPI.show( this.id )
                    .then( function( response ){
                        this.creditCard = response.data;
                        this.loaded = true;
                    }.bind(this) );
            }
        }
    }
</script>