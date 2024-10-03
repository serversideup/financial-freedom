<template>
    <Head :title="'Categories - Settings'"/>

    <div class="w-full flex flex-col">
        <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Categories</h1>
        
        <Navigation/>

        <div class="flex items-center justify-between py-5">
            <div class="flex flex-col">
                <span class="font-sans text-lg font-semibold text-[#F5F5F6]">System Categories</span>
                <span class="font-sans text-sm text-[#94969C]">Categories used for transactions within Financial Freedom</span>
            </div>
            
            <button @click="showAddGroupModal" class="bg-[#155EEF] text-[#F5F5F6] font-sans text-sm font-semibold py-[10px] px-[14px] rounded-lg flex items-center">
                <svg width="20" height="20" class="mr-[6px]" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.99984 4.16669V15.8334M4.1665 10H15.8332" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                Add Group
            </button>
        </div>

        <GroupTable v-for="group in groups"
            :group="group"/>

        <AddGroupModal/>
        <EditGroupModal/>
        <AddCategoryModal/>
        <EditCategoryModal/>
        <DeleteCategoryModal/>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import AddCategoryModal from './Partials/AddCategoryModal.vue';
import DeleteCategoryModal from './Partials/DeleteCategoryModal.vue';
import EditCategoryModal from './Partials/EditCategoryModal.vue';
import EditGroupModal from './Partials/EditGroupModal.vue';
import GroupTable from './Partials/GroupTable.vue';
import Navigation from '../Partials/Navigation.vue';
import AddGroupModal from './Partials/AddGroupModal.vue';
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')

const groups = computed(() => usePage().props.groups);

const showAddGroupModal = () => {
    promptBus.emit('prompt-add-group');
}
</script>