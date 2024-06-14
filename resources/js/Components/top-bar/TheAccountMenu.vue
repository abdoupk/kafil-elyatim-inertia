<script lang="ts" setup>
import BaseMenu from '@/Components/Base/headless/Menu/BaseMenu.vue'
import BaseMenuButton from '@/Components/Base/headless/Menu/BaseMenuButton.vue'
import BaseMenuDivider from '@/Components/Base/headless/Menu/BaseMenuDivider.vue'
import BaseMenuHeader from '@/Components/Base/headless/Menu/BaseMenuHeader.vue'
import BaseMenuItem from '@/Components/Base/headless/Menu/BaseMenuItem.vue'
import BaseMenuItems from '@/Components/Base/headless/Menu/BaseMenuItems.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
</script>

<template>
    <base-menu>
        <base-menu-button class="image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
            <img alt="Midone Tailwind HTML Admin Template" src="/images/fakers/profile-10.jpg" />
        </base-menu-button>

        <base-menu-items class="mt-px w-56 bg-primary text-white">
            <base-menu-header class="font-normal">
                <div class="font-medium">Abderrahmane Rezig</div>
                <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">Web Developer</div>
            </base-menu-header>

            <base-menu-divider class="bg-white/[0.08]" />

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader> Profile
            </base-menu-item>

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader> Add Account
            </base-menu-item>

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader> Reset Password
            </base-menu-item>

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader>Help
            </base-menu-item>

            <base-menu-divider class="bg-white/[0.08]" />

            <base-menu-item :href="route('tenant.logout')" method="post" class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader>
                Logout
            </base-menu-item>
        </base-menu-items>
    </base-menu>
</template>
