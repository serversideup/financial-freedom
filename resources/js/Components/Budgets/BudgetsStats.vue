<template>
    <div class="px-4 mb-8 sm:px-6 lg:px-8">
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Income Budgeted</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ formatMoney( totalIncomeBudgeted ) }}</dd>
            </div>

            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Expenses Budgetd</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ formatMoney( totalExpensesBudgeted ) }}</dd>
            </div>

            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Amount Remaining</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ formatMoney( amountRemaining ) }}</dd>
            </div>
        </dl>
    </div>
</template>

<script setup>
import { computed, defineProps } from 'vue';
import { formatMoney } from '@/Composables/useFormatMoney.js';
const props = defineProps(['budgets']);

const totalIncomeBudgeted = computed(() => {
    let total = 0.00;

    props.budgets.forEach( function( budget ){
        if( budget.type == 'income' ){
            total += parseFloat( budget.amount );
        }
    })

    return total;
})

const totalExpensesBudgeted = computed(() => {
    let total = 0.00;

    props.budgets.forEach( function( budget ){
        if( budget.type != 'income' ){
            total += parseFloat( budget.amount );
        }
    })

    return total;
})

const amountRemaining = computed(() => {
    return parseFloat( totalIncomeBudgeted.value ) - parseFloat( totalExpensesBudgeted.value );
})

</script>