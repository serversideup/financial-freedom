<template>
    <Modal @close="closeModal" :show="show" :max-width="'md'">
        <form class="flex flex-col w-full" @submit.prevent="submit">
            <div class="flex items-center justify-between w-full">
                <FolderModalIcon class="flex-shrink-0"/>
                
                <button type="button" @click="closeModal">
                    <ModalCloseIcon/>
                </button>
            </div>

            <span class="font-sans text-lg font-semibold text-[#F5F5F6] mt-4">Create Category</span>
            <span class="font-sans text-sm text-[#94969C]">Add a new category for your transactions</span>

            <div class="flex flex-col mt-5">
                <InputLabel value="Name"/>
                <TextInput v-model="form.name" class="mt-1"/>
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="flex flex-col mt-4">
                <InputLabel value="Group"/>
                <select v-model="form.group_id" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                    <option value="" disabled>Select a group</option>
                    <option v-for="group in groups"
                        :value="group.id">{{ group.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.group_id" />
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
                <button class="ml-3 bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                    Create
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
import { computed, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const groups = computed(() => usePage().props.groups);

const promptBus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')
const show = ref(false);

const form = useForm({
    name: '',
    color: '',
    group_id: ''
});

const listener = ( event, group ) => {
    if( event == 'prompt-add-category' ){
        form.group_id = group.id;
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
    form.post(`/settings/categories`, {
        preserveScroll: true,
        onSuccess: () => {
            show.value = false;
            form.reset();
            notifyBus.emit('notify', {
                title: 'Category Added',
                body: 'Category has been added and is ready for use.',
                type: 'success'
            });
        }
    })
}

</script>