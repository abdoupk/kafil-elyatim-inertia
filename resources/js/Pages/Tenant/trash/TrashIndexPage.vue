<script lang="ts" setup>
import type { PaginationData } from '@/types/types'

import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

const props = defineProps<{
    items: PaginationData<unknown>
}>()

console.log(props.items)
</script>

<template>trash</template>
