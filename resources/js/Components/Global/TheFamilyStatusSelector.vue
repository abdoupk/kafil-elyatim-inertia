<script lang="ts" setup>
import { ref } from 'vue'

import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { __ } from '@/utils/i18n'

const familyStatuses = [
    {
        label: __('family_statuses.college_girl'),
        value: 'college_girl'
    },
    {
        label: __('family_statuses.professional_girl'),
        value: 'professional_girl'
    },
    {
        label: __('family_statuses.at_home_with_no_income'),
        value: 'at_home_with_no_income'
    },
    {
        label: __('family_statuses.at_home_with_income'),
        value: 'at_home_with_income'
    },
    {
        label: __('family_statuses.single_female_employee'),
        value: 'single_female_employee'
    },
    {
        label: __('family_statuses.married'),
        value: 'married'
    },
    {
        label: __('family_statuses.divorced'),
        value: 'divorced'
    },
    {
        label: __('family_statuses.college_boy'),
        value: 'college_boy'
    },
    {
        label: __('family_statuses.professional_boy'),
        value: 'professional_boy'
    },
    {
        label: __('family_statuses.unemployed'),
        value: 'unemployed'
    },
    {
        label: __('family_statuses.worker_with_family'),
        value: 'worker_with_family'
    },
    {
        label: __('family_statuses.worker_outside_family'),
        value: 'worker_outside_family'
    },
    {
        label: __('family_statuses.married_with_family'),
        value: 'married_with_family'
    },
    {
        label: __('family_statuses.married_outside_family'),
        value: 'married_outside_family'
    }
]

const handleUpdate = (status: { label: string; value: string }) => {
    familyStatus.value = status.value
}

const familyStatus = defineModel('familyStatus')

const selectedStatus = ref('')
</script>

<template>
    <!--  @vue-ignore  -->
    <base-vue-select
        v-model:value="selectedStatus"
        :options="familyStatuses"
        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('filters.sponsor_type') })"
        label="label"
        track_by="value"
        @update:value="handleUpdate"
    ></base-vue-select>
</template>
