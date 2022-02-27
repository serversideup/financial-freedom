<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-6 sm:col-span-6">
        <div class="sm:col-span-6">
            <label for="account-name" class="block text-sm font-medium leading-5 text-gray-700">
                Account Name
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.name" id="account-name" type="text" v-bind:class="{ 'border-red-500': !validations.name.valid }" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.name.valid" v-text="validations.name.message"></span>
        </div>

        <div class="sm:col-span-6">
            <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                Description
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.description" v-bind:class="{ 'border-red-500': !validations.description.valid }" id="description" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.description.valid" v-text="validations.description.message"></span>
        </div>

        <div class="sm:col-span-6">
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">
                    Initial Balance
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                        $
                    </span>
                    <input type="text" name="initial-balance" id="initial-balance" v-model="form.initial_balance" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            form: {
                name: '',
                description: '',
                initial_balance: ''
            },

            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this account'
                },
                description: {
                    valid: true,
                    message: 'Enter a quick description of your account'
                },
                initial_balance: {
                    valid: true,
                    message: 'Enter the initial balance of your account'
                },
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