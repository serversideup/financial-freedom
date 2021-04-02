<template>
    <app-layout>
        <div>
            <div class="mt-2 mb-5 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl text-center font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Import Transactions
                    </h2>
                </div>
            </div>

            <select-account v-show="step >= 1"/>

            <upload-file v-show="step >= 2" />

            <confirm-import v-show="step >= 3"/>

            <finish/>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from './../../../Layouts/AppLayout'
    import SelectAccount from './components/SelectAccount';
    import UploadFile from './components/UploadFile';
    import ConfirmImport from './components/ConfirmImport.vue';
    import Finish from './components/Finish.vue';
    import { mapState } from 'vuex';

    export default {
        components: {
            AppLayout,
            SelectAccount,
            UploadFile,
            ConfirmImport,
            Finish
        },

        computed: {
            ...mapState('transactionsImport', {
                step: state => state.step
            })
        }
    }
</script>
                