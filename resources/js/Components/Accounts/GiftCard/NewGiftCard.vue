<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 sm:col-span-6">
        <div class="sm:col-span-6">
            <label for="gift-card-company" class="block text-sm font-medium leading-5 text-gray-700">
                Company
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.company" id="gift-card-company" type="text" v-bind:class="{ 'border-red-500': !validations.company.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.company.valid" v-text="validations.company.message"></span>
        </div>
        <div class="sm:col-span-6">
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">
                    Location
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.location" v-bind:class="{ 'border-red-500': !validations.location.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
                <span class="text-red-500 text-sm" v-show="!validations.location.valid" v-text="validations.location.message"></span>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">
                    Balance
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                        $
                    </span>
                    <input type="text" name="balance" id="balance" v-model="form.balance" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                </div>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="expiration" class="block text-sm font-medium text-gray-700">
                    Expiration
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.expiration" v-bind:class="{ 'border-red-500': !validations.expiration.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
                <span class="text-red-500 text-sm" v-show="!validations.expiration.valid" v-text="validations.expiration.message"></span>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="url" class="block text-sm font-medium text-gray-700">
                    URL
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.url" v-bind:class="{ 'border-red-500': !validations.url.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
                <span class="text-red-500 text-sm" v-show="!validations.url.valid" v-text="validations.url.message"></span>
            </div>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">
                    Code
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                    <input v-model="form.code" v-bind:class="{ 'border-red-500': !validations.code.valid }" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
                </div>
                <span class="text-red-500 text-sm" v-show="!validations.code.valid" v-text="validations.code.message"></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            form: {
                company: '',
                balance: '',
                location: '',
                expiration: '',
                url: '',
                code: ''
            },

            validations: {
                company: {
                    valid: true,
                    message: 'Enter a company for this gift card'
                },
                balance: {
                    valid: true,
                    message: 'Enter the initial balance of your gift card'
                },
                location: {
                    valid: true,
                    message: 'Enter the location of the gift card (i.e. Filing cabinet near desk)'
                },
                expiration: {
                    valid: true,
                    message: 'Enter the gift card\'s expiration date' 
                },
                url: {
                    valid: true,
                    message: 'Enter the URL of the giftcard'
                },
                code: {
                    valid: true,
                    message: 'Enter the code for the gift card'
                }
            }
        }
    },

    methods: {
        add(){

        },

        validate(){
            
        }
    }
}
</script>