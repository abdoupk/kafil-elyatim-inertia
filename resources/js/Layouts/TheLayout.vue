<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { PageProps } from '@/types'
import { usePage } from '@inertiajs/vue3'
import { defineAsyncComponent, onMounted } from 'vue'

import TheThemeSwitcher from '@/Components/theme-switcher/TheThemeSwitcher.vue'

import { setColorSchemeClass, setDarkModeClass } from '@/utils/helper'

const EnigmaTheme = defineAsyncComponent(() => import('@/Layouts/enigma/EnigmaTheme.vue'))

const IcewallTheme = defineAsyncComponent(() => import('@/Layouts/icewall/IcewallTheme.vue'))

const RubickTheme = defineAsyncComponent(() => import('@/Layouts/rubick/RubickTheme.vue'))

const TinkerTheme = defineAsyncComponent(() => import('@/Layouts/tinker/TinkerTheme.vue'))

const settingsStore = useSettingsStore()

onMounted(() => {
    settingsStore.layout = usePage<PageProps>().props.auth.settings.layout

    settingsStore.theme = usePage<PageProps>().props.auth.settings.theme

    settingsStore.colorScheme = usePage<PageProps>().props.auth.settings.color_scheme

    settingsStore.appearance = usePage<PageProps>().props.auth.settings.appearance

    setDarkModeClass(settingsStore.appearance)

    setColorSchemeClass(settingsStore.colorScheme, settingsStore.appearance)
})
</script>

<template>
    <suspense>
        <div>
            <enigma-theme v-if="settingsStore.theme === 'enigma'">
                <slot></slot>
            </enigma-theme>

            <icewall-theme v-if="settingsStore.theme === 'icewall'">
                <slot></slot>
            </icewall-theme>

            <rubick-theme v-if="settingsStore.theme === 'rubick'">
                <slot></slot>
            </rubick-theme>

            <tinker-theme v-if="settingsStore.theme === 'tinker'">
                <slot></slot>
            </tinker-theme>

            <the-theme-switcher></the-theme-switcher>
        </div>
    </suspense>
</template>
