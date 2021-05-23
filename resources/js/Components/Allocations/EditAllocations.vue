<template>
    <app-modal :size="'small'" :show="show">
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
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';

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

            }
        }
    },

    mounted(){
        this.bindEvents();
    },

    methods: {
        bindEvents(){
            EventBus.$on('prompt-edit-allocations', function(){
                this.show = true;
            }.bind(this));

            EventBus.$on('close-modal', function(){
                this.show = false;
            }.bind(this));
        },
        
        cancel(){
            this.show = false;
            this.resetForm();
        },

        resetForm(){

        }
    }
}
</script>
