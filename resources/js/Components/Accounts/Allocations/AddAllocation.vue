<template>
  <app-modal :size="'small'" :show="show">
    <template #image>
      <div
        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10"
      >
        <svg
          class="h-6 w-6 text-blue-600"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
    </template>
    <template #header> Add Allocation </template>
    <template #body>
      <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
        <div class="sm:col-span-6">
          <label for="name" class="block text-sm font-medium leading-5 text-gray-700"> Name </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input
              id="account-number"
              v-model="form.name"
              type="text"
              class="block w-full min-w-0 flex-1 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
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
              class="block w-full min-w-0 flex-1 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            ></textarea>
          </div>
        </div>
        <div class="sm:col-span-6">
          <div>
            <label for="amount" class="block text-sm font-medium leading-5 text-gray-700"
              >Amount</label
            >
            <div class="mt-1 flex rounded-md shadow-sm">
              <span
                class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm"
              >
                $
              </span>
              <input
                id="amount"
                v-model="form.amount"
                type="text"
                name="amount"
                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              />
            </div>
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
        @click="addAllocation()"
      >
        Add
      </button>
    </template>
  </app-modal>
</template>

<script>
import AppModal from '../../Global/AppModal.vue';
import AllocationsAPI from '../../../api/allocations.js';
import { EventBus } from '../../../event-bus.js';

export default {
  components: {
    AppModal,
  },
  props: ['available', 'account'],

  data() {
    return {
      show: false,

      form: {
        name: '',
        description: '',
        amount: 0.0,
      },
    };
  },

  mounted() {
    this.bindEvents();
  },

  methods: {
    bindEvents() {
      EventBus.on('prompt-add-allocation', () => {
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

    addAllocation() {
      AllocationsAPI.store({
        account_id: this.account.id,
        account_type: this.account.account_type,
        name: this.form.name,
        description: this.form.description,
        amount: this.form.amount,
      }).then((response) => {
        this.handleSuccessfulAllocation(response.data.name);
      });
    },

    handleSuccessfulAllocation(name) {
      EventBus.emit('notify', {
        type: 'success',
        title: 'Allocation Created',
        message: `Your "${name}" allocation has been created!`,
        action: 'close',
      });

      EventBus.emit('allocation-added');

      this.show = false;
      this.resetForm();
    },

    resetForm() {
      this.form.name = '';
      this.form.description = '';
      this.form.amount = 0.0;
    },
  },
};
</script>
