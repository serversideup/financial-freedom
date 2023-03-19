<template>
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">API Tokens</h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <api-token-manager
          :tokens="tokens"
          :available-permissions="availablePermissions"
          :default-permissions="defaultPermissions"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import ApiTokenManager from './ApiTokenManager';
import AppLayout from '../../Layouts/AppLayout';
import JetSectionBorder from '../../Jetstream/SectionBorder';

export default {
  components: {
    ApiTokenManager,
    AppLayout,
    JetSectionBorder,
  },
  props: ['tokens', 'availablePermissions', 'defaultPermissions'],
};
</script>
