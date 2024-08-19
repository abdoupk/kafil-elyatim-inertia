<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3'
import { defineAsyncComponent } from 'vue'

const BaseMenu = defineAsyncComponent(() => import('@/Components/Base/headless/Menu/BaseMenu.vue'))

const BaseMenuButton = defineAsyncComponent(() => import('@/Components/Base/headless/Menu/BaseMenuButton.vue'))

const BaseMenuDivider = defineAsyncComponent(() => import('@/Components/Base/headless/Menu/BaseMenuDivider.vue'))

const BaseMenuHeader = defineAsyncComponent(() => import('@/Components/Base/headless/Menu/BaseMenuHeader.vue'))

const BaseMenuItem = defineAsyncComponent(() => import('@/Components/Base/headless/Menu/BaseMenuItem.vue'))

const BaseMenuItems = defineAsyncComponent(() => import('@/Components/Base/headless/Menu/BaseMenuItems.vue'))

const TheAvatar = defineAsyncComponent(() => import('@/Components/Global/TheAvatar.vue'))

const SvgLoader = defineAsyncComponent(() => import('@/Components/SvgLoader.vue'))

const authName = usePage().props.auth.user?.first_name + ' ' + usePage().props.auth.user?.last_name
</script>

<template>
    <base-menu>
        <base-menu-button class="image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
            <the-avatar :gender="$page.props.auth.user?.gender" :name="authName"></the-avatar>
        </base-menu-button>

        <base-menu-items class="mt-px w-56 bg-primary text-white">
            <base-menu-header class="font-normal">
                <div class="font-medium">
                    {{ $page.props.auth.user?.first_name + ' ' + $page.props.auth.user?.last_name }}
                </div>

                <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">
                    {{ $t($page.props.auth.user.roles[0]) }}
                </div>
            </base-menu-header>

            <base-menu-divider class="bg-white/[0.08]" />

            <base-menu-item :href="route('tenant.profile.edit')" class="hover:bg-white/5" method="get">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-user"></svg-loader>
                {{ $t('Profile') }}
            </base-menu-item>

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader>
                Add Account
            </base-menu-item>

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader>
                Reset Password
            </base-menu-item>

            <base-menu-item class="hover:bg-white/5">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-bell"></svg-loader>
                Help
            </base-menu-item>

            <base-menu-divider class="bg-white/[0.08]" />

            <base-menu-item :href="route('tenant.logout')" class="hover:bg-white/5" method="post">
                <svg-loader class="me-2 h-4 w-4 fill-current" name="icon-left-from-bracket"></svg-loader>
                {{ $t('auth.Logout') }}
            </base-menu-item>
        </base-menu-items>
    </base-menu>
</template>
