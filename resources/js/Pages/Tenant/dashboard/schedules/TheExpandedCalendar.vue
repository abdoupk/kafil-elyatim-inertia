<script lang="ts" setup>
import { defineAsyncComponent } from 'vue'

const BaseExpandedVCalendar = defineAsyncComponent(
    () => import('@/Components/Base/VCalendar/BaseExpandedVCalendar.vue')
)
</script>

<template>
    <base-expanded-v-calendar></base-expanded-v-calendar>
</template>
