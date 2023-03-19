<template>
  <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 font-sans font-semibold text-astronaut-500 sm:px-6">Tag Breakdown</div>
    <div class="overflow-y-scroll px-4 pt-5 sm:p-6">
      <div
        v-for="tag in breakdown"
        :key="'tag-breakdown-' + tag.id"
        class="flex items-center justify-between p-1"
      >
        <span
          class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
          :class="['bg-' + tag.color + '-100', 'text-' + tag.color + '-800']"
        >
          {{ tag.name }}
        </span>

        <span class="font-sans text-sm">{{ formatMoney(tag.tag_total) }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import { FormatMoney } from '../../Mixins/formatMoney';
import TransactionsAPI from '../../api/transactions.js';

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
        this.computeTagBreakdown();
      });
    },

    computeTagBreakdown() {
      const tagGroup = {};

      for (let i = 0; i < this.transactions.length; i++) {
        if (this.transactions[i].direction == 'outflow') {
          for (let k = 0; k < this.transactions[i].tags.length; k++) {
            if (!tagGroup[this.transactions[i].tags[k].name.replace('-', '_')]) {
              tagGroup[this.transactions[i].tags[k].name.replace('-', '_')] =
                this.transactions[i].tags[k];
              tagGroup[this.transactions[i].tags[k].name.replace('-', '_')].tag_total = 0.0;
            }

            tagGroup[this.transactions[i].tags[k].name.replace('-', '_')].tag_total += parseFloat(
              this.transactions[i].amount,
            );
          }
        }
      }

      for (const key of Object.keys(tagGroup)) {
        this.breakdown.push(tagGroup[key]);
      }

      this.breakdown.sort((a, b) => a.tag_total < b.tag_total);
    },
  },
};
</script>
