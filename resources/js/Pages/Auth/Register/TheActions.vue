<script setup lang="ts">
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

interface Props {
    currentStep: number
    totalSteps: number
    validating: boolean
    prevStep: () => void
    nextStep: () => void
}

defineProps<Props>()
</script>

<template>
    <div class="intro-y col-span-12 mt-5 flex items-center justify-center sm:justify-end">
        <base-button
            :disabled="validating"
            type="button"
            variant="secondary"
            class="w-24"
            @click="prevStep"
            v-if="currentStep > 1"
            data-test="previous"
        >
            {{ $t('pagination.previous') }}
        </base-button>

        <base-button
            :disabled="validating"
            type="submit"
            variant="primary"
            class="ms-2 w-24"
            @click.prevent="nextStep"
            data-test="next_or_register"
        >
            <spinner-button-loader :show="validating"></spinner-button-loader>

            {{ currentStep === totalSteps ? $t('register') : $t('pagination.next') }}
        </base-button>
    </div>
</template>
