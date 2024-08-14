<script lang="ts" setup>
import TheAccentColorSelector from '@/Pages/Profile/appearance/TheAccentColorSelector.vue'
import TheAppearanceSelector from '@/Pages/Profile/appearance/TheAppearanceSelector.vue'
import TheLayoutSelector from '@/Pages/Profile/appearance/theLayoutSelector.vue'
import TheThemeSelector from '@/Pages/Profile/appearance/theThemeSelector.vue'

const submit = () => {}
</script>

<template>
    <div class="border-b px-5 pb-5">
        <h2 class="text-lg font-semibold">{{ $t('appearance') }}</h2>

        <p class="mt-1 text-slate-600 dark:text-slate-400">
            {{ $t('theme.profile_appearance_hint') }}
        </p>
    </div>

    <div class="p-5">
        <form @submit.prevent="submit">
            <the-theme-selector></the-theme-selector>

            <the-layout-selector></the-layout-selector>

            <the-accent-color-selector></the-accent-color-selector>

            <the-appearance-selector></the-appearance-selector>
        </form>
    </div>
</template>
