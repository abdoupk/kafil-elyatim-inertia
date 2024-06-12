<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import ReportBox from '@/Pages/Tenant/dashboard/ReportBox.vue'
import TheLayout from '@/Layouts/TheLayout.vue'

defineOptions({
    layout: TheLayout
})
</script>

<template>
    <Head title="Dashboard" />

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex h-10 items-center">
                        <h2 class="me-5 truncate text-lg font-medium">
                            {{ __('General Report') }}
                        </h2>
                    </div>
                    <div class="mt-5 grid grid-cols-12 gap-6">
                        <report-box
                            :stat="45232"
                            title="hello"
                            status="down"
                            icon-color="primary"
                            icon="icon-gear"
                        ></report-box>

                        <report-box
                            :stat="45232"
                            title="hello"
                            status="down"
                            icon-color="primary"
                            icon="icon-gear"
                        ></report-box>

                        <report-box
                            :stat="45232"
                            title="hello"
                            status="down"
                            icon-color="primary"
                            icon="icon-gear"
                        ></report-box>

                        <report-box
                            :stat="45232"
                            title="hello"
                            status="down"
                            icon-color="primary"
                            icon="icon-gear"
                        ></report-box>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
