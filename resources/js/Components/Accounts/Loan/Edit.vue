<template>
  <app-modal :size="'medium'" :show="show">
    <template #image>
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
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
        />
      </svg>
    </template>
    <template #header> Edit Account </template>
    <template #body>
      <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
        <div class="sm:col-span-6">
          <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
            Account Name
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="account-name"
              v-model="form.name"
              type="text"
              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            />
          </div>
        </div>
        <div class="sm:col-span-3">
          <label for="account-number" class="block text-sm font-medium leading-5 text-gray-700">
            Number
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="account-number"
              v-model="form.number"
              type="text"
              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            />
          </div>
        </div>
        <div class="sm:col-span-3">
          <div>
            <label for="current-balance" class="block text-sm font-medium leading-5 text-gray-700"
              >Current Balance</label
            >
            <div class="relative mt-1 rounded-md shadow-sm">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="text-gray-500 sm:text-sm sm:leading-5"> $ </span>
              </div>
              <input
                id="current-balance"
                v-model="form.current_balance"
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
        <div class="sm:col-span-6">
          <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
            Description
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="description"
              v-model="form.description"
              type="text"
              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            />
          </div>
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
        @click="updateAccount()"
      >
        Update
      </button>
    </template>
  </app-modal>
</template>

<script>
import AppModal from '../../Global/AppModal.vue';
import { EventBus } from '../../../event-bus.js';
import LoansAPI from '../../../api/loans.js';

export default {
  components: {
    AppModal,
  },

  data() {
    return {
      show: false,
      id: '',

      form: {
        id: '',
        name: '',
        number: '',
        description: '',
        current_balance: '',
      },
    };
  },

  mounted() {
    this.bindEvents();
  },

  methods: {
    bindEvents() {
      EventBus.on('prompt-edit-account', (data) => {
        this.show = true;

        this.id = data.id;
        this.form.name = data.name;
        this.form.number = data.number;
        this.form.description = data.description;
        this.form.current_balance = data.current_balance;
      });

      EventBus.on('close-modal', () => {
        this.show = false;
        this.resetForm();
      });
    },

    updateAccount() {
      LoansAPI.update(this.id, this.form).then(() => {
        EventBus.emit('notify', {
          type: 'success',
          title: 'Account Updated',
          message: 'Your account has been successfully updated!',
          action: 'close',
        });

        EventBus.emit('loan-updated');

        this.show = false;
        this.resetForm();
      });
    },

    cancel() {
      this.show = false;
      this.resetForm();
    },

    resetForm() {
      this.form.name = '';
      this.form.number = '';
      this.form.description = '';
      this.form.current_balance = '';
    },
  },
};
</script>
