<template>
  <Combobox v-model="selected">
    <div class="relative mt-1">
      <div
        class="relative w-full overflow-hidden rounded-md border border-gray-300 bg-white text-left focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
      >
        <ComboboxInput
          class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
          :display-value="(category) => (category.name ? category.name : '')"
          @change="query = $event.target.value"
        />

        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </ComboboxButton>
      </div>

      <TransitionRoot
        leave="transition ease-in duration-100"
        leave-from="opacity-100"
        leave-to="opacity-0"
        @after-leave="query = ''"
      >
        <ComboboxOptions
          class="absolute z-modal mt-1 max-h-60 w-96 overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        >
          <div
            v-if="filteredCategories.length === 0 && query !== ''"
            class="relative cursor-default select-none py-2 px-4 text-gray-700"
          >
            Nothing found.
          </div>

          <ComboboxOption
            v-for="category in filteredCategories"
            :key="category.id"
            v-slot="{ selected, active }"
            as="template"
            :value="category"
          >
            <li
              class="relative cursor-default select-none py-2 pl-10 pr-4"
              :class="{
                'bg-blue-600 text-white': active,
                'text-gray-900': !active,
              }"
            >
              <span
                class="block truncate"
                :class="{ 'font-medium': selected, 'font-normal': !selected }"
              >
                <span
                  v-if="category.parent_name != ''"
                  class="text-gray-400"
                  v-text="category.parent_name + ' > '"
                ></span>
                {{ category.name }}
              </span>
              <span
                v-if="selected"
                class="absolute inset-y-0 left-0 flex items-center pl-3"
                :class="{ 'text-white': active, 'text-blue-600': !active }"
              >
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ComboboxOption>
        </ComboboxOptions>
      </TransitionRoot>
    </div>
  </Combobox>
</template>

<script>
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue';
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid';

export default {
  components: {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
    CheckIcon,
    SelectorIcon,
  },
  data() {
    return {
      selected: '',
      query: '',
    };
  },

  computed: {
    filteredCategories() {
      return this.query === ''
        ? this.$page.props.categories
        : this.$page.props.categories.filter((category) =>
            category.name
              .toLowerCase()
              .replace(/\s+/g, '')
              .includes(this.query.toLowerCase().replace(/\s+/g, '')),);
    },
  },
};
</script>
