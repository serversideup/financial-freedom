<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
        <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
            Current Allocation
        </div>
        <div class="py-5 h-96">
            <canvas id="current-allocation"></canvas>
        </div>
    </div>
</template>

<script>
import { FormatMoney } from '@/Mixins/formatMoney.js';
import Chart from 'chart.js';

export default {
    props: ['allocations', 'unAllocatedAmount'],

    data(){
        return {
            chartData: [],
            chart: ''
        }
    },

    mixins: [
        FormatMoney
    ],

    watch: {
        allocations(){
            if( this.allocations.length > 0 ){
                this.configureChart();
            }
        }
    },

    methods: {
        configureChart(){
            this.prepareChartData();

            if( this.chart == '' ){
                this.displayChart();
            }else{
                this.updateChart();
            } 
        },

        prepareChartData(){
            this.chartData = [];

            this.chartData.push({
                label: "Un-allocated",
                value: this.unAllocatedAmount.toFixed( 2 )
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
    }
}
</script>