<template>
  <div>
    <div class="mb-3 md:flex md:items-center md:justify-end">
      <span class="relative z-0 inline-flex rounded-md shadow-sm">
        <button
          class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center rounded-l-md border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          @click="promptAddAllocation()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="mr-px h-4 w-4"
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
        </button>
        <button
          class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          @click="viewChart()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="mr-px h-4 w-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"
            />
          </svg>
        </button>
        <button
          class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center rounded-r-md border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          @click="editAllocations()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="mr-px h-4 w-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
            />
          </svg>
        </button>
      </span>
    </div>
    <allocation-chart
      v-show="view == 'chart'"
      :allocations="allocations"
      :un-allocated-amount="unallocatedAmount"
    />

    <edit-allocations
      v-show="view == 'edit'"
      :available="unallocatedAmount"
      :account="account"
      :allocations="allocations"
    />

    <add-allocation :available="unallocatedAmount" :account="account" />
  </div>
</template>

<script>
import AllocationChart from './Allocations/AllocationChart.vue';
import AddAllocation from './Allocations/AddAllocation.vue';
import EditAllocations from './Allocations/EditAllocations.vue';
import { EventBus } from '@/event-bus.js';
import AllocationsAPI from '@/api/allocations.js';

export default {
  components: {
    AllocationChart,
    AddAllocation,
    EditAllocations,
  },
  props: ['account'],

  data() {
    return {
      allocations: [],
      view: 'chart',
    };
  },

  computed: {
    unallocatedAmount() {
      let totalAllocated = 0.0;

      this.allocations.forEach((allocation) => {
        totalAllocated += parseFloat(allocation.amount);
      });

      return parseFloat(this.account.current_balance) - parseFloat(totalAllocated);
    },
  },

  mounted() {
    this.bindEvents();
    this.loadAllocations();
  },

  methods: {
    bindEvents() {
      EventBus.on('allocation-added', () => {
        this.view = 'chart';
        this.loadAllocations();
      });

      EventBus.on('allocation-deleted', () => {
        this.view = 'chart';
        this.loadAllocations();
      });

      EventBus.on('allocations-updated', () => {
        this.view = 'chart';
        this.loadAllocations();
      });
    },

    loadAllocations() {
      this.allocations = [];

      AllocationsAPI.index({
        account_type: this.account.account_type,
        account_id: this.account.id,
      }).then((response) => {
        this.allocations = response.data;
      });
    },

    promptAddAllocation() {
      EventBus.emit('prompt-add-allocation');
    },

    viewChart() {
      this.view = 'chart';
    },

    editAllocations() {
      this.view = 'edit';
    },
  },
};
</script>
