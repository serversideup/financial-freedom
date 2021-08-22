<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200 mt-5 max-w-md mx-auto p-5">
        <div class="mt-2 sm:mt-0 sm:col-span-2">
            <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    
                    <div class="flex text-sm text-gray-600" v-show="transactions == ''">
                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-lochmara-600 hover:text-lochmara-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-lochmara-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" ref="transactionsImportFile" v-on:change="handleFileUpload()" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500" v-show="transactions == ''">
                        CSV up to 10MB
                    </p>

                    <div class="flex text-sm text-gray-600" v-show="transactions != ''">
                        {{ transactions.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            ...mapState('transactions/importProcess', {
                transactions: state => state.transactions
            })
        },

        methods: {
            handleFileUpload(){
                this.$store.commit( 'transactions/importProcess/setTransactions', this.$refs.transactionsImportFile.files[0] );
                this.$store.commit( 'transactions/importProcess/setStep', 3 );
            }
        }
    }
</script>