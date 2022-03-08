<template>
    <app-modal :size="'small'" :show="show">
        <template v-slot:image>
            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </template>

        <template v-slot:header>
            Add Account
        </template>

        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <label for="type" class="block text-sm font-medium text-left text-gray-700">
                        Type
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="type" v-model="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option value="cash">Cash</option>
                            <option value="checking-account">Checking Account</option>
                            <option value="savings-account">Savings Account</option>
                            <option value="loan">Loan</option>
                            <option value="credit-card">Credit Card</option>
                            <option value="gift-card">Gift Card</option>
                        </select>
                    </div>
                </div>

                <new-cash-account v-if="type == 'cash'"/>
                <new-checking-account v-if="type == 'checking-account'" :institutions="institutions"/>
                <new-credit-card v-if="type == 'credit-card'" :institutions="institutions"/>
                <new-loan v-if="type == 'loan'" :institutions="institutions"/>
                <new-savings-account v-if="type == 'savings-account'" :institutions="institutions"/>
                <new-gift-card v-if="type == 'gift-card'"/>
            </form>
        </template>

        <template v-slot:footer>
            <button @click="cancel" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-show="type != ''" @click="addAccount()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>

    </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';

import NewCashAccount from './CashAccount/NewCashAccount.vue';
import NewCheckingAccount from './CheckingAccount/NewCheckingAccount.vue';
import NewCreditCard from './CreditCard/NewCreditCard.vue';
import NewLoan from './Loan/NewLoan.vue';
import NewSavingsAccount from './SavingsAccount/NewSavingsAccount.vue';
import NewGiftCard from './GiftCard/NewGiftCard.vue';

export default {
    props: ['institutions'],

    components: {
        AppModal,
        NewCashAccount,
        NewCheckingAccount,
        NewCreditCard,
        NewLoan,
        NewSavingsAccount,
        NewGiftCard
    },

    data(){
        return {
            show: false,

            type: ''
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.on('prompt-add-account', function(){
                this.show = true;
            }.bind(this));

            EventBus.on('close-modal', function(){
                this.show = false;
                this.type = '';
            }.bind(this));
        },

        cancel(){
            this.show = false;
            this.type = '';
            EventBus.emit('reset-form');
            EventBus.emit('reset-validations');
        },

        addAccount(){
            EventBus.emit('add-'+this.type);
        }
    }
}
</script>