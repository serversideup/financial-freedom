<template>
    <Combobox v-model="selected">
        <div class="relative mt-1">
            <div class="relative w-full text-left bg-white rounded-md border focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 overflow-hidden">
                <ComboboxInput
                    class="w-full border-none focus:ring-0 py-2 pl-3 pr-10 text-sm leading-5 text-gray-900"
                    :displayValue="(category) => category.name ? category.name : ''"
                    @change="query = $event.target.value"/>
          
                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                </ComboboxButton>
            </div>
            
            <TransitionRoot
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
                @after-leave="query = ''">
                    <ComboboxOptions class="absolute w-96 py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none z-modal sm:text-sm">
                        <div
                            v-if="filteredCategories.length === 0 && query !== ''"
                            class="cursor-default select-none relative py-2 px-4 text-gray-700">
                                Nothing found.
                        </div>

                        <ComboboxOption 
                            v-for="category in filteredCategories" as="template" 
                            :key="category.id"
                            :value="category"
                            v-slot="{ selected, active }">
                                <li
                                    class="cursor-default select-none relative py-2 pl-10 pr-4"
                                    :class="{
                                        'text-white bg-blue-600': active,
                                        'text-gray-900': !active,
                                    }">
                                    <span
                                        class="block truncate"
                                        :class="{ 'font-medium': selected, 'font-normal': !selected }">
                                            <span v-if="category.parent_name != ''" class="text-gray-400" v-text="category.parent_name +' > '"></span> {{ category.name }}
                                    </span>
                                    <span
                                        v-if="selected"
                                        class="absolute inset-y-0 left-0 flex items-center pl-3"
                                        :class="{ 'text-white': active, 'text-blue-600': !active }">
                                            <CheckIcon class="w-5 h-5" aria-hidden="true" />
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
} from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'

export default {
    data(){
        return {
            selected: '',
            query: '',
        }
    },

    components: {
        Combobox,
        ComboboxInput,
        ComboboxButton,
        ComboboxOptions,
        ComboboxOption,
        TransitionRoot,
        CheckIcon,
        SelectorIcon
    },

    computed: {
        filteredCategories(){
            return this.query === ''
                ? this.$page.props.categories
                : this.$page.props.categories.filter((category) => {
                    return category.name
                            .toLowerCase()
                            .replace(/\s+/g, '')
                            .includes(this.query.toLowerCase().replace(/\s+/g, ''))
                })
        }
    }
}
</script>
