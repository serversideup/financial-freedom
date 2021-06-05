<template>
    <app-layout>
        <div v-if="loaded">
            
        </div>
        <div class="mt-5" v-if="loaded">

        </div>
    </app-layout>
</template>

<script>
    import LoansAPI from '../../api/loans.js';
    import AppLayout from './../../Layouts/AppLayout'
    import { EventBus } from '../../event-bus.js';

    export default {
        props: ['id'],

        data(){
            return {
                loaded: false,
                loan: {}
            }
        },

        components: {
            AppLayout,
        },

        mounted(){
            this.bindEvents();
            this.loadLoan();
        },

        methods: {
            bindEvents(){
                EventBus.$on('loan-updated', function(){
                    this.loadLoan();
                }.bind(this) );
            },

            promptEdit(){
                EventBus.$emit('prompt-edit-account', this.loan);
            },

            loadLoan(){
                LoansAPI.show( this.id )
                    .then( function( response ){
                        this.loan = response.data;
                        this.loaded = true;
                    }.bind(this) );
            }
        }
    }
</script>