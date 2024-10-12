<template>
    <Head :title="'Dashboard'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <div class="flex w-full justify-between mb-8">
            <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Financial Performance Summary</h1>
            <div class="flex items-center space-x-3">
                <button class="py-[10px] px-[14px] rounded-lg border border-[#333741] bg-[#161B26] font-sans text-[#CECFD2] font-semibold flex items-center">
                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M12.5421 7.5H4.58333C3.43274 7.5 2.5 6.56726 2.5 5.41667C2.5 4.26607 3.43274 3.33333 4.58333 3.33333H12.5421M7.45791 16.6667H15.4167C16.5673 16.6667 17.5 15.7339 17.5 14.5833C17.5 13.4327 16.5673 12.5 15.4167 12.5H7.45791M2.5 14.5833C2.5 16.1942 3.80584 17.5 5.41667 17.5C7.0275 17.5 8.33333 16.1942 8.33333 14.5833C8.33333 12.9725 7.0275 11.6667 5.41667 11.6667C3.80584 11.6667 2.5 12.9725 2.5 14.5833ZM17.5 5.41667C17.5 7.0275 16.1942 8.33333 14.5833 8.33333C12.9725 8.33333 11.6667 7.0275 11.6667 5.41667C11.6667 3.80584 12.9725 2.5 14.5833 2.5C16.1942 2.5 17.5 3.80584 17.5 5.41667Z" stroke="#CECFD2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Customize
                </button>

                <button class="py-[10px] px-[14px] rounded-lg border border-[#333741] bg-[#161B26] font-sans text-[#CECFD2] font-semibold flex items-center">
                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M6.6665 14.1667L9.99984 17.5M9.99984 17.5L13.3332 14.1667M9.99984 17.5V10M16.6665 13.9524C17.6844 13.1117 18.3332 11.8399 18.3332 10.4167C18.3332 7.88536 16.2811 5.83333 13.7498 5.83333C13.5677 5.83333 13.3974 5.73833 13.3049 5.58145C12.2182 3.73736 10.2119 2.5 7.9165 2.5C4.46472 2.5 1.6665 5.29822 1.6665 8.75C1.6665 10.4718 2.36271 12.0309 3.48896 13.1613" stroke="#CECFD2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Export
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-x-6 gap-y-8">
            <SpendingBreakdown/>

            <SpendingComparison/>

            <PlannedIncomeExpense/>

            <CashFlow/>
        </div>

    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import CashFlow from './Partials/CashFlow.vue';
import PlannedIncomeExpense from './Partials/PlannedIncomeExpense.vue';
import SpendingBreakdown from './Partials/SpendingBreakdown.vue';
import SpendingComparison from './Partials/SpendingComparison.vue';
import { Head } from '@inertiajs/vue3';
</script>