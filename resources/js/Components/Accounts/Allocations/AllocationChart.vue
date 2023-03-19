<template>
  <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 font-sans font-semibold text-astronaut-500 sm:px-6">
      Current Allocation
    </div>
    <div class="h-96 py-5">
      <canvas id="current-allocation"></canvas>
    </div>
  </div>
</template>

<script>
import Chart from 'chart.js';
import { FormatMoney } from '@/Mixins/formatMoney.js';

export default {
  mixins: [FormatMoney],
  props: ['allocations', 'unAllocatedAmount'],

  data() {
    return {
      chartData: [],
      chart: '',
    };
  },

  watch: {
    allocations() {
      if (this.allocations.length > 0) {
        this.configureChart();
      }
    },
  },

  methods: {
    configureChart() {
      this.prepareChartData();

      if (this.chart == '') {
        this.displayChart();
      } else {
        this.updateChart();
      }
    },

    prepareChartData() {
      this.chartData = [];

      this.chartData.push({
        label: 'Un-allocated',
        value: this.unAllocatedAmount.toFixed(2),
      });

      this.allocations.forEach((allocation) => {
        this.chartData.push({
          label: allocation.name,
          value: parseFloat(allocation.amount).toFixed(2),
          backgroundColor: allocation.color,
        });
      });
    },

    displayChart() {
      const ctx = document.getElementById('current-allocation').getContext('2d');

      this.chart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: this.chartData.map((value) => value.label),
          datasets: [
            {
              data: this.chartData.map((value) => value.value),
              backgroundColor: this.chartData.map((value) => value.backgroundColor),
            },
          ],
        },
        options: {
          tooltips: {
            callbacks: {
              label: function (tooltipItem, data) {
                let label = data.labels[tooltipItem.index] || '';

                if (label) {
                  label += ': ';
                }

                label += this.formatMoney(
                  data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index],
                );
                return label;
              }.bind(this),
            },
          },
        },
      });
    },

    updateChart() {
      this.chart.data.labels.push();

      this.chart.data.labels = this.chartData.map((value) => value.label);

      this.chart.data.datasets = [
        {
          data: this.chartData.map((value) => value.value),
          backgroundColor: this.chartData.map((value) => value.backgroundColor),
        },
      ];

      this.chart.update();
    },
  },
};
</script>
