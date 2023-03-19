<template>
  <div class="grid grid-cols-12 gap-4">
    <div class="mt-5 sm:col-span-6">
      <label for="account-type" class="block text-sm font-medium leading-5 text-gray-700">
        Select Account
      </label>
      <div class="mt-1 rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
        <account-select v-model="account" :accounts="accounts" />
      </div>
    </div>
  </div>
</template>

<script>
import AccountSelect from '@/Components/Global/AccountSelect';

export default {
  components: {
    AccountSelect,
  },
  props: ['accounts'],

  computed: {
    account: {
      get() {
        return this.$store.getters['transactions/importProcess/getAccount'];
      },
      set(value) {
        this.$store.commit('transactions/importProcess/setAccount', value);
      },
    },
  },

  watch: {
    account() {
      if (this.account != '') {
        this.$store.commit('transactions/importProcess/setStep', 2);
      } else {
        this.$store.commit('transactions/importProcess/setStep', 1);
      }
    },
  },
};
</script>
