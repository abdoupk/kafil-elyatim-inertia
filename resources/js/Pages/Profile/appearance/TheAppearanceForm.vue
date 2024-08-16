<script lang="ts" setup>
import TheAccentColorSelector from '@/Pages/Profile/appearance/TheAccentColorSelector.vue'
import TheAppearanceSelector from '@/Pages/Profile/appearance/TheAppearanceSelector.vue'
import TheLayoutSelector from '@/Pages/Profile/appearance/theLayoutSelector.vue'
import TheThemeSelector from '@/Pages/Profile/appearance/theThemeSelector.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'

const submit = () => {}
</script>

<template>
    <div class="border-b px-5 pb-5">
        <h2 class="rtl:text-xl rtl:font-semibold">{{ $t('appearance') }}</h2>

        <p class="mt-1 text-slate-600 dark:text-slate-400">
            {{ $t('theme.profile_appearance_hint') }}
        </p>
    </div>

    <form @submit.prevent="submit">
        <div class="p-5">
            <the-theme-selector></the-theme-selector>

            <the-layout-selector></the-layout-selector>

            <the-appearance-selector></the-appearance-selector>

            <the-accent-color-selector></the-accent-color-selector>

            <base-button class="ms-auto mt-5 block w-20" type="submit" variant="primary">{{ $t('save') }}</base-button>
        </div>
    </form>
</template>
