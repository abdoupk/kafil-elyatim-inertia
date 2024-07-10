<script lang="ts" setup>
import FilterRule from '@/Pages/Tenant/families/index/FilterRule.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BasePopover from '@/Components/Base/headless/Popover/BasePopover.vue'
import BasePopoverButton from '@/Components/Base/headless/Popover/BasePopoverButton.vue'
import BasePopoverPanel from '@/Components/Base/headless/Popover/BasePopoverPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
</script>

<template>
    <div>
        <base-popover class="inline-block">
            <base-popover-button :as="BaseButton" variant="outline-secondary">
                <svg-loader class="fill-primary" name="icon-filters"></svg-loader>
            </base-popover-button>

            <base-popover-panel placement="bottom-start">
                <div class="w-[400px] md:w-[505px] lg:w-[580px] px-2 pt-2">
                    <div class="grid grid-cols-12 gap-4">
                        <filter-rule></filter-rule>
                    </div>

                    <a class="mt-2 -ms-1 p-1 rounded-md flex dark:hover:bg-darkmode-400 hover:bg-slate-200/60" href="#">
                        <svg-loader class="w-4 h-4 fill-slate-500 dark:fill-slate-400" name="icon-plus"></svg-loader>

                        <span class="ms-0.5 font-medium dark:text-slate-400 text-slate-500">{{
                            $t('add_filter')
                        }}</span>
                    </a>
                </div>

                <div class="mt-2 -mx-2 border-t border-slate-200">
                    <a
                        class="mt-2 mx-2 p-1 group rounded-md flex dark:hover:bg-darkmode-400 hover:bg-slate-200/60"
                        href="#"
                    >
                        <svg-loader
                            class="w-4 h-4 fill-slate-500 dark:fill-slate-300 group-hover:fill-red-500 ms-1"
                            name="icon-trash-can"
                        ></svg-loader>

                        <span class="ms-1 font-medium dark:text-slate-300 text-slate-500 group-hover:text-red-500">{{
                            $t('delete_filter')
                        }}</span>
                    </a>
                </div>
            </base-popover-panel>
        </base-popover>
    </div>
</template>
