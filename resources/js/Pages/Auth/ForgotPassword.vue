<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mx-auto w-[360px]">
            <div class="mt-3 mb-8 flex items-center justify-center">
                <span class="font-sans text-base text-[#94969C]">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </span>
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" class="text-[#CECFD2]" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full font-sans text-base bg-transparent text-[#CECFD2]"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"/>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex mt-6">
                    <PrimaryButton class="w-full justify-center py-[10px] text-base rounded-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
