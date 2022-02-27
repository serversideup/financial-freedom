<template>
    <div v-show="view == 'chart'" class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
        <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
            Current Allocation
        </div>
        <div class="py-5 h-96">
            <canvas id="current-allocation"></canvas>
        </div>
    </div>
</template>

<script>
import AllocationsAPI from '@/api/allocations.js';
import Chart from 'chart.js';

export default {
    
}
</script>