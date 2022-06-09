<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200 col-span-8">
        <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
            Current Budget
        </div>
        <div class="px-4 pt-5 sm:p-6">
            <table class="min-w-full divide-y divide-gray-300" v-if="budgetsPeriods.length > 0">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Budget</th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Category</th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Planned</th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Actual</th>
                        <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Remaining</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="budgetPeriod in budgetsPeriods" :key="'budget-period-'+budgetPeriod.id">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">{{ budgetPeriod.name }}</td>
                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ budgetPeriod.category.name }}</td>
                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ formatMoney( budgetPeriod.amount ) }}</td>
                        <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">{{ findCurrentAmount( budgetPeriod ) }}</td>
                        <td class="whitespace-nowrap py-4 px-3 text-sm">
                            <span class="px-2 py-1 rounded-full" v-bind:class="{
                                'text-green-800 bg-green-100': findRemainingAmount( budgetPeriod ) > 0,
                                'text-red-800 bg-red-100': findRemainingAmount( budgetPeriod ) < 0,
                                'text-gray-900 bg-gray-100': findRemainingAmount( budgetPeriod ) == 0
                                }">{{ formatMoney( findRemainingAmount( budgetPeriod ) ) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="budgetsPeriods.length == 0" class="px-3 py-4 text-center">
                <h3 class="mt-2 text-sm font-medium text-gray-900">No budgets created for this date.</h3>
                <p class="mt-1 text-sm text-gray-500">Would you like to create your budgets?</p>
                <div class="mt-6">
                    <button type="button" @click="createBudgetPeriods()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <!-- Heroicon name: solid/plus -->
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Create Budget Periods
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { formatMoney } from '@/Composables/useFormatMoney.js';
import BudgetsPeriodsAPI from '@/api/budgetsPeriods.js';

const budgetsPeriods = ref([]);

function loadBudgetsPeriods(){
    BudgetsPeriodsAPI.index()
        .then( function( response ){
            budgetsPeriods.value = response.data;
        })
}
loadBudgetsPeriods();

function createBudgetPeriods(){
    BudgetsPeriodsAPI.store()
        .then( function( response ){
            loadBudgetsPeriods();
        });
}

function findCurrentAmount( budgetPeriod ){
    let currentSpent = 0.00;
    
    budgetPeriod.transactions.forEach( (transaction) => {
        if( transaction.splits.length > 0 ){
            transaction.splits.forEach( (split) => {
                if( split.category_id == budgetPeriod.category_id ){
                    currentSpent += parseFloat( split.amount );
                }
            } );
        }else{
            currentSpent += parseFloat( transaction.amount );
        }
    });

    return formatMoney( currentSpent );
}

function findRemainingAmount( budgetPeriod ){
    let currentSpent = 0.00;
    
    budgetPeriod.transactions.forEach( (transaction) => {
        if( transaction.splits.length > 0 ){
            transaction.splits.forEach( (split) => {
                if( split.category_id == budgetPeriod.category_id ){
                    currentSpent += parseFloat( split.amount );
                }
            } );
        }else{
            currentSpent += parseFloat( transaction.amount );
        }
        
    });


    return budgetPeriod.amount - currentSpent;
}
</script>