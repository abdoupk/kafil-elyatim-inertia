<script setup lang="ts">
import type { CreateFamilyStepProps } from '@/types/types'

defineProps<CreateFamilyStepProps>()
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 3"
    >
        <div class="mb-6 hidden text-lg font-medium lg:block">
            {{ $t('families.create_family.stepThree') }}
        </div>

        <slot name="orphansForm"></slot>

        <slot></slot>
    </div>
</template>
