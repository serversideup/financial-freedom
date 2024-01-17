<template>
    <div class="px-4 sm:px-6 lg:px-8 mb-10">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-xl border border-[#1F242F]">
                    <div class="px-4 py-5 flex items-center justify-between border-b border-[#1F242F]">
                        <div class="flex items-center font-sans text-lg font-semibold text-[#F5F5F6]">
                            {{ group.name }}

                            <span class="ml-2 rounded-full border border-[#0040C1] bg-[#026] px-2 py-[2px] text-[#84ADFF] font-sans text-xs font-medium">
                                {{ group.categories.length }} categories
                            </span>
                        </div>

                        <div class="flex items-center justify-center">
                            <button @click="addCategory()" class="py-[10px] px-[14px] font-sans text-sm font-semibold cursor-pointer bg-[#155EEF] text-[#FFF] rounded-lg">
                                Add Category
                            </button>
                        </div>
                    </div>
                    <table class="min-w-full divide-y divide-[#1F242F]">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-medium text-[#94969C]">Name</th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-[#94969C]">Color</th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-medium text-[#94969C]">Preview</th>
                                <th scope="col" class="relative py-4 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr v-for="(category, index) in group.categories" :key="category.id">
                                <td class="py-3 pl-4 w-80 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                    {{ category.name }}
                                </td>
                                <td class="py-3 pl-4 w-32 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                    <select @change="updateColor( category )" v-model="group.categories[index].color" class="block text-sm w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
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
                                <td class="py-3 px-4 text-[#F5F5F6] border-b border-[#1F242F]">
                                    <div class="w-full flex items-center justify-end">
                                        <button @click="deleteCategory(category)" class="text-[#94969C] font-sans text-sm font-semibold">Delete</button>
                                        <button @click="editCategory(category)" class="text-[#CECFD2] ml-3 font-sans text-sm font-semibold">Edit</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useCategoryColor } from '@/Composables/useCategoryColor.js';
import { router } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const bus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')

const {
    getCategoryColor
} = useCategoryColor();

const props = defineProps({
    group: {
        type: Object,
        default: {},
    }
});

const addCategory = () => {
    bus.emit('prompt-add-category', props.group);
}

const editCategory = ( category ) => {
    bus.emit('prompt-edit-category', category);
}

const deleteCategory = ( category ) => {
    bus.emit('prompt-delete-category', category);
}

const updateColor = ( category ) => {
    router.put(`/settings/categories/${category.id}`, {
        'color': category.color
    }, {
        preserveScroll: true,
        onSuccess: () => {
            notifyBus.emit('notify', {
                title: 'Category Updated',
                body: 'The category color has been updated.',
                type: 'success'
            });
        }
    })
}
</script>