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
                    <account-select 
                        v-model="form.account"
                        :accounts="accounts"/>
                </div>
                <div class="sm:col-span-3">
                    <label for="direction" class="block text-sm font-medium text-left text-gray-700">Direction</label>
                    <select id="direction" v-model="form.direction" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="all">All</option>
                        <option value="outflow">Outflow</option>
                        <option value="inflow">Inflow</option>
                    </select>
                </div>
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
                        <label for="date" class="block text-sm font-medium leading-5 text-gray-700">Date</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            <input type="text" name="date" id="date" v-model="form.date" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" id="account-number" type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <textarea id="description" v-model="form.description" rows="3" class="rounded-md shadow-sm block w-full border-gray-300"></textarea>
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
                <div class="sm:col-span-3">
                    <label for="tags" class="block text-sm font-medium leading-5 text-gray-700">
                        Tags
                    </label>
                </div>
                
            </form>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="addTransaction()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import { EventBus } from '@/event-bus.js';

import AppModal from '@/Components/Global/AppModal.vue';
import AccountsAPI from '@/api/accounts.js';
import AccountSelect from '@/Components/Global/AccountSelect.vue';
import TagsAPI from '@/api/tags.js';

export default {
    props: [
        'categories'
    ],

    components: {
        AppModal,
        AccountSelect
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
                category: '',
                tags: []
            }
        }
    },

    mounted(){
        this.bindEvents();
        this.loadAccounts();
    },

    beforeDestroy(){
        EventBus.off('prompt-add-transaction');
        EventBus.off('close-modal');
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

        loadAccounts(){
            AccountsAPI.index()
            .then( function( response ){
                this.accounts = response.data;
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
            this.form.account = {};
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