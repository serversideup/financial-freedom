<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="mx-auto w-[360px]">
            <h2 class="mt-6 text-center text-3xl font-semibold text-[#F5F5F6]">
                Log in to your account
            </h2>

            <div class="mt-3 mb-8 flex items-center justify-center">
                <span class="font-sans text-base text-[#94969C]">
                    Welcome back! Please enter your details.
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
                        autocomplete="username"
                        placeholder="Enter your email"/>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-5">
                    <InputLabel for="password" value="Password" class="text-[#CECFD2]" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full bg-transparent text-[#CECFD2]"
                        v-model="form.password"
                        required
                        autocomplete="current-password"/>

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <label class="flex items-center">
                        <Checkbox name="remember" class="bg-transparent" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-[#CECFD2]">Remember me</span>
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="font-sans text-sm text-[#CECFD2] font-semibold hover:underline">
                            Forgot your password?
                    </Link>
                </div>

                <div class="flex mt-6">
                    <PrimaryButton class="w-full justify-center py-[10px] text-base rounded-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Sign in
                    </PrimaryButton>
                </div>

                <div v-if="canRegister" class="mt-8 text-center">
                    <span class="font-sans text-sm text-[#CECFD2]">
                        Don't have an account?
                    </span>
                    <Link
                        :href="route('register')"
                        class="font-sans text-sm text-[#CECFD2] font-semibold hover:underline">
                            Sign up
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canRegister: {
        type: Boolean,
    },
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>