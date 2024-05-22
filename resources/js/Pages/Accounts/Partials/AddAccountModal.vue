<template>
    <Modal @close="closeModal" :show="show" :max-width="'2xl'">
        <form class="flex flex-col w-full" @submit.prevent="submit">
            <div class="flex items-center justify-between w-full">
                <CoinsIcon class="flex-shrink-0 text-[#CECFD2]"/>
                
                <button type="button" @click="closeModal">
                    <ModalCloseIcon/>
                </button>
            </div>

            <span class="font-sans text-lg font-semibold text-[#F5F5F6] mt-4">Add Account</span>
            <span class="font-sans text-sm text-[#94969C]">Add a new account that you own.</span>

            <div class="flex flex-col mt-5">
                <InputLabel value="Account Type"/>
                <select v-model="form.account_type" @change="clearData()" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                    <option value="" disabled>Select an account type</option>
                    <option value="cash">Cash Account</option>
                    <option value="credit-card">Credit Card</option>
                    <option value="loan">Loan</option>
                </select>
                <InputError class="mt-2" :message="form.errors.account_type" />
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="flex flex-col">
                    <InputLabel value="Name"/>
                    <TextInput v-model="form.name" placeholder="What is the name of your account?" class="mt-1"/>
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="flex flex-col">
                    <InputLabel value="Financial Institution"/>
                    <select v-model="form.institution_id" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                        <option value="" disabled></option>
                        <option v-for="institution in institutions"
                            :value="institution.id"
                            v-text="institution.name"></option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.institution_id" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4" v-if="form.account_type != ''">
                <div class="flex flex-col" v-if="form.account_type == 'cash'">
                    <InputLabel value="Cash Account Type"/>
                    <select v-model="form.type" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                        <option value="" disabled></option>
                        <option value="checking">Checking</option>
                        <option value="savings">Savings</option>
                        <option value="cd">CD</option>
                        <option value="money-market">Money Market</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'loan'">
                    <InputLabel value="Loan Type"/>
                    <select v-model="form.type" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                        <option value="" disabled></option>
                        <option value="student-loan">Student Loan</option>
                        <option value="personal">Personal</option>
                        <option value="mortgage">Mortgage</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'cash' || form.account_type == 'credit-card'">
                    <InputLabel value="Balance"/>
                    <PrefixTextInput v-model="form.balance" class="mt-1">
                        <span>$</span>
                    </PrefixTextInput>
                    <InputError class="mt-2" :message="form.errors.balance" />
                </div>

                <div class="flex flex-col">
                    <InputLabel value="Interest Rate"/>
                    <SuffixTextInput v-model="form.interest_rate" class="mt-1">
                        <span>%</span>
                    </SuffixTextInput>
                    <InputError class="mt-2" :message="form.errors.interest_rate" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'credit-card'">
                    <InputLabel value="Brand"/>
                    <select v-model="form.brand" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                        <option value="" disabled></option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="american-express">American Express</option>
                        <option value="discover">Discover</option>
                        <option value="other">Other</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.brand" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'credit-card'">
                    <InputLabel value="Credit Limit"/>
                    <PrefixTextInput v-model="form.credit_limit" class="mt-1">
                        <span>$</span>
                    </PrefixTextInput>
                    <InputError class="mt-2" :message="form.errors.credit_limit" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'loan'">
                    <InputLabel value="Date opened"/>
                    <TextInput v-model="form.date_opened" placeholder="When did you open your loan?" class="mt-1"/>
                    <InputError class="mt-2" :message="form.errors.date_opened" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'loan'">
                    <InputLabel value="Remaining Balance"/>
                    <PrefixTextInput v-model="form.remaining_balance" class="mt-1">
                        <span>$</span>
                    </PrefixTextInput>
                    <InputError class="mt-2" :message="form.errors.remaining_balance" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'loan'">
                    <InputLabel value="Original Balance"/>
                    <PrefixTextInput v-model="form.original_balance" class="mt-1">
                        <span>$</span>
                    </PrefixTextInput>
                    <InputError class="mt-2" :message="form.errors.original_balance" />
                </div>

                <div class="flex flex-col" v-if="form.account_type == 'loan'">
                    <InputLabel value="Payment Amount"/>
                    <PrefixTextInput v-model="form.payment_amount" class="mt-1">
                        <span>$</span>
                    </PrefixTextInput>
                    <InputError class="mt-2" :message="form.errors.payment_amount" />
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <InputLabel value="Description"/>
                <TextInput v-model="form.description" placeholder="Enter some information about what this account is used for.." class="mt-1"/>
                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="pt-8 flex items-center justify-end">
                <button type="button" @click="closeModal" class="bg-[#161B26] text-[#CECFD2] cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#333741]">
                    Cancel
                </button>
                <button class="ml-3 bg-[#155EEF] text-white cursor-pointer px-4 py-[10px] rounded-lg font-semibold border border-[#155EEF]">
                    Create
                </button>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import CoinsIcon from '@/Components/Icons/CoinsIcon.vue';
import ModalCloseIcon from '@/Components/Icons/ModalCloseIcon.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrefixTextInput from '@/Components/PrefixTextInput.vue';
import SuffixTextInput from '@/Components/SuffixTextInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'
import { computed, ref } from 'vue';

const institutions = computed(() => usePage().props.institutions);
const promptBus = useEventBus('ff-prompt-event-bus')
const notifyBus = useEventBus('ff-notification-event-bus')
const show = ref(false);

const listener = ( event ) => {
    if( event == 'prompt-add-account' ){
        show.value = true;
    }
}
promptBus.on(listener);

const form = useForm({
    account_type: '',
    name: '',
    institution_id: '',
    description: '',
    type: '',
    balance: '',
    remaining_balance: '',
    original_balance: '',
    payment_amount: '',
    interest_rate: '',
    date_opened: '',
    credit_limit: '',
    brand: '',
});

const clearData = () => {
    form.name = '';
    form.institution_id = '';
    form.description = '';
    form.type = '';
    form.balance = '';
    form.remaining_balance = '';
    form.original_balance = '';
    form.payment_amount = '';
    form.interest_rate = '';
    form.opened_at = '';
    form.credit_limit = '';
    form.brand = '';
}

const closeModal = () => {
    form.clearErrors();
    form.reset();
    show.value = false;
}

const submit = () => {
    form.post(`/accounts`, {
        preserveScroll: true,
        onSuccess: () => {
            show.value = false;
            form.reset();
            notifyBus.emit('notify', {
                title: 'Account Added',
                body: 'Account has been added and is ready for use.',
                type: 'success'
            });
        }
    })
}
</script>