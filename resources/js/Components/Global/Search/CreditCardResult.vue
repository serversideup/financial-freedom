<template>
    <Link 
        :href="'/credit-cards/'+creditCard.id"
        class="flex items-center text-gray-500 text-sm p-2 hover:bg-gray-50">
            <span class="text-red-500 w-24">
                -{{ formatMoney( creditCard.current_balance ) }}
            </span>

            <span class="pr-2">{{ creditCard.name }}</span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
    props: ['creditCard'],

    components: {
        Link
    },

    mixins: [
        FormatMoney
    ],
}
</script>