<template>
    <VDatePicker v-model="date" :is-dark="true" :popover :update-on-input="false" borderless locale="ar" mode="date"
                 title-position="left" transparent>
        <template v-slot="{ inputValue, inputEvents }">
            <BaseFormInput :value="inputValue" v-on="inputEvents" />
        </template>
    </VDatePicker>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import { getLocale } from '@/utils/i18n.js'

const date = ref(new Date())

const popover = ref({
    visibility: 'click',
    placement: getLocale() === 'ar' ? 'top-end' : 'top-start'
})
</script>
