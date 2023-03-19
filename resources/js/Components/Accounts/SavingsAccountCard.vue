<template>
  <div class="overflow-hidden rounded-lg bg-white shadow">
    <div class="p-5">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <img :src="account.institution.logo" class="h-8 w-8 rounded-full" />
        </div>
        <div class="ml-5 w-0 flex-1">
          <dl>
            <dt class="truncate text-sm font-medium leading-5 text-gray-500">
              {{ account.institution.name }}: Savings
            </dt>
            <dd class="truncate text-xs italic text-gray-500">
              {{ account.description }}
            </dd>
            <dd>
              <div class="text-lg font-medium leading-7 text-gray-900">
                {{ formatMoney(account.current_balance) }}
              </div>
            </dd>
          </dl>
        </div>
      </div>
    </div>
    <div class="bg-gray-50 px-5 py-3">
      <div class="text-sm leading-5">
        <Link
          :href="'/savings-accounts/' + account.id"
          class="font-medium text-blue-600 transition duration-150 ease-in-out hover:text-blue-900"
        >
          View account
        </Link>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '../../Mixins/formatMoney.js';

export default {
  components: {
    Link,
  },

  mixins: [FormatMoney],
  props: ['account'],
};
</script>
