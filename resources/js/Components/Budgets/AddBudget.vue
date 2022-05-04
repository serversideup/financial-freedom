<template>
    <app-modal :size="'medium'" :show="show">
        <template v-slot:header>
            Add Budget
        </template>
        <template v-slot:body>
            <form class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Name
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input v-model="form.name" id="account-number" type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="type" class="block text-sm font-medium leading-5 text-gray-700">
                        Type
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <select id="type" v-model="form.type" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option value="expense">Expense</option>
                            <option value="income">Income</option>
                            <option value="goal">Goal</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="amount" class="block text-sm font-medium leading-5 text-gray-700">Budgeted Amount</label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input v-model="form.amount" id="amount" type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300">
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="tags" class="block text-sm font-medium leading-5 text-gray-700">
                        Category
                    </label>
                    <category-select v-model="form.category"/>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="frequency" class="block text-sm font-medium leading-5 text-gray-700">Frequency</label>
                        <select id="frequency" v-model="form.frequency" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div>
                        <label for="renews" class="block text-sm font-medium leading-5 text-gray-700">Renews</label>
                        <select id="renews" v-model="form.renews" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option value="first-of-month">First of the Month</option>
                        </select>
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <button v-on:click="cancel()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
            <button v-on:click="addBudget()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add
            </button>
        </template>
    </app-modal>
</template>

<script setup>
import AppModal from '@/Components/Global/AppModal.vue';
import BudgetsAPI from '@/api/budgets.js';
import CategorySelect from '@/Components/Categories/CategorySelect.vue';
import { EventBus } from '@/event-bus.js';
import { ref, reactive } from 'vue';

const show = ref(false);

const form = reactive({
    name: null,
    type: null,
    amount: null,
    category: {},
    frequency: null,
    renews: null
});

const addBudget = () => {
    BudgetsAPI.store( form )
        .then( function( response ){
            EventBus.emit('re-load-budgets');
            resetForm();
            show.value = false;
        })
}

const cancel = () => {
    show.value = false;
    resetForm();
    EventBus.emit('close-modal');
}

const resetForm = () => {
    form.name = '';
    form.type = '';
    form.amount = '';
    form.category = {};
    form.frequency = '';
    form.renews = '';
}

EventBus.on('show-add-budget', function(){
    show.value = true;
});
</script>