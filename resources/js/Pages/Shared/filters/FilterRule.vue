<script lang="ts" setup>
import type { ListBoxFilter, ListBoxOperator } from '@/types/types'

import { ref, watch } from 'vue'

import FieldsFilterDropDown from '@/Pages/Shared/filters/FieldsFilterDropDown.vue'
import OperatorsFilterDropDown from '@/Pages/Shared/filters/OperatorsFilterDropDown.vue'
import SponsorsFilterDropDown from '@/Pages/Shared/filters/SponsorsFilterDropDown.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'

defineProps<{ filters: ListBoxFilter[] }>()

const operators = ref<ListBoxOperator[]>([])

const field = defineModel<ListBoxFilter>('field')

const operator = defineModel<ListBoxOperator>('operator')

const value = defineModel('value')

watch(
    () => field.value,
    (newField) => {
        newField?.operators && (operators.value = newField.operators)

        operator.value = operators.value[0]

        value.value = ''
    }
)

watch(
    () => operator.value,
    () => {
        value.value = ''
    }
)
</script>

<template>
    <fields-filter-drop-down v-model:selected="field" :filters class="col-span-4"></fields-filter-drop-down>

    <operators-filter-drop-down v-model:selected="operator" :operators class="col-span-4"></operators-filter-drop-down>

    <slot></slot>
</template>
