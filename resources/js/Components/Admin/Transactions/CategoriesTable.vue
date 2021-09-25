<template>
    <div>
        <h2 class="text-xl font-extrabold text-gray-900 mt-5 mb-2">Categories</h2>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Preview
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Color
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template v-for="( category, index ) in availableCategories">
                                    <tr :key="'category-'+category.id">
                                        <th scope="col" class="px-6 py-3 text-left whitespace-nowrap text-sm">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                                                v-bind:class="[
                                                    'bg-'+category.color+'-100', 'text-'+category.color+'-800'
                                                ]">
                                                    {{ category.name }}
                                            </span>
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <input type="text" class="form-input block w-full max-w-xs transition duration-150 ease-in-out sm:text-sm sm:leading-5" v-model="availableCategories[index].name"/>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <select id="type" v-model="availableCategories[index].color" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                <option value=""></option>
                                                <option value="red">Red</option>
                                                <option value="green">Green</option>
                                                <option value="blue">Blue</option>
                                                <option value="gray">Gray</option>
                                                <option value="purple">Purple</option>
                                                <option value="pink">Pink</option>
                                                <option value="orange">Orange</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button type="button" v-on:click="updateCategory( index )" class="text-indigo-600 hover:text-indigo-900">Update</button>
                                        </td>
                                    </tr>
                                <!-- Add sub categories here -->
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CategoriesAPI from '../../../api/categories.js';
import { EventBus } from '../../../event-bus.js';

export default {
    props: ['categories'],

    data(){
        return {
            availableCategories: []
        }
    },

    mounted(){
        this.availableCategories = JSON.parse( JSON.stringify( this.categories ) );
    },

    methods: {
        updateCategory( index ){
            CategoriesAPI.update( this.availableCategories[index].id, {
                name: this.availableCategories[index].name,
                color: this.availableCategories[index].color
            }).then( function( response ){
                EventBus.$emit('notifiy', {
                    type: 'success',
                    title: 'Category updated',
                    message: 'Your category meta has been updated',
                    action: 'close'
                });
            });
        }
    }
}
</script>