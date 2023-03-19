<template>
  <app-layout>
    <div>
      <div class="mt-2 mb-5 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
          <h2
            class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:leading-9"
          >
            Import Transactions
          </h2>
        </div>
      </div>

      <div class="mt-5 flex w-full">
        <steps />
      </div>

      <select-account v-if="step == 1" :accounts="accounts" />

      <upload-file v-if="step == 2" />

      <confirm-import v-show="step == 3" :rules="rules" />

      <view-duplicate />

      <add-rule-modal />
    </div>
  </app-layout>
</template>

<script>
import { mapState } from 'vuex';
import AppLayout from '@/Layouts/AppLayout';
import Steps from './components/Steps';
import SelectAccount from './components/SelectAccount';
import UploadFile from './components/UploadFile';
import ConfirmImport from './components/ConfirmImport.vue';
import ViewDuplicate from './components/ViewDuplicate.vue';
import AddRuleModal from '@/Components/Transactions/AddRuleModal.vue';

export default {
  components: {
    AppLayout,
    Steps,
    SelectAccount,
    UploadFile,
    ConfirmImport,
    ViewDuplicate,
    AddRuleModal,
  },
  props: ['accounts', 'rules'],

  computed: {
    ...mapState('transactions/importProcess', {
      step: (state) => state.step,
    }),
  },
};
</script>
