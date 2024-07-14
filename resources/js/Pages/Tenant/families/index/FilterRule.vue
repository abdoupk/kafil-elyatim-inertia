<script lang="ts" setup>
import type { ListBoxFilter } from '@/types/types'

import { ref } from 'vue'

import TestDropDown from '@/Pages/Tenant/dashboard/TestDropDown.vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'

const filters: ListBoxFilter[] = [
    {
        field: 'name',
        icon: 'icon-bell',
        operators: ['contains',
'not_contains',
'starts_with',
'ends_with']
    },
    {
        field: 'age',
        icon: 'icon-users-gear',
        operators: ['contains',
'not_contains',
'starts_with',
'ends_with']
    }
]

const field = ref('')

const operator = ref('')

const value = ref('')
</script>

<template>
    {{ field }}
    <test-drop-down v-model="field" :filters class="col-span-4"></test-drop-down>

    <!--    <test-drop-down v-model:selected="operator" class="col-span-4"></test-drop-down>-->

    <base-form-input v-model="value" class="col-span-4 mt-2 text-sm"></base-form-input>
</template>

<style lang="postcss" scoped></style>
