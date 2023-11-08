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
                    <button v-on:click="promptAddAccount()" class="-ml-px relative inline-flex items-center px-4 py-2 rounded-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>
                </span>
            </div>
        </div>
        <div class="mt-5 grid grid-cols-3 gap-4">
            <h2 class="col-span-3 text-gray-900 text-xl font-bold">Checking Accounts</h2>
            <checking-account-card
                v-for="(account, index) in accounts.checking_accounts"
                v-bind:key="'account-checking-account-'+index"
                :account="account"
                />

            <h2 class="col-span-3 text-gray-900 text-xl font-bold">Savings Accounts</h2>
            <savings-account-card
                v-for="(account, index) in accounts.savings_accounts"
                v-bind:key="'account-savings-account-'+index"
                :account="account"
                :type="'Savings'"
                />

            <h2 class="col-span-3 text-gray-900 text-xl font-bold">Credit Accounts</h2>
            <credit-account-card
                v-for="(account, index) in accounts.credit_cards"
                v-bind:key="'account-credit-card-'+index"
                :account="account"
                :type="'Credit Card'"
                />

            <h2 class="col-span-3 text-gray-900 text-xl font-bold">Loans</h2>
            <loan-card
                v-for="(account, index) in accounts.loans"
                v-bind:key="'account-loan-'+index"
                :account="account"
                />

            <h2 class="col-span-3 text-gray-900 text-xl font-bold">Cash Acconts</h2>
            <cash-account-card
                v-for="(account, index) in accounts.cash_accounts"
                v-bind:key="'account-cash-'+index"
                :account="account"
                />
            
            <h2 class="col-span-3 text-gray-900 text-xl font-bold">Gift Cards</h2>        
            <gift-card-card 
                v-for="(account, index) in accounts.gift_cards"
                v-bind:key="'account-gift-card-'+index"
                :account="account"
                :type="'Gift Card'"
                />
        </div>
        
        <a href="https://clearbit.com" target="_blank" class="text-xs mt-10 text-gray-900">Logos provided by Clearbit</a>

        <add-account
            :institutions="institutions"/>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    import CashAccountCard from '@/Components/Accounts/CashAccountCard.vue';
    import LoanCard from '@/Components/Accounts/LoanCard.vue';
    import CheckingAccountCard from '@/Components/Accounts/CheckingAccountCard';
    import SavingsAccountCard from '@/Components/Accounts/SavingsAccountCard';
    import CreditAccountCard from '@/Components/Accounts/CreditAccountCard';
    import GiftCardCard from '@/Components/Accounts/GiftCardCard.vue';
    import AddAccount from '@/Components/Accounts/AddAccount.vue';
    import AccountsAPI from '@/api/accounts.js';
    import InstitutionsAPI from '@/api/institutions.js';

    import { EventBus } from '@/event-bus.js';

    export default {
        data(){
            return {
                institutions: [],
                accounts: []
            }
        },

        components: {
            AppLayout,
            CashAccountCard,
            LoanCard,
            CheckingAccountCard,
            SavingsAccountCard,
            CreditAccountCard,
            GiftCardCard,
            AddAccount
        },

        mounted(){
            this.bindEvents();
            this.loadAccounts();
            this.loadInstitutions();
        },

        methods: {
            bindEvents(){
                EventBus.on('reload-accounts', function(){
                    this.loadAccounts();
                }.bind(this));
            },

            loadAccounts(){
                AccountsAPI.index()
                    .then( function( response ){
                        this.accounts = response.data;
                    }.bind(this) );
            },

            loadInstitutions(){
                InstitutionsAPI.index()
                    .then( function( response ){
                        this.institutions = response.data;
                    }.bind(this) );
            },

            promptAddAccount(){
                EventBus.emit('prompt-add-account');
            }
        }
    }
</script>