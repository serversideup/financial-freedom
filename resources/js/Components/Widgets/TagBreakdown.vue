<template>
    <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
        <div class="px-4 py-5 font-semibold font-sans text-astronaut-500 sm:px-6">
            Tag Breakdown
        </div>
        <div class="px-4 pt-5 overflow-y-scroll sm:p-6">
            <div v-for="tag in breakdown"
                :key="'tag-breakdown-'+tag.id"
                class="flex items-center justify-between p-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mr-1"
                        v-bind:class="[
                            'bg-'+tag.color+'-100', 'text-'+tag.color+'-800'
                        ]">
                            {{ tag.name }}
                    </span>

                    <span class="font-sans text-sm">{{ formatMoney( tag.tag_total ) }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import { FormatMoney } from '../../Mixins/formatMoney';
    import TransactionsAPI from '../../api/transactions.js';

    export default {
        data(){
            return {
                breakdown: [],
                transactions: []
            }
        },

        mixins: [
            FormatMoney
        ],

        mounted(){
            this.loadTransactions();
        },

        methods: {
            loadTransactions(){
                TransactionsAPI.index( {
                    start_date: moment().startOf('month').format( 'YYYY-MM-DD' ),
                    end_date: moment().endOf('month').format('YYYY-MM-DD')
                } ).then( function( response ){
                    this.transactions = response.data;
                    this.computeTagBreakdown();
                }.bind(this) );
            },

            computeTagBreakdown(){
                let tagGroup = {};

                for( let i = 0; i < this.transactions.length; i++ ){
                    if( this.transactions[i].direction == 'outflow' ){
                        for( let k = 0; k < this.transactions[i].tags.length; k++ ){
                            if( !tagGroup[ this.transactions[i].tags[k].name.replace('-', '_') ] ){
                                tagGroup[ this.transactions[i].tags[k].name.replace('-', '_') ] = this.transactions[i].tags[k];
                                tagGroup[ this.transactions[i].tags[k].name.replace('-', '_') ].tag_total = 0.00;
                            }

                            tagGroup[ this.transactions[i].tags[k].name.replace('-', '_') ].tag_total += parseFloat( this.transactions[i].amount );
                        }
                    }
                }

                for (var key of Object.keys(tagGroup)) {
                    this.breakdown.push( tagGroup[key] );
                }

                this.breakdown.sort( function( a, b ){
                    return a.tag_total < b.tag_total;
                });
            }
        }
    }
</script>