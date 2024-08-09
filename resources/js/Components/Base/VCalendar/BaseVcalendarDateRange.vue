<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { getLocale } from '@/utils/i18n'

const settingsStore = useSettingsStore()

const date = defineModel('date')

const masks = ref({
    input: 'DD/MM/YYYY'
})

const popover = ref({
    visibility: 'focus',
    autoHide: 0,
    placement: getLocale() === 'ar' ? 'top-end' : 'top-start'
})

// eslint-disable-next-line @typescript-eslint/no-unused-vars
const range = ref({
    start: new Date(),
    end: new Date()
})

const rules = ref({
    hours: Array.from({ length: 13 }, (_, i) => i + 8),
    milliseconds: 0
})
</script>

<template>
    <VDatePicker
        v-model.range="date"
        :is-dark="settingsStore.appearance === 'dark'"
        :locale="getLocale()"
        :masks="masks"
        :popover
        :rules="rules"
        borderless
        color="primary"
        mode="dateTime"
        title-position="left"
        transparent
    >
        <template v-slot="{ togglePopover, inputValue, inputEvents }">
            <div class="relative">
                <div
                    class="absolute flex h-full w-10 items-center justify-center rounded-s border bg-slate-100 text-slate-500 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400"
                    @click="() => togglePopover()"
                >
                    <svg-loader class="h-4 w-4 fill-current" name="icon-calendar" />
                </div>

                <base-form-input
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the date') })"
                    :value="inputValue.end"
                    class="ps-12"
                    v-on="inputEvents"
                ></base-form-input>
            </div>
        </template>
    </VDatePicker>
</template>

<style lang="postcss">
@import '/resources/css/vendors/v-calendar.css';
</style>
