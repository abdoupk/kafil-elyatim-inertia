<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { ref } from 'vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'

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
    <div class="col-span-12 sm:col-span-6">
        <base-form-label for="created_at">
            {{ $t('validation.attributes.created_at') }}
        </base-form-label>

        <base-v-calendar v-model:date="form.created_at"></base-v-calendar>

        <base-form-input-error>
            <div v-if="form?.invalid('created_at')" class="mt-2 text-danger" data-test="error_start_date_message">
                {{ form.errors.created_at }}
            </div>
        </base-form-input-error>
    </div>

    <base-v-calendar
        :is-dark="settingsStore.appearance === 'dark'"
        :locale="getLocale()"
        :masks="masks"
        :popover
        borderless
        color="primary"
        hide-time-header
        is24hr
        mode="Time"
        transparent
    ></base-v-calendar>
</template>
