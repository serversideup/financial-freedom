<template>
    <div id="transactions-filter-popup" v-bind:class="{'hidden' : !show}" class="absolute bg-white rounded w-64 shadow-lg border-astronaut-100 p-3 border z-modal right-0" style="top: 45px;">
        <div class="grid grid-cols-1">
            <div class="sm:col-span-3">
                <label for="direction" class="block text-sm font-medium leading-5 text-left text-gray-700">
                    Direction
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <select id="direction" v-model="direction" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="all">All</option>
                        <option value="outflow">Outflow</option>
                        <option value="inflow">Inflow</option>
                    </select>
                </div>
            </div>
            <!-- <div class="sm:col-span-3 mt-1">
                <label for="category" class="block text-sm font-medium leading-5 text-left text-gray-700">
                    Category
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <select id="category" v-model="category" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value=""></option>
                    </select>
                </div>
            </div> -->
            <div class="sm:col-span-3 mt-1">
                <label for="tags" class="block text-sm font-medium leading-5 text-left text-gray-700 mb-1">
                    Tags
                </label>
                <tags
                    :unique="'filter-transaction-tags'"
                    :existing="tags"/>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../../../event-bus.js';
import Tags from '../Tags.vue';

export default {
    props: ['show'],

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
            EventBus.$emit( 'transaction-filters-updated', {
                direction: this.direction,
                category: this.category,
                tags: this.tags
            });
       }
    }
}
</script>