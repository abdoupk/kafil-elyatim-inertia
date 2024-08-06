<script lang="ts" setup>
import MenuLink from '@/Pages/Profile/MenuLink.vue'
</script>

<template>
    <!-- BEGIN: Profile Menu -->
    <div class="flex flex-col-reverse col-span-12 lg:col-span-3 2xl:col-span-3 lg:block">
        <div class="mt-5 intro-y box lg:mt-0">
            <div class="p-5 border-slate-200/60 dark:border-darkmode-400 rtl:text-base">
                <menu-link class="!mt-0" icon="icon-users" view-name="account"></menu-link>

                <menu-link icon="icon-brush" view-name="appearance"></menu-link>

                <menu-link icon="icon-bell" view-name="notifications"></menu-link>
            </div>
        </div>
    </div>
    <!-- END: Profile Menu -->
</template>
