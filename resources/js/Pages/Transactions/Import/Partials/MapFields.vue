<template>
    <p class="font-sans text-base font-semibold text-[#F5F5F6]">Account: <span class="font-normal text-sm">{{ account.name }}</span></p>
    <div class="px-4 sm:px-6 lg:px-8 mt-5">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-xl border border-[#1F242F]">
                    <table class="min-w-full divide-y divide-[#1F242F]">
                        <thead class="bg-[#161B26]">
                            <tr>
                                <th scope="col" class="py-2 pl-4 pr-3 text-left text-xs font-medium text-[#94969C] sm:pl-6">Transaction Field</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">CSV Column</th>
                                <th scope="col" class="px-2 py-4 text-left text-xs font-medium text-[#94969C]">CSV Example Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-4 pl-4">
                                    <span class="font-bold text-[#CECFD2]">Name*</span>
                                </td>
                                <td class="py-4 px-2">
                                    <select v-model="fieldMap.name" class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                                        <option value=""></option>
                                        <option v-for="(headerField, index) in header" 
                                            :key="index" 
                                            :value="headerField">
                                                {{ headerField }}
                                        </option>
                                    </select>
                                </td>
                                <td class="py-4 px-2 w-3/5">
                                    <div class="text-[#CECFD2] text-sm max-w-lg truncate">
                                        {{ namePreview }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4">
                                    <span class="font-bold text-[#CECFD2]">Date*</span>
                                </td>
                                <td class="py-4 px-2">
                                    <select v-model="fieldMap.date" class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                                        <option value=""></option>
                                        <option v-for="(headerField, index) in header" 
                                            :key="index" 
                                            :value="headerField">
                                                {{ headerField }}
                                        </option>
                                    </select>
                                </td>
                                <td class="py-4 px-2 w-3/5">
                                    <div class="text-[#CECFD2] text-sm max-w-lg truncate">
                                        {{ datePreview }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4">
                                    <span class="font-bold text-[#CECFD2]">Amount*</span>
                                </td>
                                <td class="py-4 px-2">
                                    <select v-model="fieldMap.amount" class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                                        <option value=""></option>
                                        <option v-for="(headerField, index) in header" 
                                            :key="index" 
                                            :value="headerField">
                                                {{ headerField }}
                                        </option>
                                    </select>
                                </td>
                                <td class="py-4 px-2 w-3/5">
                                    <div class="text-[#CECFD2] text-sm max-w-lg truncate">
                                        {{ amountPreview }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 flex items-center justify-between">
        <div class="flex items-center pl-1">
            <Checkbox v-model="saveMapping" :checked="saveMapping" v-show="account.import_map == null"/>
            <span class="text-[#CECFD2] text-sm ml-2" v-show="account.import_map == null">Save this mapping for future imports</span>
        </div>

        <button @click="next()" class="bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
            Next &rarr;
        </button>
    </div>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import { useImportTransactions } from '@/Composables/useImportTransactions';
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const { 
    step,
    account,
    fieldMap,
    header,
    csvData,
    convertTransactions
} = useImportTransactions();

const saveMapping = ref(false);

if( account.value.import_map ){
    fieldMap.name = account.value.import_map.name;
    fieldMap.date = account.value.import_map.date;
    fieldMap.amount = account.value.import_map.amount
}

const namePreview = computed(() => {
    if( fieldMap.name != '' ){
        let preview = [];

        for( let i = 0; i < 3; i++ ) {
            preview.push(csvData.value[i][fieldMap.name]);
        }

        return preview.join(', ');
    }else{
        return '';
    }
});

const datePreview = computed(() => {
    if( fieldMap.date != '' ){
        let preview = [];

        for( let i = 0; i < 3; i++ ) {
            preview.push(csvData.value[i][fieldMap.date]);
        }

        return preview.join(', ');
    }else{
        return '';
    }
});

const amountPreview = computed(() => {
    if( fieldMap.amount != '' ){
        let preview = [];

        for( let i = 0; i < 3; i++ ) {
            preview.push(csvData.value[i][fieldMap.amount]);
        }

        return preview.join(', ');
    }else{
        return '';
    }
});

const accountMapUrl = computed(() => {
    switch( account.value.type ){
        case 'credit-card':
            return `/credit-cards/${account.value.id}`;
        break;
        case 'loan':
        return `/credit-cards/${account.value.id}`;
        break;
        case 'cash-account':
            return `/cash-accounts/${account.value.id}`;
        break;
    }
});

const next = () => {
    if( saveMapping.value ){
        router.put(accountMapUrl.value, {
            import_map: fieldMap
        }, {
            preserveState: true,
            onSuccess: () => {
                reviewTransactions();
            }
        });
    }else{
        reviewTransactions();
    }
}

const reviewTransactions = () => {
    // load rules
    // Duplicates
    convertTransactions();
    step.value = 'review-transactions';
}


</script>