<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { Link } from '@inertiajs/vue3'
import { twMerge } from 'tailwind-merge'
import { defineAsyncComponent } from 'vue'

import { isAssociationNameLatin } from '@/utils/helper'

const TheAccountMenu = defineAsyncComponent(() => import('@/Components/top-bar/TheAccountMenu.vue'))

const TheBreadcrumb = defineAsyncComponent(() => import('@/Components/top-bar/TheBreadcrumb.vue'))

const TheNotification = defineAsyncComponent(() => import('@/Components/top-bar/notifications/TheNotification.vue'))

const TheSearch = defineAsyncComponent(() => import('@/Components/top-bar/search/TheSearch.vue'))

const settingsStore = useSettingsStore()
</script>

<template>
    <div
        class="top-bar-boxed relative z-[51] -mx-5 mb-12 mt-12 h-[70px] border-b border-white/[0.08] px-3 sm:-mx-8 sm:px-8 md:-mt-5 md:pt-0"
    >
        <suspense suspensible>
            <div class="flex h-full items-center">
                <Link :href="route('tenant.dashboard')" class="-intro-x hidden md:flex">
                    <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg" />
                    <span
                        :class="
                            twMerge([
                                'ms-3 max-w-40 truncate font-semibold capitalize text-white',
                                settingsStore.layout == 'side_menu' && 'hidden xl:block',
                                settingsStore.layout == 'simple_menu' && 'hidden',
                                isAssociationNameLatin && 'text-sm',
                                !isAssociationNameLatin && 'text-base'
                            ])
                        "
                    >
                        {{ $page.props.association }}
                    </span>
                </Link>

                <the-breadcrumb
                    :class="
                        twMerge([
                            '-intro-x me-auto h-[45px] border-white/[0.08] dark:border-white/[0.08] md:ms-10 md:border-s',
                            settingsStore.layout != 'top_menu' && 'md:ps-6',
                            settingsStore.layout == 'top_menu' && 'md:ps-10'
                        ])
                    "
                    light
                ></the-breadcrumb>

                <the-search></the-search>

                <the-notification></the-notification>

                <the-account-menu></the-account-menu>
            </div>

            <template #fallback> aaaaaaa</template>
        </suspense>
    </div>
</template>
