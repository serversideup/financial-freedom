<template>
  <app-modal :size="'small'" :show="show">
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
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
          />
        </svg>
      </div>
    </template>

    <template #header> Add Rule </template>

    <template #body>
      <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
        <div class="sm:col-span-6">
          <label for="find" class="block text-sm font-medium leading-5 text-gray-700"> Find </label>
          <input
            v-model="form.find"
            type="text"
            class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            placeholder="Find string"
          />
        </div>
        <div class="sm:col-span-6">
          <label for="replace" class="block text-sm font-medium leading-5 text-gray-700">
            Replace
          </label>
          <input
            v-model="form.replace"
            type="text"
            class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            placeholder="Find string"
          />
        </div>
        <div class="sm:col-span-6">
          <label for="category" class="block text-sm font-medium leading-5 text-gray-700">
            Category
          </label>
          <category-select v-model="form.category_id" />
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
        class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
        @click="addRule()"
      >
        Add
      </button>
    </template>
  </app-modal>
</template>

<script>
import { EventBus } from '@/event-bus.js';
import RulesAPI from '@/api/rules.js';
import CategorySelect from '@/Components/Transactions/CategorySelect.vue';
import AppModal from '@/Components/Global/AppModal.vue';

export default {
  components: {
    AppModal,
    CategorySelect,
  },
  data() {
    return {
      show: false,

      form: {
        find: '',
        replace: '',
        category_id: '',
      },
    };
  },

  mounted() {
    this.bindEvents();
  },

  beforeUnmount() {
    EventBus.off('prompt-add-rule');
    EventBus.off('close-modal');
  },

  methods: {
    bindEvents() {
      EventBus.on('prompt-add-rule', () => {
        this.show = true;
      });

      EventBus.on('close-modal', () => {
        this.show = false;
      });
    },

    addRule() {
      RulesAPI.store(this.form).then((response) => {
        this.form.find = '';
        this.form.replace = '';
        this.form.category_id = '';

        EventBus.emit('notify', {
          type: 'success',
          title: 'Rule added',
          message: 'New transaction naming rule has been added!',
          action: 'close',
        });

        EventBus.emit('new-rule-added', response.data);

        this.show = false;
        this.resetForm();
      });
    },

    cancel() {
      this.show = false;
      this.resetForm();
    },

    resetForm() {
      this.form.find = '';
      this.form.replace = '';
      this.form.category_id = '';
    },
  },
};
</script>
