<script lang="ts" setup></script>

<template>
    <div class="col-span-12 mt-8 sm:col-span-6 lg:col-span-3">
        <div class="intro-y flex h-10 items-center">
            <h2 class="me-5 truncate text-lg font-medium rtl:font-semibold">
                {{ $t('statistics.families.titles.families_by_zone') }}
            </h2>
        </div>
        <div class="intro-y box mt-5 p-5">
            <div class="mt-3">
                chart here
                <!--                <ReportDonutChart :height="213" />-->
            </div>
        </div>
    </div>
</template>
