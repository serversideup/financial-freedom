<template>
    <Link 
        :href="'/savings-accounts/'+savingsAccount.id"
        class="flex items-center text-gray-500 text-sm p-2 hover:bg-gray-50">
            <span class="text-green-500 w-24">
                {{ formatMoney( savingsAccount.current_balance ) }}
            </span>

            <span class="pr-2">{{ savingsAccount.name }}</span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { FormatMoney } from '@/Mixins/formatMoney';

export default {
    props: ['savingsAccount'],

    components: {
        Link
    },

    mixins: [
        FormatMoney
    ],
}
</script>