<template>
  <app-modal :size="'medium'" :show="show">
    <template #image>
      <div
        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 text-blue-600"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
          />
        </svg>
      </div>
    </template>
    <template #header> Check Potential Duplicate </template>
    <template #body>
      <div v-if="key !== null" class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                    >
                      Field
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                    >
                      Existing
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                    >
                      New
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                      Amount
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatMoney(Math.abs(parseFloat(transaction.amount))) }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{
                        formatMoney(Math.abs(parseFloat(transaction.potential_duplicate.amount)))
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                      Date
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatDate(transaction.date) }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ formatDate(transaction.potential_duplicate.date) }}
                    </td>
                  </tr>
                  <tr>
                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                      Name
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ transaction.name }}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                      {{ transaction.potential_duplicate.name }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </template>
    <template #footer>
      <button
        type="button"
        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
        @click="cancel()"
      >
        Cancel
      </button>
      <button
        type="button"
        class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
        @click="remove()"
      >
        Remove
      </button>
    </template>
  </app-modal>
</template>

<script>
import moment from 'moment';
import AppModal from '../../../../Components/Global/AppModal.vue';
import { EventBus } from '../../../../event-bus.js';
import { FormatMoney } from '../../../../Mixins/formatMoney';

export default {
  components: {
    AppModal,
  },

  mixins: [FormatMoney],

  data() {
    return {
      show: false,
      transaction: {},
      key: null,
    };
  },

  mounted() {
    this.bindEvents();
  },

  methods: {
    bindEvents() {
      EventBus.on('view-potential-duplicate', (data) => {
        this.transaction = data.transaction;
        this.key = data.key;
        this.show = true;
      });

      EventBus.on('close-modal', () => {
        this.show = false;
      });
    },

    formatDate(date) {
      return moment(date).format('MM/DD/YYYY');
    },

    remove() {
      EventBus.emit('remove-transaction', this.key);
      this.cancel();
    },

    cancel() {
      this.key = null;
      this.show = false;
      this.transaction = {};

      EventBus.emit('close-modal');
    },
  },
};
</script>
