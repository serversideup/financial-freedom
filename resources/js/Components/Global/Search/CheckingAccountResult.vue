<template>
    <Link 
        :href="'/checking-accounts/'+checkingAccount.id"
        class="flex items-center text-gray-500 text-sm p-2 hover:bg-gray-50">
            <span class="text-green-500 w-24">
                {{ formatMoney( checkingAccount.current_balance ) }}
            </span>

            <span class="pr-2">{{ checkingAccount.name }}</span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
    props: ['checkingAccount'],

    components: {
        Link
    },

    mixins: [
        FormatMoney
    ],
}
</script>