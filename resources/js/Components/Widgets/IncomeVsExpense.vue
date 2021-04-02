<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200 col-span-2">
        <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
            Income vs Expense: {{ startDate }} - {{ endDate }}
        </div>
        <div class="px-4 py-5 sm:p-6">
            <canvas id="income-vs-expense" class="h-64" width="250"></canvas>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import TransactionsAPI from '../../api/transactions.js';
import Chart from 'chart.js';
import { FormatMoney } from '../../Mixins/formatMoney';

export default {
    mixins: [
        FormatMoney
    ],

    data(){
        return {
            transactions: [],
            loading: false,
            chart: '',
            chartData: [],
        }
    },

    computed: {
        startDate(){
            return moment().subtract('2', 'month').format( 'MMM YYYY');
        },

        endDate(){
            return moment().format( 'MMM YYYY');
        }
    },

    mounted(){
        this.configureWidget();
    },

    methods: {
        configureWidget(){
            this.primeChartData();

            this.loading = true;

            TransactionsAPI.index( {
                start_date: moment( this.startDate, 'MMM YYYY' ).format( 'YYYY-MM-DD' ),
                end_date: moment( this.endDate, 'MMM YYYY' ).endOf('month').format('YYYY-MM-DD')
            } ).then( function( response ){
                this.prepareData( response.data );
            }.bind(this) );
        },

        primeChartData(){
            this.chartData = [
                {
                    label: moment( this.endDate, 'MMM, YYYY').subtract('2', 'month').format('MMM YYYY'),
                    expenses: 0.00,
                    income: 0.00
                },
                {
                    label: moment( this.endDate, 'MMM, YYYY').subtract('1', 'month').format('MMM YYYY'),
                    expenses: 0.00,
                    income: 0.00
                },
                {
                    label: moment( this.endDate, 'MMM, YYYY').format('MMM YYYY'),
                    expenses: 0.00,
                    income: 0.00
                }
            ];
        },

        prepareData( transactions ){
            this.transactions = transactions;

            this.groupData();
            this.displayGraph();
        },

        groupData(){
            
            this.transactions.forEach( function( transaction ){
                let date = moment( transaction.date ).format('MMM YYYY');
                
                for( let i = 0; i < this.chartData.length; i++ ){
                    if( this.chartData[i].label == date ){
                        if( transaction.direction == 'outflow' ){
                            this.chartData[i].expenses += parseFloat( transaction.amount );
                        }

                        if( transaction.direction == 'inflow' ){
                            this.chartData[i].income += parseFloat( transaction.amount );
                        }
                        break;
                    }
                }
            }.bind(this));
        },

        buildLabels(){
            this.transactions.forEach( function( transaction ){
                let date = moment( transaction.date ).format('MMM. YYYY');

                if( this.labels.indexOf( date ) < 0 ){
                    this.labels.push( date );
                }
            }.bind(this));
        },

        displayGraph( ){
            let ctx = document.getElementById('income-vs-expense').getContext('2d');

            this.chart = new Chart(
                            ctx, 
                            {
                                type: 'bar',
                                data: {
                                    labels: this.chartData.map( function( value ){
                                        return value.label
                                    }),
                                    datasets: [{
                                        backgroundColor: 'rgba( 66, 124, 199, .5 )',
                                        borderColor: 'rgba( 66, 124, 199, 1 )',
                                        borderWidth: 3,
                                        label: 'Expenses',
                                        data: [
                                            this.chartData[0].expenses.toFixed(2),
                                            this.chartData[1].expenses.toFixed(2),
                                            this.chartData[2].expenses.toFixed(2)
                                        ],
                                    }, {
                                        backgroundColor: 'rgba( 211, 164, 40, .5 )',
                                        borderColor: 'rgba( 211, 164, 40, 1 )',
                                        borderWidth: 3,
                                        label: 'Income',
                                        data: [
                                            this.chartData[0].income.toFixed(2),
                                            this.chartData[1].income.toFixed(2),
                                            this.chartData[2].income.toFixed(2)
                                        ]
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true,
                                                callback: function(value, index, values) {
                                                    return this.formatMoney( value );
                                                }.bind(this)
                                            }
                                        }]
                                    },
                                    tooltips: {
                                        callbacks: {
                                            label: function(tooltipItem, data) {
                                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                                if (label) {
                                                    label += ': ';
                                                }
                                                label += this.formatMoney( tooltipItem.yLabel )
                                                return label;
                                            }.bind(this)
                                        }
                                    }
                                }
                            });
        }
    }
}
</script>