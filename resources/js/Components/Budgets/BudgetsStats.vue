<template>
  <div class="mb-8 px-4 sm:px-6 lg:px-8">
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
      <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-500">Total Income Budgeted</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          {{ formatMoney(totalIncomeBudgeted) }}
        </dd>
      </div>

      <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-500">Total Expenses Budgetd</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          {{ formatMoney(totalExpensesBudgeted) }}
        </dd>
      </div>

      <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
        <dt class="truncate text-sm font-medium text-gray-500">Amount Remaining</dt>
        <dd class="mt-1 text-3xl font-semibold text-gray-900">
          {{ formatMoney(amountRemaining) }}
        </dd>
      </div>
    </dl>
  </div>
</template>

<script setup>
import { computed, defineProps } from 'vue';
import { formatMoney } from '@/Composables/useFormatMoney.js';

const props = defineProps(['budgets']);

const totalIncomeBudgeted = computed(() => {
  let total = 0.0;

  props.budgets.forEach((budget) => {
    if (budget.type == 'income') {
      total += parseFloat(budget.amount);
    }
  });

  return total;
});

const totalExpensesBudgeted = computed(() => {
  let total = 0.0;

  props.budgets.forEach((budget) => {
    if (budget.type != 'income') {
      total += parseFloat(budget.amount);
    }
  });

  return total;
});

const amountRemaining = computed(
  () =>
  parseFloat(totalIncomeBudgeted.value)
    - parseFloat(totalExpensesBudgeted.value),
));
</script>
