<template>
    <Head :title="'Settings'"/>

    <div class="w-full flex flex-col overflow-y-scroll">
        <h1 class="font-semibold font-sans text-[#F5F5F6] text-3xl">Settings</h1>
        
        <Navigation/>

        <form @submit.prevent="submit">
            <div class="flex items-center justify-between w-full border-b border-[#1F242F] pb-5 mb-6">
                <div class="flex flex-col">
                    <h1 class="font-sans text-lg font-semibold text-[#F5F5F6]">Portfolio</h1>
                    <span class="font-sans text-sm text-[#94969C]">Update your portfolio settings here.</span>
                </div>

                <div class="flex items-center space-x-3">
                    <Link href="/" class="text-[#CECFD2] cursor-pointer px-[14px] py-[10px] rounded-md font-semibold border border-[#333741]">
                        Cancel
                    </Link>
                    <button type="submit" class="bg-[#004EEB] text-white cursor-pointer px-[14px] py-[10px] rounded-md font-semibold border border-[#004EEB]">
                        Submit
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-8 max-w-4xl py-5 border-b border-[#1F242F]">
                <div class="flex flex-col">
                    <label for="username" class="font-sans text-sm font-semibold text-[#CECFD2]">Name</label>
                    <span class="text-[#94969C] font-sans text-sm">Your full name.</span>
                </div>
                <div class="col-span-2">
                    <input type="text" v-model="form.name" id="name" name="name" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-8 max-w-4xl py-5 border-b border-[#1F242F]">
                <div class="flex flex-col">
                    <label for="currency" class="font-sans text-sm font-semibold text-[#CECFD2]">Currency</label>
                    <span class="text-[#94969C] font-sans text-sm">Select the currency used across the app.</span>
                </div>
                <div class="col-span-2">
                    <select v-model="form.currency" id="currency" name="currency" class="mt-1 block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                        <option value="" disabled>Select a currency</option>
                        <option v-for="currency in currencies" :key="currency.value" :value="currency.value">
                            {{ currency.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end w-full py-5 mb-6">
                <div class="flex items-center space-x-3">
                    <Link href="/" class="text-[#CECFD2] cursor-pointer px-[14px] py-[10px] rounded-md font-semibold border border-[#333741]">
                        Cancel
                    </Link>
                    <button type="submit" class="bg-[#004EEB] text-white cursor-pointer px-[14px] py-[10px] rounded-md font-semibold border border-[#004EEB]">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
    
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    layout: AuthenticatedLayout
};
</script>

<script setup>
import Navigation from './Partials/Navigation.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { useEventBus } from '@vueuse/core'

const bus = useEventBus('ff-notification-event-bus')

const form = useForm({
    currency: 'usd',
    name: usePage().props.auth.user.name
});

const currencies = [
    { value: 'usd', name: 'USD' },
    { value: 'eur', name: 'EUR' },
    { value: 'gbp', name: 'GBP' },
];

const submit = () => {
    form.put('/settings/portfolio', {
        preserveScroll: true,
        onSuccess: () => {
            bus.emit('notify', {
                title: 'Settings updated',
                body: 'Your settings have been updated successfully.',
                type: 'success'
            });

            form.reset();
        }
    });
}
</script>