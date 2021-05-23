<template>
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img :src="account.institution.logo" class="h-8 w-8 rounded-full"/>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm leading-5 font-medium text-cool-gray-500 truncate">
                            {{ account.institution.name }}: Savings
                        </dt>
                        <dd class="italic text-xs text-cool-gray-500 truncate">
                            {{ account.description }}
                        </dd>
                        <dd>
                            <div class="text-lg leading-7 font-medium text-cool-gray-900">
                                {{ formatMoney( account.current_balance ) }}
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="ml-5 flex-shrink-0">
                    <inertia-link :href="'/savings-accounts/'+account.id+'/edit'" class="rounded-full block p-2 text-cool-gray-500 hover:bg-gray-200 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </inertia-link>
                </div>
            </div>
        </div>
        <div class="bg-cool-gray-50 px-5 py-3">
            <div class="text-sm leading-5">
                <inertia-link :href="'/savings-accounts/'+account.id" class="font-medium text-lochmara-600 hover:text-lochmara-900 transition ease-in-out duration-150">
                    View account
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
import {FormatMoney} from '../../Mixins/formatMoney.js';

export default {
    props: ['account'],

    mixins: [
        FormatMoney
    ]
}
</script>