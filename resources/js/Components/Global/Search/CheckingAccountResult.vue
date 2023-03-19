<template>
  <Link
    :href="'/checking-accounts/' + checkingAccount.id"
    class="flex items-center p-2 text-sm text-gray-500 hover:bg-gray-50"
  >
    <span class="w-24 text-green-500">
      {{ formatMoney(checkingAccount.current_balance) }}
    </span>

    <span class="pr-2">{{ checkingAccount.name }}</span>
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
  props: ['checkingAccount'],
};
</script>
