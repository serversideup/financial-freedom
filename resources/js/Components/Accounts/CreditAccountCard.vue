<template>
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img :src="account.institution.logo" class="h-8 w-8 rounded-full"/>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                            {{ account.institution.name }}: Credit Card
                        </dt>
                        <dd class="italic text-xs text-gray-500 truncate">
                            {{ account.description }}
                        </dd>
                        <dd>
                            <div class="text-lg leading-7 font-medium text-gray-900">
                                {{ formatMoney( account.current_balance ) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm leading-5">
                <Link :href="'/credit-cards/'+account.id" class="font-medium text-blue-600 hover:text-blue-900 transition ease-in-out duration-150">
                    View account
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { FormatMoney } from '../../Mixins/formatMoney.js';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: ['account'],

    mixins: [
        FormatMoney
    ],

    components: {
        Link
    }
}
</script>