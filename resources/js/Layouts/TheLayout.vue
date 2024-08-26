<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import type { PageProps } from '@/types'
import { usePage } from '@inertiajs/vue3'
import { onMounted, ref, watch } from 'vue'

import EnigmaTheme from '@/Layouts/enigma/EnigmaTheme.vue'
import IcewallTheme from '@/Layouts/icewall/IcewallTheme.vue'
import RubickTheme from '@/Layouts/rubick/RubickTheme.vue'
import TinkerTheme from '@/Layouts/tinker/TinkerTheme.vue'

import { setColorSchemeClass, setDarkModeClass } from '@/utils/helper'

const settingsStore = useSettingsStore()

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
            <enigma-theme v-if="settingsStore.theme === 'enigma'" :show-loader="showLoader">
                <slot></slot>
            </enigma-theme>

            <icewall-theme v-if="settingsStore.theme === 'icewall'" :show-loader="showLoader">
                <slot></slot>
            </icewall-theme>

            <rubick-theme v-if="settingsStore.theme === 'rubick'" :show-loader="showLoader">
                <slot></slot>
            </rubick-theme>
            <tinker-theme v-if="settingsStore.theme === 'tinker'" :show-loader="showLoader">
                <slot></slot>
            </tinker-theme>
        </div>
    </suspense>
</template>
