<template>
  <div class="grid grid-cols-12 gap-4">
    <div class="mt-5 sm:col-span-6">
      <label for="account-type" class="block text-sm font-medium leading-5 text-gray-700">
        Account
      </label>
      <div class="mt-1">
        <div class="grid grid-cols-1 gap-4">
          <div
            class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:border-gray-400"
          >
            <div class="flex-shrink-0">
              <img
                v-if="account.institution"
                class="h-10 w-10 rounded-full"
                :src="account.institution.logo"
                alt=""
              />
            </div>
            <div class="min-w-0 flex-1">
              <a href="#" class="focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true" />
                <p class="text-sm font-medium text-gray-900">
                  {{ account.name }}
                </p>
                <p class="truncate text-sm text-gray-500">
                  {{ account.description }}
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-5 sm:col-span-6">
      <label for="account-type" class="block text-sm font-medium leading-5 text-gray-700">
        Select your transactions file
      </label>
      <div
        class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
      >
        <div class="text-center">
          <div class="flex text-sm text-gray-600">
            <label
              for="file-upload"
              class="relative cursor-pointer rounded-md font-medium text-blue-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 hover:text-blue-500"
            >
              <span>Upload a file</span>
              <input
                id="file-upload"
                ref="transactionsImportFile"
                name="file-upload"
                type="file"
                class="sr-only"
                @change="handleFileUpload()"
              />
            </label>
            <p class="pl-1">or drag and drop</p>
          </div>
          <p class="text-xs text-gray-500">CSV up to 10MB</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState('transactions/importProcess', {
      transactions: (state) => state.transactions,
      account: (state) => state.account,
    }),
  },

  methods: {
    handleFileUpload() {
      this.$store.commit(
        'transactions/importProcess/setTransactions',
        this.$refs.transactionsImportFile.files[0],
      );
      this.$store.commit('transactions/importProcess/setStep', 3);
    },
  },
};
</script>
