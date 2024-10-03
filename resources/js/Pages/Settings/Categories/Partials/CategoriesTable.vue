<template>
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
                                    </select>
                                </td>
                                <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                    <span class="text-xs font-sans font-medium leading-[18px] px-[6px] py-[2px] inline-flex items-center border border-[#333741] rounded-md">
                                        <span :style="{ backgroundColor: getCategoryColor(category.color) }" class="w-2 h-2 rounded-full mr-1"></span>
                                        {{ category.name }}
                                    </span>
                                </td>
                                <td class="py-3 pl-4 font-sans text-sm text-[#F5F5F6] font-medium border-b border-[#1F242F]">
                                    <button @click="deleteCategory(category)" class="text-[#94969C] font-sans text-sm font-semibold">Delete</button>
                                    <button @click="editCategory(category)" class="text-[#CECFD2] ml-3 font-sans text-sm font-semibold">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="py-[14px] px-6">
                                    <div class="w-full flex items-center justify-between">
                                        <button @click="previous()" class="text-sm inline-flex items-center px-3 py-2 rounded-lg border border-[#333741] font-sans font-semibold text-[#CECFD2] bg-[#161B26]">
                                            <div class="w-5 h-5 flex items-center justify-center mr-1">
                                                <ArrowLeftIcon/>
                                            </div>
                                            
                                            Previous
                                        </button>

                                        <div class="flex items-center">
                                            <button
                                                v-for="link in paginationNumbers" 
                                                @click="link.url != null ? toPage( link.url ) : null"
                                                v-text="link.label"
                                                class="w-8 h-8 flex items-center justify-center font-sans text-sm font-medium hover:text-[#ECECED]"
                                                :class="link.active 
                                                    ? 'text-[#ECECED] bg-[#1F242F] rounded-lg' 
                                                    : 'text-[#94969C]'">
                                            </button>
                                        </div>
                                        

                                        <button @click="next()" class="text-sm inline-flex items-center px-3 py-2 rounded-lg border border-[#333741] font-sans font-semibold text-[#CECFD2] bg-[#161B26]">
                                            Next
                                            
                                            <div class="w-5 h-5 flex items-center justify-center ml-1">
                                                <ArrowRightIcon/>
                                            </div>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ArrowLeftIcon from '@/Components/Icons/LeftArrowIcon.vue';
import ArrowRightIcon from '@/Components/Icons/RightArrowIcon.vue';
import { useCategoryColor } from '@/Composables/useCategoryColor.js';
import { router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { useEventBus } from '@vueuse/core'

const {
    getCategoryColor
} = useCategoryColor();

const bus = useEventBus('ff-prompt-event-bus')

const categories = computed( () => usePage().props.categories );
const paginationNumbers = computed(() => {
    return categories.value.links 
        ? categories.value.links.splice(1, categories.value.links.length - 2) 
        : [];
});

const url = ref('/settings/categories');
const loading = ref(false);

const previous = () => {
    if( categories.value.prev_page_url == null ){
        return;
    }

    url.value = categories.value.prev_page_url;
    getCategories();
}

const next = () => {
    if( categories.value.next_page_url == null ){
        return;
    }

    url.value = categories.value.next_page_url;
    getCategories();
}

const toPage = ( page ) => {
    url.value = page;
    getCategories();
}

const getCategories = () => {
    loading.value = true;

    let params = buildParams();

    router.visit(url.value, { 
        only: ['categories'], 
        data: params,
        preserveScroll: true,
        preserveState: true,
        onSuccess: () =>  {
            loading.value = false;
        }
    });
}

const deleteCategory = ( category ) => {
    bus.emit('prompt-delete-category', category);
}

const buildParams = () => {
    let params = {};

    // if( orderBy.value != 'created_at' ){
    //     params.order_by = orderBy.value;
    // }

    // if( orderDirection.value != 'desc' ){
    //     params.order_direction = orderDirection.value;
    // }
        
    // params.status = status.value;

    return params;
}
</script>