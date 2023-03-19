<template>
  <nav aria-label="Progress" class="w-full">
    <ol
      role="list"
      class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0"
    >
      <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative md:flex md:flex-1">
        <a
          v-if="step.status === 'complete'"
          :href="step.href"
          class="group flex w-full items-center"
        >
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span
              class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-600 group-hover:bg-blue-800"
            >
              <CheckIcon class="h-6 w-6 text-white" aria-hidden="true" />
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ step.name }}</span>
          </span>
        </a>
        <a
          v-else-if="step.status === 'current'"
          :href="step.href"
          class="flex items-center px-6 py-4 text-sm font-medium"
          aria-current="step"
        >
          <span
            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-blue-600"
          >
            <span class="text-blue-600">{{ step.id }}</span>
          </span>
          <span class="ml-4 text-sm font-medium text-blue-600">{{ step.name }}</span>
        </a>
        <a v-else :href="step.href" class="group flex items-center">
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span
              class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400"
            >
              <span class="text-gray-500 group-hover:text-gray-900">{{ step.id }}</span>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{
              step.name
            }}</span>
          </span>
        </a>
        <template v-if="stepIdx !== steps.length - 1">
          <!-- Arrow separator for lg screens and up -->
          <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">
            <svg
              class="h-full w-full text-gray-300"
              viewBox="0 0 22 80"
              fill="none"
              preserveAspectRatio="none"
            >
              <path
                d="M0 -2L20 40L0 82"
                vector-effect="non-scaling-stroke"
                stroke="currentcolor"
                stroke-linejoin="round"
              />
            </svg>
          </div>
        </template>
      </li>
    </ol>
  </nav>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid';
import { mapState } from 'vuex';

export default {
  computed: {
    steps() {
      return [
        {
          id: 1,
          name: 'Select Account',
          href: '#',
          status: this.determineStatus(1),
        },
        {
          id: 2,
          name: 'Upload File',
          href: '#',
          status: this.determineStatus(2),
        },
        {
          id: 3,
          name: 'Import',
          href: '#',
          status: this.determineStatus(3),
        },
      ];
    },

    ...mapState('transactions/importProcess', {
      step: (state) => state.step,
    }),
  },

  components: {
    CheckIcon,
  },

  methods: {
    determineStatus(id) {
      if (this.step == id) {
        return 'current';
      }
      if (this.step < id) {
        return 'upcoming';
      }
      return 'complete';
    },
  },
};
</script>
