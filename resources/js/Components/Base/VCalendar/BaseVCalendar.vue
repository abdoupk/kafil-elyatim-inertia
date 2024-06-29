<script setup lang="ts">
import { useSettingsStore } from '@/stores/settings'
import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { getLocale } from '@/utils/i18n.js'

const settingsStore = useSettingsStore()

const date = defineModel('date', { default: new Date() })

const popover = ref({
    visibility: 'click',
    placement: getLocale() === 'ar' ? 'top-end' : 'top-start'
})
</script>

<template>
    <VDatePicker
        color="primary"
        v-model="date"
        :is-dark="settingsStore.appearance === 'dark'"
        :popover
        :update-on-input="false"
        borderless
        locale="ar"
        mode="date"
        title-position="left"
        transparent
    >
        <template v-slot="{ inputValue, inputEvents }">
            <div class="relative">
                <div
                    class="absolute flex items-center justify-center w-10 h-full border rounded-s bg-slate-100 text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"
                >
                    <svg-loader name="icon-calendar" class="w-4 h-4 fill-current" />
                </div>

                <base-form-input class="ps-12" :value="inputValue" v-on="inputEvents"></base-form-input>
            </div>
        </template>
    </VDatePicker>
</template>

<style lang="postcss">
@import '/resources/css/vendors/v-calendar.css';
</style>
