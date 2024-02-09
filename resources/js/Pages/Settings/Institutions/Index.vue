<template>
    <Head :title="'Institutions - Settings'"/>

    <div class="w-full flex flex-col">
        <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Institutions</h1>
    
        <Navigation/>

        <div class="flex items-center justify-between py-5">
            <div class="flex flex-col">
                <span class="font-sans text-lg font-semibold text-[#F5F5F6]">Institutions</span>
                <span class="font-sans text-sm text-[#94969C]">Financial institutions available Financial Freedom</span>
            </div>
            
            <button @click="promptAddInstitution()" class="bg-[#155EEF] text-[#F5F5F6] font-sans text-sm font-semibold py-[10px] px-[14px] rounded-lg flex items-center">
                <svg width="20" height="20" class="mr-[6px]" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.99984 4.16669V15.8334M4.1665 10H15.8332" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                Add Institution
            </button>
        </div>

        <InstitutionTable/>

        <AddInstitutionModal/>
        <EditInstitutionModal/>
        <DeleteInstitutionModal/>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import AddInstitutionModal from './Partials/AddInstitutionModal.vue';
import EditInstitutionModal from './Partials/EditInstitutionModal.vue';
import DeleteInstitutionModal from './Partials/DeleteInstitutionModal.vue';
import InstitutionTable from './Partials/InstitutionTable.vue';
import Navigation from '../Partials/Navigation.vue';
import { Head } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')

const promptAddInstitution = () => {
    promptBus.emit('prompt-add-institution')
}
</script>