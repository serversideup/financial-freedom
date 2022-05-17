<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200 col-span-4">
        <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
            Category Breakdown
        </div>
        <div class="px-4 pt-5 overflow-y-scroll sm:p-6">

        </div>
    </div>
</template>
<script>
import { FormatMoney } from '@/Mixins/formatMoney';
import TransactionsAPI from '@/api/transactions.js';

export default {
    data(){
        return {
            breakdown: [],
            transactions: []
        }
    },

    mixins: [
        FormatMoney
    ],

    mounted(){
        this.loadTransactions();
    },

    methods: {
        loadTransactions(){
            TransactionsAPI.index( {
                start_date: moment().startOf('month').format( 'YYYY-MM-DD' ),
                end_date: moment().endOf('month').format('YYYY-MM-DD')
            } ).then( function( response ){
                this.transactions = response.data;
                this.computeCategoryBreakdown();
            }.bind(this) );
        },

        computeCategoryBreakdown(){
        
        }
    }
}
</script>

