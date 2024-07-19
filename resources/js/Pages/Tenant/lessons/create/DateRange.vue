<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { getLocale } from '@/utils/i18n'

const settingsStore = useSettingsStore()

const range = defineModel('range', {
    default: {
        start: '',
        end: ''
    }
})

const masks = ref({
    input: 'DD/MM/YYYY'
})

const popover = ref({
    visibility: 'focus',
    placement: getLocale() === 'ar' ? 'bottom-end' : 'bottom-start'
})
</script>

<template>
    <VDatePicker
        v-model.range="range"
        :is-dark="settingsStore.appearance === 'dark'"
        :locale="getLocale()"
        :masks="masks"
        :popover
        :update-on-input="false"
        borderless
        color="primary"
        hide-time-header
        is24hr
        mode="dateTime"
        title-position="left"
        transparent
    >
        <template v-slot="{ togglePopover, inputValue, inputEvents }">
            <div class="col-span-12 sm:col-span-6">
                <slot name="label_start"></slot>

                <div class="relative">
                    <div
                        class="absolute flex items-center justify-center w-10 h-full border rounded-s bg-slate-100 text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"
                        @click="() => togglePopover()"
                    >
                        <svg-loader class="w-4 h-4 fill-current" name="icon-calendar" />
                    </div>

                    <base-form-input
                        id="start_date"
                        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the date') })"
                        :value="inputValue.start"
                        class="ps-12"
                        v-on="inputEvents.start"
                    ></base-form-input>
                </div>

                <slot name="error_start"></slot>
            </div>

            <div class="col-span-12 sm:col-span-6">
                <slot name="label_end"></slot>

                <div class="relative">
                    <div
                        class="absolute flex items-center justify-center w-10 h-full border rounded-s bg-slate-100 text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"
                        @click="() => togglePopover()"
                    >
                        <svg-loader class="w-4 h-4 fill-current" name="icon-calendar" />
                    </div>

                    <base-form-input
                        id="end_date"
                        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the date') })"
                        :value="inputValue.end"
                        class="ps-12"
                        v-on="inputEvents.end"
                    ></base-form-input>
                </div>

                <slot name="error_end"></slot>
            </div>
        </template>
    </VDatePicker>
</template>

<style lang="postcss">
@import '/resources/css/vendors/v-calendar.css';
</style>
