<template>
    <div class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow md:grid-cols-3">
        <div v-if="showCurrentBalance">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Current Balance
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-astronaut-600">
                            {{ formatMoney( account.current_balance ) }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div v-if="showAmountSpendable" class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Amount Left to Spend
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-astronaut-600">
                            {{ formatMoney( unAllocatedAmount ) }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div v-if="showAmountChanged" class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        This Month
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-astronaut-600">
                            {{ formatMoney( amountChanged ) }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div v-if="showInterestRate" class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Interest Rate
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-astronaut-600">
                            {{ account.interest_rate }}%
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div v-if="showTransactionsChanged" class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Number of Transactions
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-astronaut-600">
                            {{ numberOfTransactions }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div v-if="showPaymentAmount" class="border-t border-gray-200 md:border-0 md:border-l">
            <div class="px-4 py-5 sm:p-6">
                <dl>
                    <dt class="text-base leading-6 font-normal text-gray-900">
                        Payment Amount
                    </dt>
                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl leading-8 font-semibold text-astronaut-600">
                            {{ formatMoney( account.payment_amount ) }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import TransactionsAPI from '@/api/transactions.js';
import AllocationsAPI from '@/api/allocations.js';
import { FormatMoney } from '@/Mixins/formatMoney.js';
import moment from 'moment';

export default {
    props: ['account', 'type', 'fields'],

    data(){
        return {
            monthlyTransactions: [],
            allocations: []
        }
    },

    mixins: [
        FormatMoney
    ],

    computed: {
        amountChanged(){
            let amount = 0.00;

            this.monthlyTransactions.forEach( function( transaction ){
                if( transaction.direction == 'outflow' ){
                    amount = parseFloat( amount ) - parseFloat( transaction.amount );
                }else if( transaction.direction == 'inflow' ){
                    amount = parseFloat( amount ) + parseFloat( transaction.amount );
                }
            } );

            return amount;
        },

        unAllocatedAmount(){
            let totalAllocated = 0.00;
            
            this.allocations.forEach( function( allocation ){
                totalAllocated += parseFloat( allocation.amount )
            });

            return parseFloat( this.account.current_balance )
                    - parseFloat( totalAllocated );
        },

        numberOfTransactions(){
            return this.monthlyTransactions.length;
        },

        showCurrentBalance(){
            let types = ['cash', 'checking', 'credit-card', 'savings', 'loan'];

            return this.fields.includes('current_balance') && types.includes( this.type );
        },

        showAmountSpendable(){
            let types = ['checking'];

            return this.fields.includes('amount_spendable') && types.includes( this.type );
        },

        showAmountChanged(){
            let types = ['cash', 'checking', 'credit-card', 'savings'];

            return this.fields.includes('amount_changed') && types.includes( this.type );
        },

        showTransactionsChanged(){
            let types = ['cash', 'checking', 'credit-card', 'savings'];

            return this.fields.includes('transactions_changed') && types.includes( this.type );
        },

        showInterestRate(){
            let types = ['loan'];

            return this.fields.includes('interest_rate') && types.includes( this.type );
        },

        showPaymentAmount(){
            let types = ['loan'];

            return this.fields.includes('payment_amount') && types.includes( this.type );
        }
    },

    mounted(){
        this.loadStats();
        this.loadAllocations();
    },

    methods: {
        loadStats(){
            this.loadLastTwoMonthsOfTransactions();
        },

        loadLastTwoMonthsOfTransactions(){
            if( this.showAmountChanged || this.showTransactionsChanged ){
                TransactionsAPI.index({
                    account: this.account.id,
                    account_type: this.account.account_type,
                    start_date: moment().startOf('month').format('YYYY-MM-DD'),
                    end_date: moment().endOf('month').format('YYYY-MM-DD')
                }).then( function( response ){
                    this.monthlyTransactions = response.data;
                }.bind(this));
            }
        },

        loadAllocations(){
            if( this.showAmountSpendable ){
                this.allocations = [];

                AllocationsAPI.index({
                    account_type: this.account.account_type,
                    account_id: this.account.id
                }).then( function( response ){
                    this.allocations = response.data;
                }.bind(this));       
            }     
        },
    }
}
</script>