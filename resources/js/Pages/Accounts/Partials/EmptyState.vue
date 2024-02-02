<template>
    <div class="flex flex-col items-center justify-center">
        <div class="flex items-center justify-center w-12 h-12 rounded-[10px] border border-[#333741]">
            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3C12 4.10457 9.53757 5 6.5 5C3.46243 5 1 4.10457 1 3M12 3C12 1.89543 9.53757 1 6.5 1C3.46243 1 1 1.89543 1 3M12 3V4.5M1 3V15C1 16.1046 3.46243 17 6.5 17M6.5 9C6.33145 9 6.16468 8.99724 6 8.99185C3.19675 8.89999 1 8.04328 1 7M6.5 13C3.46243 13 1 12.1046 1 11M21 9.5C21 10.6046 18.5376 11.5 15.5 11.5C12.4624 11.5 10 10.6046 10 9.5M21 9.5C21 8.39543 18.5376 7.5 15.5 7.5C12.4624 7.5 10 8.39543 10 9.5M21 9.5V17C21 18.1046 18.5376 19 15.5 19C12.4624 19 10 18.1046 10 17V9.5M21 13.25C21 14.3546 18.5376 15.25 15.5 15.25C12.4624 15.25 10 14.3546 10 13.25" stroke="#CECFD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <span class="text-[#F5F5F6] font-sans font-semibold text-base mt-4">No accounts found</span>
        <span class="mt-1 font-sans text-[#94969C] text-sm">You must add an account before you can view data.</span>
        
        <button @click="addAccount" class="px-[14px] py-[10px] rounded-lg bg-[#155EEF] flex items-center text-[#F5F5F6] font-semibold mt-6">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-[6px]">
                <path d="M7.00033 1.16669V12.8334M1.16699 7.00002H12.8337" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Add Account
        </button>
    </div>
</template>

<script setup>
import { useEventBus } from '@vueuse/core'

const promptBus = useEventBus('ff-prompt-event-bus')

const addAccount = () => {
    promptBus.emit('prompt-add-account');
}
</script>