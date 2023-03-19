<template>
  <div>
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-4 mt-5">
        <div
          class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:border-gray-400"
        >
          <div class="flex-shrink-0">
            <img
              v-if="account.institution"
              class="h-10 w-10 rounded-full"
              :src="account.institution.logo"
              alt=""
            />
          </div>
          <div class="min-w-0 flex-1">
            <a href="#" class="focus:outline-none">
              <span class="absolute inset-0" aria-hidden="true" />
              <p class="text-sm font-medium text-gray-900">
                {{ account.name }}
              </p>
              <p class="truncate text-sm text-gray-500">
                {{ account.description }}
              </p>
            </a>
          </div>
        </div>
      </div>

      <div class="col-span-4 mt-5">
        <div
          class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:border-gray-400"
        >
          <div class="min-w-0 flex-1">
            <a href="#" class="focus:outline-none">
              <span class="absolute inset-0" aria-hidden="true" />
              <p class="text-sm font-medium text-gray-900">New Account Balance</p>
              <p class="truncate text-sm text-gray-500">$300.00</p>
            </a>
          </div>
        </div>
      </div>

      <div class="col-span-2 mt-5">
        <div class="mt-1 flex flex-col items-center justify-center overflow-hidden">
          <button
            type="button"
            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            @click="addTransactionRule()"
          >
            Add Rule
          </button>
        </div>
      </div>

      <div class="col-span-2 mt-5">
        <div class="mt-1 flex flex-col items-center justify-center overflow-hidden">
          <div class="mb-1 flex w-full items-center justify-center">
            <input v-model="accountBalanceSync" type="checkbox" value="yes" class="mr-1" />
            Sync account balance
          </div>
          <button
            type="button"
            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            @click="importTransactions()"
          >
            Import
          </button>
        </div>
      </div>

      <div class="col-span-12 mt-5">
        <div class="flex flex-col shadow">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-3 py-3"></th>
                      <th
                        scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                      >
                        Direction
                      </th>
                      <th
                        scope="col"
                        class="max-w-xs px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                      >
                        Category
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                      >
                        Name
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                      >
                        Amount
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                      >
                        Date
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                      ></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="loading" colspan="8" class="p-6 text-center">
                      Loading...
                    </tr>
                    <import-row
                      v-for="(transaction, key) in pendingTransactions"
                      :key="'transaction-' + key"
                      :index="key"
                      :transaction="transaction"
                      :categories="categories"
                      :sync-balances="accountBalanceSync"
                    />
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Papa from 'papaparse';
import moment from 'moment';

import { mapState } from 'vuex';
import { EventBus } from '@/event-bus.js';
import { FormatCSVImport } from '@/Mixins/formatCSVImport.js';

import TransactionsAPI from '@/api/transactions.js';
// import Tags from '../../../../Components/Transactions/Tags.vue';
import ImportRow from './ImportRow.vue';

export default {
  props: ['categories', 'rules'],

  data() {
    return {
      loading: false,
      pendingTransactions: [],
      startDate: moment(),
      endDate: 0,
      accountBalanceSync: false,
    };
  },

  computed: {
    ...mapState('transactions/importProcess', {
      transactions: (state) => state.transactions,
      account: (state) => state.account,
    }),
  },

  components: {
    ImportRow,
  },

  mixins: [FormatCSVImport],

  watch: {
    transactions() {
      this.loadTransactions();
    },
  },

  mounted() {
    EventBus.on('remove-transaction', (key) => {
      this.pendingTransactions.splice(key, 1);
    });

    EventBus.on('transaction-persisted', (key) => {
      this.pendingTransactions[key].imported = true;
    });

    EventBus.on('new-rule-added', (rule) => {
      this.applyNewRule(rule);
    });
  },

  methods: {
    loadTransactions() {
      this.loading = true;
      Papa.parse(this.transactions, {
        header: true,
        skipEmptyLines: true,
        complete: function (results) {
          this.formatCSVImport(results.data);
          this.checkForDuplicates();
          this.loading = false;
        }.bind(this),
      });
    },

    importTransactions() {
      TransactionsAPI.import(this.account, this.pendingTransactions).then((response) => {
        this.$inertia.visit('/transactions');
      });
    },

    checkForDuplicates() {
      this.findStartAndEndDates();
      this.loadPotentialTransactions();
    },

    findStartAndEndDates() {
      for (let i = 0; i < this.pendingTransactions.length; i++) {
        const transactionDate = moment(this.pendingTransactions[i].date);

        if (transactionDate.format('X') < moment(this.startDate).format('X')) {
          this.startDate = moment(this.pendingTransactions[i].date);
        }

        if (transactionDate.format('X') > moment(this.endDate).format('X')) {
          this.endDate = moment(this.pendingTransactions[i].date);
        }
      }
    },

    loadPotentialTransactions() {
      const params = {};

      params.start_date = moment(this.startDate).format('YYYY-MM-DD');
      params.end_date = moment(this.endDate).format('YYYY-MM-DD');

      TransactionsAPI.index(params).then((response) => {
        this.compareTransactions(response.data);
      });
    },

    compareTransactions(existingTransactions) {
      for (let i = 0; i < this.pendingTransactions.length; i++) {
        for (let k = 0; k < existingTransactions.length; k++) {
          if (this.validateUnique(this.pendingTransactions[i], existingTransactions[k])) {
            this.pendingTransactions[i].potential_duplicate = existingTransactions[k];
            break;
          }
        }
      }
    },

    validateUnique(transaction, existingTransaction) {
      if (
        moment(transaction.date).format('YYYY-MM-DD') ==
          moment(existingTransaction.date).format('YYYY-MM-DD') &&
        Math.abs(parseFloat(transaction.amount)) == existingTransaction.amount
      ) {
        return true;
      }
      return false;
    },

    addTransactionRule() {
      console.log('asdf');
      EventBus.emit('prompt-add-rule');
    },

    applyNewRule(rule) {
      this.pendingTransactions.forEach((transaction, index) => {
        if (transaction.name.search(rule.find) > -1) {
          transaction.name = rule.replace;
          transaction.category = rule.category ? rule.category : '';
        }
      });
    },
  },
};
</script>
