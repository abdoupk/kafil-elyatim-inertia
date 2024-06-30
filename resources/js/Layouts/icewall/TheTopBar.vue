<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { Link } from '@inertiajs/vue3'
import { twMerge } from 'tailwind-merge'

import TheAccountMenu from '@/Components/top-bar/TheAccountMenu.vue'
import TheBreadcrumb from '@/Components/top-bar/TheBreadcrumb.vue'
import TheNotification from '@/Components/top-bar/TheNotification.vue'
import TheSearch from '@/Components/top-bar/search/TheSearch.vue'

import { isAssociationNameLatin } from '@/utils/helper'

const settingsStore = useSettingsStore()
</script>

<template>
    <div
        class="top-bar-boxed relative z-[51] -mx-5 mb-12 mt-12 h-[70px] border-b border-white/[0.08] px-3 sm:-mx-8 sm:px-8 md:-mt-5 md:pt-0"
    >
        <div class="flex h-full items-center">
            <Link :href="route('tenant.dashboard')" class="-intro-x hidden md:flex">
                <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg" />
                <span
                    :class="
                        twMerge([
                            'ms-3 text-white font-semibold max-w-40 capitalize truncate',
                            settingsStore.layout == 'side-menu' && 'hidden xl:block',
                            settingsStore.layout == 'simple-menu' && 'hidden',
                            isAssociationNameLatin && 'text-sm',
                            !isAssociationNameLatin && 'text-base'
                        ])
                    "
                >
                    {{ $page.props.association }}
                </span>
            </Link>

            <the-breadcrumb
                light
                :class="
                    twMerge([
                        '-intro-x me-auto h-[45px] border-white/[0.08] dark:border-white/[0.08] md:ms-10 md:border-s',
                        settingsStore.layout != 'top-menu' && 'md:ps-6',
                        settingsStore.layout == 'top-menu' && 'md:ps-10'
                    ])
                "
            ></the-breadcrumb>

            <the-search></the-search>

            <the-notification></the-notification>

            <the-account-menu></the-account-menu>
        </div>
    </div>
</template>
