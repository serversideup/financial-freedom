<template>
    <app-modal :size="'medium'" :show="show">
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
                    <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
                        Account Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" id="account-name" type="text" v-bind:class="{ 'border-red-500': !validations.name.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.name.valid" v-text="validations.name.message"></span>
                </div>
                <div class="sm:col-span-3">
                    <label for="type" class="block text-sm font-medium leading-5 text-gray-700">
                        Type
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="type" v-model="form.type" v-bind:class="{ 'border-red-500': !validations.type.valid }" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value=""></option>
                            <option value="cash">Cash</option>
                            <option value="checking-account">Checking Account</option>
                            <option value="savings-account">Savings Account</option>
                            <option value="loan">Loan</option>
                            <option value="credit-card">Credit Card</option>
                        </select>
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.type.valid" v-text="validations.type.message"></span>
                </div>
                <div class="sm:col-span-3" v-show="form.type != 'cash'">
                    <label for="account-number" class="block text-sm font-medium leading-5 text-gray-700">
                        Number
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.number" v-bind:class="{ 'border-red-500': !validations.number.valid }" id="account-number" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.number.valid" v-text="validations.number.message"></span>
                </div>
                <div class="sm:col-span-3" v-show="form.type != 'cash'">
                    <label for="institution" class="block text-sm font-medium leading-5 text-gray-700">
                        Institution
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="institution" v-model="form.institution" v-bind:class="{ 'border-red-500': !validations.institution.valid }" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value=""></option>
                            <option v-for="(institution, key) in institutions"
                                v-bind:key="'institution-'+key"
                                v-bind:value="institution.id"
                                v-text="institution.name"/>
                        </select>
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.institution.valid" v-text="validations.institution.message"></span>
                </div>
                <div class="sm:col-span-3" v-show="form.type == 'loan'">
                    <label for="open-date" class="block text-sm font-medium leading-5 text-gray-700">
                        Open Date
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.open_date" v-bind:class="{ 'border-red-500': !validations.open_date.valid }" id="open-date" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.open_date.valid" v-text="validations.open_date.message"></span>
                </div>
                <div class="sm:col-span-3">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.description" v-bind:class="{ 'border-red-500': !validations.description.valid }" id="description" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.description.valid" v-text="validations.description.message"></span>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="initial-balance" class="block text-sm font-medium leading-5 text-gray-700">Initial Balance</label>
                        <div class="mt-1 relative rounded-md shadow-sm" v-bind:class="{ 'border-red-500': !validations.initial_balance.valid, 'border': !validations.initial_balance.valid }">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div>
                            <input id="initial-balance" v-model="form.initial_balance" class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                    USD
                                </span>
                            </div>
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.initial_balance.valid" v-text="validations.initial_balance.message"></span>
                    </div>
                </div>
                <div class="sm:col-span-3" v-show="form.type == 'loan' || form.type == 'credit-card'">
                    <div>
                        <label for="interest-rate" class="block text-sm font-medium leading-5 text-gray-700">Interest Rate</label>
                        <div class="mt-1 relative rounded-md shadow-sm" v-bind:class="{ 'border-red-500': !validations.interest_rate, 'border': !validations.interest_rate }">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">
                                    %
                                </span>
                            </div>
                            <input id="interest-rate" v-model="form.interest_rate" class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00" aria-describedby="price-currency">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.interest_rate.valid" v-text="validations.interest_rate.message"></span>
                    </div>
                </div>
                <div class="sm:col-span-3" v-show="form.type == 'loan'">
                    <div>
                        <label for="payment-amount" class="block text-sm font-medium leading-5 text-gray-700">Payment Amount</label>
                        <div class="mt-1 relative rounded-md shadow-sm" v-bind:class="{ 'border-red-500': !validations.payment_amount.valid, 'border': !validations.payment_amount.valid }">>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div>
                            <input id="payment-amount" v-model="form.payment_amount" class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                    USD
                                </span>
                            </div>
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.payment_amount.valid" v-text="validations.payment_amount.message"></span>
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <button @click="cancel" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button @click="addAccount()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';
import AccountsAPI from '../../api/accounts.js';

export default {
    props: ['institutions'],

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
            },

            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this account'
                },
                type: {
                    valid: true,
                    message: 'Please select an account type'
                },
                number: {
                    valid: true,
                    message: 'Please enter an account number'
                },
                description: {
                    valid: true,
                    message: 'Enter a quick description of your account'
                },
                institution: {
                    valid: true,
                    message: 'Please select the institution that provides your account.'
                },
                open_date: {
                    valid: true,
                    message: 'Enter the open date for your loan.'
                },
                payment_amount: {
                    valid: true,
                    message: 'Enter the payment details for your loan'
                },
                initial_balance: {
                    valid: true,
                    message: 'Enter the initial balance of your account'
                },
                interest_rate: {
                    valid: true,
                    message: 'Enter the interest rate for your loan'
                }
            }
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
            }.bind(this));
        },

        cancel(){
            this.show = false;
            this.resetForm();
            this.resetValidations();
        },

        addAccount(){
            if( this.validateNewAccount() ){
                AccountsAPI.store( this.form )
                    .then( function( response ){
                        EventBus.emit('notify', {
                            type: 'success',
                            title: 'Account Added',
                            message: 'You can now add transactions, set goals, and budget for this account!',
                            action: 'close'
                        });

                        EventBus.emit('reload-accounts');

                        this.resetForm();
                        this.resetValidations();
                    }.bind(this) )
                    .catch( function( error ){
                        this.setServerSideValidations( error.response.data.errors );
                    }.bind(this) );
            }
        },

        validateNewAccount(){
            return true;
        },

        setServerSideValidations( errors ){
            for (const [key, value] of Object.entries(errors)) {
                this.validations[ key ].valid = false;
                this.validations[ key ].message = value[0];
            }
        },

        resetForm(){
            this.show = false;

            this.form.name = '';
            this.form.type = '';
            this.form.number = '';
            this.form.description = '';
            this.form.institution = '';
            this.form.open_date = '';
            this.form.payment_amount = 0.00;
            this.form.initial_balance = 0.00;
            this.form.interest_rate = 0.000;
        },

        resetValidations(){
            this.validations.name.valid = true;
            this.validations.name.message = 'Enter a name for this account';

            this.validations.type.valid = true;
            this.validations.type.message = 'Please select an account type';

            this.validations.number.valid = true;
            this.validations.number.message = 'Please enter an account number';

            this.validations.description.valid = true;
            this.validations.description.message = 'Enter a quick description of your account';

            this.validations.institution.valid = true;
            this.validations.institution.message = 'Please select the institution that provides your account.';

            this.validations.open_date.valid = true;
            this.validations.open_date.message = 'Enter the open date for your loan.';

            this.validations.payment_amount.valid = true;
            this.validations.payment_amount.message = 'Enter the payment details for your loan';

            this.validations.initial_balance.valid = true;
            this.validations.initial_balance.message = 'Enter the initial balance of your account';

            this.validations.interest_rate.valid = true;
            this.validations.interest_rate.message = 'Enter the interest rate for your loan'
        }
    }
}
</script>