<script lang="ts" setup></script>

<template>
    <div class="col-span-12 mt-8 sm:col-span-6 lg:col-span-3">
        <div class="intro-y flex h-10 items-center">
            <h2 class="me-5 truncate text-lg font-medium">Weekly Top Seller</h2>
            <a class="ms-auto truncate text-primary" href=""> Show More </a>
        </div>
        <div class="intro-y box mt-5 p-5">
            <div class="mt-3">
                <!--                <ReportPieChart :height="213" />-->

                chart here
            </div>
            <div class="mx-auto mt-8 w-52 sm:w-auto">
                <div class="flex items-center">
                    <div class="me-3 h-2 w-2 rounded-full bg-primary"></div>
                    <span class="truncate">17 - 30 Years old</span>
                    <span class="ms-auto font-medium">62%</span>
                </div>
                <div class="mt-4 flex items-center">
                    <div class="me-3 h-2 w-2 rounded-full bg-pending"></div>
                    <span class="truncate">31 - 50 Years old</span>
                    <span class="ms-auto font-medium">33%</span>
                </div>
                <div class="mt-4 flex items-center">
                    <div class="me-3 h-2 w-2 rounded-full bg-warning"></div>
                    <span class="truncate">&gt;= 50 Years old</span>
                    <span class="ms-auto font-medium">10%</span>
                </div>
            </div>
        </div>
    </div>
</template>
