<script setup lang="ts">
import BaseTippy from '@/Components/Base/tippy/BaseTippy.vue'
import type { SVGType } from '@/types/types'
import SvgLoader from '@/Components/SvgLoader.vue'
import { __ } from '@/utils/i18n'
import { computed } from 'vue'
import { twMerge } from 'tailwind-merge'

interface Props {
    icon: SVGType
    iconColor: 'primary' | 'secondary' | 'success' | 'warning' | 'pending' | 'danger' | 'dark'
    stat: number
    title: string
    percentageDifference: number
}

const props = defineProps<Props>()

const tippyContent = computed(() => {
    return __('reportTooltip', {
        percentage: props?.percentageDifference?.toString(),
        range: props?.percentageDifference > 0 ? __('higher') : __('lower')
    })
})
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
                        class="h-[38px] w-[38px]"
                        :class="
                            twMerge([
                                iconColor === 'primary' && 'fill-primary dark:fill-current',
                                iconColor === 'secondary' && 'fill-secondary',
                                iconColor === 'success' && 'fill-success',
                                iconColor === 'warning' && 'fill-warning',
                                iconColor === 'pending' && 'fill-pending',
                                iconColor === 'danger' && 'fill-danger',
                                iconColor === 'dark' && 'fill-dark dark:fill-slate-400'
                            ])
                        "
                    ></svg-loader>

                    <div class="ms-auto" v-if="percentageDifference">
                        <base-tippy
                            as="div"
                            class="flex cursor-pointer items-center rounded-full py-[3px] pe-1 ps-2 text-xs font-medium text-white"
                            :class="percentageDifference > 0 ? 'bg-success' : 'bg-danger'"
                            :content="tippyContent"
                        >
                            {{ Math.abs(percentageDifference) }}%
                            <svg-loader
                                class="ms-0.5 h-4 w-4 rotate-180"
                                name="icon-chevron-down"
                                v-if="percentageDifference > 0"
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
