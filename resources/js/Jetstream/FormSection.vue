<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <jet-section-title>
      <template #title><slot name="title"></slot></template>
      <template #description><slot name="description"></slot></template>
    </jet-section-title>

    <div class="mt-5 md:col-span-2 md:mt-0">
      <form @submit.prevent="$emit('submitted')">
        <div class="overflow-hidden shadow sm:rounded-md">
          <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">
              <slot name="form"></slot>
            </div>
          </div>

          <div
            v-if="hasActions"
            class="flex items-center justify-end bg-gray-50 px-4 py-3 text-right sm:px-6"
          >
            <slot name="actions"></slot>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import JetSectionTitle from './SectionTitle';

export default {
  components: {
    JetSectionTitle,
  },

  computed: {
    hasActions() {
      return !!this.$slots.actions;
    },
  },
};
</script>
