<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <jet-section-title>
      <template #title><slot name="title"></slot></template>
      <template #description><slot name="description"></slot></template>
    </jet-section-title>

    <div class="mt-5 md:col-span-2 md:mt-0">
      <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
        <slot name="content"></slot>
      </div>
    </div>
  </div>
</template>

<script>
import JetSectionTitle from './SectionTitle';

export default {
  components: {
    JetSectionTitle,
  },
};
</script>
