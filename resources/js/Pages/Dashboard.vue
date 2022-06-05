<template>
    <app-layout>

        <div class="py-12">
            <div class="sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-4 w-full">
                    <income-vs-expense/>
                    <category-breakdown/>
                    <budgets-status/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    
    import IncomeVsExpense from '@/Components/Widgets/IncomeVsExpense.vue';
    import CategoryBreakdown from '@/Components/Widgets/CategoryBreakdown.vue';
    import BudgetsStatus from '@/Components/Widgets/BudgetsStatus.vue';

    export default {
        components: {
            AppLayout,
            IncomeVsExpense,
            CategoryBreakdown,
            BudgetsStatus
        },
    }
</script>
