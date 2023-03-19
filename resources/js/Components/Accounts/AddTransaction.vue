<template>
  <app-modal :size="'medium'" :show="show">
    <template #image>
      <div
        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10"
      >
        <!-- Heroicon name: exclamation -->
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
            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
          ></path>
        </svg>
      </div>
    </template>
    <template #header> Add Transaction </template>
    <template #body>
      <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="acount" class="block text-sm font-medium leading-5 text-gray-700">
            Account
          </label>
          <div class="mt-2 font-sans font-bold text-gray-700">
            {{ account.name }}
          </div>
        </div>
        <div class="sm:col-span-3">
          <label for="direction" class="block text-sm font-medium leading-5 text-gray-700">
            Direction
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <select
              id="direction"
              v-model="form.direction"
              class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            >
              <option value="outflow">Outflow</option>
              <option value="inflow">Inflow</option>
              <option value="transfer">Transfer</option>
            </select>
          </div>
        </div>
        <div class="sm:col-span-3">
          <div>
            <label for="amount" class="block text-sm font-medium leading-5 text-gray-700"
              >Amount</label
            >
            <div class="relative mt-1 rounded-md shadow-sm">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="text-gray-500 sm:text-sm sm:leading-5"> $ </span>
              </div>
              <input
                id="amount"
                v-model="form.amount"
                class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5"
                placeholder="0.00"
                aria-describedby="price-currency"
              />
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <span id="price-currency" class="text-gray-500 sm:text-sm sm:leading-5"> USD </span>
              </div>
            </div>
          </div>
        </div>
        <div class="sm:col-span-3">
          <div>
            <label for="date" class="block text-sm font-medium leading-5 text-gray-700">Date</label>
            <div class="relative mt-1 rounded-md shadow-sm">
              <input
                id="date"
                v-model="form.date"
                class="form-input block w-full pl-3 pr-12 sm:text-sm sm:leading-5"
                placeholder=""
                aria-describedby="date"
              />
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <span id="price-currency" class="text-gray-500 sm:text-sm sm:leading-5">
                  <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                    ></path>
                  </svg>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="sm:col-span-6">
          <label for="name" class="block text-sm font-medium leading-5 text-gray-700"> Name </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="account-number"
              v-model="form.name"
              type="text"
              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            />
          </div>
        </div>
        <div class="sm:col-span-6">
          <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
            Description
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <textarea
              id="description"
              v-model="form.description"
              rows="3"
              class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            ></textarea>
          </div>
        </div>
        <div class="sm:col-span-6">
          <label for="tags" class="block text-sm font-medium leading-5 text-gray-700"> Tags </label>
          <tags :unique="'add-transaction-tag'" :existing="form.tags" />
        </div>
      </form>
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
        class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
        @click="addTransaction()"
      >
        Add
      </button>
    </template>
  </app-modal>
</template>

<script>
import AppModal from '../Global/AppModal.vue';
import { EventBus } from '../../event-bus.js';
import Tags from '../Transactions/Tags.vue';

export default {
  components: {
    AppModal,
    Tags,
  },
  props: ['account'],

  data() {
    return {
      accounts: [],

      show: false,

      form: {
        account: {},
        date: '',
        amount: 0.0,
        direction: 'outflow',
        name: '',
        description: '',
        tags: [],
      },
    };
  },

  mounted() {
    this.bindEvents();
    this.form.account = this.account;
  },

  beforeUnmount() {
    EventBus.$off('prompt-add-transaction');
    EventBus.$off('close-modal');
  },

  methods: {
    bindEvents() {
      EventBus.on('prompt-add-transaction', () => {
        this.show = true;
      });

      EventBus.on('close-modal', () => {
        this.show = false;
      });
    },

    cancel() {
      this.show = false;
      this.resetForm();
      EventBus.emit('close-modal');
    },

    addTransaction() {
      this.$inertia.post('/transactions', this.form).then((response) => {
        EventBus.emit('load-transactions');
        EventBus.emit('notify', {
          type: 'success',
          title: 'Transaction Added',
          message: 'Your transaction was added successfully.',
          action: 'clear',
        });
        this.cancel();
      });
    },

    resetForm() {
      this.form.date = '';
      this.form.amount = 0.0;
      this.form.direction = 'outflow';
      this.form.name = '';
      this.form.description = '';
      this.form.tags = [];
    },
  },
};
</script>
