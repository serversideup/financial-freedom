<template>
  <div class="col-span-4 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 font-sans font-semibold text-astronaut-500 sm:px-6">
      Category Breakdown
    </div>
    <div class="overflow-y-scroll px-4 pt-5 sm:p-6"></div>
  </div>
</template>
<script>
import { FormatMoney } from '@/Mixins/formatMoney';
import TransactionsAPI from '@/api/transactions.js';

export default {
  mixins: [FormatMoney],
  data() {
    return {
      breakdown: [],
      transactions: [],
    };
  },

  mounted() {
    this.loadTransactions();
  },

  methods: {
    loadTransactions() {
      TransactionsAPI.index({
        start_date: moment().startOf('month').format('YYYY-MM-DD'),
        end_date: moment().endOf('month').format('YYYY-MM-DD'),
      }).then((response) => {
        this.transactions = response.data;
        this.computeCategoryBreakdown();
      });
    },

    computeCategoryBreakdown() {},
  },
};
</script>
