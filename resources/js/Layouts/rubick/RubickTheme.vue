<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { defineAsyncComponent } from 'vue'

const sideMenu = defineAsyncComponent({
    loader: () => import('./side-menu/TheSideMenu.vue')
})

const simpleMenu = defineAsyncComponent({
    loader: () => import('./simple-menu/TheSimpleMenu.vue')
})

const topMenu = defineAsyncComponent({
    loader: () => import('./top-menu/TheTopMenu.vue')
})

const settingsStore = useSettingsStore()
</script>

<template>
    <suspense v-if="settingsStore.layout === 'simple_menu'">
        <component :is="simpleMenu">
            <slot></slot>
        </component>
    </suspense>

    <suspense v-if="settingsStore.layout === 'side_menu'">
        <component :is="sideMenu">
            <slot></slot>
        </component>
    </suspense>

    <suspense v-if="settingsStore.layout === 'top_menu'">
        <component :is="topMenu">
            <slot></slot>
        </component>
    </suspense>
</template>
