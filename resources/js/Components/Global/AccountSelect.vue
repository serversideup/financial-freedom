<template>
  <Listbox v-model="selected" as="div" class="relative">
    <ListboxButton
      class="relative mt-1 w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 sm:text-sm"
    >
      <span class="flex items-center">
        <img
          v-if="selected.institution"
          :src="selected.institution.logo"
          alt=""
          class="h-6 w-6 flex-shrink-0 rounded-full"
        />
        <span v-if="selected != ''" class="ml-3 block truncate">{{ selected.name }}</span>
        <span v-if="selected == ''" class="block truncate text-gray-500">N/A</span>
      </span>
      <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
        <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
      </span>
    </ListboxButton>

    <transition
      leave-active-class="transition ease-in duration-100"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <ListboxOptions
        class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
      >
        <ListboxOption as="template" :disabled="true">
          <li class="relative cursor-default select-none py-2 pl-1 pr-9 text-gray-900">
            <span class="ml-3 block truncate font-semibold">Credit Cards</span>
          </li>
        </ListboxOption>

        <ListboxOption
          v-for="account in accounts.credit_cards"
          :key="account.id"
          v-slot="{ active, selected }"
          as="template"
          :value="account"
        >
          <li
            :class="[
              active ? 'bg-blue-600 text-white' : 'text-gray-900',
              'relative cursor-default select-none py-2 pl-3 pr-9',
            ]"
          >
            <div class="flex items-center">
              <img
                v-if="account.institution"
                :src="account.institution.logo"
                alt=""
                class="h-6 w-6 flex-shrink-0 rounded-full"
              />
              <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                {{ account.name }}
              </span>
            </div>

            <span
              v-if="selected"
              :class="[
                active ? 'text-white' : 'text-blue-600',
                'absolute inset-y-0 right-0 flex items-center pr-4',
              ]"
            >
              <CheckIcon class="h-5 w-5" aria-hidden="true" />
            </span>
          </li>
        </ListboxOption>

        <ListboxOption as="template" :disabled="true">
          <li class="relative cursor-default select-none py-2 pl-1 pr-9 text-gray-900">
            <span class="ml-3 block truncate font-semibold">Checking Accounts</span>
          </li>
        </ListboxOption>

        <ListboxOption
          v-for="account in accounts.checking_accounts"
          :key="account.id"
          v-slot="{ active, selected }"
          as="template"
          :value="account"
        >
          <li
            :class="[
              active ? 'bg-blue-600 text-white' : 'text-gray-900',
              'relative cursor-default select-none py-2 pl-3 pr-9',
            ]"
          >
            <div class="flex items-center">
              <img
                v-if="account.institution"
                :src="account.institution.logo"
                alt=""
                class="h-6 w-6 flex-shrink-0 rounded-full"
              />
              <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                {{ account.name }}
              </span>
            </div>

            <span
              v-if="selected"
              :class="[
                active ? 'text-white' : 'text-blue-600',
                'absolute inset-y-0 right-0 flex items-center pr-4',
              ]"
            >
              <CheckIcon class="h-5 w-5" aria-hidden="true" />
            </span>
          </li>
        </ListboxOption>

        <ListboxOption as="template" :disabled="true">
          <li class="relative cursor-default select-none py-2 pl-1 pr-9 text-gray-900">
            <span class="ml-3 block truncate font-semibold">Savings Accounts</span>
          </li>
        </ListboxOption>

        <ListboxOption
          v-for="account in accounts.savings_accounts"
          :key="account.id"
          v-slot="{ active, selected }"
          as="template"
          :value="account"
        >
          <li
            :class="[
              active ? 'bg-blue-600 text-white' : 'text-gray-900',
              'relative cursor-default select-none py-2 pl-3 pr-9',
            ]"
          >
            <div class="flex items-center">
              <img
                v-if="account.institution"
                :src="account.institution.logo"
                alt=""
                class="h-6 w-6 flex-shrink-0 rounded-full"
              />
              <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                {{ account.name }}
              </span>
            </div>

            <span
              v-if="selected"
              :class="[
                active ? 'text-white' : 'text-blue-600',
                'absolute inset-y-0 right-0 flex items-center pr-4',
              ]"
            >
              <CheckIcon class="h-5 w-5" aria-hidden="true" />
            </span>
          </li>
        </ListboxOption>

        <ListboxOption as="template" :disabled="true">
          <li class="relative cursor-default select-none py-2 pl-1 pr-9 text-gray-900">
            <span class="ml-3 block truncate font-semibold">Cash Accounts</span>
          </li>
        </ListboxOption>

        <ListboxOption
          v-for="account in accounts.cash_accounts"
          :key="account.id"
          v-slot="{ active, selected }"
          as="template"
          :value="account"
        >
          <li
            :class="[
              active ? 'bg-blue-600 text-white' : 'text-gray-900',
              'relative cursor-default select-none py-2 pl-3 pr-9',
            ]"
          >
            <div class="flex items-center">
              <img
                v-if="account.institution"
                :src="account.institution.logo"
                alt=""
                class="h-6 w-6 flex-shrink-0 rounded-full"
              />
              <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                {{ account.name }}
              </span>
            </div>

            <span
              v-if="selected"
              :class="[
                active ? 'text-white' : 'text-blue-600',
                'absolute inset-y-0 right-0 flex items-center pr-4',
              ]"
            >
              <CheckIcon class="h-5 w-5" aria-hidden="true" />
            </span>
          </li>
        </ListboxOption>

        <ListboxOption as="template" :disabled="true">
          <li class="relative cursor-default select-none py-2 pl-1 pr-9 text-gray-900">
            <span class="ml-3 block truncate font-semibold">Loans</span>
          </li>
        </ListboxOption>

        <ListboxOption
          v-for="account in accounts.loans"
          :key="account.id"
          v-slot="{ active, selected }"
          as="template"
          :value="account"
        >
          <li
            :class="[
              active ? 'bg-blue-600 text-white' : 'text-gray-900',
              'relative cursor-default select-none py-2 pl-3 pr-9',
            ]"
          >
            <div class="flex items-center">
              <img
                v-if="account.institution"
                :src="account.institution.logo"
                alt=""
                class="h-6 w-6 flex-shrink-0 rounded-full"
              />
              <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                {{ account.name }}
              </span>
            </div>

            <span
              v-if="selected"
              :class="[
                active ? 'text-white' : 'text-blue-600',
                'absolute inset-y-0 right-0 flex items-center pr-4',
              ]"
            >
              <CheckIcon class="h-5 w-5" aria-hidden="true" />
            </span>
          </li>
        </ListboxOption>
      </ListboxOptions>
    </transition>
  </Listbox>
</template>

<script>
import { ref } from 'vue';
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from '@headlessui/vue';
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid';

export default {
  components: {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  props: ['accounts'],

  data() {
    return {
      selected: '',
    };
  },

  mounted() {},

  methods: {},
};
</script>
