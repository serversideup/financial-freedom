<template>
  <Link
    :href="'/credit-cards/' + creditCard.id"
    class="flex items-center p-2 text-sm text-gray-500 hover:bg-gray-50"
  >
    <span class="w-24 text-red-500"> -{{ formatMoney(creditCard.current_balance) }} </span>

    <span class="pr-2">{{ creditCard.name }}</span>
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
  props: ['creditCard'],
};
</script>
