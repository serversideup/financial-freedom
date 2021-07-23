<template>
    <div>
        <div class="mb-3 md:flex md:items-center md:justify-end">
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                <button v-on:click="promptAddAllocation()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Add Allocation
                </button>
                <button v-on:click="promptEditAllocations()" class="-ml-px relative cursor-pointer inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>

                    Edit Allocations
                </button>
            </span>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
            <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
                Current Allocation
            </div>
            <div class="py-5 h-96">
                <canvas id="current-allocation"></canvas>
            </div>
        </div>

        <add-allocation :available="unallocatedAmount" :account="account"/>
        <edit-allocations :allocations="allocations" :account="account"/>
    </div>
</template>

<script>
import AddAllocation from './Allocations/AddAllocation.vue';
import EditAllocations from './Allocations/EditAllocations.vue';
import AllocationsAPI from '../../api/allocations.js';
import Chart from 'chart.js';
import { FormatMoney } from '../../Mixins/formatMoney.js';
import { EventBus } from '../../event-bus.js';

export default {
    props: ['account'],

    data(){
        return {
            chartData: [],
            chart: '',
            allocations: []
        }
    },

    mixins: [
        FormatMoney
    ],

    components: {
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
            EventBus.$on('allocation-added', function(){
                this.loadAllocations();
            }.bind(this));
            
            EventBus.$on('allocation-deleted', function(){
                this.loadAllocations();
            }.bind(this));

            EventBus.$on('allocations-updated', function(){
                this.loadAllocations();
            }.bind(this));
        },

        loadAllocations(){
            this.chartData = [];
            this.allocations = [];

            AllocationsAPI.index({
                account_type: this.account.account_type,
                account_id: this.account.id
            }).then( function( response ){
                this.allocations = response.data;
                this.configureChart();
            }.bind(this));            
        },

        configureChart(){
            this.prepareChartData();

            if( this.chart == '' ){
                this.displayChart();
            }else{
                this.updateChart();
            }
        },

        prepareChartData(){
            this.chartData.push({
                label: "Un-allocated",
                value: this.unallocatedAmount.toFixed( 2 )
            });

            this.allocations.forEach( function( allocation ){
                this.chartData.push({
                    label: allocation.name,
                    value: parseFloat( allocation.amount ).toFixed( 2 ),
                    backgroundColor: allocation.color
                });
            }.bind(this));
        },

        displayChart(){
            let ctx = document.getElementById('current-allocation').getContext('2d');

            this.chart = new Chart(
                ctx,
                {
                    type: 'pie',
                    data: {
                        labels: this.chartData.map( function( value ){
                            return value.label
                        }),
                        datasets: [{
                            data: this.chartData.map( function( value ){
                                return value.value
                            }),
                            backgroundColor: this.chartData.map( function( value ){
                                return value.backgroundColor
                            })
                        }]
                    },
                    options: {
                        tooltips: {
                            callbacks: {
                                label: function( tooltipItem, data ){
                                    let label = data.labels[ tooltipItem.index ] || '';

                                    if( label ) {
                                        label += ': ';
                                    }

                                    label += this.formatMoney( data.datasets[ tooltipItem.datasetIndex ].data[ tooltipItem.index ] );
                                    return label;
                                }.bind(this)
                            }
                        }
                    }
                }
            )
        },

        updateChart(){
            this.chart.data.labels.push()
            
            this.chart.data.labels = this.chartData.map( function( value ){
                return value.label
            });

            this.chart.data.datasets = [{
                data: this.chartData.map( function( value ){
                    return value.value
                }),
                backgroundColor: this.chartData.map( function( value ){
                    return value.backgroundColor
                })
            }];

            this.chart.update();
        },

        promptAddAllocation(){
            EventBus.$emit('prompt-add-allocation');
        },

        promptEditAllocations(){
            EventBus.$emit('prompt-edit-allocations');
        }
    }
}
</script>