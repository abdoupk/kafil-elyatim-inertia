<script lang="ts" setup>
import type { IFormattedMenu, ILocation, IMenu } from '@/types/types'
import { Link, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref, watch } from 'vue'
import TheAccountMenu from '@/Components/top-bar/TheAccountMenu.vue'
import TheBreadcrumb from '@/Components/top-bar/TheBreadcrumb.vue'
import TheMobileMenu from '@/Components/mobile-menu/TheMobileMenu.vue'
import TheNotification from '@/Components/top-bar/TheNotification.vue'
import TheSearch from '@/Components/top-bar/search/TheSearch.vue'
import TopMenuLink from '@/Layouts/rubick/top-menu/TopMenuLink.vue'
import { nestedMenu } from '@/Layouts/menu'
import { toRaw } from '@/utils/helper'
import { useMenuStore } from '@/stores/menu'

const formattedMenu = ref<Array<IFormattedMenu | 'divider'>>([])

const menuStore = useMenuStore()

const _route = { routeName: '' } as ILocation

const topMenu = computed(() => nestedMenu(menuStore.menu as IMenu[], _route))

watch(
    computed(() => usePage().url),
    () => {
        delete _route.forceActiveMenu

        formattedMenu.value = toRaw(topMenu.value)
    }
)

onMounted(() => {
    formattedMenu.value = toRaw(topMenu.value)
})
</script>

<template>
    <div
        class="rubick px-5 py-5 before:fixed before:inset-0 before:z-[-1] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:content-[''] dark:before:from-darkmode-800 dark:before:to-darkmode-800 sm:px-8"
    >
        <the-mobile-menu></the-mobile-menu>
        <div class="-mx-3 mb-10 mt-[2.2rem] border-b border-white/[0.08] px-3 pt-3 sm:-mx-8 sm:px-8 md:-mt-5 md:pt-0">
            <div class="relative z-[51] flex h-[70px] items-center">
                <Link href="/" class="-intro-x hidden md:flex">
                    <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg" />
                    <span class="ms-3 text-lg text-white"> Rubick </span>
                </Link>

                <the-breadcrumb
                    class="-intro-x me-auto h-full border-white/[0.08] md:ms-10 md:border-s md:ps-10"
                    light
                ></the-breadcrumb>

                <the-search class="intro-x relative me-3 sm:me-6"></the-search>

                <the-notification
                    class="relative block text-white/70 outline-none before:absolute before:end-0.5 before:top-[-2px] before:h-[8px] before:w-[8px] before:rounded-full before:bg-danger before:content-['']"
                ></the-notification>

                <the-account-menu></the-account-menu>
            </div>
        </div>

        <nav class="top-nav relative z-50 hidden md:block">
            <ul class="flex flex-wrap pb-3 xl:px-[50px] xl:pb-0">
                <template v-for="(menu, menuKey) in formattedMenu" :key="`rubick_top__menu__${menu.title}__${menuKey}`">
                    <li
                        v-if="menu !== 'divider'"
                        class="relative [&:hover>a>div:nth-child(2)>svg]:-rotate-90 [&:hover>ul]:block"
                        :class="
                            !menu.active &&
                            '[&:hover>a]:bg-primary/60 [&:hover>a]:before:absolute [&:hover>a]:before:inset-0 [&:hover>a]:before:z-[-1] [&:hover>a]:before:block [&:hover>a]:before:rounded-full [&:hover>a]:before:bg-white/[0.04] [&:hover>a]:before:content-[\'\'] [&:hover>a]:dark:bg-transparent [&:hover>a]:before:dark:bg-darkmode-700 [&:hover>a]:xl:before:rounded-xl'
                        "
                    >
                        <top-menu-link
                            :class="!menu.active ? `animate-delay-${(menuKey + 1) * 10}` : ''"
                            :menu="menu"
                            level="first"
                        ></top-menu-link>

                        <ul v-if="menu.subMenu" :class="{ 'top-menu__sub-open': menu.subMenu && menu.activeDropdown }">
                            <li
                                v-for="(subMenu, subMenuKey) in menu.subMenu"
                                :key="`rubick_top__menu__${subMenu.title}__${subMenuKey}`"
                                class="relative px-5 ltr:[&:hover>a>div:nth-child(2)>svg]:-rotate-90 rtl:[&:hover>a>div:nth-child(2)>svg]:rotate-90 [&:hover>ul]:block"
                            >
                                <top-menu-link :menu="subMenu" level="second"></top-menu-link>

                                <ul :class="{ 'top-menu__sub-open': menu.subMenu && menu.activeDropdown }">
                                    <li
                                        v-for="(lastSubMenu, lastSubMenuKey) in subMenu.subMenu"
                                        :key="`rubick_top__menu__${lastSubMenu.title}__${lastSubMenuKey}`"
                                        class="relative px-5 [&:hover>a>div:nth-child(2)>svg]:-rotate-90 [&:hover>ul]:block"
                                    >
                                        <top-menu-link :menu="lastSubMenu" level="third"></top-menu-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </template>
            </ul>
        </nav>

        <div
            class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] dark:bg-darkmode-700 md:px-[22px]"
        >
            <slot></slot>
        </div>
    </div>
</template>
<style lang="postcss" scoped>
@import '/resources/css/themes/rubick/top-nav.css';
</style>
