<template>
    <Modal @close="closeModal" :show="show">
        <div class="flex flex-col w-full">
            <div class="flex items-center justify-between w-full">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                    <path d="M11.9998 9.88182V13.8818M11.9998 17.8818H12.0098M10.6151 4.77355L2.39019 18.9802C1.93398 19.7682 1.70588 20.1622 1.73959 20.4855C1.769 20.7676 1.91677 21.0239 2.14613 21.1906C2.40908 21.3818 2.86435 21.3818 3.77487 21.3818H20.2246C21.1352 21.3818 21.5904 21.3818 21.8534 21.1906C22.0827 21.0239 22.2305 20.7676 22.2599 20.4855C22.2936 20.1622 22.0655 19.7682 21.6093 18.9802L13.3844 4.77354C12.9299 3.98838 12.7026 3.5958 12.4061 3.46395C12.1474 3.34893 11.8521 3.34893 11.5935 3.46395C11.2969 3.5958 11.0696 3.98838 10.6151 4.77355Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                
                <button type="button" @click="closeModal">
                    <ModalCloseIcon/>
                </button>
            </div>

            <span class="font-sans text-lg font-semibold text-[#F5F5F6] mt-4">Potential Duplicate Transaction</span>
            <span class="font-sans text-sm text-[#94969C]">We found a transaction that you've already processed that looks similar.</span>

            <table class="mt-8">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th class="text-left text-[#F5F5F6]">
                            Existing Transaction
                        </th>
                        <th class="text-left text-[#F5F5F6]">
                            New Transaction
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-[#F5F5F6] py-2 font-medium">
                            Amount
                        </td>
                        <td class="text-[#F5F5F6] py-2">
                            ${{ Math.abs( form.transactions[transactionIndex].potential_duplicate.amount ) }}
                        </td>
                        <td class="text-[#F5F5F6] py-2">
                            ${{ Math.abs( form.transactions[transactionIndex].amount ) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-[#F5F5F6] py-2 font-medium">
                            Date
                        </td>
                        <td class="text-[#F5F5F6] py-2">
                            {{ moment( form.transactions[transactionIndex].potential_duplicate.date ).format('MM/DD/YYYY') }}
                        </td>
                        <td class="text-[#F5F5F6] py-2">
                            {{ moment( form.transactions[transactionIndex].date ).format('MM/DD/YYYY') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-[#F5F5F6] py-2 font-medium">
                            Merchant
                        </td>
                        <td class="text-[#F5F5F6] py-2">
                            {{ form.transactions[transactionIndex].potential_duplicate.merchant }}
                        </td>
                        <td class="text-[#F5F5F6] py-2">
                            {{ form.transactions[transactionIndex].name }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="pt-8 flex items-center justify-end">
                <button type="button" @click="notDuplicate()" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                    Not Duplicate
                </button>
                <button type="button" @click="deleteTransaction()" class="ml-3 bg-[#D92D20] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#D92D20]">
                    Remove
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import ModalCloseIcon from '@/Components/Icons/ModalCloseIcon.vue';
import moment from 'moment';
import { ref } from 'vue';
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { useEventBus } from '@vueuse/core'

const { 
    form,
    removeTransaction
} = useImportTransactions();

const show = ref(false);
const transactionIndex = ref(null);

const promptBus = useEventBus('ff-prompt-event-bus')

const listener = ( event, data ) => {
    if( event == 'prompt-check-duplicate' ){
        transactionIndex.value = data;
        show.value = true;
    }
}
promptBus.on(listener);

const closeModal = () => {
    show.value = false;
    transactionIndex.value = false;
}

const notDuplicate = () => {
    form.transactions[transactionIndex.value].potential_duplicate = null;
    closeModal();
}

const deleteTransaction = () => {
    removeTransaction(transactionIndex.value);
    closeModal();
}
</script>