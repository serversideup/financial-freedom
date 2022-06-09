<template>
    <app-modal :size="'small'" :show="show">
        <template v-slot:image>
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </template>

        <template v-slot:header>
            Add Rule
        </template>

        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <label for="find" class="block text-sm font-medium leading-5 text-gray-700">
                        Find
                    </label>
                    <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" placeholder="Find string" v-model="form.find"/>
                </div>
                <div class="sm:col-span-6">
                    <label for="replace" class="block text-sm font-medium leading-5 text-gray-700">
                        Replace
                    </label>
                    <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" placeholder="Find string" v-model="form.replace"/>
                </div>
                <div class="sm:col-span-6">
                    <label for="category" class="block text-sm font-medium leading-5 text-gray-700">
                        Category
                    </label>
                    <category-select v-model="form.category_id"/>
                </div>
            </form>
        </template>

        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="addRule()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import RulesAPI from '@/api/rules.js';
import CategorySelect from '@/Components/Transactions/CategorySelect.vue';
import AppModal from '@/Components/Global/AppModal.vue';

export default {
    data(){
        return {
            show: false,

            form: {
                find: '',
                replace: '',
                category_id: ''
            }
        }
    },

    mounted(){
        this.bindEvents();
    },

    beforeDestroy(){
        EventBus.off('prompt-add-rule');
        EventBus.off('close-modal');
    },

    components: {
        AppModal,
        CategorySelect
    },

    methods: {
        bindEvents(){
            EventBus.on('prompt-add-rule', function(){
                this.show = true;
            }.bind(this));

            EventBus.on('close-modal', function(){
                this.show = false;
            }.bind(this));
        },

        addRule(){
            RulesAPI.store( this.form )
                .then( function( response ){
                    this.form.find = '';
                    this.form.replace = '';
                    this.form.category_id = '';

                    EventBus.emit( 'notify', {
                        type: 'success',
                        title: 'Rule added',
                        message: 'New transaction naming rule has been added!',
                        action: 'close'
                    });

                    EventBus.emit( 'new-rule-added', response.data );

                    this.show = false;
                    this.resetForm();
                }.bind(this));
        },

        cancel(){
            this.show = false;
            this.resetForm();
        },

        resetForm(){
            this.form.find = '';
            this.form.replace = '';
            this.form.category_id = '';
        }
    }
}
</script>