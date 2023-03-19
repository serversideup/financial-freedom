<template>
  <app-modal :size="'medium'" :show="show">
    <template #header> Add Budget </template>
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
        <div class="sm:col-span-3">
          <label for="type" class="block text-sm font-medium leading-5 text-gray-700"> Type </label>
          <div class="mt-1 rounded-md shadow-sm">
            <select
              id="type"
              v-model="form.type"
              class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            >
              <option value=""></option>
              <option value="expense">Expense</option>
              <option value="income">Income</option>
              <option value="goal">Goal</option>
            </select>
          </div>
        </div>
        <div class="sm:col-span-3">
          <div>
            <label for="amount" class="block text-sm font-medium leading-5 text-gray-700"
              >Budgeted Amount</label
            >
            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="amount"
                v-model="form.amount"
                type="text"
                class="block w-full min-w-0 flex-1 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
              />
            </div>
          </div>
        </div>
        <div class="sm:col-span-3">
          <label for="tags" class="block text-sm font-medium leading-5 text-gray-700">
            Category
          </label>
          <category-select v-model="form.category" />
        </div>
        <div class="sm:col-span-3">
          <div>
            <label for="frequency" class="block text-sm font-medium leading-5 text-gray-700"
              >Frequency</label
            >
            <select
              id="frequency"
              v-model="form.frequency"
              class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            >
              <option value=""></option>
              <option value="monthly">Monthly</option>
            </select>
          </div>
        </div>
        <div class="sm:col-span-3">
          <div>
            <label for="renews" class="block text-sm font-medium leading-5 text-gray-700"
              >Renews</label
            >
            <select
              id="renews"
              v-model="form.renews"
              class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
            >
              <option value=""></option>
              <option value="first-of-month">First of the Month</option>
            </select>
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
        @click="addBudget()"
      >
        Add
      </button>
    </template>
  </app-modal>
</template>

<script setup>
import { ref, reactive } from 'vue';
import AppModal from '@/Components/Global/AppModal.vue';
import BudgetsAPI from '@/api/budgets.js';
import CategorySelect from '@/Components/Categories/CategorySelect.vue';
import { EventBus } from '@/event-bus.js';

const show = ref(false);

const form = reactive({
  name: null,
  type: null,
  amount: null,
  category: {},
  frequency: null,
  renews: null,
});

const addBudget = () => {
  BudgetsAPI.store(form).then((response) => {
    EventBus.emit('re-load-budgets');
    resetForm();
    show.value = false;
  });
};

const cancel = () => {
  show.value = false;
  resetForm();
  EventBus.emit('close-modal');
};

const resetForm = () => {
  form.name = '';
  form.type = '';
  form.amount = '';
  form.category = {};
  form.frequency = '';
  form.renews = '';
};

EventBus.on('show-add-budget', () => {
  show.value = true;
});
</script>
