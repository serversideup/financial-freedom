<template>
    <input
        class="border-[#333741] bg-transparent focus:border-[#155EEF] focus:ring-[#155EEF] text-[#CECFD2] w-full rounded-lg shadow-sm"
        v-model="model"
        ref="input"
    />
</template>

<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
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