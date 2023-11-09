<template>
    <app-layout>
        <div>
            <div class="mt-2 mb-5 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                        Import Transactions
                    </h2>
                </div>
            </div>

            <div class="flex w-full mt-5">
                <steps/>
            </div>

            <select-account 
                :accounts="accounts"
                v-if="step == 1"/>

            <upload-file 
                v-if="step == 2"/>

            <confirm-import 
                v-show="step == 3"
                :rules="rules"/>

            <view-duplicate/>

            <add-rule-modal/>
        </div>

    </app-layout>
</template>

<script>
    import { mapState } from 'vuex';
    import AppLayout from '@/Layouts/AppLayout';
    import Steps from './components/Steps';
    import SelectAccount from './components/SelectAccount';
    import UploadFile from './components/UploadFile';
    import ConfirmImport from './components/ConfirmImport.vue';
    import ViewDuplicate from './components/ViewDuplicate.vue';
    import AddRuleModal from '@/Components/Transactions/AddRuleModal.vue';

    export default {
        props: [
            'accounts',
            'rules'
        ],

        components: {
            AppLayout,
            Steps,
            SelectAccount,
            UploadFile,
            ConfirmImport,
            ViewDuplicate,
            AddRuleModal
        },

        computed: {
            ...mapState('transactions/importProcess', {
                step: state => state.step
            })
        }
    }
</script>
                