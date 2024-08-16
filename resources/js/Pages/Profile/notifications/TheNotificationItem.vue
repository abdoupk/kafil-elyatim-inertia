<script lang="ts" setup>
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'

defineProps<{
    label: string
    description: string
}>()

const status = defineModel('status')
</script>

<template>
    <div class="flex flex-row items-center justify-between rounded-lg border p-5">
        <div class="space-y-0.5">
            <base-form-label class="text-base">{{ $t(`profile.notifications.${label}`) }}</base-form-label>
            <p class="text-sm text-slate-400">{{ $t(`profile.notifications.${description}`) }}</p>
        </div>
        <base-form-switch class="text-lg">
            <base-form-switch-input v-model="status" type="checkbox"></base-form-switch-input>
        </base-form-switch>
    </div>
</template>
