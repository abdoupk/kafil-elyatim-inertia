<script lang="ts" setup>
import type { HousingType } from '@/types/families'

defineProps<{ housing: HousingType }>()
</script>

<template>
    <!-- BEGIN: Sponsor Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-base font-medium">Sponsor Information</h2>
        </div>
        <div class="p-5">hello 2</div>
    </div>
    <!-- END: Sponsor Information -->
</template>
