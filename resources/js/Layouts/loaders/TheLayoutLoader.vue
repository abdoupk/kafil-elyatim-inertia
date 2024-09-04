<script lang="ts" setup>
import { onMounted, ref } from 'vue'

import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'

import { $t } from '@/utils/i18n'

const ready = ref(false)

onMounted(() => {
    setTimeout(() => {
        ready.value = true
    }, 0)
})
</script>

<template>
    <suspense v-if="ready">
        <template #fallback>
            <div class="flex h-screen w-screen flex-col items-center justify-center">
                <spinner-loader class="h-10 w-10"></spinner-loader>

                <h3 class="mt-6 text-lg font-medium rtl:font-semibold">{{ $t('loading...') }}</h3>
            </div>
        </template>
    </suspense>
</template>
