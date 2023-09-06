<template>
    <div class="not-prose my-6 overflow-hidden rounded-2xl bg-zinc-900 shadow-md ring-1 ring-white/10">
        <div class="flex min-h-[calc(theme(spacing.12)+1px)] flex-wrap items-start gap-x-4 border-b px-4 border-zinc-800 bg-transparent">
            <h3 v-if="label != ''" class="mr-auto pt-3 text-xs font-semibold text-white">
                {{ label }}
            </h3>
        </div>

        <div class="group bg-white/2.5">
            <div class="relative overflow-x-auto p-4 text-xs text-white">
                <ContentSlot :use="$slots.default" unwrap="pre"/>
                <CopyButton :code="$slots.default()[0].props.code"/>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    code: {
        return: ''
    },
    tag: {
        return: ''
    },
    label: {
        return: ''
    }
})
</script>