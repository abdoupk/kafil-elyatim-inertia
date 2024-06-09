<script setup lang="ts">
import type { ExtractProps } from '@/types/utils'
import { TabGroup as HeadlessTabGroup } from '@headlessui/vue'

interface GroupProps extends /* @vue-ignore */ ExtractProps<typeof HeadlessTabGroup> {}

defineProps<GroupProps>()
</script>

<template>
    <headless-tab-group as="div">
        <slot></slot>
    </headless-tab-group>
</template>
