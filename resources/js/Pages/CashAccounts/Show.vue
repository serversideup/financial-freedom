<template>
  <app-layout>
    <div v-if="loaded">
      <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2
            class="flex w-full items-center text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
          >
            {{ cashAccount.name }}
          </h2>
        </div>
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
          <button
            class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center rounded-l-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="mr-px h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              />
            </svg>

            Add Transaction
          </button>
          <button
            class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center rounded-r-md border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
            @click="promptEdit()"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="mr-px h-4 w-4"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
              />
            </svg>

            Edit Account
          </button>
        </span>
      </div>
    </div>
    <div v-if="loaded" class="mt-5">
      <stats
        :account="cashAccount"
        :type="'cash'"
        :fields="['current_balance', 'amount_changed', 'transactions_changed']"
      />

      <div class="mt-5 grid grid-cols-2 gap-4">
        <allocations :account="cashAccount" />
        <transactions-table
          :account="cashAccount"
          :columns="['amount', 'date', 'name', 'category']"
          :buttons="['filter', 'add']"
        />
      </div>
    </div>
    <edit />
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout';
import CashAccountsAPI from '../../api/cashAccounts.js';
import Stats from '../../Components/Accounts/Stats.vue';
import Allocations from '../../Components/Accounts/Allocations.vue';
import Edit from '../../Components/Accounts/CashAccount/Edit.vue';
import TransactionsTable from '../../Components/Transactions/TransactionsTable.vue';
import { EventBus } from '../../event-bus.js';

export default {
  components: {
    AppLayout,
    Allocations,
    Stats,
    Edit,
    TransactionsTable,
  },
  props: ['id'],

  data() {
    return {
      loaded: false,
      cashAccount: {},
    };
  },

  mounted() {
    this.bindEvents();
    this.loadCashAccount();
  },

  methods: {
    bindEvents() {
      EventBus.on('cash-account-updated', () => {
        this.loadCashAccount();
      });
    },

    promptEdit() {
      EventBus.emit('prompt-edit-account', this.cashAccount);
    },

    loadCashAccount() {
      CashAccountsAPI.show(this.id).then((response) => {
        this.cashAccount = response.data;
        this.loaded = true;
      });
    },
  },
};
</script>
