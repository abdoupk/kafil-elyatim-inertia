<script lang="ts" setup>
import { ref } from 'vue'

import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { __ } from '@/utils/i18n'

const sponsorTypes = [
    {
        label: __('sponsor_types.widower'),
        value: 'widower'
    },
    {
        label: __('sponsor_types.widow'),
        value: 'widow'
    },
    {
        label: __('sponsor_types.widows_husband'),
        value: 'widows_husband'
    },
    {
        label: __('sponsor_types.widowers_wife'),
        value: 'widowers_wife'
    },
    {
        label: __('sponsor_types.mother_of_a_supported_childhood'),
        value: 'mother_of_a_supported_childhood'
    },
    {
        label: __('sponsor_types.other'),
        value: 'other'
    }
]

const handleUpdate = (sponsorType: { label: string; value: string }) => {
    type.value = sponsorType.value
}

const type = defineModel('type')

const selectedType = ref('')
</script>

<template>
    <!--  @vue-ignore  -->
    <base-vue-select
        v-model:value="selectedType"
        :options="sponsorTypes"
        :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('filters.sponsor_type') })"
        label="label"
        track_by="value"
        @update:value="handleUpdate"
    ></base-vue-select>
</template>
