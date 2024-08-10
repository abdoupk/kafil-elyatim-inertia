<script lang="ts" setup>
import { TransitionRoot } from '@headlessui/vue'
import { router } from '@inertiajs/vue3'
import type { Hit } from 'meilisearch'
import { twMerge } from 'tailwind-merge'
import { computed, onMounted, onUnmounted, ref, watch } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNoResultsFound from '@/Components/top-bar/search/TheNoResultsFound.vue'
import TheResults from '@/Components/top-bar/search/TheResults.vue'

import { isEmpty, jumpToNextItem, jumpToPreviousItem } from '@/utils/helper'
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

watch(
    () => query.value,
    async (query: string) => {
        if (query != '')
            await search(query)
                .then((res) => (results.value = res.map((r) => r.hits)))
                .finally(() => {
                    currentIndex.value.group = currentIndex.value.item = 0
                })
    },
    { immediate: true }
)

const goTo = () => {
    const item = results.value[currentIndex.value.group][currentIndex.value.item]

    if (item) {
        closeSearch()

        setTimeout(() => {
            router.visit(item.url, {
                method: 'get',
                preserveState: false
            })
        }, 100)
    }
}

const currentIndex = ref({
    group: 0,
    item: 0
})

const onTermKeydown = (event: KeyboardEvent) => {
    if (['ArrowUp', 'ArrowDown'].includes(event.code)) {
        event.preventDefault()
    }

    switch (event.code) {
        case 'ArrowDown':
            jumpToNextItem(results.value, currentIndex.value)

            break

        case 'ArrowUp':
            jumpToPreviousItem(results.value, currentIndex.value)

            break
    }

    ;

(
        resultsRefs.value[
            results.value[currentIndex.value.group]?.length * currentIndex.value.group + currentIndex.value.item
        ] as HTMLElement
    )?.scrollIntoView(false)
}

onMounted(() => {
    window.addEventListener('keydown', onKeydown)
})

onUnmounted(() => window.removeEventListener('keydown', onKeydown))

const noResults = computed(() => results.value.every((a) => isEmpty(a)))
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
            @keydown.enter.prevent="goTo"
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
                <div class="box scrollbar-hidden max-h-[500px] w-[450px] overflow-y-auto scroll-smooth px-5 pt-5">
                    <the-no-results-found v-if="noResults"></the-no-results-found>

                    <!-- @vue-expect-error Results Types -->
                    <the-results
                        v-else
                        :currentIndex
                        :results
                        :results-refs="resultsRefs"
                        @hover="currentIndex = $event"
                    ></the-results>
                </div>
            </div>
        </transition-root>
    </div>
</template>
