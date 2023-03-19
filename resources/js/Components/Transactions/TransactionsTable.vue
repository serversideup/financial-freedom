<template>
  <div>
    <div class="flex items-center justify-between">
      <div class="mb-3 flex-shrink-0 md:flex md:items-center md:justify-end">
        <div class="flex flex-col items-center">
          <span class="relative z-0 inline-flex shadow-sm">
            <button
              type="button"
              class="focus:shadow-outline-blue relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-3 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-500"
              aria-label="Previous"
              @click="viewPreviousMonth()"
            >
              <!-- Heroicon name: chevron-left -->
              <svg
                class="h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </button>
            <button
              type="button"
              class="focus:shadow-outline-blue relative -ml-px inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
            >
              <span class="font-sans text-astronaut-500">{{
                currentTime ? currentTime.format('MMM YYYY') : ''
              }}</span>
            </button>
            <button
              type="button"
              class="focus:shadow-outline-blue relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-3 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-500"
              aria-label="Next"
              @click="viewNextMonth()"
            >
              <!-- Heroicon name: chevron-right -->
              <svg
                class="h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </button>
          </span>
        </div>
      </div>

      <div v-if="allowSearching" class="mx-5 mb-3 w-full">
        <input
          v-model="search"
          type="text"
          class="block w-full rounded-md border-gray-300 shadow-sm"
          placeholder="Search..."
        />
      </div>

      <div class="mb-3 md:flex md:items-center md:justify-end">
        <slot name="buttons"></slot>

        <button
          v-if="buttons.indexOf('filter') > -1"
          id="transactions-show-filters"
          :class="{ 'rounded-l-md': !$slots.buttons }"
          type="button"
          class="focus:shadow-outline-blue relative -ml-px inline-flex items-center border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          @click="showFilters = true"
        >
          <!-- Heroicon name: filter -->
          <svg
            class="h-5 w-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
            ></path>
          </svg>
          <span class="ml-1">Filter</span>

          <filter-popup :show="showFilters" :categories="categories" />
        </button>

        <button
          v-if="buttons.indexOf('add') > -1"
          type="button"
          class="focus:shadow-outline-blue relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          @click="promptAddTransaction()"
        >
          <svg
            class="h-5 w-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
            ></path>
          </svg>
          <span class="ml-1">Add</span>
        </button>
      </div>
    </div>

    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
      <div class="px-4 py-5 font-sans font-semibold text-astronaut-500 sm:px-6">Transactions</div>
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th v-if="columns.indexOf('select') > -1" class="bg-gray-50 px-6 py-3 text-left">
                    <input type="checkbox" />
                  </th>
                  <th
                    v-if="columns.indexOf('amount') > -1"
                    class="cursor-pointer bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                  >
                    Amount
                  </th>
                  <th
                    v-if="columns.indexOf('date') > -1"
                    class="cursor-pointer bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                  >
                    Date
                  </th>
                  <th
                    v-if="columns.indexOf('account') > -1"
                    class="cursor-pointer bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                  >
                    Account
                  </th>
                  <th
                    v-if="columns.indexOf('name') > -1"
                    class="cursor-pointer bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                  >
                    Name
                  </th>
                  <th
                    v-if="columns.indexOf('tags') > -1"
                    class="cursor-pointer bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                  >
                    Tags
                  </th>
                  <th
                    v-if="columns.indexOf('category') > -1"
                    class="cursor-pointer bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500"
                  >
                    Category
                  </th>
                  <th v-if="columns.indexOf('edit') > -1" class="bg-gray-50 px-6 py-3"></th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-show="loading">
                  <td colspan="7" class="p-10 text-center font-sans">
                    <img class="inline-block" src="/img/ui/loading.svg" />
                  </td>
                </tr>
                <tr v-show="!loading && transactions.length == 0">
                  <td colspan="7" class="p-10 text-center font-sans">
                    No transactions have been entered for the filters provided.
                  </td>
                </tr>
                <tr
                  v-for="transaction in transactions"
                  v-show="!loading && transactions.length > 0 && filterTransaction(transaction)"
                  :key="'transaction-' + transaction.id"
                >
                  <td v-if="columns.indexOf('select') > -1" class="px-6 py-3">
                    <input v-model="selectedTransactions" type="checkbox" :value="transaction.id" />
                  </td>
                  <td
                    v-if="columns.indexOf('amount') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-sm font-medium leading-5 text-gray-500"
                  >
                    <div class="flex items-center justify-between">
                      <span v-if="transaction.direction == 'outflow'" class="text-red-500">
                        -{{ formatMoney(transaction.amount) }}
                      </span>
                      <span v-if="transaction.direction == 'inflow'" class="text-green-500">
                        {{ formatMoney(transaction.amount) }}
                      </span>
                      <span v-if="transaction.direction == 'transfer'" class="italic text-gray-500">
                        {{ formatMoney(transaction.amount) }}
                      </span>
                    </div>
                  </td>
                  <td
                    v-if="columns.indexOf('date') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-sm leading-5 text-gray-500"
                  >
                    {{ formatDate(transaction.date) }}
                  </td>
                  <td
                    v-if="columns.indexOf('account') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-sm leading-5 text-gray-500"
                  >
                    {{ transaction.accountable.institution.name }}:
                    {{ transaction.accountable.name }}
                  </td>
                  <td
                    v-if="columns.indexOf('name') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-sm leading-5 text-gray-500"
                  >
                    {{ transaction.name }}
                  </td>
                  <td
                    v-if="columns.indexOf('tags') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-sm leading-5 text-gray-500"
                  >
                    <div v-if="!transaction.is_split">
                      <span
                        v-for="(tag, key) in transaction.tags"
                        :key="'transaction-' + transaction.id + '-tag-' + key"
                        class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                        :class="['bg-' + tag.color + '-100', 'text-' + tag.color + '-800']"
                      >
                        {{ tag.name }}
                      </span>
                    </div>

                    <div v-if="transaction.is_split">
                      <span
                        v-for="(tag, key) in getTransactionSplitTags(transaction)"
                        :key="'transaction-' + transaction.id + '-tag-' + key"
                        class="mr-1 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                        :class="['bg-' + tag.color + '-100', 'text-' + tag.color + '-800']"
                      >
                        {{ tag.name }}
                      </span>
                    </div>
                  </td>
                  <td
                    v-if="columns.indexOf('category') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-sm leading-5 text-gray-500"
                  >
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
                        :class="[
                          'bg-' + split.category.color + '-100',
                          'text-' + split.category.color + '-800',
                        ]"
                      >
                        {{ split.category.name }}
                      </span>
                    </div>
                  </td>
                  <td
                    v-if="columns.indexOf('edit') > -1"
                    class="whitespace-no-wrap px-6 py-4 text-right text-sm font-medium leading-5"
                  >
                    <Link
                      :href="'/transactions/' + transaction.id"
                      class="text-blue-600 hover:text-blue-900"
                      >Edit</Link
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <add-transaction :account="account" :categories="categories" />
  </div>
</template>

<script>
import moment from 'moment';
import { mapState } from 'vuex';
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';
import { EventBus } from '@/event-bus.js';
import TransactionsAPI from '@/api/transactions.js';
import AddTransaction from './AddTransaction.vue';
import FilterPopup from './TransactionsTable/FilterPopup.vue';

export default {
  props: {
    account: {
      type: Object,
      default() {
        return {};
      },
    },
    columns: {
      type: Array,
      default() {
        return ['amount', 'date', 'name', 'category'];
      },
    },
    buttons: {
      type: Array,
      default() {
        return [];
      },
    },
    allowSearching: {
      type: Boolean,
      default() {
        return false;
      },
    },
    categories: {
      type: Array,
      default() {
        return [];
      },
    },
  },

  data() {
    return {
      showFilters: false,
    };
  },

  computed: {
    ...mapState('transactions/table', {
      transactions: (state) => state.transactions,
      selectedTransactions: (state) => state.selectedTransactions,
      loading: (state) => state.loading,
      startDate: (state) => state.startDate,
      endDate: (state) => state.endDate,
      currentTime: (state) => state.currentTime,
      order: (state) => state.order,
      filters: (state) => state.filters,
    }),

    search: {
      get() {
        return this.$store.getters['transactions/table/getSearch'];
      },
      set(value) {
        this.$store.commit('transactions/table/setSearch', value);
      },
    },
  },

  watch: {
    order: {
      deep: true,
      handler() {},
    },

    filters: {
      deep: true,
      handler() {},
    },

    showFilters() {
      if (this.showFilters) {
        document.addEventListener('click', this.toggleShowFilters);
      } else {
        document.removeEventListener('click', this.toggleShowFilters);
      }
    },

    // Allows other components to connect and compute based off of the view
    transactions: {
      deep: true,
      handler() {
        EventBus.emit('current-transactions-updated', this.transactions);
      },
    },
  },

  components: {
    AddTransaction,
    FilterPopup,
    Link,
  },

  mounted() {
    this.bindEvents();
    this.setCurrentTime();
    this.setStartDate();
    this.setEndDate();
    this.loadTransactions();
  },

  mixins: [FormatMoney],

  methods: {
    filterTransaction(transaction) {
      if (this.search == '') {
        return true;
      }
      if (transaction.name.toLowerCase().includes(this.search.toLowerCase())) {
        return true;
      }
      if (transaction.amount.includes(this.search)) {
        return true;
      }
      return false;
    },

    toggleShowFilters(e) {
      if (
        !document.getElementById('transactions-filter-popup').contains(e.target) &&
        !document.getElementById('transactions-show-filters').contains(e.target)
      ) {
        this.showFilters = false;
      }
    },

    bindEvents() {
      EventBus.on('transaction-filters-updated', (data) => {
        this.filters.direction = data.direction;
        this.filters.tags = data.tags;
        this.filters.category = data.category;

        this.loadTransactions();
      });
    },

    viewPreviousMonth() {
      this.$store.commit(
        'transactions/table/setCurrentTime',
        this.currentTime.clone().subtract('1', 'month'),
      );
      this.setStartDate();
      this.setEndDate();
      this.loadTransactions();
    },

    viewNextMonth() {
      this.$store.commit(
        'transactions/table/setCurrentTime',
        this.currentTime.clone().add('1', 'month'),
      );
      this.setStartDate();
      this.setEndDate();
      this.loadTransactions();
    },

    setCurrentTime() {
      this.$store.commit('transactions/table/setCurrentTime', moment());
    },

    setStartDate(date = null) {
      if (date) {
        this.$store.commit('transactions/table/setStartDate', moment(date));
      } else {
        this.$store.commit(
          'transactions/table/setStartDate',
          moment(this.currentTime, 'MMM YYYY').startOf('month'),
        );
      }
    },

    setEndDate(date = null) {
      if (date) {
        this.$store.commit('transactions/table/setEndDate', moment(date));
      } else {
        this.$store.commit(
          'transactions/table/setEndDate',
          moment(this.currentTime, 'MMM YYYY').endOf('month'),
        );
      }
    },

    loadTransactions() {
      const params = {};

      if (this.account) {
        params.account = this.account.id;
        params.account_type = this.account.account_type;
      }

      if (this.filters.category != '') {
        params.category = this.filters.category;
      }

      if (this.filters.tags.length > 0) {
        params.tags = this.filters.tags.map((tag) => tag.id).join(',');
      }

      if (this.filters.direction != 'all') {
        params.direction = this.filters.direction;
      }

      params.order_column = this.order.column;
      params.order_direction = this.order.direction;

      params.start_date = moment(this.startDate).format('YYYY-MM-DD');
      params.end_date = moment(this.endDate).format('YYYY-MM-DD');

      TransactionsAPI.index(params).then((response) => {
        this.$store.commit('transactions/table/setTransactions', response.data);
      });
    },

    formatDate(date) {
      return moment(date, 'YYYY-MM-DD').format('L');
    },

    promptAddTransaction() {
      EventBus.emit('prompt-add-transaction');
    },

    promptFilterTransactions() {},

    getTransactionSplitTags(transaction) {
      const tags = [];

      transaction.splits.forEach((split) => {
        split.tags.forEach((tag) => {
          tags.push(tag);
        });
      });

      return tags;
    },
  },
};
</script>
