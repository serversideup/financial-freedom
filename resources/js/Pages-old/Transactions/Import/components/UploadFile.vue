<template>
    <div class="grid grid-cols-12 gap-4">
        <div class="sm:col-span-6 mt-5">
            <label for="account-type" class="block text-sm font-medium leading-5 text-gray-700">
                Account
            </label>
            <div class="mt-1">
                <div class="grid grid-cols-1 gap-4">
                    <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" v-if="account.institution" :src="account.institution.logo" alt="" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="#" class="focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true" />
                                <p class="text-sm font-medium text-gray-900">
                                    {{ account.name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ account.description }}
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm:col-span-6 mt-5">
            <label for="account-type" class="block text-sm font-medium leading-5 text-gray-700">
                Select your transactions file
            </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="text-center">                    
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" ref="transactionsImportFile" v-on:change="handleFileUpload()" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        CSV up to 10MB
                    </p>
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
                transactions: state => state.transactions,
                account: state => state.account
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