<template>
  <app-layout>
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2
            class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
          >
            Budgets
          </h2>
        </div>
      </div>
    </div>

    <BudgetsStats :budgets="budgets" />
    <BudgetsList :budgets="budgets" />

    <AddBudget />
  </app-layout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout';
import BudgetsAPI from '@/api/budgets.js';
import BudgetsStats from '@/Components/Budgets/BudgetsStats.vue';
import BudgetsList from '@/Components/Budgets/BudgetsList.vue';
import AddBudget from '@/Components/Budgets/AddBudget.vue';
import { EventBus } from '@/event-bus.js';

const budgets = ref([]);

function loadBudgets() {
  BudgetsAPI.index().then((response) => {
    budgets.value = response.data;
  });
}

loadBudgets();

EventBus.on('re-load-budgets', () => {
  loadBudgets();
});
</script>
