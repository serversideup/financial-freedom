<template>
  <div
    id="transactions-filter-popup"
    :class="{ hidden: !show }"
    class="absolute right-0 z-modal w-64 rounded border border-astronaut-100 bg-white p-3 shadow-lg"
    style="top: 45px"
  >
    <div class="grid grid-cols-1">
      <div class="sm:col-span-3">
        <label for="direction" class="block text-left text-sm font-medium text-gray-700"
          >Direction</label
        >
        <select
          id="direction"
          v-model="direction"
          class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
        >
          <option value="all">All</option>
          <option value="outflow">Outflow</option>
          <option value="inflow">Inflow</option>
          <option value="transfer">Transfer</option>
        </select>
      </div>

      <div class="mt-1 sm:col-span-3">
        <label class="block text-left text-sm font-medium text-gray-700">Category</label>
        <select
          id="category"
          v-model="category"
          name="category"
          class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
        >
          <option value=""></option>
          <option
            v-for="category in $page.props.categories"
            :key="'category-' + category.id"
            :value="category.id"
            v-text="(category.parent_id != null ? ' - ' : '') + category.name"
          />
        </select>
      </div>

      <!-- <div class="sm:col-span-3 mt-1">
                <label for="tags" class="block text-sm font-medium leading-5 text-left text-gray-700 mb-1">
                    Tags
                </label>
                <tags
                    :unique="'filter-transaction-tags'"
                    :existing="tags"/>
            </div> -->
    </div>
  </div>
</template>

<script>
import { EventBus } from '../../../event-bus.js';
import Tags from '../Tags.vue';

export default {
  components: {
    Tags,
  },
  props: ['show', 'categories'],

  data() {
    return {
      direction: 'all',
      category: '',
      tags: [],
    };
  },

  watch: {
    direction() {
      this.applyFilters();
    },

    category() {
      this.applyFilters();
    },

    tags() {
      this.applyFilters();
    },
  },

  methods: {
    applyFilters() {
      EventBus.emit('transaction-filters-updated', {
        direction: this.direction,
        category: this.category,
        tags: this.tags,
      });
    },
  },
};
</script>
