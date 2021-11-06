<template>
    <Link 
        :href="'/cash-accounts/'+cashAccount.id"
        class="flex items-center text-gray-500 text-sm p-2 hover:bg-gray-50">
            <span class="text-green-500 w-24">
                {{ formatMoney( cashAccount.current_balance ) }}
            </span>

            <span class="pr-2">{{ cashAccount.name }}</span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
    props: ['cashAccount'],

    components: {
        Link
    },

    mixins: [
        FormatMoney
    ],
}
</script>