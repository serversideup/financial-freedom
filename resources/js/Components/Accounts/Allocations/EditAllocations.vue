<template>
    <app-modal :size="'large'" :show="show">
        <template v-slot:image>
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-lochmara-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-lochmara-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </template>
        <template v-slot:header>
            Edit Allocations
        </template>
        <template v-slot:body>
            <div class="p-3 flex items-center justify-betwen"
                v-for="( allocation, key ) in form.allocations"
                v-bind:key="'allocation-'+key"
            >   
                <div class="pr-5">
                    <input class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" v-model="form.allocations[key].name"/>
                </div>
                <div class="pr-5">
                    <select class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" v-model="form.allocations[key].color">
                        <option value=""></option>
                        <option value="#f05252">Red</option>
                        <option value="#0e9f6e">Green</option>
                        <option value="#3f83f8">Blue</option>
                        <option value="#9061f9">Purple</option>
                        <option value="#e74694">Pink</option>
                        <option value="#ff5a1f">Orange</option>
                    </select>
                </div>
                <div class="pr-5">
                    <input class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" v-model="form.allocations[key].description"/>
                </div>
                <div class="pr-5">
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm sm:leading-5">
                                $
                            </span>
                        </div>
                        <input class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" v-model="form.allocations[key].amount" placeholder="0.00" aria-describedby="price-currency"/>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                USD
                            </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <button type="button" @click="removeAllocation( allocation.id )" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Remove
                    </button>
                </div>
            </div>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lochmara-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="update()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-lochmara-600 text-base font-medium text-white hover:bg-lochmara-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
        </template>
    </app-modal>
</template>

<script>
import AllocationsAPI from '../../../api/allocations.js';
import AppModal from '../../Global/AppModal.vue';
import { EventBus } from '../../../event-bus.js';

export default {
    props: [
        'allocations',
        'account'
    ],

    components: {
        AppModal
    },

    data(){
        return {
            show: false,

            form: {
                allocations: []
            }
        }
    },

    watch: {
        allocations(){
            this.form.allocations = this.allocations;
        },

        show(){
            this.form.allocations = this.allocations;
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.on('prompt-edit-allocations', function(){
                this.show = true;
            }.bind(this));

            EventBus.on('close-modal', function(){
                this.show = false;
            }.bind(this));
        },
        
        cancel(){
            this.show = false;
            this.resetForm();
        },

        update(){
            AllocationsAPI.update( this.form.allocations )
                .then( function( response ){
                    EventBus.emit('allocations-updated');
                    this.show = false;
                    this.resetForm();

                    EventBus.emit('notify', {
                        type: 'success',
                        title: 'Allocations Updated',
                        message: 'Your allocations now represent your account!',
                        action: 'close'
                    });
                }.bind(this));
        },

        resetForm(){
            this.form.allocations = [];
        },

        removeAllocation( id ){
            AllocationsAPI.delete( id )
                .then( function( response ){
                    EventBus.emit('allocation-deleted');
                }.bind(this));
        }
    }
}
</script>
