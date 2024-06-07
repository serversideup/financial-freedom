<template>
    <div>
        <SlideOut :show="show" @close="close" :max-width="'sm'">
            <template #title>
                <h3 class="font-semibold font-sans text-[#F5F5F6] text-xl">Add Rule</h3>
            </template>

            <template #body>
                <div class="flex flex-col w-full">
                    <div class="flex flex-col mt-5">
                        <InputLabel value="Adding Rule to Account"/>
                        <span class="text-[#94969C] font-sans text-sm">{{ account.name }}</span>
                    </div>

                    <div class="flex flex-col mt-5">
                        <InputLabel value="Text to match"/>
                        <TextInput class="mt-1" v-model="form.search_string" placeholder="Text to match against"/>
                        <InputError class="mt-2" :message="form.errors.search_string" />
                    </div>

                    <div class="flex flex-col mt-5">
                        <InputLabel value="Replace String"/>
                        <TextInput class="mt-1" v-model="form.replace_string" placeholder="Text to replace"/>
                        <InputError class="mt-2" :message="form.errors.replace_string" />
                    </div>

                    <div class="flex flex-col mt-5">
                        <InputLabel value="Apply Category"/>
                        <Combobox v-model="form.category">
                            <div class="relative mt-1">
                                <ComboboxInput 
                                    @change="categoryQuery = $event.target.value"
                                    :displayValue="(category) => category ? category.name : ''" 
                                    placeholder="Select a category"
                                    class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                    <ChevronDownIcon class="h-5 w-5 text-[#6C727F]"/>
                                </ComboboxButton>
                            </div>
                            <TransitionRoot
                                leave="transition ease-in duration-100"
                                leaveFrom="opacity-100"
                                leaveTo="opacity-0"
                                @after-leave="categoryQuery = ''">

                                <ComboboxOptions
                                    class="absolute mt-1 max-h-60 w-72 overflow-auto rounded-md bg-[#161B26] border border-[#1F242F] py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm z-50">
                                    <div
                                        v-if="filteredGroups.length === 0 && categoryQuery !== ''"
                                        class="relative cursor-default text-[#CECFD2] select-none px-4 py-2">
                                            No category found.
                                    </div>
                                    <template v-for="group in filteredGroups">
                                        <ComboboxOption
                                            :disabled="true">
                                                <li class="pl-2 py-2 text-[#CECFD2] cursor-default select-none font-semibold">
                                                    {{ group.name }}
                                                </li>
                                        </ComboboxOption>
                                        <ComboboxOption
                                            v-for="category in group.categories"
                                            as="template"
                                            :key="category.id"
                                            :value="category"
                                            v-slot="{ selected, active }">
                                                <li 
                                                    :class="{
                                                        'bg-[#1F242F]': active,
                                                    }" 
                                                    class="px-2 py-2 text-[#CECFD2] flex items-center cursor-pointer select-none pl-5 pr-4">
                                                        <span :style="{ backgroundColor: getCategoryColor(category.color) }" class="w-2 h-2 rounded-full mr-1"></span>
                                                        {{ category.name }}
                                                </li>
                                        </ComboboxOption>
                                    </template>
                                    
                                </ComboboxOptions>
                            </TransitionRoot>
                        </Combobox>
                    </div>
                </div>
            </template>

            <template #footer>
                <div class="flex items-center justify-end space-x-3 px-3 py-4 border-t border-[#1F242F]">
                    <button type="button" @click="closeModal" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                        Cancel
                    </button>
                    <button @click="addRule" class="bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                        Add
                    </button>
                </div>
            </template>
        </SlideOut>
    </div>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SlideOut from '@/Components/SlideOut.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ChevronDownIcon } from '@heroicons/vue/20/solid';
import { useEventBus } from '@vueuse/core';
import { 
    computed, 
    ref
} from 'vue';
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'
import { 
    useCategoryColor 
} from '@/Composables/useCategoryColor.js';

const props = defineProps({
    apply: Boolean,
});

const {
    getCategoryColor
} = useCategoryColor();

const account = ref({});
const show = ref(false);

const form = useForm({
    account: null,
    category: null,
    search_string: '',
    replace_string: '',
});

const categoryQuery = ref('');

const groups = computed(() => usePage().props.groups);
const filteredGroups = computed(() => {
    let filteredGroups = groups.value.map(group => {
        return {
            ...group,
            categories: group.categories.filter(category => {
                return category.name.toLowerCase().includes(categoryQuery.value.toLowerCase());
            })
        }
    });

    return filteredGroups.filter(group => group.categories.length > 0);
});

const promptBus = useEventBus('ff-prompt-event-bus');

const listener = ( event, data ) => {
    if( event == 'prompt-add-rule' ) {
        show.value = true;
        account.value = data.account;
        form.account = data.account;
    }
}
promptBus.on(listener);

const close = () => {
    show.value = false;
}

const functionBus = useEventBus('ff-function-event-bus');

const addRule = () => {
    form.post('/rules', {
        preserveScroll: true,
        onSuccess: () => {
            show.value = false;
            form.reset();

            if( props.apply ) {
                functionBus.emit('apply-rules');
            }
        }
    });
}
</script>