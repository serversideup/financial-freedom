<style scoped>
    input[type="file"]{
        position: absolute;
        top: -500px;
    }
</style>

<template>
    <div class="bg-white shadow overflow-hidden mt-5 mx-auto max-w-screen-md sm:rounded-lg">
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <input type="text" class="rounded-md shadow-sm w-full border-gray-300" v-model="form.name"/>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Date
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <input type="text" class="rounded-md shadow-sm w-full border-gray-300" v-model="form.date"/>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Description
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <input type="text" class="rounded-md shadow-sm w-full border-gray-300" v-model="form.description"/>
                    </dd>
                </div>
                <div v-if="!transaction.is_split" class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Category
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select id="category" v-model="form.category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value=""></option>
                            <option v-for="category in $page.props.categories"
                                :key="'category-'+category.id"
                                v-bind:value="category.id"
                                v-text="( category.parent_id != null ? ' - ' : '' )+category.name"/>
                        </select>
                    </dd>
                </div>
                <!-- <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tags
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <tags
                            v-if="!transaction.is_split"
                            :unique="'transaction-tags'"
                            :existing="transaction.tags"
                            />
                        <div class="flex flex-col" v-if="transaction.is_split">
                            <div class="mb-1">
                                <span v-for="(tag, key) in splitTags"
                                        v-bind:key="'transaction-split-'+key"
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                                        v-bind:class="[
                                            'bg-'+tag.color+'-100', 'text-'+tag.color+'-800'
                                        ]">
                                        {{ tag.name }}
                                </span>
                            </div>
                            <span class="text-xs italic">Transaction is split, tags are from splits.</span>
                        </div>
                    </dd>
                </div> -->
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Receipt
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" v-show="transaction.receipt_url == null && form.receipt == ''">
                        <div class="flex-shrink-0">
                            <input type="file" id="receipt" ref="receipt" v-on:change="handleReceiptUpload()"/>
                            <a v-on:click="selectReceipt()" class="cursor-pointer font-medium text-blue-600 hover:text-blue-500">
                                Upload Receipt
                            </a>
                        </div>
                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" v-show="transaction.receipt_url == null && form.receipt != ''">
                        {{ form.receipt.name }}
                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2" v-show="transaction.receipt_url != null">
                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                        Receipt
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a :href="'/transactions/'+transaction.id+'/receipt'" target="_blank" v-on:click="viewReceipt()" class="font-medium text-blue-600 hover:text-blue-500">
                                        View
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                    <button type="button" v-on:click="saveChanges()" class="px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </dl>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import { EventBus } from '@/event-bus.js';
import TransactionsAPI from '@/api/transactions.js';

// import Tags from '../../../../Components/Transactions/Tags.vue';

export default {
    props: ['transaction'],

    components: {
        // Tags,
    },

    data(){
        return {
            form: {
                name: '',
                date: '',
                description: '',
                tags: [],
                receipt: '',
                category: ''
            }
        }
    },

    computed: {
        splitTags(){
            let tags = [];

            this.transaction.splits.forEach( function( split ){
                split.tags.forEach( function( tag ){
                    tags.push( tag );
                } );
            } );

            return tags;
        }
    },

    mounted(){
        this.form.tags = this.transaction.tags;
        this.form.name = this.transaction.name;
        this.form.date = this.transaction.date;
        this.form.description = this.transaction.description;
        this.form.category = this.transaction.category_id;
    },
    
    methods: {
        formatDate( date ){
            return moment( date, 'YYYY-MM-DD' ).format('L');
        },

        viewReceipt(){

        },

        selectReceipt(){
            this.$refs.receipt.click();
        },

        handleReceiptUpload(){
            this.form.receipt = this.$refs.receipt.files[0];
        },

        saveChanges(){
            let formData = new FormData();

            formData.append( 'receipt', this.form.receipt );
            formData.append( 'tags', JSON.stringify( this.form.tags ) );
            formData.append( 'category', this.form.category );
            formData.append( 'name', this.form.name );
            formData.append( 'date', this.form.date );
            formData.append( 'description', this.form.description );
            formData.append( '_method', 'PUT' );

            TransactionsAPI.update( this.transaction.id, formData )
                .then( function( response ){
                    EventBus.emit('notify', {
                        type: 'success',
                        title: 'Transaction Updated',
                        message: 'Your transaction has been updated',
                        action: 'close'
                    } );
                });
        }
    }
}
</script>