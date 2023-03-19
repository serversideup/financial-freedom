<template>
  <app-modal :size="'small'" :show="show">
    <template #image>
      <svg
        class="h-6 w-6 text-blue-600"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        aria-hidden="true"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        ></path>
      </svg>
    </template>

    <template #header> Add Account </template>

    <template #body>
      <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
        <div class="sm:col-span-6">
          <label for="type" class="block text-left text-sm font-medium text-gray-700"> Type </label>
          <div class="mt-1 rounded-md shadow-sm">
            <select
              id="type"
              v-model="type"
              class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            >
              <option value=""></option>
              <option value="cash">Cash</option>
              <option value="checking-account">Checking Account</option>
              <option value="savings-account">Savings Account</option>
              <option value="loan">Loan</option>
              <option value="credit-card">Credit Card</option>
              <option value="gift-card">Gift Card</option>
            </select>
          </div>
        </div>

        <new-cash-account v-if="type == 'cash'" />
        <new-checking-account v-if="type == 'checking-account'" :institutions="institutions" />
        <new-credit-card v-if="type == 'credit-card'" :institutions="institutions" />
        <new-loan v-if="type == 'loan'" :institutions="institutions" />
        <new-savings-account v-if="type == 'savings-account'" :institutions="institutions" />
        <new-gift-card v-if="type == 'gift-card'" />
      </form>
    </template>

    <template #footer>
      <button
        type="button"
        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
        @click="cancel"
      >
        Cancel
      </button>
      <button
        v-show="type != ''"
        type="button"
        class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
        @click="addAccount()"
      >
        Add
      </button>
    </template>
  </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';

import NewCashAccount from './CashAccount/NewCashAccount.vue';
import NewCheckingAccount from './CheckingAccount/NewCheckingAccount.vue';
import NewCreditCard from './CreditCard/NewCreditCard.vue';
import NewLoan from './Loan/NewLoan.vue';
import NewSavingsAccount from './SavingsAccount/NewSavingsAccount.vue';
import NewGiftCard from './GiftCard/NewGiftCard.vue';

export default {
  components: {
    AppModal,
    NewCashAccount,
    NewCheckingAccount,
    NewCreditCard,
    NewLoan,
    NewSavingsAccount,
    NewGiftCard,
  },
  props: ['institutions'],

  data() {
    return {
      show: false,

      type: '',
    };
  },

  mounted() {
    this.bindEvents();
  },

  methods: {
    bindEvents() {
      EventBus.on('prompt-add-account', () => {
        this.show = true;
      });

      EventBus.on('close-modal', () => {
        this.show = false;
        this.type = '';
      });
    },

    cancel() {
      this.show = false;
      this.type = '';
      EventBus.emit('reset-form');
      EventBus.emit('reset-validations');
    },

    addAccount() {
      EventBus.emit(`add-${this.type}`);
    },
  },
};
</script>
