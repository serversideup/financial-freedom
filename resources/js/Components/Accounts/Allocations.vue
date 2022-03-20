<template>
    <div>
        <div class="mb-3 md:flex md:items-center md:justify-end">
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                <button v-on:click="promptAddAllocation()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-3 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <button v-on:click="viewChart()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-3 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                </button>
                <button v-on:click="editAllocations()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-3 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </button>
            </span>
        </div>
        <allocation-chart 
            v-show="view == 'chart'"
            :allocations="allocations"
            :un-allocated-amount="unallocatedAmount"/>

        <edit-allocations 
            v-show="view == 'edit'"
            :available="unallocatedAmount"
            :account="account"
            :allocations="allocations"/>

        <add-allocation 
            :available="unallocatedAmount" 
            :account="account"/>
    </div>
</template>

<script>
import AllocationChart from './Allocations/AllocationChart.vue';
import AddAllocation from './Allocations/AddAllocation.vue';
import EditAllocations from './Allocations/EditAllocations.vue';
import { EventBus } from '@/event-bus.js';
import AllocationsAPI from '@/api/allocations.js';

export default {
    props: ['account'],

    data(){
        return {
            allocations: [],
            view: 'chart'
        }
    },

    components: {
        AllocationChart,
        AddAllocation,
        EditAllocations
    },

    computed: {
        unallocatedAmount(){
            let totalAllocated = 0.00;
            
            this.allocations.forEach( function( allocation ){
                totalAllocated += parseFloat( allocation.amount )
            });

            return parseFloat( this.account.current_balance )
                    - parseFloat( totalAllocated );
        }
    },

    mounted(){
        this.bindEvents();
        this.loadAllocations();
    },

    methods: {
        bindEvents(){
            EventBus.on('allocation-added', function(){
                this.view = 'chart';
                this.loadAllocations();
            }.bind(this));
            
            EventBus.on('allocation-deleted', function(){
                this.view = 'chart';
                this.loadAllocations();
            }.bind(this));

            EventBus.on('allocations-updated', function(){
                this.view = 'chart';
                this.loadAllocations();
            }.bind(this));
        },

        loadAllocations(){
            this.allocations = [];

            AllocationsAPI.index({
                account_type: this.account.account_type,
                account_id: this.account.id
            }).then( function( response ){
                this.allocations = response.data;
            }.bind(this));            
        },

        promptAddAllocation(){
            EventBus.emit('prompt-add-allocation');
        },

        viewChart(){
            this.view = 'chart';
        },

        editAllocations(){
            this.view = 'edit';
        }
    }
}
</script>