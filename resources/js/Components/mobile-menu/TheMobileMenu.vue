<script lang="ts" setup>
import type { IFormattedMenu, ILocation } from '@/types/types'
import { Link, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref, watch } from 'vue'
import { enter, leave, linkTo, nestedMenu } from '@/Layouts/menu'
import SimpleBar from 'simplebar'
import SvgLoader from '@/Components/SvgLoader.vue'
import { toRaw } from '@/utils/helper'
import { twMerge } from 'tailwind-merge'
import { useMenuStore } from '@/stores/menu'

const activeMobileMenu = ref(false)

const _route: ILocation = { routeName: '' }

const formattedMenu = ref<Array<IFormattedMenu | 'divider'>>([])

const menuStore = useMenuStore()

const mobileMenu = computed(() => nestedMenu(menuStore.menu as Array<IFormattedMenu | 'divider'>, _route))

watch(
    computed(() => usePage().url),
    () => {
        formattedMenu.value = toRaw(mobileMenu.value)
    }
)

const handleClickMenu = (menu: IFormattedMenu, event: Event) => {
    event.preventDefault()

    linkTo(menu, event)

    if (!menu.subMenu && menu.url !== usePage().url) {
        setTimeout(() => {
            activeMobileMenu.value = false
        }, 150)
    }
}

const scrollableRef = ref<HTMLDivElement>()

onMounted(() => {
    if (scrollableRef.value) {
        new SimpleBar(scrollableRef.value)
    }

    formattedMenu.value = toRaw(mobileMenu.value)
})

const setActiveMobileMenu = (value: boolean) => {
    activeMobileMenu.value = value
}
</script>

<template>
    <div
        :class="[
            'mobile-menu group fixed inset-x-0 top-0 z-[60] border-b border-white/[0.08] bg-theme-1/90 dark:bg-darkmode-800/90 md:hidden',
            'before:fixed before:inset-x-0 before:z-10 before:h-screen before:w-full before:bg-black/90 before:transition-opacity before:duration-200 before:ease-in-out before:content-[\'\']',
            !activeMobileMenu && 'before:invisible before:opacity-0',
            activeMobileMenu && 'before:visible before:opacity-100'
        ]"
    >
        <div class="flex h-[70px] items-center px-3 sm:px-8">
            <Link class="me-auto flex" href="/">
                <img alt="Tinker Starter" class="w-6" src="/images/logo.svg" />
            </Link>
            <a href="#" @click="(e) => e.preventDefault()">
                <svg-loader
                    @click="
                        () => {
                            setActiveMobileMenu(!activeMobileMenu)
                        }
                    "
                    class="h-6 w-6 transform text-white ltr:-rotate-180"
                    name="icon-bars-staggered"
                ></svg-loader>
            </a>
        </div>
        <div
            ref="scrollableRef"
            :class="
                twMerge([
                    'start-0 top-0 z-20 -ms-[100%] h-screen w-[270px] bg-primary transition-all duration-300 ease-in-out dark:bg-darkmode-800',
                    '[&[data-simplebar]]:fixed [&_.simplebar-scrollbar]:before:bg-black/50',
                    activeMobileMenu && 'menu--active  ms-0'
                ])
            "
        >
            <a
                href="#"
                @click="(e) => e.preventDefault()"
                :class="[
                    'fixed end-0 top-0 me-4 mt-4 transition-opacity duration-200 ease-in-out',
                    !activeMobileMenu && 'invisible opacity-0',
                    activeMobileMenu && 'visible opacity-100'
                ]"
            >
                <svg-loader
                    class="h-8 w-8 transform text-white ltr:-rotate-90 rtl:rotate-90"
                    name="icon-circle-x-mark"
                    @click="setActiveMobileMenu(!activeMobileMenu)"
                ></svg-loader>
            </a>
            <ul class="py-2">
                <!-- BEGIN: First Child -->
                <template v-for="(menu, menuKey) in formattedMenu">
                    <li :key="`divider_${menuKey}`" v-if="menu == 'divider'" class="menu__divider my-6"></li>

                    <li v-else :key="`mobile_${menuKey}}`">
                        <a
                            class="menu flex h-[50px] items-center px-6 text-white"
                            :href="menu.subMenu ? '#' : menu.url"
                            @click="handleClickMenu(menu, $event)"
                            :class="
                                twMerge([menu.active && 'menu--active', $page.url === menu.url && 'cursor-not-allowed'])
                            "
                        >
                            <div class="menu__icon">
                                <!-- TODO: fix width and height  -->
                                <svg-loader :name="menu.icon"></svg-loader>
                            </div>
                            <div class="menu__title ms-3 flex w-full items-center">
                                {{ menu.title }}
                                <div
                                    v-if="menu.subMenu"
                                    :class="[
                                        'menu__sub-icon    ms-auto transition',
                                        menu.activeDropdown && 'rotate-180 transform'
                                    ]"
                                >
                                    <svg-loader name="icon-chevron-down"></svg-loader>
                                </div>
                            </div>
                        </a>
                        <Transition @enter="enter" @leave="leave">
                            <ul
                                v-if="menu.subMenu && menu.activeDropdown"
                                :class="{ 'menu__sub-open': menu.activeDropdown }"
                            >
                                <li v-for="(subMenu, subMenuKey) in menu.subMenu" :key="subMenuKey">
                                    <a
                                        class="menu flex h-[50px] items-center px-4 text-white"
                                        :href="subMenu.subMenu ? '#' : subMenu.url"
                                        @click="handleClickMenu(subMenu, $event)"
                                        :class="
                                            twMerge([
                                                subMenu.active && 'menu--active',
                                                $page.url === subMenu.url && 'cursor-not-allowed'
                                            ])
                                        "
                                    >
                                        <div class="menu__icon">
                                            <svg-loader :name="subMenu.icon"></svg-loader>
                                        </div>
                                        <div class="menu__title ms-3 flex w-full items-center">
                                            {{ subMenu.title }}
                                            <div
                                                v-if="subMenu.subMenu"
                                                :class="[
                                                    'menu__sub-icon ms-auto transition',
                                                    subMenu.activeDropdown && 'rotate-180 transform'
                                                ]"
                                            >
                                                <svg-loader name="icon-chevron-down"></svg-loader>
                                            </div>
                                        </div>
                                    </a>
                                    <Transition @enter="enter" @leave="leave">
                                        <ul
                                            v-if="subMenu.subMenu && subMenu.activeDropdown"
                                            :class="{ 'menu__sub-open': subMenu.activeDropdown }"
                                        >
                                            <li
                                                v-for="(lastSubMenu, lastSubMenuKey) in subMenu.subMenu"
                                                :key="lastSubMenuKey"
                                            >
                                                <a
                                                    class="menu flex h-[50px] items-center px-4 text-white"
                                                    :href="lastSubMenu.subMenu ? '#' : lastSubMenu.url"
                                                    @click="handleClickMenu(lastSubMenu, $event)"
                                                    :class="
                                                        twMerge([
                                                            lastSubMenu.active && 'menu--active',
                                                            $page.url === lastSubMenu.url && 'cursor-not-allowed'
                                                        ])
                                                    "
                                                >
                                                    <div class="menu__icon">
                                                        <svg-loader :name="lastSubMenu.icon"></svg-loader>
                                                    </div>
                                                    <div class="menu__title ms-3 flex w-full items-center">
                                                        {{ lastSubMenu.title }}
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </Transition>
                                </li>
                            </ul>
                        </Transition>
                    </li>
                </template>
                <!-- END: First Child -->
            </ul>
        </div>
    </div>
</template>
<style lang="postcss">
@import '/resources/css/components/mobile-menu.css';
@import '/resources/css/vendors/simplebar.css';
</style>
