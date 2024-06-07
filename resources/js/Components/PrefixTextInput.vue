<template>
    <div class="w-full flex items-center">
        <span class="font-sans rounded-l-md text-[#94969C] flex-shrink-0 border-t border-l border-b border-[#333741] py-2 px-4">
            <slot/>
        </span>
        <input v-model="model" ref="input" class="block flex-1 rounded-r-md bg-transparent border border-[#333741] text-[#CECFD2] py-2 px-3"/>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>