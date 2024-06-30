<script lang="ts" setup>
import { TransitionRoot } from '@headlessui/vue'
import type { Hit } from 'meilisearch'
import { twMerge } from 'tailwind-merge'
import { onMounted, onUnmounted, ref, watch } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { getResultsSize } from '@/utils/helper'
import { search } from '@/utils/search'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const query = ref('')

const searchDropdown = ref(false)

const attrs = useComputedAttrs()

const closeSearch = () => {
    setTimeout(() => {
        document.getElementById('search_dropdown')?.blur()
    }, 100)

    query.value = ''
}

function onKeydown(event: KeyboardEvent) {
    const searchInput = document.getElementById('search_dropdown') as HTMLInputElement

    if (event.key == 'k' && (event.metaKey || event.ctrlKey)) {
        event.preventDefault()

        if (searchDropdown.value) {
            searchInput?.blur()

            query.value = ''
        } else {
            searchInput?.focus()
        }
    }
}

const results = ref<Hit[]>([])

const resultsRefs = ref<HTMLElement[]>([])

const selectedIndex = ref(0)
watch(
    () => query.value,
    async (query: string) => {
        if (query != '') await search(query).then((res) => (results.value = res.map((r) => r.hits)))
    },
    { immediate: true }
)

const goTo = (step: string) => {
    console.log(step)
    if (results.value[selectedIndex.value]) {
        window.location = results.value[selectedIndex.value].url
    }
}
const onTermKeydown = (event) => {
    console.log(event.code)
    if (['ArrowUp', 'ArrowDown'].includes(event.code)) {
        event.preventDefault()
    }
    console.log(selectedIndex.value)
    switch (event.code) {
        case 'ArrowDown':
            if (selectedIndex.value === getResultsSize(results.value) - 1) {
                selectedIndex.value = 0
            } else {
                selectedIndex.value += 1
            }
            break
        case 'ArrowUp':
            if (selectedIndex.value === 0) {
                selectedIndex.value = getResultsSize(results.value) - 1
            } else {
                selectedIndex.value -= 1
            }
            break
    }

    console.log(getResultsSize(results.value))
    console.log(selectedIndex.value, '0000')

    resultsRefs.value[selectedIndex.value]?.scrollIntoView(false)
}

onMounted(() => {
    window.addEventListener('keydown', onKeydown)
})
onUnmounted(() => window.removeEventListener('keydown', onKeydown))
</script>

<template>
    <div class="relative hidden sm:block">
        <base-form-input
            id="search_dropdown"
            v-model="query"
            :class="
                twMerge(
                    'w-56 rounded-full border-transparent bg-slate-200 pe-8 shadow-none transition-[width] duration-300 ease-in-out focus:w-72 focus:border-transparent dark:bg-darkmode-400',
                    typeof attrs.class === 'string' && attrs.class
                )
            "
            :placeholder="$t('Search...')"
            type="text"
            v-bind="attrs.attrs"
            @blur="searchDropdown = false"
            @focus="searchDropdown = true"
            @input="query = ($event.target as HTMLInputElement).value"
            @keydown.esc.prevent="closeSearch"
            @keydown="onTermKeydown"
        ></base-form-input>
        <svg-loader
            class="absolute inset-y-0 end-0 my-auto me-3 h-5 w-5 text-slate-600 dark:text-slate-500 rtl:rotate-90"
            name="icon-search"
        ></svg-loader>
        <transition-root
            :show="query.length > 0 && searchDropdown"
            as="template"
            enter="transition-all ease-linear duration-150"
            enter-from="mt-5 invisible opacity-0 translate-y-1"
            enter-to="mt-[3px] visible opacity-100 translate-y-0"
            entered="mt-[3px]"
            leave="transition-all ease-linear duration-150"
            leave-from="mt-[3px] visible opacity-100 translate-y-0"
            leave-to="mt-5 invisible opacity-0 translate-y-1"
        >
            <div class="absolute end-0 z-10 mt-[3px] box max-h-96 overflow-y-auto px-5 pt-5">
                <div v-for="(result, key, index) in results" :key="`${key}_${index}`">
                    <div
                        v-if="result[0]?.index"
                        :class="{ 'mb-0': Object.keys(results).length - 1 === index }"
                        class="mb-5"
                    >
                        <div class="mb-2 font-medium ltr:capitalize">
                            <!-- TODO: change breadcrumb -->
                            {{ $t(`breadcrumb.${result[0]?.index}`) }}
                        </div>

                        <div
                            v-for="(info, i_index) in result"
                            :key="`${info.title}_${i_index}`"
                            :ref="
                                (el) => {
                                    resultsRefs[key * result.length + i_index] = el
                                }
                            "
                            :class="{
                                '-ms-1 rounded-md bg-slate-200 ps-1 dark:bg-darkmode-300':
                                    selectedIndex === key * result.length + i_index
                            }"
                            @mousemove="selectedIndex = key * result.length + i_index"
                        >
                            <a
                                class="-my-2 mt-2.5 flex items-center py-1 pe-1"
                                href="javascript:void(0)"
                                @click.prevent="goTo(info.link)"
                            >
                                <div
                                    v-if="info.icon"
                                    :class="info.icon.color"
                                    class="flex h-8 w-8 items-center justify-center rounded-full"
                                >
                                    <svg-loader :name="info.icon.icon" class="w-h h-4"></svg-loader>
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
                    </div>
                </div>
            </div>
        </transition-root>
    </div>
</template>
