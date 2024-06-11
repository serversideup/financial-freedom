<template>
    <div class="rounded-xl border border-[#1F242F] flex flex-col p-4 md:col-span-5">
        <span class="text-[#94969C] font-medium text-sm font-sans">Net Worth</span>
        <span class="text-[#F5F5F6] font-bold text-2xl font-sans">{{ currency.format( netWorth ) }}</span>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useFormatters } from '@/Composables/useFormatters';

const props = defineProps({
    assets: Number,
    liabilities: Number
});

const { currency } = useFormatters();

const netWorth = computed(() => props.assets - props.liabilities);
</script>