<template>
    <Modal @close="closeModal" :show="show" :max-width="'xl'">
        <div class="flex flex-col w-full">
            <div class="flex w-full">
                <TrashModalIcon class="flex-shrink-0"/>
                
                <div class="flex-1 ml-4">
                    <div class="flex items-center justify-between w-full">
                        <span class="font-sans text-lg font-semibold text-[#F5F5F6]">Delete Category</span>
                        <button @click="closeModal">
                            <ModalCloseIcon/>
                        </button>
                    </div>
                    <span class="font-sans text-sm text-[#94969C]">Are you sure you want to delete this category?</span>
                </div>
            </div>
            <div class="pt-8 flex items-center justify-end">
                <button @click="closeModal" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                    Cancel
                </button>
                <button @click="deleteCategory" class="ml-3 bg-[#D92D20] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#D92D20]">
                    Delete
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import ModalCloseIcon from '@/Components/Icons/ModalCloseIcon.vue';
import TrashModalIcon from '@/Components/Icons/TrashModalIcon.vue';
import { ref } from 'vue';
import { useEventBus } from '@vueuse/core'
import { router } from '@inertiajs/vue3';

const promptBus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')
const show = ref(false);
const category = ref({});

const listener = ( event, data ) => {
    if( event == 'prompt-delete-category' ){
        category.value = data;
        show.value = true;
    }
}
promptBus.on(listener);

const closeModal = () => {
    category.value = {};
    show.value = false;
}

const deleteCategory = () => {
    router.delete('/settings/categories/'+category.value.id, {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            notifyBus.emit('notify', {
                title: 'Category Deleted',
                body: 'The category has been deleted.',
                type: 'success'
            });
        }
    });
}
</script>