<template>
    <Head :title="'Settings'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Categories</h1>
        
        
        <Navigation/>

        <div class="flex items-center justify-between py-5">
            <div class="flex flex-col">
                <span class="font-sans text-lg font-semibold text-[#F5F5F6]">System Categories</span>
                <span class="font-sans text-sm text-[#94969C]">Categories used for transactions within Financial Freedom</span>
            </div>
            
            <button class="bg-[#155EEF] text-[#F5F5F6] font-sans text-sm font-semibold py-[10px] px-[14px] rounded-lg flex items-center">
                <svg width="20" height="20" class="mr-[6px]" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.99984 4.16669V15.8334M4.1665 10H15.8332" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                Add Category
            </button>
        </div>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-xl border border-[#1F242F]">
                        <table class="min-w-full divide-y divide-[#1F242F]">
                            <thead class="bg-[#161B26]">
                                <tr>
                                    <th scope="col" class="py-4 pl-4 pr-3 text-left text-xs font-medium text-[#94969C] sm:pl-6">Name</th>
                                    <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-[#94969C]">Color</th>
                                    <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-[#94969C]">Preview</th>
                                    <th scope="col" class="relative py-4 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr v-for="(category, index) in categories.data" :key="category.id">
                                    <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                        {{ category.name }}<br>
                                        <span v-if="category.parent_id" class="text-[#94969C] font-sans text-sm">Parent: {{ category.parent.name }}</span>
                                    </td>
                                    <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                        <select v-model="categories.data[index].color" class="block text-sm w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                                            <option value="" disabled>Select a color</option>
                                            <option value="green">Green</option>
                                            <option value="purple">Purple</option>
                                            <option value="orange">Orange</option>
                                            <option value="gray">Gray</option>
                                            <option value="blue">Blue</option>
                                            <option value="pink">Pink</option>
                                            <option value="red">Red</option>
                                        </select>
                                    </td>
                                    <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                        <span class="text-xs font-sans font-medium leading-[18px] px-[6px] py-[2px] inline-flex items-center border border-[#333741] rounded-md">
                                            <span :style="{ backgroundColor: getCategoryColor(category.color) }" class="w-2 h-2 rounded-full mr-1"></span>
                                            {{ category.name }}
                                        </span>
                                    </td>
                                    <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                        <button @click="editCategory(category)">Edit</button>
                                        <button @click="deleteCategory(category)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="bg-[#161B26] py-8"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import Navigation from '../Partials/Navigation.vue';
import { useCategoryColor } from '@/Composables/useCategoryColor.js';
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const {
    getCategoryColor
} = useCategoryColor();

const bus = useEventBus('ff-notification-event-bus')

const categories = computed( () => usePage().props.categories );

</script>