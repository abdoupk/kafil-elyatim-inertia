<script setup lang="ts">
import BaseTippy from '@/Components/Base/tippy/BaseTippy.vue'
import type { SVGType } from '@/types/types'
import SvgLoader from '@/Components/SvgLoader.vue'
import { twMerge } from 'tailwind-merge'

interface Props {
    icon: SVGType
    iconColor: 'primary' | 'warning' | 'success' | 'pending'
    stat: number
    title: string
    tippyContent?: string
    percentage?: number | null
    status?: 'up' | 'down'
}

const { icon = 'icon-x', status = 'up', iconColor = 'primary', tippyContent = '' } = defineProps<Props>()
</script>

<template>
    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
        <div
            :class="[
                'zoom-in relative',
                'before:absolute before:inset-x-0 before:mx-auto before:mt-2.5 before:h-full before:w-[90%] before:rounded-md before:bg-white/60 before:shadow-[0px_3px_5px_#0000000b] before:content-[\'\'] before:dark:bg-darkmode-400/70'
            ]"
        >
            <div class="box p-5">
                <div class="flex">
                    <svg-loader
                        :name="icon"
                        class="h-[28px] w-[28px]"
                        :class="
                            twMerge([
                                iconColor === 'primary' && 'fill-primary',
                                iconColor === 'pending' && 'fill-pending',
                                iconColor === 'success' && 'fill-success',
                                iconColor === 'warning' && 'fill-warning'
                            ])
                        "
                    ></svg-loader>

                    <div class="ms-auto" v-if="percentage">
                        <base-tippy
                            as="div"
                            class="flex cursor-pointer items-center rounded-full py-[3px] pe-1 ps-2 text-xs font-medium text-white"
                            :class="status === 'up' ? 'bg-success' : 'bg-danger'"
                            :content="tippyContent"
                        >
                            {{ percentage }}%
                            <svg-loader
                                class="ms-0.5 h-4 w-4 rotate-180"
                                name="icon-chevron-down"
                                v-if="status === 'up'"
                            ></svg-loader>

                            <svg-loader class="ms-0.5 h-4 w-4" name="icon-chevron-down" v-else></svg-loader>
                        </base-tippy>
                    </div>
                </div>

                <div class="mt-6 text-3xl font-medium leading-8">{{ stat }}</div>

                <div class="mt-1 text-base text-slate-500">{{ title }}</div>
            </div>
        </div>
    </div>
</template>
