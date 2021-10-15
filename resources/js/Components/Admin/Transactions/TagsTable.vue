<template>
    <div>
        <h2 class="text-xl font-extrabold text-gray-900 mt-5 mb-2">Tags</h2>
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
                                <tr v-for="( tag, index ) in availableTags" :key="'tag-'+tag.id">
                                    <th scope="col" class="px-6 py-3 text-left whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                                            v-bind:class="[
                                                'bg-'+tag.color+'-100', 'text-'+tag.color+'-800'
                                            ]">
                                                {{ tag.name }}
                                        </span>
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <input type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" v-model="availableTags[index].name"/>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <select id="type" v-model="availableTags[index].color" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
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
                                        <button type="button" v-on:click="updateTag( index )" class="text-blue-600 hover:text-blue-900">Update</button>
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
import TagsAPI from '../../../api/tags.js';
import { EventBus } from '../../../event-bus.js';

export default {
    props: ['tags'],

    data(){
        return {
            availableTags: []
        }
    },

    mounted(){
        this.availableTags = JSON.parse( JSON.stringify( this.tags ) );
    },

    methods: {
        updateTag( index ){
            TagsAPI.update( this.availableTags[index].id, {
                name: this.availableTags[index].name,
                color: this.availableTags[index].color
            }).then( function( response ){
                EventBus.emit('notifiy', {
                    type: 'success',
                    title: 'Tag updated',
                    message: 'Your tag meta has been updated',
                    action: 'close'
                });
            });
        }
    }
}
</script>