<template>
    <Link 
        :href="'/transactions/'+transaction.id"
        class="flex items-center text-gray-500 text-sm p-2 hover:bg-gray-50">
            <span v-if="transaction.direction == 'outflow'" class="text-red-500 w-24">
                -{{ formatMoney( transaction.amount ) }}
            </span>
            <span v-if="transaction.direction == 'inflow'" class="text-green-500 w-24">
                {{ formatMoney( transaction.amount ) }}
            </span>

            <span class="w-20">{{ transactionDate }}</span>
            <span class="pr-2">{{ transaction.name }}</span>
            
            <div v-if="!transaction.is_split">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                    v-bind:class="[
                        'bg-'+transaction.category.color+'-100', 'text-'+transaction.category.color+'-800'
                    ]">
                        {{ transaction.category.name }}
                </span>
            </div>

            <div v-if="transaction.is_split">
                <span
                    v-for="split in transaction.splits"
                    v-bind:key="'transaction-split-'+split.id"
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                    v-bind:class="[
                        'bg-'+split.category.color+'-100', 'text-'+split.category.color+'-800'
                    ]">
                        {{ split.category.name }}
                </span>
            </div>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';
import moment from 'moment';

export default {
    props: ['transaction'],

    components: {
        Link
    },

    mixins: [
        FormatMoney
    ],

    computed: {
        transactionDate(){
            return moment( this.transaction.date, 'YYYY-MM-DD' ).format('L');
        }
    }
}
</script>