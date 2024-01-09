<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <div class="mx-auto w-[360px]">
            <h2 class="mt-6 mb-8 text-center text-3xl font-semibold text-[#F5F5F6]">
                Reset your password
            </h2>

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

                <div class="mt-5">
                    <InputLabel for="password" value="Password" class="text-[#CECFD2]" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full font-sans text-base bg-transparent text-[#CECFD2]"
                        v-model="form.password"
                        required
                        autocomplete="new-password"/>

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-5">
                    <InputLabel for="password_confirmation" value="Confirm Password" class="text-[#CECFD2]" />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full font-sans text-base bg-transparent text-[#CECFD2]"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"/>

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center mt-6">
                    <PrimaryButton class="w-full justify-center py-[10px] text-base rounded-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Reset Password
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

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
