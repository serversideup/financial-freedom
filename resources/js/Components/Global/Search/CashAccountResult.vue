<template>
  <Link
    :href="'/cash-accounts/' + cashAccount.id"
    class="flex items-center p-2 text-sm text-gray-500 hover:bg-gray-50"
  >
    <span class="w-24 text-green-500">
      {{ formatMoney(cashAccount.current_balance) }}
    </span>

    <span class="pr-2">{{ cashAccount.name }}</span>
  </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
  components: {
    Link,
  },

  mixins: [FormatMoney],
  props: ['cashAccount'],
};
</script>
