<script setup lang="ts">
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'
import { TransitionRoot } from '@headlessui/vue'

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
            <!-- TODO: Fix This its too late to appear or disappear -->
            <transition-root
                appear
                :show="validating"
                enter="transition ease-out"
                enterFrom="scale-0"
                enterTo="scale-100"
            >
                <spinner-loader class="me-1 h-4 w-4 animate-spin text-white"></spinner-loader>
            </transition-root>

            {{ currentStep === totalSteps ? $t('register') : $t('pagination.next') }}
        </base-button>
    </div>
</template>
