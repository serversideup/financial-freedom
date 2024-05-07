<template>
    <tr class="border-b border-[#1F242F]">
        <td class="py-4 pl-4">
            <Checkbox v-model="localTransaction.import" :checked="localTransaction.import"/>
        </td>
        <td class="py-4 px-2">
            <select v-model="localTransaction.direction" class="block w-full rounded-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3">
                <option value=""></option>
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
            </select>
        </td>
        <td class="py-4 px-2">

        </td>
        <td class="py-4 px-2">
            <TextInput type="text" class="block font-sans text-base bg-transparent text-[#CECFD2]" v-model="localTransaction.name"/>
        </td>
        <td class="py-4 px-2">
            <TextInput type="text" class="block font-sans text-base bg-transparent text-[#CECFD2]" v-model="localTransaction.amount"/>
        </td>
        <td class="py-4 px-2">
            <TextInput type="text" class="block font-sans text-base bg-transparent text-[#CECFD2]" v-model="localTransaction.date"/>
        </td>
        <td class="py-4 px-2">

        </td>
    </tr>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';

const props = defineProps({
    transaction: Object
});

const groups = computed(() => usePage().props.groups);

const localTransaction = reactive({ ...props.transaction });
</script>