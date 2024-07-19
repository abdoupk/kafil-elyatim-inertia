<script lang="ts" setup>
import { Head } from '@inertiajs/vue3'

import TheLayout from '@/Layouts/TheLayout.vue'

import ReportBox from '@/Pages/Tenant/dashboard/ReportBox.vue'

import BaseCalendar from '@/Components/Base/calendar/BaseCalendar.vue'

defineOptions({
    layout: TheLayout
})

interface Stats {
    total: number
    percentageDifference: string
}

defineProps<{
    members: Stats
    orphans: Stats
    branches: Stats
    families: Stats
}>()
</script>

<template>
    <Head title="Dashboard" />

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex h-10 items-center">
                        <h2 class="me-5 truncate text-lg font-medium">
                            {{ $t('General Reports') }}
                        </h2>
                    </div>
                    <div class="mt-5 grid grid-cols-12 gap-6">
                        <report-box
                            :percentageDifference="parseInt(orphans.percentageDifference)"
                            :stat="orphans.total"
                            :title="$t('total orphans')"
                            icon="icon-hands-holding-child"
                            icon-color="primary"
                        ></report-box>

                        <report-box
                            :percentageDifference="parseInt(families.percentageDifference)"
                            :stat="families.total"
                            :title="$t('total families')"
                            icon="icon-family"
                            icon-color="dark"
                        ></report-box>

                        <report-box
                            :percentageDifference="parseInt(members.percentageDifference)"
                            :stat="members.total"
                            :title="$t('total members')"
                            icon="icon-users-gear"
                            icon-color="pending"
                        ></report-box>

                        <report-box
                            :percentageDifference="parseInt(branches.percentageDifference)"
                            :stat="branches.total"
                            :title="$t('total branches')"
                            icon="icon-branches"
                            icon-color="success"
                        ></report-box>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <base-calendar></base-calendar>
</template>
