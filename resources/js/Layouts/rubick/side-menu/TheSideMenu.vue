<script lang="ts" setup>
import type { IFormattedMenu, ILocation } from '@/types/types'
import { Link, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref, watch } from 'vue'
import { enter, leave, nestedMenu } from '@/Layouts/menu'
import MenuDivider from '@/Layouts/rubick/side-menu/MenuDivider.vue'
import SideMenuLink from '@/Layouts/rubick/side-menu/SideMenuLink.vue'
import TheMobileMenu from '@/Components/mobile-menu/TheMobileMenu.vue'
import TheTopBar from '@/Layouts/rubick/TheTopBar.vue'
import { toRaw } from '@/utils/helper'
import { useMenuStore } from '@/stores/menu'

const formattedMenu = ref<Array<IFormattedMenu | 'divider'>>([])

const menuStore = useMenuStore()

const _route = { routeName: '' } as ILocation

const sideMenu = computed(() => nestedMenu(menuStore.menu as Array<IFormattedMenu | 'divider'>, _route))

watch(
    computed(() => usePage().url),
    () => {
        delete _route.forceActiveMenu

        formattedMenu.value = toRaw(sideMenu.value)
    }
)

onMounted(() => {
    formattedMenu.value = toRaw(sideMenu.value)
})
</script>

<template>
    <div
        class="rubick px-5 py-5 before:fixed before:inset-0 before:z-[-1] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:content-[''] dark:before:from-darkmode-800 dark:before:to-darkmode-800 sm:px-8"
    >
        <the-mobile-menu></the-mobile-menu>

        <div class="mt-[4.7rem] flex md:mt-0">
            <nav class="side-nav hidden w-[80px] overflow-x-hidden pb-16 pe-5 md:block xl:w-[230px]">
                <Link href="/" class="intro-x flex items-center ps-5 pt-4">
                    <img alt="Tinker Tailwind HTML Admin Template" class="w-6" src="/images/logo.svg" />
                    <span class="ms-3 hidden text-lg text-white xl:block"> Rubick </span>
                </Link>

                <menu-divider class="my-6"></menu-divider>

                <ul>
                    <template v-for="(menu, menuKey) in formattedMenu">
                        <li v-if="menu === 'divider'" :key="`rubick_side_menu_${menu}_${menuKey}`">
                            <menu-divider class="my-6"></menu-divider>
                        </li>

                        <li v-else :key="`rubick_side_menu__${menu.title + menuKey}`">
                            <side-menu-link
                                :class="!menu.active ? `animate-delay-${(menuKey + 1) * 10}` : ''"
                                :menu="menu"
                                level="first"
                            ></side-menu-link>

                            <transition @enter="enter" @leave="leave">
                                <ul
                                    v-if="menu.subMenu && menu.activeDropdown"
                                    :class="{ 'side-menu__sub-open': menu.subMenu && menu.activeDropdown }"
                                >
                                    <li
                                        v-for="(subMenu, subMenuKey) in menu.subMenu"
                                        :key="`rubick_side_menu__${subMenu.title}_${subMenuKey}`"
                                    >
                                        <side-menu-link
                                            :class="!subMenu.active ? `animate-delay-${(subMenuKey + 1) * 10}` : ''"
                                            :menu="subMenu"
                                            level="second"
                                        ></side-menu-link>

                                        <!-- BEGIN: Third Child -->
                                        <transition @enter="enter" @leave="leave">
                                            <ul
                                                v-if="subMenu.subMenu && subMenu.activeDropdown"
                                                :class="{
                                                    'side-menu__sub-open': subMenu.subMenu && subMenu.activeDropdown
                                                }"
                                            >
                                                <li
                                                    v-for="(lastSubMenu, lastSubMenuKey) in subMenu.subMenu"
                                                    :key="`rubick_side_menu_${lastSubMenu.title}_${lastSubMenuKey}`"
                                                >
                                                    <side-menu-link
                                                        :class="
                                                            !lastSubMenu.active
                                                                ? `animate-delay-${(lastSubMenuKey + 1) * 10}`
                                                                : ''
                                                        "
                                                        :menu="lastSubMenu"
                                                        level="third"
                                                    ></side-menu-link>
                                                </li>
                                            </ul>
                                        </transition>
                                    </li>
                                </ul>
                            </transition>
                        </li>
                    </template>
                </ul>
            </nav>

            <div
                class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] dark:bg-darkmode-700 md:px-[22px]"
            >
                <the-top-bar></the-top-bar>

                <slot></slot>
            </div>
        </div>
    </div>
</template>
<style lang="postcss" scoped>
@import '/resources/css/themes/rubick/side-nav.css';
</style>
