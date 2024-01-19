<template>
    <Modal @close="closeModal" :show="show" :max-width="'md'">
        <form class="flex flex-col w-full" @submit.prevent="submit">
            <div class="flex items-center justify-between w-full">
                <BankModalIcon class="flex-shrink-0"/>
                
                <button type="button" @click="closeModal">
                    <ModalCloseIcon/>
                </button>
            </div>

            <span class="font-sans text-lg font-semibold text-[#F5F5F6] mt-4">Edit Institution</span>
            <span class="font-sans text-sm text-[#94969C]">Edit the institution where you bank at.</span>

            <div class="flex flex-col mt-5">
                <label class="text-[#CECFD2] font-sans font-medium text-sm">Name</label>
                <input v-model="form.name" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="flex flex-col mt-5">
                <label class="text-[#CECFD2] font-sans font-medium text-sm">URL</label>
                <input v-model="form.url" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
                <InputError class="mt-2" :message="form.errors.url" />
            </div>

            <div class="pt-8 flex items-center justify-end">
                <button type="button" @click="closeModal" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                    Cancel
                </button>
                <button class="ml-3 bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                    Update
                </button>
            </div>
        </form>
        
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import BankModalIcon from '@/Components/Icons/BankModalIcon.vue';
import ModalCloseIcon from '@/Components/Icons/ModalCloseIcon.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')
const show = ref(false);
const institutionId = ref(null);

const form = useForm({
    name: '',
    url: '',
});

const listener = ( event, institution ) => {
    if( event == 'prompt-edit-institution' ){
        institutionId.value = institution.id;
        form.name = institution.name;
        form.url = institution.url;
        show.value = true;
    }
}
promptBus.on(listener);

const closeModal = () => {
    form.clearErrors();
    form.reset();
    show.value = false;
}

const submit = () => {
    form.put(`/settings/institutions/${institutionId.value}`, {
        preserveScroll: true,
        onSuccess: () => {
            institutionId.value = null;
            show.value = false;
            form.reset();
            notifyBus.emit('notify', {
                title: 'Institution Updated',
                body: 'Institution has been updated.',
                type: 'success'
            });
        }
    })
}
</script>