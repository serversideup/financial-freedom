<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="mx-auto w-[360px]">
            <h2 class="mt-6 text-center text-3xl font-semibold text-[#F5F5F6]">
                Create your account
            </h2>

            <div class="mt-3 mb-8 flex items-center justify-center">
                <span class="font-sans text-base text-[#94969C]">
                    Welcome to Financial Freedom!
                </span>
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Name*" class="text-[#CECFD2]" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full font-sans text-base bg-transparent text-[#CECFD2]"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter your name"/>

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-5">
                    <InputLabel for="email" value="Email*" class="text-[#CECFD2]" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full font-sans text-base bg-transparent text-[#CECFD2]"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        placeholder="Enter your email"/>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-5">
                    <InputLabel for="password" value="Password*" class="text-[#CECFD2]" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full font-sans text-base bg-transparent text-[#CECFD2]"
                        v-model="form.password"
                        required
                        autocomplete="new-password"/>

                    <div class="w-full flex items-center mt-2">
                        <span class="rounded-full mr-1 w-9 h-[6px] block"
                            v-bind:class="{
                                'bg-red-500' : passwordStrength.score <= 1,
                                'bg-orange-500' : passwordStrength.score == 2,
                                'bg-yellow-500' : passwordStrength.score == 3,
                                'bg-green-500' : passwordStrength.score == 4
                            }"></span>
                        <span class="rounded-full mr-1 w-9 h-[6px] block"
                            v-bind:class="{
                                'bg-gray-500' : passwordStrength.score <= 1,
                                'bg-orange-500' : passwordStrength.score == 2,
                                'bg-yellow-400' : passwordStrength.score == 3,
                                'bg-green-500' : passwordStrength.score == 4
                            }"></span>
                        <span class="rounded-full mr-1 w-9 h-[6px] block"
                            v-bind:class="{
                                'bg-gray-500' : passwordStrength.score <= 2,
                                'bg-yellow-400' : passwordStrength.score == 3,
                                'bg-green-500' : passwordStrength.score == 4
                            }"></span>
                        <span class="rounded-full mr-1 w-9 h-[6px] block"
                            v-bind:class="{
                                'bg-gray-500' : passwordStrength.score <= 3,
                                'bg-green-500' : passwordStrength.score == 4
                            }"></span>
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />
                    <span class="text-xs font-sans text-[#85888E]">At least 8 characters (with a number)</span>
                </div>

                <div class="flex items-center mt-6">
                    <PrimaryButton class="w-full justify-center py-[10px] text-base rounded-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create Account
                    </PrimaryButton>
                </div>

                <div class="mt-8 text-center">
                    <span class="font-sans text-sm text-[#CECFD2]">
                        Already have an account?
                    </span>
                    <Link
                        :href="route('register')"
                        class="font-sans text-sm text-[#CECFD2] font-semibold hover:underline">
                            Log In
                    </Link>
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
import zxcvbn from 'zxcvbn';
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: ''
});

const passwordStrength = computed(() => {
    return zxcvbn( form.password );
});

const submit = () => {
    if( passwordStrength.value.score < 4 ) {
        form.setError('password', 'A secure password must be entered.' )
    }else{
        form.post(route('register'), {
            onFinish: () => form.reset('password'),
        });
    } 
};
</script>