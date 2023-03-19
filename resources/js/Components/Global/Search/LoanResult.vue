<template>
  <Link
    :href="'/loans/' + loan.id"
    class="flex items-center p-2 text-sm text-gray-500 hover:bg-gray-50"
  >
    <span class="w-24 text-red-500"> -{{ formatMoney(loan.current_balance) }} </span>

    <span class="pr-2">{{ loan.name }}</span>
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
  props: ['loan'],
};
</script>
