<template>
  <app-layout>
    <div>
      <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2
            class="flex w-full items-center text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
          >
            <img :src="account.institution.logo" class="mr-2 h-8 w-8 rounded-full" />
            {{ account.institution.name }}: {{ account.type.name }}
          </h2>
        </div>
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
          <button
            class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
          >
            <svg
              class="h-5 w-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              ></path>
            </svg>
          </button>
        </span>
      </div>
    </div>
    <div class="mt-5">
      <h3 class="text-lg font-medium leading-6 text-gray-900">Last 30 days</h3>
      <div class="mt-5 grid grid-cols-1 overflow-hidden rounded-lg bg-white shadow md:grid-cols-3">
        <div>
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base font-normal leading-6 text-gray-900">Current Balance</dt>
              <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold leading-8 text-blue-600">
                  $71,897.00
                </div>
                <div
                  class="inline-flex items-baseline rounded-full bg-green-100 px-2.5 py-0.5 text-sm font-medium leading-5 text-green-800 md:mt-2 lg:mt-0"
                >
                  <svg
                    class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <span class="sr-only"> Increased by </span>
                  $35.00
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base font-normal leading-6 text-gray-900">This Month</dt>
              <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold leading-8 text-blue-600">
                  $350.00
                </div>
                <div
                  class="inline-flex items-baseline rounded-full bg-green-100 px-2.5 py-0.5 text-sm font-medium leading-5 text-green-800 md:mt-2 lg:mt-0"
                >
                  <svg
                    class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <span class="sr-only"> Increased by </span>
                  $13.00
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base font-normal leading-6 text-gray-900">Number of Transactions</dt>
              <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold leading-8 text-blue-600">
                  23
                </div>
                <div
                  class="inline-flex items-baseline rounded-full bg-red-100 px-2.5 py-0.5 text-sm font-medium leading-5 text-red-800 md:mt-2 lg:mt-0"
                >
                  <svg
                    class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-red-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <span class="sr-only"> Decreased by </span>
                  4
                </div>
              </dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="mt-5 flex"></div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout';

export default {
  components: {
    AppLayout,
  },
  props: ['account'],
};
</script>
