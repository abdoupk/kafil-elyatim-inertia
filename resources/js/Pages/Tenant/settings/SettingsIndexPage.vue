<script lang="ts" setup>
import type { CalculationTableType } from '@/types/settings'
import type { SiteSettingsType } from '@/types/types'

import { Head } from '@inertiajs/vue3'

import TheLayout from '@/Layouts/TheLayout.vue'

import TheCalculationTable from '@/Pages/Tenant/settings/TheCalculationTable.vue'
import TheTenantInfosUpdateForm from '@/Pages/Tenant/settings/TheTenantInfosUpdateForm.vue'

defineOptions({
    layout: TheLayout
})

defineProps<{
    settings: SiteSettingsType
    calculation: CalculationTableType
}>()
</script>

<template>
    <Head :title="$t('settings')"></Head>

    <h2 class="intro-y mt-10 text-lg font-medium">{{ $t('settings') }}</h2>
    <div class="intro-y mt-5 grid grid-cols-12 gap-6">
        <the-tenant-infos-update-form :settings></the-tenant-infos-update-form>

        <the-calculation-table :calculation></the-calculation-table>
    </div>
</template>
