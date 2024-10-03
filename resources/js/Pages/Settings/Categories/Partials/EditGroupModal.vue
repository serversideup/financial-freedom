<template>
    <Modal @close="closeModal" :show="show" :max-width="'md'">
        <form class="flex flex-col w-full" @submit.prevent="submit">
            <div class="flex items-center justify-between w-full">
                <FolderModalIcon class="flex-shrink-0"/>
                
                <button type="button" @click="closeModal">
                    <ModalCloseIcon/>
                </button>
            </div>

            <span class="font-sans text-lg font-semibold text-[#F5F5F6] mt-4">Update Group</span>
            <span class="font-sans text-sm text-[#94969C]">Update data regarding your group</span>

            <div class="flex flex-col mt-5">
                <InputLabel value="Name"/>
                <TextInput v-model="form.name" class="mt-1"/>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="flex flex-col mt-5">
                <InputLabel value="Color"/>
                <select v-model="form.color" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                    <option value="" disabled>Select a color</option>
                    <option value="green">Green</option>
                    <option value="purple">Purple</option>
                    <option value="orange">Orange</option>
                    <option value="gray">Gray</option>
                    <option value="blue">Blue</option>
                    <option value="pink">Pink</option>
                </select>
                <InputError class="mt-2" :message="form.errors.color" />
            </div>

            <div class="pt-8 flex items-center justify-end">
                <button type="button" @click="closeModal" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                    Cancel
                </button>
                <button @click="updateCategory" class="ml-3 bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                    Update
                </button>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import ModalCloseIcon from '@/Components/Icons/ModalCloseIcon.vue';
import FolderModalIcon from '@/Components/Icons/FolderModalIcon.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')
const show = ref(false);
const groupId = ref(null);

const form = useForm({
    name: '',
    color: '',
    group_id: ''
});

const listener = ( event, group ) => {
    if( event == 'prompt-edit-group' ){
        groupId.value = group.id;
        form.name = group.name;
        form.color = group.color;
        show.value = true;
    }
}
promptBus.on(listener);

const closeModal = () => {
    form.reset();
    groupId.value = null;
    show.value = false;
}

const submit = () => {
    form.put(`/settings/groups/${groupId.value}`, {
        preserveScroll: true,
        onSuccess: () => {
            groupId.value = null;
            show.value = false;
            form.reset();
            notifyBus.emit('notify', {
                title: 'Group Updated',
                body: 'Your group has been updated.',
                type: 'success'
            });
        }
    })
}

</script>