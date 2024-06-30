<script lang="ts" setup>
import { TransitionRoot } from '@headlessui/vue'
import type { Hit } from 'meilisearch'
import { twMerge } from 'tailwind-merge'
import { onMounted, onUnmounted, ref, watch } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheResults from '@/Components/top-bar/search/TheResults.vue'
import TheSearchResults from '@/Components/top-bar/search/TheSearchResults.vue'

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

const resultsRefs = ref([])

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

const onTermKeydown = (event: KeyboardEvent) => {
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

    ;(resultsRefs.value[selectedIndex.value] as HTMLElement)?.scrollIntoView(false)
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
            @keydown="onTermKeydown"
            @keydown.esc.prevent="closeSearch"
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
            <div class="absolute end-0 z-10 mt-[3px]">
                <div class="w-[450px] px-5 pt-5 box scroll-smooth overflow-y-auto max-h-[calc(100vh-10rem)]">
                    <the-results
                        :results-refs="resultsRefs"
                        :results="results"
                        :selected-index="selectedIndex"
                    ></the-results>
                </div>
            </div>
        </transition-root>
    </div>
</template>
