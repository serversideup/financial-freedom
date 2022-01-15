<template>
    <app-modal :size="'medium'" :show="show">
        <template v-slot:image>
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: exclamation -->
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </template>
        <template v-slot:header>
            Add Transaction
        </template>
        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="acount" class="block text-sm font-medium leading-5 text-gray-700">
                        Account
                    </label>
                    <div class="mt-2 font-bold text-gray-700 font-sans">
                        {{ account.name }}
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="direction" class="block text-sm font-medium leading-5 text-gray-700">
                        Direction
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="direction" v-model="form.direction" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="outflow">Outflow</option>
                            <option value="inflow">Inflow</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="amount" class="block text-sm font-medium leading-5 text-gray-700">Amount</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div>
                            <input id="amount" v-model="form.amount" class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                    USD
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="date" class="block text-sm font-medium leading-5 text-gray-700">Date</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="date" v-model="form.date" class="form-input block w-full pl-3 pr-12 sm:text-sm sm:leading-5" placeholder="" aria-describedby="date">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" id="account-number" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <textarea id="description" v-model="form.description" rows="3" class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="tags" class="block text-sm font-medium leading-5 text-gray-700">
                        Tags
                    </label>
                    <tags
                        :unique="'add-transaction-tag'"
                        :existing="form.tags"/>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="addTransaction()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';
import Tags from '../../Components/Transactions/Tags.vue';

export default {
    props: ['account'],

    components: {
        AppModal,
        Tags
    },

    data(){
        return {
            accounts: [],

            show: false,

            form: {
                account: {},
                date: '',
                amount: 0.00,
                direction: 'outflow',
                name: '',
                description: '',
                tags: []
            }
        }
    },

    mounted(){
        this.bindEvents();
        this.form.account = this.account;
    },

    beforeDestroy(){
        EventBus.$off('prompt-add-transaction');
        EventBus.$off('close-modal');
    },

    methods: {
        bindEvents(){
            EventBus.on('prompt-add-transaction', function(){
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

        addTransaction(){
            this.$inertia.post('/transactions', this.form)
                .then(function( response ){
                    EventBus.emit('load-transactions');
                    EventBus.emit('notify', {
                        type: 'success',
                        title: 'Transaction Added',
                        message: 'Your transaction was added successfully.',
                        action: 'clear'
                    });
                    this.cancel();
                }.bind(this));
        },

        resetForm(){
            this.form.date = '';
            this.form.amount = 0.00;
            this.form.direction = 'outflow';
            this.form.name = '';
            this.form.description = '';
            this.form.tags = [];
        }
    }
}
</script>