<script lang="ts" setup>
import { ComboboxInput, Combobox as HeadlessCombobox, TransitionRoot } from '@headlessui/vue'
import { twMerge } from 'tailwind-merge'
import { onMounted, onUnmounted, ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNoResultsFound from '@/Components/top-bar/search/TheNoResultsFound.vue'
import TheSearchResults from '@/Components/top-bar/search/TheSearchResults.vue'

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

onMounted(() => {
    window.addEventListener('keydown', onKeydown)
})

onUnmounted(() => {
    window.removeEventListener('keydown', onKeydown)
})
</script>

<template>
    <headless-combobox v-slot="{ activeIndex }" as="div" class="relative hidden sm:block">
        <combobox-input
            v-model="query"
            id="search_dropdown"
            :as="BaseFormInput"
            :class="
                twMerge(
                    'w-56 rounded-full border-transparent bg-slate-200 pe-8 shadow-none transition-[width] duration-300 ease-in-out focus:w-72 focus:border-transparent dark:bg-darkmode-400',
                    typeof attrs.class === 'string' && attrs.class
                )
            "
            :placeholder="$t('Search...')"
            type="text"
            v-bind="attrs.attrs"
            @change="query = $event.target.value"
            @focus="searchDropdown = true"
            @keydown.esc.prevent="closeSearch"
        ></combobox-input>
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
                <the-search-results @close="closeSearch" :activeIndex :query class="max-h-[500px] w-[450px]">
                    <template #notFound>
                        <the-no-results-found class="box w-[450px] text-center"></the-no-results-found>
                    </template>
                </the-search-results>
            </div>
        </transition-root>
    </headless-combobox>
</template>
