<script lang="ts" setup>
defineProps<{
    active?: boolean
    selected?: boolean
    label?: string
}>()
</script>

<template>
    <li
        :class="[
            active ? 'bg-primary text-white' : 'text-gray-900 dark:text-slate-300',
            'relative cursor-default select-none py-2 ps-3 pe-9'
        ]"
    >
        <div class="flex items-center">
            <span :class="[selected ? 'font-semibold' : 'font-normal', 'ms-3 block truncate']">{{ label }}</span>
        </div>

        <span
            v-if="selected"
            :class="[active ? 'text-white' : 'text-primary', 'absolute inset-y-0 end-0 flex items-center pe-4']"
        >
        </span>
    </li>
</template>
