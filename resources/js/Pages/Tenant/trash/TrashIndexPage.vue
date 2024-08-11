<script lang="ts" setup>
import { onMounted, ref } from 'vue'

import TheLayout from '@/Layouts/TheLayout.vue'

import { getPaginatedDocuments } from '@/utils/trash'

defineOptions({
    layout: TheLayout
})

const rows = ref([])

onMounted(async () => {
    await getPaginatedDocuments().then((res) => {
        console.log(res)

        rows.value = res
    })
})
</script>

<template>
    <h1 v-for="row in rows" :key="row.id">{{ row.id }}</h1>
</template>
