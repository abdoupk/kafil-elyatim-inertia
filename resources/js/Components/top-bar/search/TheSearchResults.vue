<script lang="ts" setup>
import { ComboboxOption, ComboboxOptions } from '@headlessui/vue'
import { computed, watch } from 'vue'
import { groupArrayOfObject, size } from '@/utils/helper'
import SvgLoader from '@/Components/SvgLoader.vue'
import { twMerge } from 'tailwind-merge'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const { query = '', activeIndex = 0 } = defineProps<{ query: string; activeIndex: number | null }>()

const results = [
    {
        index: 'pages',
        icon: 'mail',
        title: 'mail settings'
    },
    {
        index: 'pages',
        icon: 'wallet',
        title: 'transactions report'
    },
    {
        index: 'pages',
        icon: 'users',
        title: 'users & permissions',
        hint: null
    },
    {
        index: 'users',
        image: '/images/fakers/profile-10.jpg',
        title: 'Robert de Nero',
        hint: 'robert@pk.com'
    },
    {
        index: 'users',
        image: '/images/fakers/profile-3.jpg',
        title: 'Robert de Nero',
        hint: 'robert@pk.com'
    },
    {
        index: 'users',
        image: '/images/fakers/profile-5.jpg',
        title: 'Robert de Nero',
        hint: 'robert@pk.com'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-1.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-9.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-7.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-7.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-7.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-7.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    },
    {
        index: 'products',
        image: '/images/fakers/profile-7.jpg',
        title: 'Nike Shoes',
        hint: 'Sport & outdoor'
    }
]

watch(
    () => activeIndex,
    () => {
        const optionsRef = document.getElementById('optionsRef') as HTMLDivElement

        if (activeIndex === 0) optionsRef.scroll(0, 0)

        if (activeIndex === size(results) - 1) optionsRef.scrollTop = optionsRef.scrollHeight
    }
)

const groupedResults = computed(() =>
    query === '' ? groupArrayOfObject(results, 'index') : groupArrayOfObject(results, 'index')
)

const attrs = useComputedAttrs()
</script>

<template>
    <combobox-options
        id="optionsRef"
        :class="twMerge(['box max-h-96 overflow-y-auto px-5 pt-5', typeof attrs.class === 'string' && attrs.class])"
        as="div"
        v-bind="attrs.attrs"
    >
        <div
            v-for="(result, key, index) in groupedResults"
            :key="`${key}_${index}`"
            :class="{ 'mb-0': Object.keys(groupedResults).length - 1 === index }"
            class="mb-5"
        >
            <div class="mb-2 font-medium ltr:capitalize">{{ result[0].index }}</div>

            <combobox-option
                v-for="(info, i_index) in result"
                :key="`${info.title}_${i_index}`"
                v-slot="{ active }"
                as="div"
            >
                <div :class="{ '-ms-1 rounded-md bg-slate-200 ps-1 dark:bg-darkmode-300': active }">
                    <a class="-my-2 mt-2.5 flex items-center py-1 pe-1" href="">
                        <div
                            v-if="info.icon"
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-success/20 text-success dark:bg-success/10"
                        >
                            <svg-loader class="w-h h-4" name="icon-sort"></svg-loader>
                        </div>
                        <div v-else class="image-fit h-8 w-8">
                            <img :alt="info.title" :src="info.image" class="rounded-full" />
                        </div>
                        <div class="ms-3 ltr:capitalize">{{ info.title }}</div>
                        <div v-if="info.hint" class="ms-auto w-48 truncate text-end text-xs text-slate-500">
                            {{ info.hint }}
                        </div>
                    </a>
                </div>
            </combobox-option>
        </div>
    </combobox-options>
    <template v-if="query && Object.keys(groupedResults).length === 0">
        <slot name="notFound"></slot>
    </template>
</template>
