<template>
    <app-modal :size="'small'" :show="show">
        <template v-slot:image>
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                        <input v-model="form.name" id="account-number" type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                        Description
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <textarea id="description" v-model="form.description" rows="3" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300"></textarea>
                    </div>
                </div>
                <div class="sm:col-span-6">
                    <div>
                        <label for="amount" class="block text-sm font-medium leading-5 text-gray-700">Amount</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                $
                            </span>
                            <input type="text" name="amount" id="amount" v-model="form.amount" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="addAllocation()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import AppModal from '../../Global/AppModal.vue';
import AllocationsAPI from '../../../api/allocations.js';
import { EventBus } from '../../../event-bus.js';

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
            EventBus.on('prompt-add-allocation', function(){
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

        addAllocation(){
            AllocationsAPI.store( {
                account_id: this.account.id,
                account_type: this.account.account_type,
                name: this.form.name,
                description: this.form.description,
                amount: this.form.amount
            }).then( function( response ){
                this.handleSuccessfulAllocation( response.data.name );
            }.bind(this));            
        },

        handleSuccessfulAllocation( name ){
            EventBus.emit('notify', {
                type: 'success',
                title: 'Allocation Created',
                message: 'Your "'+name+'" allocation has been created!',
                action: 'close'
            });

            EventBus.emit('allocation-added');

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
