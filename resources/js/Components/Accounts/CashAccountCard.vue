<template>
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                            Cash Account
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
                <Link :href="'/cash-accounts/'+account.id" class="font-medium text-blue-600 hover:text-blue-900 transition ease-in-out duration-150">
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