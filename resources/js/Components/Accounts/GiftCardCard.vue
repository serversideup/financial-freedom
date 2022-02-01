<template>
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                            Gift Card
                        </dt>
                        <dd class="italic text-xs text-gray-500 truncate">
                            {{ account.company }}
                        </dd>
                        <dd>
                            <div class="text-lg leading-7 font-medium text-gray-900">
                                {{ formatMoney( account.balance ) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm leading-5">
                <Link :href="'/gift-cards/'+account.id" class="font-medium text-blue-600 hover:text-blue-900 transition ease-in-out duration-150">
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