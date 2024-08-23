<script lang="ts" setup>
import { defineAsyncComponent, ref } from 'vue'

const BaseExpandedVCalendar = defineAsyncComponent(
    () => import('@/Components/Base/VCalendar/BaseExpandedVCalendar.vue')
)

const date = new Date()

const year = date.getFullYear()

const month = date.getMonth()

const attributes = ref([
    {
        key: 'today',
        highlight: {
            color: 'purple',
            fillMode: 'solid',
            contentClass: 'italic'
        },
        dates: new Date(year, month, 12)
    },
    {
        highlight: {
            color: 'purple',
            fillMode: 'light'
        },
        dates: new Date(year, month, 13)
    },
    {
        highlight: {
            color: 'purple',
            fillMode: 'outline'
        },
        dates: new Date(year, month, 14)
    }
])
</script>

<template>
    <base-expanded-v-calendar :attributes="attributes"></base-expanded-v-calendar>
</template>
