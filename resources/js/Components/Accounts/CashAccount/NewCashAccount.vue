<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 sm:col-span-6">
        <div class="sm:col-span-6">
            <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
                Account Name
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.name" id="account-name" type="text" v-bind:class="{ 'border-red-500': !validations.name.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.name.valid" v-text="validations.name.message"></span>
        </div>

        <div class="sm:col-span-6">
            <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                Description
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.description" v-bind:class="{ 'border-red-500': !validations.description.valid }" id="description" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.description.valid" v-text="validations.description.message"></span>
        </div>

        <div class="sm:col-span-6">
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">
                    Current Balance
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                        $
                    </span>
                    <input type="text" name="current-balance" id="current-balance" v-model="form.current_balance" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                </div>
                <span class="text-red-500 text-sm" v-show="!validations.current_balance.valid" v-text="validations.current_balance.message"></span>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import CashAccountAPI from '@/api/cashAccounts.js';

export default {
    data(){
        return {
            form: {
                name: '',
                description: '',
                current_balance: ''
            },

            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this account'
                },
                description: {
                    valid: true,
                    message: 'Enter a quick description of your account'
                },
                current_balance: {
                    valid: true,
                    message: 'Enter the current balance of your account'
                },
            }
        }
    },

    mounted(){
        EventBus.on('add-cash', function(){
            this.add();
        }.bind(this));

        EventBus.on('reset-form', function(){
            this.resetForm();
        }.bind(this));

        EventBus.on('reset-validations', function(){
            this.resetValidations();
        }.bind(this));
    },

    methods: {
        add(){
            if( this.validate() ){
                CashAccountAPI.store( this.form )
                    .then( function( message ){
                        this.notify();
                        this.reloadAccounts();
                        this.resetForm();
                        this.resetValidations();
                        this.hideModal();
                    }.bind(this))
                    .catch( function( error ){
                        this.setServerSideValidations( error.response.data.errors );
                    }.bind(this) );
            }
        },
        
        validate(){
            let validAccount = true;

            if( this.form.name == '' ){
                validAccount = false;
                this.validations.name.valid = false;
            }else{
                this.validations.name.valid = true;
            }

            if( this.form.description == '' ){
                validAccount = false;
                this.validations.description.valid = false;
            }else{
                this.validations.description.valid = true;
            }

            if( this.form.current_balance == '' || isNaN( this.form.current_balance ) ){
                validAccount = false;
                this.validations.current_balance.valid = false;
            }else{
                this.validations.current_balance.valid = true;
            }

            return validAccount;
        },

        notify(){
            EventBus.emit('notify', {
                type: 'success',
                title: 'Account Added',
                message: 'You can now add transactions, set goals, and budget for this account!',
                action: 'close'
            });
        },

        reloadAccounts(){
            EventBus.emit('reload-accounts');
        },

        resetForm(){
            this.form.name = '';
            this.form.description = '';
            this.form.current_balance = '';
        },

        resetValidations(){
            this.validations.name.valid = true;
            this.validations.description.valid = true;
            this.validations.current_balance.valid = true;
        },

        hideModal(){
            EventBus.emit('close-modal');
        },

        setServerSideValidations( errors ){
            for (const [key, value] of Object.entries(errors)) {
                this.validations[ key ].valid = false;
                this.validations[ key ].message = value[0];
            }
        }
    }
}
</script>