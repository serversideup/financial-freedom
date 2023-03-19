<template>
  <div>
    <h2 class="mt-5 mb-2 text-xl font-extrabold text-gray-900">Rules</h2>
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Find
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Replace
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                  >
                    Categorize
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="(rule, index) in rules" :key="'rule-' + rule.id">
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    <input
                      v-model="rules[index].find"
                      type="text"
                      class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    />
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    <input
                      v-model="rules[index].replace"
                      type="text"
                      class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    />
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500"></td>
                  <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                    <button
                      type="button"
                      class="text-blue-600 hover:text-blue-900"
                      @click="updateRule(index)"
                    >
                      Update
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    <input
                      v-model="newRule.find"
                      type="text"
                      class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                      placeholder="Find string"
                    />
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                    <input
                      v-model="newRule.replace"
                      type="text"
                      class="block w-full min-w-0 flex-1 rounded-md border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                      placeholder="Replace with"
                    />
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                    <category-select v-model="newRule.category_id" />
                  </td>
                  <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                    <button
                      type="button"
                      class="text-blue-600 hover:text-blue-900"
                      @click="addRule()"
                    >
                      Add
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { EventBus } from '@/event-bus.js';
import RulesAPI from '@/api/rules.js';
import CategorySelect from '@/Components/Transactions/CategorySelect.vue';

export default {
  components: {
    CategorySelect,
  },
  data() {
    return {
      rules: [],
      newRule: {
        find: '',
        replace: '',
        category_id: '',
      },
    };
  },

  mounted() {
    this.initializeRules();
  },

  methods: {
    initializeRules() {
      RulesAPI.index().then((response) => {
        this.rules = response.data;
      });
    },

    addRule() {
      RulesAPI.store(this.newRule).then((response) => {
        this.newRule.find = '';
        this.newRule.replace = '';
        this.newRule.category_id = '';

        EventBus.emit('notify', {
          type: 'success',
          title: 'Rule added',
          message: 'New transaction naming rule has been added!',
          action: 'close',
        });

        this.initializeRules();
      });
    },
    updateRule(index) {
      RulesAPI.update(this.rules[index].id, {
        find: this.rules[index].find,
        replace: this.rules[index].replace,
        category_id: this.rules[index].category_id,
      }).then((response) => {
        EventBus.emit('notifiy', {
          type: 'success',
          title: 'Rule updated',
          message: 'Your category meta has been updated',
          action: 'close',
        });
      });
    },
  },
};
</script>
