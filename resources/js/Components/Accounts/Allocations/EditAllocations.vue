<template>
        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Color</th>
                                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                    <th scope="col" class="relative whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="( allocation, key ) in form.allocations"
                                    v-bind:key="'allocation-'+key">
                                        <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">
                                            <input class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" v-model="form.allocations[key].name"/>
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">
                                            <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" v-model="form.allocations[key].color">
                                                <option value=""></option>
                                                <option value="#f05252">Red</option>
                                                <option value="#0e9f6e">Green</option>
                                                <option value="#3f83f8">Blue</option>
                                                <option value="#9061f9">Purple</option>
                                                <option value="#e74694">Pink</option>
                                                <option value="#ff5a1f">Orange</option>
                                            </select>
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                                    $
                                                </span>
                                                <input type="text" name="amount" id="amount" v-model="form.allocations[key].amount" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                                            </div>
                                        </td>
                                        <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <button type="button" @click="removeAllocation( allocation.id )" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </td>
                                </tr>
                                <tr v-show="form.allocations.length == 0">
                                    <td colspan="4" class="text-center p-5">
                                        No Allocations! 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button v-on:click="update()" type="button" class="mt-5 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Update
            </button>
        </div>
        
</template>

<script>
import AllocationsAPI from '@/api/allocations.js';
import { EventBus } from '@/event-bus.js';

export default {
    props: [
        'allocations',
        'account'
    ],

    data(){
        return {
            form: {
                allocations: []
            }
        }
    },

    watch: {
        allocations(){
            this.form.allocations = this.allocations;
        },
    },

    methods: {
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
