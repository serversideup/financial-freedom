<template>
  <div class="mx-auto mt-10 w-full max-w-screen-md">
    <h3
      class="mb-5 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
    >
      Splits
    </h3>

    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Name
                  </th>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Amount
                  </th>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Category
                  </th>
                  <th
                    scope="col"
                    class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  ></th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-show="transaction.splits.length == 0" class="bg-white">
                  <td colspan="4">
                    <div
                      class="flex w-full flex-col items-center p-10 text-center text-astronaut-400"
                    >
                      <svg
                        class="mb-5 h-12 w-12"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"
                        ></path>
                      </svg>
                      Splitting a transaction allows you to allocate your amount spent to your
                      budget more precisely.
                      <button
                        type="button"
                        class="mt-5 inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        @click="promptSplitTransaction()"
                      >
                        Split Transaction
                      </button>
                    </div>
                  </td>
                </tr>

                <tr v-for="split in transaction.splits" :key="'transaction-split-' + split.id">
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    {{ split.name }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                    {{ formatMoney(split.amount) }}
                  </td>
                  <td>
                    <span
                      class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                      :class="[
                        'bg-' + split.category.color + '-100',
                        'text-' + split.category.color + '-800',
                      ]"
                    >
                      {{ split.category.name }}
                    </span>
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm">
                    <button type="button" class="text-red-500" @click="removeSplit(split.id)">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                      </svg>
                    </button>
                  </td>
                </tr>

                <tr v-show="transaction.splits.length > 0">
                  <td colspan="4" class="px-6 py-4 text-right">
                    <button
                      type="button"
                      class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                      @click="promptSplitTransaction()"
                    >
                      Split Transaction
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import { FormatMoney } from '@/Mixins/formatMoney.js';
import TransactionsAPI from '@/api/transactions.js';

export default {
  mixins: [FormatMoney],
  props: ['transaction'],

  methods: {
    promptSplitTransaction() {
      EventBus.emit('prompt-split-transaction');
    },

    removeSplit(splitID) {
      TransactionsAPI.removeSplit(this.transaction.id, splitID).then((response) => {
        EventBus.emit('notify', {
          type: 'success',
          title: 'Transaction Split Deleted',
          message: 'Your transaction split has been deleted',
          action: 'close',
        });

        EventBus.emit('reload-transaction');
      });
    },
  },
};
</script>
