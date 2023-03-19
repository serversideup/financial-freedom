<template>
  <Link
    :href="'/transactions/' + transaction.id"
    class="flex items-center p-2 text-sm text-gray-500 hover:bg-gray-50"
  >
    <span v-if="transaction.direction == 'outflow'" class="w-24 text-red-500">
      -{{ formatMoney(transaction.amount) }}
    </span>
    <span v-if="transaction.direction == 'inflow'" class="w-24 text-green-500">
      {{ formatMoney(transaction.amount) }}
    </span>

    <span class="w-20">{{ transactionDate }}</span>
    <span class="pr-2">{{ transaction.name }}</span>

    <div v-if="!transaction.is_split">
      <span
        class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
        :class="[
          'bg-' + transaction.category.color + '-100',
          'text-' + transaction.category.color + '-800',
        ]"
      >
        {{ transaction.category.name }}
      </span>
    </div>

    <div v-if="transaction.is_split">
      <span
        v-for="split in transaction.splits"
        :key="'transaction-split-' + split.id"
        class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
        :class="['bg-' + split.category.color + '-100', 'text-' + split.category.color + '-800']"
      >
        {{ split.category.name }}
      </span>
    </div>
  </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
  components: {
    Link,
  },

  mixins: [FormatMoney],
  props: ['transaction'],

  computed: {
    transactionDate() {
      return moment(this.transaction.date, 'YYYY-MM-DD').format('L');
    },
  },
};
</script>
