<template>
    <div class="col-span-4 p-6 border border-[#1F242F] rounded-xl">
        <div class="flex items-center justify-between">
            <div class="flex flex-col">
                <h3 class="text-[#F5F5F6] font-sans font-semibold">Spending Breakdown</h3>
                <span class="mt-1 text-[#94969C] font-sans text-sm">{{ monthStartDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) }}</span>
            </div>
            
            <button class="w-5 h-5 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M9.99984 10.8334C10.4601 10.8334 10.8332 10.4603 10.8332 10C10.8332 9.5398 10.4601 9.16671 9.99984 9.16671C9.5396 9.16671 9.1665 9.5398 9.1665 10C9.1665 10.4603 9.5396 10.8334 9.99984 10.8334Z" stroke="#85888E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.99984 5.00004C10.4601 5.00004 10.8332 4.62694 10.8332 4.16671C10.8332 3.70647 10.4601 3.33337 9.99984 3.33337C9.5396 3.33337 9.1665 3.70647 9.1665 4.16671C9.1665 4.62694 9.5396 5.00004 9.99984 5.00004Z" stroke="#85888E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.99984 16.6667C10.4601 16.6667 10.8332 16.2936 10.8332 15.8334C10.8332 15.3731 10.4601 15 9.99984 15C9.5396 15 9.1665 15.3731 9.1665 15.8334C9.1665 16.2936 9.5396 16.6667 9.99984 16.6667Z" stroke="#85888E" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="w-full flex items-start mt-6 space-x-4" >
            <div class="w-1/2">
                <Doughnut 
                    :data="chartData"
                    :options="chartOptions"/>
            </div>
            <div class="w-1/2">
                <ul class="space-y-[6px]">
                    <li v-for="(label, labelIndex) in chartData.labels" :key="labelIndex">
                        <div class="flex items-start space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                <circle cx="5" cy="5" r="5" :fill="chartData.datasets[0].backgroundColor[labelIndex]"/>
                            </svg>
                            <div class="flex flex-col">
                                <span class="text-[#94969C] font-sans font-medium text-xs leading-none">{{ label }}</span>
                                <span class="text-[#F5F5F6] font-sans font-semibold text-base mt-1">{{ currency.format(chartData.datasets[0].data[labelIndex]) }}</span>
                            </div>
                        </div>
                        
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { useCategoryColor } from '@/Composables/useCategoryColor';
import { useFormatters } from '@/Composables/useFormatters';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'

ChartJS.register(ArcElement, Tooltip, Legend)

const { getCategoryColor } = useCategoryColor();
const { currency } = useFormatters();

const transactions = ref([]);

const date = new Date();
const monthStartDate = new Date(date.getFullYear(), date.getMonth(), 1);
const monthEndDate = new Date(date.getFullYear(), date.getMonth() + 1, 0);

onMounted(() => {
    loadTransactions();
});

const loading = ref(false);

const loadTransactions = () => {
    loading.value = true;
    
    axios.get('/api/transactions', {
        params: {
            start_date: monthStartDate.getFullYear() + '-' + (monthStartDate.getMonth() + 1).toString().padStart(2, '0') + '-' + monthStartDate.getDate().toString().padStart(2, '0'),
            end_date: monthEndDate.getFullYear() + '-' + (monthEndDate.getMonth() + 1).toString().padStart(2, '0') + '-' + monthEndDate.getDate().toString().padStart(2, '0')
        }
    }).then(response => {
        transactions.value = response.data;

        loading.value = false;
    });
};

const chartData = computed(() => {
    let labels = [];
    let colors = [];
    let totals = [];

    transactions.value.forEach(transaction => {
        if (!labels.includes(transaction.category.group.name)) {
            labels.push(transaction.category.group.name);
            colors.push(getCategoryColor(transaction.category.group.color));
            totals.push(transaction.amount);
        } else {
            const index = labels.indexOf(transaction.category.group.name);
            totals[index] += transaction.amount;
        }
    });

    return {
        labels: labels,
        datasets: [{
            data: totals,
            backgroundColor: colors,
            borderWidth: 0
        }]
    }
});

const chartOptions = computed(() => {
    return {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return '$' + context.formattedValue;
                    }
                }
            }
        }
    }
})

</script>