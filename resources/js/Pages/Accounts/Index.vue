<template>
    <app-layout>
        <div>
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Accounts
                    </h2>
                </div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    <inertia-link href="/accounts/create" class="-ml-px relative inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </inertia-link>
                </span>
            </div>
        </div>
        <div class="mt-5 grid grid-cols-3 gap-4">
            <cash-account-card
                v-for="(account, index) in accounts.cash_accounts"
                v-bind:key="'account-cash-'+index"
                :account="account"
                />
            <loan-card
                v-for="(account, index) in accounts.loans"
                v-bind:key="'account-loan-'+index"
                :account="account"
                />
            <checking-account-card
                v-for="(account, index) in accounts.checking_accounts"
                v-bind:key="'account-checking-account-'+index"
                :account="account"
                />
            <savings-account-card
                v-for="(account, index) in accounts.savings_accounts"
                v-bind:key="'account-savings-account-'+index"
                :account="account"
                :type="'Savings'"
                />
            <credit-account-card
                v-for="(account, index) in accounts.credit_cards"
                v-bind:key="'account-credit-card-'+index"
                :account="account"
                :type="'Credit Card'"
                />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'

    import CashAccountCard from '../../Components/Accounts/CashAccountCard.vue';
    import LoanCard from '../../Components/Accounts/LoanCard.vue';
    import CheckingAccountCard from '../../Components/Accounts/CheckingAccountCard';
    import SavingsAccountCard from '../../Components/Accounts/SavingsAccountCard';
    import CreditAccountCard from '../../Components/Accounts/CreditAccountCard';
    
    export default {
        props: ['accounts'],

        components: {
            AppLayout,
            CashAccountCard,
            LoanCard,
            CheckingAccountCard,
            SavingsAccountCard,
            CreditAccountCard
        },
    }
</script>