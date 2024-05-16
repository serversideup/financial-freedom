<template>
    <nav class="flex items-center my-6">
        <Link href="/settings" class="rounded-l font-medium py-[10px] px-4 text-[#CECFD2] border-l border-t border-b border-[#333741]"
            :class="[subGroup == 'portfolio' ? 'bg-[#1F242F]' : '']">
            Portfolio
        </Link>
        <Link href="/settings/categories" class="font-medium py-[10px] px-4 text-[#CECFD2] border-l border-t border-b border-[#333741]"
            :class="[subGroup == 'categories' ? 'bg-[#1F242F]' : '']">
            Categories
        </Link>
        <Link href="/settings/institutions" class="rounded-r font-medium py-[10px] px-4 text-[#CECFD2] border border-[#333741]"
            :class="[subGroup == 'institutions' ? 'bg-[#1F242F]' : '']">
            Institutions
        </Link>
    </nav>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const subGroup = computed(() => usePage().props.subGroup);
</script>