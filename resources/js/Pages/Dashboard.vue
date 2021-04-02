<template>
    <app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-4 w-full">
                    <income-vs-expense/>
                    <tag-breakdown/>
                    <span>z</span>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    
    import IncomeVsExpense from '../Components/Widgets/IncomeVsExpense.vue';
    import TagBreakdown from '../Components/Widgets/TagBreakdown.vue';

    export default {
        components: {
            AppLayout,
            IncomeVsExpense,
            TagBreakdown
        },
    }
</script>
