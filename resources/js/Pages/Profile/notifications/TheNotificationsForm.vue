<script lang="ts" setup>
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
</script>

<template>
    <div class="flex flex-row items-center justify-between rounded-lg border p-4">
        <div class="space-y-0.5">
            <base-form-label class="text-base"> Communication emails</base-form-label>
            <p>Receive emails about your account activity.</p>
        </div>
        <base-form-switch class="text-lg">
            <base-form-switch-input id="television" type="checkbox"></base-form-switch-input>
        </base-form-switch>
    </div>
</template>
