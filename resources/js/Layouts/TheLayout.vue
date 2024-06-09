<script setup lang="ts">
import { defineAsyncComponent, onMounted, ref, watch } from 'vue'
import { setColorSchemeClass, setDarkModeClass } from '@/utils/helper'
import EnigmaTheme from '@/Layouts/enigma/EnigmaTheme.vue'
import IcewallTheme from '@/Layouts/icewall/IcewallTheme.vue'
import type { PageProps } from '@/types'
import RubickTheme from '@/Layouts/rubick/RubickTheme.vue'
import TinkerTheme from '@/Layouts/tinker/TinkerTheme.vue'
import { usePage } from '@inertiajs/vue3'
import { useSettingsStore } from '@/stores/settings'

const settingsStore = useSettingsStore()

const theThemeSwitcher = defineAsyncComponent(() => import('@/Components/theme-switcher/TheThemeSwitcher.vue'))

const showLoader = ref(false)

watch(
    () => [settingsStore.theme, settingsStore.layout],
    () => {
        showLoader.value = false

        setTimeout(() => {
            showLoader.value = true
        }, 700)
    }
)

onMounted(() => {
    settingsStore.layout = usePage<PageProps>().props.auth.settings.layout

    settingsStore.theme = usePage<PageProps>().props.auth.settings.theme

    settingsStore.colorScheme = usePage<PageProps>().props.auth.settings.color_scheme

    settingsStore.appearance = usePage<PageProps>().props.auth.settings.appearance

    setDarkModeClass(settingsStore.appearance)

    setColorSchemeClass(settingsStore.colorScheme, settingsStore.appearance)

    showLoader.value = true
})
</script>

<template>
    <suspense>
        <div>
            <enigma-theme :show-loader="showLoader" v-if="settingsStore.theme === 'enigma'">
                <slot></slot>
            </enigma-theme>

            <icewall-theme :show-loader="showLoader" v-if="settingsStore.theme === 'icewall'">
                <slot></slot>
            </icewall-theme>

            <rubick-theme :show-loader="showLoader" v-if="settingsStore.theme === 'rubick'">
                <slot></slot>
            </rubick-theme>
            <tinker-theme :show-loader="showLoader" v-if="settingsStore.theme === 'tinker'">
                <slot></slot>
            </tinker-theme>

            <the-theme-switcher></the-theme-switcher>
        </div>
    </suspense>
</template>
