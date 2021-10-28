<template>
    <app-modal :size="'medium'" :show="show">
        <template v-slot:image>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </template>
        <template v-slot:header>
            Edit Account
        </template>
        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
                        Account Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" id="account-name" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="account-number" class="block text-sm font-medium leading-5 text-gray-700">
                        Number
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.number" id="account-number" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="current-balance" class="block text-sm font-medium leading-5 text-gray-700">Current Balance</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div>
                            <input id="current-balance" v-model="form.current_balance" class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                    USD
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.description" id="description" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <button @click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button @click="updateAccount()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../../Global/AppModal.vue';
import { EventBus } from '../../../event-bus.js';
import CreditCardsAPI from '../../../api/creditCards.js';

export default {
    components: {
        AppModal
    },

    data(){
        return {
            show: false,
            id: '',

            form: {
                id: '',
                name: '',
                number: '',
                description: '',
                current_balance: ''
            }
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.on('prompt-edit-account', function( data ){
                this.show = true;

                this.id = data.id;
                this.form.name = data.name;
                this.form.number = data.number;
                this.form.description = data.description;
                this.form.current_balance = data.current_balance;
            }.bind(this));

            EventBus.on('close-modal', function(){
                this.show = false;
                this.resetForm();
            }.bind(this));
        },

        updateAccount(){
            CreditCardsAPI.update( this.id, this.form )
                .then( function(){
                    EventBus.emit('notify', {
                        type: 'success',
                        title: 'Account Updated',
                        message: 'Your account has been successfully updated!',
                        action: 'close'
                    });

                    EventBus.emit('credit-card-updated');

                    this.show = false;
                    this.resetForm();
                }.bind(this));
        },

        cancel(){
            this.show = false;
            this.resetForm();
        },

        resetForm(){
            this.form.name = '';
            this.form.number = '';
            this.form.description = '';
            this.form.current_balance = '';
        }
    }
}
</script>