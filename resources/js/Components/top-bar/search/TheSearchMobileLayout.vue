<script lang="ts" setup>
/* eslint-disable vue/no-parsing-error */
import { useSettingsStore } from '@/stores/settings'
import { Dialog as HeadlessDialog, TransitionRoot } from '@headlessui/vue'
import { router } from '@inertiajs/vue3'
import { computedEager } from '@vueuse/core'
import type { Hit } from 'meilisearch'
import { twMerge } from 'tailwind-merge'
import { computed, onMounted, onUnmounted, ref, watch } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNoResultsFound from '@/Components/top-bar/search/TheNoResultsFound.vue'
import TheResults from '@/Components/top-bar/search/TheResults.vue'

import { isEmpty, jumpToNextItem, jumpToPreviousItem } from '@/utils/helper'
import { search } from '@/utils/search'

const query = ref('')

const open = ref(false)

const settingStore = useSettingsStore()

const computedTheme = computedEager(() => {
    if (settingStore.layout === 'top_menu') {
        return true
    }

    return ['enigma', 'icewall'].includes(settingStore.theme)
})

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
        // SearchDropdown.value = false

        setTimeout(() => {
            router.visit(item.url, {
                method: 'get',
                preserveState: true
            })
        }, 100)
    }
}

const currentIndex = ref({
    group: 0,
    item: 0
})

const noResults = computed(() => results.value.every((a) => isEmpty(a)))

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

    ;(
        resultsRefs.value[
            results.value[currentIndex.value.group]?.length * currentIndex.value.group + currentIndex.value.item
        ] as HTMLElement
    )?.scrollIntoView(false)
}

function onKeydown(event: KeyboardEvent) {
    if (event.key == 'k' && (event.metaKey || event.ctrlKey)) {
        event.preventDefault()

        open.value = !open.value
    }
}

onMounted(() => {
    window.addEventListener('keydown', onKeydown)
})

onUnmounted(() => {
    window.removeEventListener('keydown', onKeydown)
})
</script>

<template>
    <a class="relative text-slate-600 sm:hidden" role="button" @click="open = true">
        <svg-loader
            :class="{ 'fill-white/70': computedTheme }"
            class="h-5 w-5 dark:fill-slate-500"
            name="icon-search"
        ></svg-loader>
    </a>
    <transition-root :show="open" appear as="div" @after-enter="() => (query = '')">
        <headless-dialog class="relative z-[60]" @close="open = false">
            <base-dialog-panel class="rounded-xl" size="md">
                <div class="divide-y divide-gray-100 overflow-hidden rounded-xl dark:divide-darkmode-400">
                    <div class="flex items-center px-4">
                        <svg-loader class="h-6 w-6 text-slate-500" name="icon-search"></svg-loader>

                        <base-form-input
                            v-model="query"
                            :class="
                                twMerge(
                                    'h-12 border-transparent bg-transparent shadow-none ring-0 ring-black/5 focus:border-transparent focus:ring-0 dark:bg-transparent'
                                )
                            "
                            :placeholder="$t('Search...')"
                            type="text"
                            @input="query = ($event.target as HTMLInputElement).value"
                            @keydown="onTermKeydown"
                            @keydown.enter.prevent="goTo"
                            @keydown.esc.prevent="open = false"
                        ></base-form-input>
                    </div>
                    <div
                        :class="query.length > 0 ? 'pt-5' : ''"
                        class="box max-h-96 overflow-y-auto px-5 scrollbar-hidden"
                    >
                        <the-no-results-found v-if="noResults && query != ''"></the-no-results-found>

                        <the-results
                            v-if="query.length > 0 && !noResults"
                            :currentIndex
                            :results
                            :results-refs="resultsRefs"
                            @hover="currentIndex = $event"
                        ></the-results>
                    </div>
                </div>
            </base-dialog-panel>
        </headless-dialog>
    </transition-root>
</template>
