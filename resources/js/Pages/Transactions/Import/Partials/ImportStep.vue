<template>
    <nav aria-label="Progress">
        <ol role="list" class="divide-y divide-gray-300 rounded-md border border-[#333741] md:flex md:divide-y-0">
            <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative md:flex md:flex-1">
                <a v-if="step.status === 'complete'" :href="step.href" class="group flex w-full items-center">
                    <span class="flex items-center px-3 py-2 text-sm font-medium">
                        <span class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-[#155EEF]">
                            <CheckIcon class="h-3 w-3 text-white" aria-hidden="true" />
                        </span>
                        <span class="ml-4 text-sm font-medium text-[#CECFD2]">{{ step.name }}</span>
                    </span>
                </a>
                <a v-else-if="step.status === 'current'" :href="step.href" class="flex items-center px-3 py-2 text-sm font-medium" aria-current="step">
                    <span class="flex h-6 w-6 text-[10px] flex-shrink-0 items-center justify-center rounded-full border-2 border-[#155EEF]">
                        <span class="text-[#155EEF]">{{ step.id }}</span>
                    </span>
                    <span class="ml-4 text-sm font-medium text-[#155EEF]">{{ step.name }}</span>
                </a>
                <a v-else :href="step.href" class="group flex items-center">
                    <span class="flex items-center px-3 py-2 text-sm font-medium">
                        <span class="flex h-6 w-6 text-[10px] flex-shrink-0 items-center justify-center rounded-full border-2 border-[#333741]">
                            <span class="text-gray-500">{{ step.id }}</span>
                        </span>
                        <span class="ml-4 text-sm font-medium text-gray-500">{{ step.name }}</span>
                    </span>
                </a>
                <template v-if="stepIdx !== steps.length - 1">
                    <!-- Arrow separator for lg screens and up -->
                    <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
                        <svg class="h-full w-full text-[#333741]" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                        </svg>
                    </div>
                </template>
            </li>
        </ol>
    </nav>
</template>
  
<script setup>
import { computed } from 'vue'
import { CheckIcon } from '@heroicons/vue/24/solid'
import { 
    useImportTransactions 
} from '@/Composables/useImportTransactions';

const { step } = useImportTransactions();

const stepMap = {
    'select-account': 0,
    'upload-file': 1,
    'map-fields': 2,
    'review-transactions': 3
};

const steps = computed(() => [
    { 
        id: '01', 
        name: 'Select Account', 
        href: '#', 
        status: stepMap[ step.value ] === 0
            ? 'current'
            : 'complete'
    },
    { 
        id: '02', 
        name: 'Select File', 
        href: '#', 
        status: stepMap[ step.value ] === 1 
            ? 'current' : stepMap[ step.value ] < 1 
                ? 'upcoming' 
                : 'complete'
    },
    { 
        id: '03', 
        name: 'Map Fields', 
        href: '#', 
        status: stepMap[ step.value ] === 2 
            ? 'current' : stepMap[ step.value ] < 2 
                ? 'upcoming' 
                : 'complete'
    },
    { 
        id: '04', 
        name: 'Import transactions', 
        href: '#', 
        status: stepMap[ step.value ] === 3 
            ? 'current' 
            : 'upcoming'
    }
]);



</script>