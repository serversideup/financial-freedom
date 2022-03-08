<template>
    <div id="transactions-filter-popup" v-bind:class="{'hidden' : !show}" class="absolute bg-white rounded w-64 shadow-lg border-astronaut-100 p-3 border z-modal right-0" style="top: 45px;">
        <div class="grid grid-cols-1">
            
            <div class="sm:col-span-3">
                <label for="direction" class="block text-sm font-medium text-left text-gray-700">Direction</label>
                <select id="direction" v-model="direction" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="all">All</option>
                    <option value="outflow">Outflow</option>
                    <option value="inflow">Inflow</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            <div class="sm:col-span-3 mt-1">
                <label class="block text-sm font-medium text-left text-gray-700">Category</label>
                <select id="category" v-model="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value=""></option>
                    <option v-for="category in $page.props.categories"
                        :key="'category-'+category.id"
                        v-bind:value="category.id"
                        v-text="( category.parent_id != null ? ' - ' : '' )+category.name"/>
                </select>
            </div>
            

            <!-- <div class="sm:col-span-3 mt-1">
                <label for="tags" class="block text-sm font-medium leading-5 text-left text-gray-700 mb-1">
                    Tags
                </label>
                <tags
                    :unique="'filter-transaction-tags'"
                    :existing="tags"/>
            </div> -->
        </div>
    </div>
</template>

<script>
import { EventBus } from '../../../event-bus.js';
import Tags from '../Tags.vue';

export default {
    props: ['show', 'categories'],

    components: {
        Tags
    },

    data(){
        return {
            direction: 'all',
            category: '',
            tags: []
        }
    },

    watch: {
        direction(){
            this.applyFilters();
        },
        
        category(){
            this.applyFilters();
        },

        tags(){
            this.applyFilters();
        }
    },

    methods: {
       applyFilters(){
            EventBus.emit( 'transaction-filters-updated', {
                direction: this.direction,
                category: this.category,
                tags: this.tags
            });
       }
    }
}
</script>