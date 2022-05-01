<template>
    <div>
        <h2 class="text-xl font-extrabold text-gray-900 mt-5 mb-2">Rules</h2>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Find
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Replace
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Categorize
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="( rule, index ) in rules" :key="'rule-'+rule.id" >
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" v-model="rules[index].find"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" v-model="rules[index].replace"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" v-on:click="updateRule( index )" class="text-blue-600 hover:text-blue-900">Update</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" placeholder="Find string" v-model="newRule.find"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" placeholder="Replace with" v-model="newRule.replace"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <category-select v-model="newRule.category_id"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" v-on:click="addRule()" class="text-blue-600 hover:text-blue-900">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import RulesAPI from '@/api/rules.js';
import CategorySelect from '@/Components/Transactions/CategorySelect.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    data(){
        return {
            rules: [],
            newRule: {
                find: '',
                replace: '',
                category_id: ''
            }
        }
    },

    components: {
        CategorySelect
    },

    mounted(){
        this.initializeRules();
    },

    methods: {
        initializeRules(){
            RulesAPI.index()
                .then( function( response ){
                    this.rules = response.data;
                }.bind(this));
        },

        addRule(){
            RulesAPI.store( this.newRule )
                .then( function( response ){
                    this.newRule.find = '';
                    this.newRule.replace = '';
                    this.newRule.category_id = '';

                    EventBus.emit( 'notify', {
                        type: 'success',
                        title: 'Rule added',
                        message: 'New transaction naming rule has been added!',
                        action: 'close'
                    });

                    this.initializeRules();
                }.bind(this));
        },
        updateRule( index ){
            RulesAPI.update( this.rules[index].id, {
                find: this.rules[index].find,
                replace: this.rules[index].replace,
                category_id: this.rules[index].category_id
            }).then( function( response ){
                EventBus.emit('notifiy', {
                    type: 'success',
                    title: 'Rule updated',
                    message: 'Your category meta has been updated',
                    action: 'close'
                });
            });
        }
    }
}
</script>