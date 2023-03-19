<template>
  <div class="col-span-8 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 font-sans font-semibold text-astronaut-500 sm:px-6">
      Income vs Expense: {{ startDate }} - {{ endDate }}
    </div>
    <div class="px-4 py-5 sm:p-6">
      <canvas id="income-vs-expense" class="h-64" width="250"></canvas>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
import Chart from 'chart.js';
import TransactionsAPI from '../../api/transactions.js';
import { FormatMoney } from '../../Mixins/formatMoney';

export default {
  mixins: [FormatMoney],

  data() {
    return {
      transactions: [],
      loading: false,
      chart: '',
      chartData: [],
    };
  },

  computed: {
    startDate() {
      return moment().subtract('2', 'month').format('MMM YYYY');
    },

    endDate() {
      return moment().format('MMM YYYY');
    },
  },

  mounted() {
    this.configureWidget();
  },

  methods: {
    configureWidget() {
      this.primeChartData();

      this.loading = true;

      TransactionsAPI.index({
        start_date: moment(this.startDate, 'MMM YYYY').format('YYYY-MM-DD'),
        end_date: moment(this.endDate, 'MMM YYYY').endOf('month').format('YYYY-MM-DD'),
      }).then((response) => {
        this.prepareData(response.data);
      });
    },

    primeChartData() {
      this.chartData = [
        {
          label: moment(this.endDate, 'MMM, YYYY').subtract('2', 'month').format('MMM YYYY'),
          expenses: 0.0,
          income: 0.0,
        },
        {
          label: moment(this.endDate, 'MMM, YYYY').subtract('1', 'month').format('MMM YYYY'),
          expenses: 0.0,
          income: 0.0,
        },
        {
          label: moment(this.endDate, 'MMM, YYYY').format('MMM YYYY'),
          expenses: 0.0,
          income: 0.0,
        },
      ];
    },

    prepareData(transactions) {
      this.transactions = transactions;

      this.groupData();
      this.displayGraph();
    },

    groupData() {
      this.transactions.forEach((transaction) => {
        const date = moment(transaction.date).format('MMM YYYY');

        for (let i = 0; i < this.chartData.length; i++) {
          if (this.chartData[i].label == date) {
            if (transaction.direction == 'outflow') {
              this.chartData[i].expenses += parseFloat(transaction.amount);
            }

            if (transaction.direction == 'inflow') {
              this.chartData[i].income += parseFloat(transaction.amount);
            }
            break;
          }
        }
      });
    },

    buildLabels() {
      this.transactions.forEach((transaction) => {
        const date = moment(transaction.date).format('MMM. YYYY');

        if (this.labels.indexOf(date) < 0) {
          this.labels.push(date);
        }
      });
    },

    displayGraph() {
      const ctx = document.getElementById('income-vs-expense').getContext('2d');

      this.chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: this.chartData.map((value) => value.label),
          datasets: [
            {
              backgroundColor: 'rgb(240, 82, 82)',
              borderColor: 'rgb(240, 82, 82)',
              borderWidth: 3,
              label: 'Expenses',
              data: [
                this.chartData[0].expenses.toFixed(2),
                this.chartData[1].expenses.toFixed(2),
                this.chartData[2].expenses.toFixed(2),
              ],
            },
            {
              backgroundColor: 'rgb( 14, 159, 110 )',
              borderColor: 'rgb( 14, 159, 110 )',
              borderWidth: 3,
              label: 'Income',
              data: [
                this.chartData[0].income.toFixed(2),
                this.chartData[1].income.toFixed(2),
                this.chartData[2].income.toFixed(2),
              ],
            },
          ],
        },
        options: {
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  callback: function (value, index, values) {
                    return this.formatMoney(value);
                  }.bind(this),
                },
              },
            ],
          },
          tooltips: {
            callbacks: {
              label: function (tooltipItem, data) {
                let label = data.datasets[tooltipItem.datasetIndex].label || '';

                if (label) {
                  label += ': ';
                }
                label += this.formatMoney(tooltipItem.yLabel);
                return label;
              }.bind(this),
            },
          },
        },
      });
    },
  },
};
</script>
