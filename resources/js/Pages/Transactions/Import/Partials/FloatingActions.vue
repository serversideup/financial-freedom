<template>
    <div class="fixed bg-opacity-70 bg-[#0C111D] border-t border-[#1F242F] left-0 right-0 bottom-0 p-4 space-x-4 flex items-center justify-end">
        <button @click="promptAddRule" class="text-[#CECFD2] bg-[#0C111D] hover:bg-gray-800 cursor-pointer px-[14px] py-[10px] rounded-md font-semibold border border-[#333741] inline-flex items-center gap-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>

            Create Rule
        </button>
        <button :disabled="importing" @click="importTransactions" :class="{
            'bg-gray-300 border-gray-300 text-gray-500' : importing,
            'bg-[#004EEB] text-white border-[#004EEB]' : !importing
        }" class="cursor-pointer px-[14px] py-[10px] rounded-md font-semibold border inline-flex items-center gap-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
            </svg>

            Import
        </button>
    </div>
</template>

<script setup>
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { useEventBus } from '@vueuse/core';

const { 
    form,
    importing,
    importTransactions 
} = useImportTransactions();

const promptBus = useEventBus('ff-prompt-event-bus');

const promptAddRule = () => {
    promptBus.emit('prompt-add-rule', {
        account: form.account
    });
}
</script>