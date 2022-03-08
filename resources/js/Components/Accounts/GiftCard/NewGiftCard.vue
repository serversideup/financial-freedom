<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 sm:col-span-6">
        <div class="sm:col-span-6">
            <label for="gift-card-company" class="block text-sm font-medium leading-5 text-gray-700">
                Company
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.company" id="gift-card-company" type="text" v-bind:class="{ 'border-red-500': !validations.company.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.company.valid" v-text="validations.company.message"></span>
        </div>
        <div class="sm:col-span-6">
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">
                    Location
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.location" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">
                    Balance
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                        $
                    </span>
                    <input type="text" name="balance" id="balance" v-model="form.balance" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                </div>
                <span class="text-red-500 text-sm" v-show="!validations.balance.valid" v-text="validations.balance.message"></span>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="expiration" class="block text-sm font-medium text-gray-700">
                    Expiration
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.expiration" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="url" class="block text-sm font-medium text-gray-700">
                    URL
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.url" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">
                    Code
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.code" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import GiftCardAPI from '@/api/giftCards.js';

export default {
    data(){
        return {
            form: {
                company: '',
                balance: '',
                location: '',
                expiration: '',
                url: '',
                code: ''
            },

            validations: {
                company: {
                    valid: true,
                    message: 'Enter a company for this gift card'
                },
                balance: {
                    valid: true,
                    message: 'Enter the initial balance of your gift card'
                }
            }
        }
    },

    mounted(){
        EventBus.on('add-gift-card', function(){
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
                GiftCardAPI.store( this.form )
                    .then( function( message ){
                        this.notify();
                        this.reloadAccounts();
                        this.resetForm();
                        this.resetValidations();
                        this.hideModal();
                    }.bind(this))
                    .catch( function( error ){
                        this.setServerSideValidations( error.response.data.errors );
                    }.bind(this));
            }
        },

        validate(){
            let validAccount = true;
            
            if( this.form.company == '' ){
                validAccount = false;
                this.validations.company.valid = false;
            }else{
                this.validations.company.valid = true;
            }

            if( this.form.balance == '' ){
                validAccount = false;
                this.validations.balance.valid = false;
            }else{
                this.validations.balance.valid = true;
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
            this.form.company = '';
            this.form.balance = '';
            this.form.location = '';
            this.form.expiration = '';
            this.form.url = '';
            this.form.code = '';
        },

        resetValidations(){
            this.validations.company.valid = true;
            this.validations.balance.valid = true;
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