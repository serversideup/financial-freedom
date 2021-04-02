<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200 mt-10 max-w-md mx-auto">
        <div class="px-4 py-5 sm:p-6">
            <div class="sm:col-span-3">
                <label for="account-type" class="block text-sm font-medium leading-5 text-gray-700">
                    Import Transactions for Account
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <select id="account" v-model="account" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value=""></option>
                        <optgroup label="Credit Cards" v-if="$page.creditCards.length > 0 ">
                            <option v-for="account in $page.creditCards"
                                v-bind:key="'credit-card-'+account.id"
                                v-bind:value="account"
                                v-text="account.institution.name+': '+account.name"></option>
                        </optgroup>
                        <optgroup label="Checking Accounts" v-if="$page.checkingAccounts.length > 0">
                            <option v-for="account in $page.checkingAccounts"
                                v-bind:key="'checking-account-'+account.id"
                                v-bind:value="account"
                                v-text="account.institution.name+': '+account.name"></option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    computed: {
        account: {
            get() {
                return this.$store.getters['transactionsImport/getAccount']
            },
            set( value ){
                this.$store.commit( 'transactionsImport/setAccount', value );
            }
        }
    },

    watch: {
        account(){
            if( this.account != '' ){
                this.$store.commit('transactionsImport/setStep', 2 );
            }else{
                this.$store.commit('transactionsImport/setStep', 1 );
            }
        }
    }
}
</script>