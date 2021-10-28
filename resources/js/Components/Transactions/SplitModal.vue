<template>
    <app-modal :size="'medium'" :show="show">
        <template v-slot:image>
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: exclamation -->
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                </svg>
            </div>
        </template>
        <template v-slot:header>
            Split Transaction
        </template>
        <template v-slot:body>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">
                            Amount
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                $
                            </span>
                            <input type="text" name="amount" id="amount" v-model="form.amount" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="amount-remaining" class="block text-sm font-medium leading-5 text-gray-700">Remaining To Split</label>
                        <div class="mt-1 relative text-xl font-bold text-blue-700">
                            {{ formatMoney( remaining ) }}
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="tags" class="block text-sm font-medium leading-5 text-gray-700">
                        Category
                    </label>
                    <select id="category" v-model="form.category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value=""></option>
                        <option v-for="category in $page.props.categories"
                            :key="'category-'+category.id"
                            v-bind:value="category.id"
                            v-text="( category.parent_id != null ? ' - ' : '' )+category.name"/>
                    </select>
                </div>
                <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <textarea id="description" v-model="form.description" rows="3" class="rounded-md shadow-sm block w-full border-gray-300"></textarea>
                    </div>
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="splitTransaction()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Split
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../../Components/Global/AppModal.vue';
import TransactionsAPI from '@/api/transactions.js';
import { EventBus } from '../../event-bus.js';
import { FormatMoney } from '../../Mixins/formatMoney';

export default {
    props: ['transaction'],

    components: {
        AppModal
    },

    mixins: [
        FormatMoney
    ],

    data(){
        return {
            show: false,

            form: {
                amount: 0.00,
                name: '',
                description: '',
                category: ''
            }
        }
    },

    computed: {
        remaining(){
            let remainingAmount = parseFloat( this.transaction.amount );

            this.transaction.splits.forEach( function( split ){
                remainingAmount = remainingAmount - parseFloat( split.amount );
            } );

            remainingAmount = remainingAmount - parseFloat( this.form.amount );
            
            return remainingAmount;
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.on('prompt-split-transaction', function(){
                this.show = true;
            }.bind(this));

            EventBus.on('close-modal', function(){
                this.show = false;
            }.bind(this));
        },

        cancel(){
            this.show = false;
            this.resetForm();
            EventBus.emit('close-modal');
        },

        splitTransaction(){
            TransactionsAPI.split( this.transaction.id, this.form )
                .then( function( response ){
                    EventBus.emit('notify', {
                        type: 'success',
                        title: 'Transaction Split',
                        message: 'Your transaction has been split',
                        action: 'close'
                    } );

                    EventBus.emit('reload-transaction');

                    this.closeModal();
                }.bind(this));
        },

        closeModal(){
            this.show = false;
            this.form.amount = 0.00;
            this.form.name = '';
            this.form.description = '';
            this.form.category = '';
        }
    }
}
</script>