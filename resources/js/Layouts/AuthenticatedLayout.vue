<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>
    
                <div class="fixed inset-0 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-[#0C111D] px-6 pb-2 ring-1 ring-white/10">
                                <div class="flex h-16 shrink-0 items-center">
                                    <ApplicationLogo class="h-8 w-auto" />
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                        <li>
                                            <ul role="list" class="-mx-2 space-y-1">
                                                <li v-for="item in navigation" :key="item.name">
                                                    <a :href="item.href" :class="[item.current ? 'bg-[#1F242F] text-[#ECECED]' : 'text-gray-400 hover:text-white hover:bg-[#1F242F]', 'group flex font-sans gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                        <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                                                        {{ item.name }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>
  
        <!-- Static sidebar for desktop -->
        <div class="hidden border-r border-[#1F242F] lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-[#0C111D] px-6">
                <div class="flex h-16 shrink-0 items-center">
                    <ApplicationLogo class="h-8 w-auto" />
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <a :href="item.href" :class="[item.current ? 'bg-[#1F242F] text-[#ECECED]' : 'text-gray-400 hover:text-white hover:bg-[#1F242F]', 'group flex font-sans gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                        <component :is="item.icon" class="h-6 w-6 group-hover:stroke-[#ECECED] shrink-0" aria-hidden="true" />
                                        {{ item.name }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="-mx-6 mt-auto">
                            <a href="#" class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-white hover:bg-[#1F242F]">
                                <img class="h-8 w-8 rounded-full bg-gray-800" :src="user.profile_picture" alt="" />
                                <span class="sr-only">Your profile</span>
                                <span aria-hidden="true">{{ user.name }}</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
  
        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-[#0C111D] px-4 py-4 shadow-sm sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-white">Dashboard</div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img class="h-8 w-8 rounded-full bg-gray-800" :src="user.profile_picture" alt="" />
            </a>
        </div>
  
        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                <slot/>
            </div>
        </main>
    </div>
  </template>
  
<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import DashboardIcon from '@/Components/Icons/DashboardIcon.vue'
import TransactionsIcon from '@/Components/Icons/TransactionsIcon.vue'
import CashFlowIcon from '@/Components/Icons/CashFlowIcon.vue'
import BudgetPlanIcon from '@/Components/Icons/BudgetPlanIcon.vue';
import GoalsIcon from '@/Components/Icons/GoalsIcon.vue';
import { computed, ref } from 'vue'
import { usePage } from '@inertiajs/vue3';
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {
    Bars3Icon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'

const navigation = [
    { name: 'Dashboard', href: '#', icon: DashboardIcon, current: true },
    { name: 'Transactions', href: '#', icon: TransactionsIcon, current: false },
    { name: 'Cash Flow', href: '#', icon: CashFlowIcon, current: false },
    { name: 'Budget Plan', href: '#', icon: BudgetPlanIcon, current: false },
    { name: 'Goals', href: '#', icon: GoalsIcon, current: false },
]

const sidebarOpen = ref(false);

const user = computed(() => usePage().props.auth.user);
</script>