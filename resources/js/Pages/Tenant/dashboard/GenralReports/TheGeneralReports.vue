<script lang="ts" setup>
import type { GeneralReports } from '@/types/dashboard'

import ReportBox from '@/Pages/Tenant/dashboard/GenralReports/ReportBox.vue'

defineProps<{
    reports: GeneralReports
}>()
</script>

<template>
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
                            :percentageDifference="parseInt(reports.orphans.percentageDifference)"
                            :stat="reports.orphans.total"
                            :title="$t('total orphans')"
                            icon="icon-hands-holding-child"
                            icon-color="primary"
                        ></report-box>

                        <report-box
                            :percentageDifference="parseInt(reports.families.percentageDifference)"
                            :stat="reports.families.total"
                            :title="$t('total families')"
                            icon="icon-family"
                            icon-color="dark"
                        ></report-box>

                        <report-box
                            :percentageDifference="parseInt(reports.members.percentageDifference)"
                            :stat="reports.members.total"
                            :title="$t('total members')"
                            icon="icon-users-gear"
                            icon-color="pending"
                        ></report-box>

                        <report-box
                            :percentageDifference="parseInt(reports.branches.percentageDifference)"
                            :stat="reports.branches.total"
                            :title="$t('total branches')"
                            icon="icon-branches"
                            icon-color="success"
                        ></report-box>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="postcss" scoped></style>
