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
            <label for="institution" class="block text-sm font-medium leading-5 text-gray-700">
                Institution
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <select id="institution" v-model="form.institution" v-bind:class="{ 'border-red-500': !validations.institution.valid }" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value=""></option>
                    <option v-for="(institution, key) in institutions"
                        v-bind:key="'institution-'+key"
                        v-bind:value="institution.id"
                        v-text="institution.name"/>
                </select>
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.institution.valid" v-text="validations.institution.message"></span>
        </div>
        <div class="sm:col-span-3">
            <label for="account-number" class="block text-sm font-medium leading-5 text-gray-700">
                Number
            </label>
            <div class="mt-1 rounded-md shadow-sm">
                <input v-model="form.number" v-bind:class="{ 'border-red-500': !validations.number.valid }" id="account-number" type="text" class="rounded-md shadow-sm block w-full border-gray-300">
            </div>
            <span class="text-red-500 text-sm" v-show="!validations.number.valid" v-text="validations.number.message"></span>
        </div>
        <div class="sm:col-span-3">
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">
                    Current Balance
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                        $
                    </span>
                    <input type="text" name="current-balance" id="current-balance" v-model="form.current_balance" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['institutions'],

    data(){
        return {
            form: {
                name: '',
                number: '',
                institution: '',
                description: '',
                current_balance: ''
            },

            validations: {
                name: {
                    valid: true,
                    message: 'Enter a name for this account'
                },
                number: {
                    valid: true,
                    message: 'Please enter an account number'
                },
                description: {
                    valid: true,
                    message: 'Please enter a description'
                },
                institution: {
                    valid: true,
                    message: 'Please select the institution that provides your account.'
                },
                current_balance: {
                    valid: true,
                    message: 'Enter the current balance of your account'
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