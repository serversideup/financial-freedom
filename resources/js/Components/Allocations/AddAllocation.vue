<template>
    <app-modal :size="'small'" :show="show">
        <template v-slot:image>
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-lochmara-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-lochmara-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </template>
        <template v-slot:header>
            Add Allocation
        </template>
        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
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
            </form>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lochmara-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="addAllocation()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-lochmara-600 text-base font-medium text-white hover:bg-lochmara-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import CheckingAccountAPI from '../../api/checkingAccounts.js';
import CashAccountsAPI from '../../api/cashAccounts.js';
import { EventBus } from '../../event-bus.js';

export default {
    props: [
        'available',
        'account'
    ],

    components: {
        AppModal
    },

    data(){
        return {
            show: false,

            form: {
                name: '',
                description: '',
                amount: 0.00 
            }
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.$on('prompt-add-allocation', function(){
                this.show = true;
            }.bind(this));

            EventBus.$on('close-modal', function(){
                this.show = false;
            }.bind(this));
        },
        
        cancel(){
            this.show = false;
            this.resetForm();
            EventBus.$emit('close-modal');
        },

        addAllocation(){
            switch( this.account.account_type ){
                case 'checking':
                    CheckingAccountAPI.addAllocation( this.account.id, {
                        name: this.form.name,
                        description: this.form.description,
                        amount: this.form.amount
                    }).then( function( response ){
                        this.handleSuccessfulAllocation( response.data.name );
                    }.bind(this));
                break;
                case 'cash':
                    CashAccountsAPI.addAllocation( this.account.id, {
                        name: this.form.name,
                        description: this.form.description,
                        amount: this.form.amount
                    }).then( function( response ){
                        this.handleSuccessfulAllocation( response.data.name );
                    }.bind(this));
                break;
            }
            
        },

        handleSuccessfulAllocation( name ){
            EventBus.$emit('notify', {
                type: 'success',
                title: 'Allocation Created',
                message: 'Your "'+name+'" allocation has been created!',
                action: 'close'
            });

            EventBus.$emit('allocation-added');

            this.show = false;
            this.resetForm();
        },

        resetForm(){
            this.form.name = '';
            this.form.description = '';
            this.form.amount = 0.00;
        }
    }
}
</script>
