<template>
  <app-layout>
    <div v-if="transactionLoaded" class="mx-auto mb-5 max-w-screen-md">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
          <li>
            <div>
              <a href="#" class="text-gray-400 hover:text-gray-500">
                <!-- Heroicon name: home -->
                <svg
                  class="h-5 w-5 flex-shrink-0"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                  />
                </svg>
                <span class="sr-only">Home</span>
              </a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <svg
                class="h-5 w-5 flex-shrink-0 text-gray-300"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
                aria-hidden="true"
              >
                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
              </svg>
              <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                >Transactions</a
              >
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <svg
                class="h-5 w-5 flex-shrink-0 text-gray-300"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
                aria-hidden="true"
              >
                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
              </svg>
              <a
                href="#"
                aria-current="page"
                class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                >{{ transaction.name }} {{ formatDate(transaction.date) }}</a
              >
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div v-if="transactionLoaded">
      <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="mx-auto flex w-full max-w-screen-md justify-between">
          <h2
            class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
          >
            <img
              class="mr-2 inline-block h-10 w-10 rounded-full"
              :src="transaction.accountable.institution.logo"
            />
            {{ transaction.accountable.institution.name }}:
            {{ transaction.accountable.name }}
          </h2>
          <div class="text-2xl leading-7 sm:truncate sm:text-3xl sm:leading-9">
            <span v-if="transaction.direction == 'outflow'">-</span
            >{{ formatMoney(transaction.amount) }}
          </div>
        </div>
      </div>
    </div>

    <breakdown v-if="transactionLoaded" :transaction="transaction" :categories="categories" />

    <splits-table
      v-show="transaction.direction == 'outflow'"
      v-if="transactionLoaded"
      :transaction="transaction"
    />

    <split-modal v-if="transactionLoaded" :transaction="transaction" />

    <!--<items-table
            :items="''"/> -->
  </app-layout>
</template>

<script>
import Breakdown from './components/Breakdown.vue';
import ItemsTable from './components/ItemsTable.vue';
import SplitsTable from './components/SplitsTable.vue';
import SplitModal from '../../../Components/Transactions/SplitModal.vue';
import AppLayout from '../../../Layouts/AppLayout';
import { FormatMoney } from '../../../Mixins/formatMoney';
import { EventBus } from '@/event-bus.js';
import TransactionsAPI from '@/api/transactions.js';

export default {
  components: {
    Breakdown,
    AppLayout,
    SplitsTable,
    ItemsTable,
    SplitModal,
  },
  mixins: [FormatMoney],
  props: ['categories'],

  data() {
    return {
      transaction: {},
      transactionLoaded: false,
    };
  },

  mounted() {
    EventBus.on('reload-transaction', () => {
      this.loadTransaction();
    });

    this.loadTransaction();
  },

  methods: {
    formatDate(date) {
      return moment(date, 'YYYY-MM-DD').format('L');
    },

    loadTransaction() {
      TransactionsAPI.show(this.$page.props.transaction.id).then((response) => {
        this.transaction = response.data;
        this.transactionLoaded = true;
      });
    },
  },
};
</script>
