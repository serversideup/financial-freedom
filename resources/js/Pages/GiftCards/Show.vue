<template>
  <app-layout>
    <div v-if="loaded">
      <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2
            class="flex w-full items-center text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
          >
            <img
              :src="'https://logo.clearbit.com/' + giftCard.company.toLowerCase() + '.com'"
              class="mr-2 h-8 w-8 rounded-full"
            />
            {{ giftCard.company }}
          </h2>
        </div>
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
          <button
            class="focus:shadow-outline-blue relative -ml-px inline-flex cursor-pointer items-center rounded-md border border-gray-300 bg-white px-4 py-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-blue-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
            @click="promptEdit()"
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
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
              />
            </svg>

            Edit Gift Card
          </button>
        </span>
      </div>
    </div>
    <div v-if="loaded" class="mt-5 max-w-lg">
      <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Gift Card Details</h3>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Location, balance, url, etc.</p>
        </div>
        <div class="border-t border-gray-200">
          <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Balance</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                ${{ giftCard.balance }}
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Location</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                {{ giftCard.location }}
              </dd>
            </div>
            <div
              v-if="giftCard.expiration"
              class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
            >
              <dt class="text-sm font-medium text-gray-500">Expires</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                {{ giftCard.expiration }}
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">URL</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <a
                  :href="giftCard.url"
                  class="underline"
                  target="_blank"
                  v-text="'Link to Gift Card'"
                ></a>
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <a href="https://clearbit.com" target="_blank" class="text-xs text-gray-900"
        >Logos provided by Clearbit</a
      >
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import GiftCardsAPI from '@/api/giftCards.js';

export default {
  components: {
    AppLayout,
  },
  props: ['id'],

  data() {
    return {
      giftCard: {},
      loaded: false,
    };
  },

  mounted() {
    this.loadGiftCard();
  },

  methods: {
    promptEdit() {},

    loadGiftCard() {
      GiftCardsAPI.show(this.id).then((response) => {
        this.giftCard = response.data;
        this.loaded = true;
      });
    },
  },
};
</script>
