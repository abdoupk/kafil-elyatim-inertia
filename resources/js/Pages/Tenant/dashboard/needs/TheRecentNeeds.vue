<script lang="ts" setup>
import type { RecentNeedsType } from '@/types/dashboard'

import 'swiper/css'
import { Autoplay, Navigation } from 'swiper/modules'
import { Swiper, SwiperSlide } from 'swiper/vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'

defineProps<{
    recentNeeds: RecentNeedsType
}>()
</script>

<template>
    <div
        class="col-span-12 mt-3 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto"
    >
        <div class="intro-x flex h-10 items-center">
            <h2 class="me-auto truncate text-lg font-medium">Important Notes</h2>
            <base-button class="swiper-button-prev me-2 border-slate-300 px-2 text-slate-600 dark:text-slate-300">
                CL
            </base-button>
            <base-button class="swiper-button-next me-2 border-slate-300 px-2 text-slate-600 dark:text-slate-300">
                CR
            </base-button>
        </div>
        <div class="intro-x mt-5">
            <div class="box zoom-in">
                <Swiper
                    :autoplay="{
                        delay: 3000
                    }"
                    :loop="true"
                    :modules="[Navigation, Autoplay]"
                    :navigation="{
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }"
                    :slides-per-view="1"
                    :speed="1000"
                >
                    <SwiperSlide v-for="need in recentNeeds" :key="need.id" class="p-5">
                        <div class="truncate text-base font-medium">{{ need.subject }}</div>
                        <div class="mt-1 text-slate-400">{{ need.date }}</div>
                        <div class="mt-1 text-justify text-slate-500">
                            {{ need.demand }}
                        </div>
                    </SwiperSlide>
                </Swiper>
            </div>
        </div>
    </div>
</template>
