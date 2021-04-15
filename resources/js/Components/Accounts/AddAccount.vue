<template>
    <app-modal :size="'medium'" :show="show">
        <template v-slot:image>
            <svg class="h-6 w-6 text-lochmara-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </template>
        <template v-slot:header>
            Add Account
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
                    <label for="type" class="block text-sm font-medium leading-5 text-gray-700">
                        Type
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="type" v-model="form.type" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value=""></option>
                            <option value="cash">Cash</option>
                            <option value="checking-account">Checking Account</option>
                            <option value="savings-account">Savings Account</option>
                            <option value="loan">Loan</option>
                            <option value="credit-card">Credit Card</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-3" v-show="form.type != 'cash'">
                    <label for="account-number" class="block text-sm font-medium leading-5 text-gray-700">
                        Number
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.number" id="account-number" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <button @click="cancel" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lochmara-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button @click="addAccount()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-lochmara-600 text-base font-medium text-white hover:bg-lochmara-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';

export default {
    components: {
        AppModal
    },

    data(){
        return {
            show: false,

            form: {
                name: '',
                type: '',
                number: '',
                description: '',
                institution: '',
                open_date: '',
                payment_amount: 0.00,
                initial_balance: 0.00,
                interest_rate: 0.000
            }
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.$on('prompt-add-account', function(){
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

        addAccount(){

        },

        resetForm(){
            
        }
    }
}
</script>