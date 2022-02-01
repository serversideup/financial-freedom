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
                <div class="sm:col-span-3">
                    <label for="type" class="block text-sm font-medium text-left text-gray-700">
                        Type
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="type" v-model="form.type" v-bind:class="{ 'border-red-500': !validations.type.valid }" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option value="cash">Cash</option>
                            <option value="checking-account">Checking Account</option>
                            <option value="savings-account">Savings Account</option>
                            <option value="loan">Loan</option>
                            <option value="credit-card">Credit Card</option>
                            <option value="gift-card">Gift Card</option>
                        </select>
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.type.valid" v-text="validations.type.message"></span>
                </div>

                <div class="sm:col-span-6" v-show="showCompany">
                    <label for="gift-card-company" class="block text-sm font-medium leading-5 text-gray-700">
                        Company
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.company" id="gift-card-company" type="text" v-bind:class="{ 'border-red-500': !validations.company.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.company.valid" v-text="validations.company.message"></span>
                </div>

                <div class="sm:col-span-6" v-show="showAccountName">
                    <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
                        Account Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" id="account-name" type="text" v-bind:class="{ 'border-red-500': !validations.name.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.name.valid" v-text="validations.name.message"></span>
                </div>
                
                <div class="sm:col-span-3" v-show="showNumber">
                    <label for="account-number" class="block text-sm font-medium leading-5 text-gray-700">
                        Number
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.number" v-bind:class="{ 'border-red-500': !validations.number.valid }" id="account-number" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.number.valid" v-text="validations.number.message"></span>
                </div>

                <div class="sm:col-span-3" v-show="showInstitution">
                    <label for="institution" class="block text-sm font-medium leading-5 text-gray-700">
                        Institution
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="institution" v-model="form.institution" v-bind:class="{ 'border-red-500': !validations.institution.valid }" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option v-for="(institution, key) in institutions"
                                v-bind:key="'institution-'+key"
                                v-bind:value="institution.id"
                                v-text="institution.name"/>
                        </select>
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.institution.valid" v-text="validations.institution.message"></span>
                </div>

                <div class="sm:col-span-3" v-show="showOpenDate">
                    <label for="open-date" class="block text-sm font-medium leading-5 text-gray-700">
                        Open Date
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.open_date" v-bind:class="{ 'border-red-500': !validations.open_date.valid }" id="open-date" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.open_date.valid" v-text="validations.open_date.message"></span>
                </div>

                <div class="sm:col-span-3" v-show="showDescription">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.description" v-bind:class="{ 'border-red-500': !validations.description.valid }" id="description" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                    </div>
                    <span class="text-red-500 text-sm" v-show="!validations.description.valid" v-text="validations.description.message"></span>
                </div>

                <div class="sm:col-span-3" v-show="showInitialBalance">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">
                            Initial Balance
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                $
                            </span>
                            <input type="text" name="initial-balance" id="initial-balance" v-model="form.initial_balance" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3" v-show="showInterestRate">
                    <div>
                        <label for="interest-rate" class="block text-sm font-medium text-gray-700">
                            Interest Rate
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                %
                            </span>
                            <input type="text" name="interest-rate" id="interest-rate" v-model="form.amount" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3" v-show="showPaymentAmount">
                    <div>
                        <label for="payment-amount" class="block text-sm font-medium text-gray-700">
                            Payment Amount
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                $
                            </span>
                            <input type="text" name="payment-amount" id="payment-amount" v-model="form.payment_amount" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3" v-show="showLocation">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">
                            Location
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.location" v-bind:class="{ 'border-red-500': !validations.location.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.location.valid" v-text="validations.location.message"></span>
                    </div>
                </div>

                <div class="sm:col-span-3" v-show="showExpiration">
                    <div>
                        <label for="expiration" class="block text-sm font-medium text-gray-700">
                            Expiration
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.expiration" v-bind:class="{ 'border-red-500': !validations.expiration.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.expiration.valid" v-text="validations.expiration.message"></span>
                    </div>
                </div>

                <div class="sm:col-span-3" v-show="showUrl">
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700">
                            URL
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.url" v-bind:class="{ 'border-red-500': !validations.url.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.url.valid" v-text="validations.url.message"></span>
                    </div>
                </div>

                <div class="sm:col-span-3" v-show="showCode">
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">
                            Code
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.code" v-bind:class="{ 'border-red-500': !validations.code.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                        </div>
                        <span class="text-red-500 text-sm" v-show="!validations.code.valid" v-text="validations.code.message"></span>
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
                company: '',
                type: '',
                number: '',
                description: '',
                institution: '',
                open_date: '',
                payment_amount: 0.00,
                initial_balance: 0.00,
                interest_rate: 0.000,
                location: '',
                expiration: '',
                url: '',
                code: '',
            },

            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this account'
                },
                company: {
                    valid: true,
                    message: 'Enter a company for this gift card'
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
                },
                location: {
                    valid: true,
                    message: 'Enter the location of the gift card (i.e. Filing cabinet near desk)'
                },
                expiration: {
                    valid: true,
                    message: 'Enter the gift card\'s expiration date' 
                },
                url: {
                    valid: true,
                    message: 'Enter the URL of the giftcard'
                },
                code: {
                    valid: true,
                    message: 'Enter the code for the gift card'
                }
            }
        }
    },

    computed: {
        showCompany(){
            return this.form.type != '' && this.form.type == 'gift-card';
        },

        showAccountName(){
            return this.form.type != '' && this.form.type != 'gift-card';
        },

        showNumber(){
            return this.form.type != '' && this.form.type != 'cash' && this.form.type != 'gift-card';
        },

        showInstitution(){
            return this.form.type != '' && this.form.type != 'cash' && this.form.type != 'gift-card';
        },

        showOpenDate(){
            return this.form.type != '' && this.form.type == 'loan';
        },

        showDescription(){
            return this.form.type != '' && this.form.type != 'gift-card';
        },

        showInitialBalance(){
            return this.form.type != '';
        },

        showInterestRate(){
            return this.form.type != '' && ( this.form.type == 'loan' || this.form.type == 'credit-card');
        },

        showPaymentAmount(){
            return this.form.type != '' && this.form.type == 'loan';
        },

        showLocation(){
            return this.form.type != '' && this.form.type == 'gift-card';
        },

        showExpiration(){
            return this.form.type != '' && this.form.type == 'gift-card';
        },

        showUrl(){
            return this.form.type != '' && this.form.type == 'gift-card';
        },

        showCode(){
            return this.form.type != '' && this.form.type == 'gift-card';
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