<template>
    <Transition name="slide-in-right">
        <div class="flex items-start justify-between w-[400px] rounded-xl p-4 fixed top-6 right-6 bg-[#161B26] z-50" v-show="show">
            <SuccessNotificationIcon class="flex-shrink-0"/>

            <div class="flex flex-1 flex-col pl-2">
                <span v-text="title" class="mb-1 font-semibold text-sm text-white"></span>
                <span v-text="body" class="text-sm text-[#CECFD2]"></span>

                <div class="mt-3" @click="show = false">
                    <button class="text-[#CECFD2] font-sans font-semibold text-sm">Dismiss</button>
                </div>
            </div>

            <button class="cursor-pointer flex-shrink-0 pl-2" @click="show = false">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 11M1 1L11 11" stroke="#85888E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </Transition>
</template>

<script setup>
import SuccessNotificationIcon from '@/Components/Icons/SuccessNotificationIcon.vue';
import { ref } from 'vue';
import { useEventBus } from '@vueuse/core'

const bus = useEventBus('ff-notification-event-bus')
const show = ref(false);

const title = ref('');
const body = ref('');

const listener = ( event, data ) => {
    title.value = data.title;
    body.value = data.body;

    show.value = true;

    setTimeout(() => {
        show.value = false;
    }, 3000);
}
bus.on(listener);
</script>