<template>
    <app-layout>
        <div class="mx-auto max-w-screen-md mb-5" v-if="transactionLoaded">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="#" class="text-gray-400 hover:text-gray-500">
                                <!-- Heroicon name: home -->
                                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <span class="sr-only">Home</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Transactions</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <a href="#" aria-current="page" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ transaction.name }} {{ formatDate( transaction.date ) }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div v-if="transactionLoaded">
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="max-w-screen-md mx-auto w-full flex justify-between">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        <img class="inline-block mr-2 rounded-full w-10 h-10" :src="transaction.accountable.institution.logo"/>
                        {{ transaction.accountable.institution.name }}: {{ transaction.accountable.name }}
                    </h2>
                    <div class="text-2xl leading-7 sm:text-3xl sm:leading-9 sm:truncate">
                        <span v-if="transaction.direction == 'outflow'">-</span>{{ formatMoney( transaction.amount ) }}
                    </div>
                </div>
            </div>
        </div>

        <breakdown
            :transaction="transaction"
            :categories="categories"
            v-if="transactionLoaded"/>
        
        <splits-table
            :transaction="transaction"
            v-show="transaction.direction == 'outflow'"
            v-if="transactionLoaded"/>

        <split-modal
            :transaction="transaction"
            v-if="transactionLoaded"/>

        <!--<items-table
            :items="''"/> -->
        
    </app-layout>
</template>

<script>
    import Breakdown from './components/Breakdown.vue';
    import ItemsTable from './components/ItemsTable.vue';
    import SplitsTable from './components/SplitsTable.vue';
    import SplitModal from '../../../Components/Transactions/SplitModal.vue';
    import AppLayout from './../../../Layouts/AppLayout'
    import { FormatMoney } from '../../../Mixins/formatMoney';
    import { EventBus } from '@/event-bus.js';
    import TransactionsAPI from '@/api/transactions.js';

    export default {
        props: [
            'categories'
        ],

        data(){
            return {
                transaction: {},
                transactionLoaded: false
            }
        },

        mixins: [
            FormatMoney
        ],

        components: {
            Breakdown,
            AppLayout,
            SplitsTable,
            ItemsTable,
            SplitModal
        },

        mounted(){
            EventBus.on('reload-transaction', function(){
                this.loadTransaction();
            }.bind(this));

            this.loadTransaction();
        },

        methods: {
            formatDate( date ){
                return moment( date, 'YYYY-MM-DD' ).format('L');
            },

            loadTransaction(){
                TransactionsAPI.show( this.$page.props.transaction.id )
                    .then( function( response ){
                        this.transaction = response.data;
                        this.transactionLoaded = true;
                    }.bind(this));
            }
        }
    }
</script>