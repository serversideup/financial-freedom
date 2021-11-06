<template>
    <Link 
        :href="'/loans/'+loan.id"
        class="flex items-center text-gray-500 text-sm p-2 hover:bg-gray-50">
            <span class="text-red-500 w-24">
                -{{ formatMoney( loan.current_balance ) }}
            </span>

            <span class="pr-2">{{ loan.name }}</span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
    props: ['loan'],

    components: {
        Link
    },

    mixins: [
        FormatMoney
    ],
}
</script>