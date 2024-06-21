<script lang="ts" setup>
import { useSettingsStore } from '@/stores/settings'
import { Link } from '@inertiajs/vue3'
import { twMerge } from 'tailwind-merge'

import TheAccountMenu from '@/Components/top-bar/TheAccountMenu.vue'
import TheBreadcrumb from '@/Components/top-bar/TheBreadcrumb.vue'
import TheNotification from '@/Components/top-bar/TheNotification.vue'
import TheSearch from '@/Components/top-bar/search/TheSearch.vue'

const settingsStore = useSettingsStore()
</script>

<template>
    <div
        :class="
            twMerge([
                'relative z-[51] -mx-5 mt-12 h-[70px] border-b border-white/[0.08] px-3 sm:-mx-8 sm:px-8 md:fixed md:inset-x-0 md:top-0 md:-mx-0 md:mt-0 md:h-[65px] md:border-b-0 md:bg-gradient-to-b md:from-slate-100 md:to-transparent md:px-10 md:pt-10 dark:md:from-darkmode-700',

                'before:absolute before:inset-0 before:top-0 before:mx-7 before:mt-3 before:hidden before:h-[65px] before:rounded-xl before:bg-primary/30 before:content-[\'\'] before:dark:bg-darkmode-600/30 before:md:block',
                'after:absolute after:inset-0 after:mx-3 after:mt-5 after:hidden after:h-[65px] after:rounded-xl after:bg-primary after:shadow-md after:content-[\'\'] after:dark:bg-darkmode-600 after:md:block',

                settingsStore.layout == 'top-menu' && 'dark:md:from-darkmode-800'
            ])
        "
    >
        <div class="flex h-full items-center">
            <Link href="/" class="-intro-x hidden md:flex">
                <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg" />
                <span
                    :class="
                        twMerge([
                            'ms-3 text-lg text-white',
                            settingsStore.layout == 'side-menu' && 'hidden xl:block',
                            settingsStore.layout == 'simple-menu' && 'hidden'
                        ])
                    "
                >
                    Tinker
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
