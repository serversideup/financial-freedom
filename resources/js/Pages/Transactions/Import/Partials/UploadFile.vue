<template>
    <div class="flex flex-col max-w-md">
        <p class="font-sans text-base font-semibold text-[#F5F5F6]">Account: <span class="font-normal text-sm">{{ form.account.name }}</span></p>
        <label class="text-[#CECFD2] font-sans font-medium text-sm mt-5">Upload Transactions File</label>
        <div class="mt-1 flex flex-col items-center justify-center mx-auto w-full rounded-xl border border-[#1F242F] px-6 py-4">
            <div class="rounded-lg border border-[#333741] p-[10px] flex items-center justify-center mb-3">
                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66666 12.3333L9.99999 9M9.99999 9L13.3333 12.3333M9.99999 9V16.5M16.6667 12.9524C17.6846 12.1117 18.3333 10.8399 18.3333 9.41667C18.3333 6.88536 16.2813 4.83333 13.75 4.83333C13.5679 4.83333 13.3975 4.73833 13.3051 4.58145C12.2184 2.73736 10.212 1.5 7.91666 1.5C4.46488 1.5 1.66666 4.29822 1.66666 7.75C1.66666 9.47175 2.36286 11.0309 3.48911 12.1613" stroke="#CECFD2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <span class="mb-1 text-[#94969C] text-xs font-sans">
                <label for="file-upload" class="font-semibold text-sm font-sans text-[#CECFD2] cursor-pointer">Click to upload
                    <input ref="transactionsImportCsv" accept="text/csv" type="file" id="file-upload" @change="handleFileUpload()" class="sr-only"/>
                </label>
                or drag and drop
            </span>
            <span class="text-[#94969C] text-xs font-sans">CSV files in the proper format accepted.</span>
        </div>
    </div>
</template>

<script setup>
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { ref } from 'vue';

const { 
    form,
    file, 
    parseUpload 
} = useImportTransactions();

const transactionsImportCsv = ref(null);

const handleFileUpload = () => {
    file.value = transactionsImportCsv.value.files[0];
    parseUpload();
}
</script>