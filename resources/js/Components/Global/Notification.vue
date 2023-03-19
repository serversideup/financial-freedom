<template>
  <div
    v-show="show"
    aria-live="assertive"
    class="pointer-events-none fixed inset-0 z-50 flex items-end justify-center px-4 py-6 sm:items-start sm:justify-end sm:p-6"
  >
    <transition
      enter-active-class="transform ease-out duration-300 transition"
      enter-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
      leave-active-class="transition ease-in duration-100"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
      >
        <div class="p-4">
          <div class="flex items-start">
            <div class="flex-shrink-0">
              <!-- Heroicon name: outline/check-circle -->
              <svg
                v-show="type == 'success'"
                class="h-6 w-6 text-green-400"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5">
              <p class="text-sm font-medium text-gray-900" v-text="title"></p>
              <p class="mt-1 text-sm text-gray-500" v-text="message"></p>
            </div>
            <div class="ml-4 flex flex-shrink-0">
              <button
                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                @click="runAction()"
              >
                <span class="sr-only">Close</span>
                <!-- Heroicon name: solid/x -->
                <svg
                  class="h-5 w-5"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import { EventBus } from '../../event-bus.js';

export default {
  data() {
    return {
      show: false,
      type: '',
      title: '',
      message: '',
      action: '',
    };
  },

  mounted() {
    this.bindEvents();
  },

  methods: {
    bindEvents() {
      EventBus.on('notify', (data) => {
        this.handleNotification(data);
      });
    },

    handleNotification(data) {
      this.type = data.type;
      this.title = data.title;
      this.message = data.message;
      this.action = data.action;
      this.show = true;

      setTimeout(() => {
        this.clearNotification();
      }, 3000);
    },

    runAction() {
      switch (this.action) {
        case 'clear':
          this.clearNotification();
          break;
      }
    },

    clearNotification() {
      this.show = false;

      setTimeout(() => {
        this.type = '';
        this.title = '';
        this.message = '';
        this.action = '';
      }, 1000);
    },
  },
};
</script>
