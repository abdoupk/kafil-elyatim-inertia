<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import ReportBox from '@/Pages/Tenant/dashboard/ReportBox.vue'
import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})

interface Stats {
    total: number
    percentageDifference: number
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
                            {{ __('General Reports') }}
                        </h2>
                    </div>
                    <div class="mt-5 grid grid-cols-12 gap-6">
                        <report-box
                            :stat="orphans.total"
                            :title="__('total orphans')"
                            :percentageDifference="orphans.percentageDifference"
                            icon-color="primary"
                            icon="icon-hands-holding-child"
                        ></report-box>

                        <report-box
                            :stat="families.total"
                            :title="__('total families')"
                            :percentageDifference="families.percentageDifference"
                            icon-color="dark"
                            icon="icon-family"
                        ></report-box>

                        <report-box
                            :stat="members.total"
                            :title="__('total members')"
                            :percentageDifference="members.percentageDifference"
                            icon-color="pending"
                            icon="icon-users-gear"
                        ></report-box>

                        <report-box
                            :stat="branches.total"
                            :title="__('total branches')"
                            :percentageDifference="branches.percentageDifference"
                            icon-color="success"
                            icon="icon-circle-nodes"
                        ></report-box>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
