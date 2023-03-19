<template>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:p-6">
      <dt class="truncate text-sm font-medium text-gray-500">Total Spent</dt>
      <dd class="mt-1 text-3xl font-semibold text-gray-900">
        {{ formatMoney(totalSpent) }}
      </dd>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import { FormatMoney } from '../../../Mixins/formatMoney';

export default {
  mixins: [FormatMoney],
  data() {
    return {
      totalSpent: 0.0,
    };
  },

  computed: {
    ...mapState('transactions/table', {
      transactions: (state) => state.transactions,
    }),
  },

  watch: {
    transactions() {
      this.computeTotalSpent();
    },
  },

  methods: {
    computeTotalSpent() {
      this.totalSpent = 0.0;

      this.transactions.forEach((transaction) => {
        if (transaction.direction == 'outflow') {
          this.totalSpent += parseFloat(transaction.amount);
        }
      });
    },
  },
};
</script>
