<template>
  <multi-select-wrapper
    :unique="unique"
    :allow-new="true"
    :allow-duplicates="false"
    :existing-tags="existing"
  >
    <template #tags="{ index, tag, remove }">
      <span
        class="mr-1 inline-block rounded-md border py-px px-2 font-sans text-xs"
        :class="[
          tag.color != undefined ? 'bg-' + tag.color + '-100' : 'bg-gray-100',
          tag.color != undefined ? 'text-' + tag.color + '-800' : 'text-gray-800',
        ]"
      >
        {{ tag.name }}
        <span class="cursor-pointer" @click.stop="remove(index)">&times;</span>
      </span>
    </template>

    <template #autocomplete="{ result }">
      <div class="font-sm bg-white py-1 px-2 font-sans hover:bg-gray-100">
        <span
          class="mr-2 inline-block h-2 w-2 rounded-full"
          :class="'bg-' + result.color + '-500'"
        />{{ result.name }}
      </div>
    </template>
  </multi-select-wrapper>
</template>

<script>
import MultiSelectWrapper from '../Global/MultiSelectWrapper.vue';
import { EventBus } from '../../event-bus.js';

export default {
  components: {
    MultiSelectWrapper,
  },

  props: ['unique', 'existing'],

  data() {
    return {
      tags: [],
    };
  },

  mounted() {
    EventBus.on('tags-changed', (data) => {
      if (data.id == this.unique) {
        this.tags = data.tags;
      }
    });
  },
};
</script>
