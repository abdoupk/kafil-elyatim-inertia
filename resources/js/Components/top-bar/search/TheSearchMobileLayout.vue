<script lang="ts" setup>
import { ComboboxInput, Combobox as HeadlessCombobox, Dialog as HeadlessDialog, TransitionRoot } from '@headlessui/vue'
import { onUnmounted, ref } from 'vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import SvgLoader from '@/Components/SvgLoader.vue'
import TheNoResultsFound from '@/Components/top-bar/search/TheNoResultsFound.vue'
import TheSearchResults from '@/Components/top-bar/search/TheSearchResults.vue'
import { computedEager } from '@vueuse/core'
import { onMounted } from 'vue'
import { useSettingsStore } from '@/stores/settings'

const query = ref('')

const open = ref(false)

const settingStore = useSettingsStore()

const computedTheme = computedEager(() => {
    if (settingStore.layout === 'top-menu') {
        return true
    }

    return ['enigma', 'icewall'].includes(settingStore.theme)
})

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
            class="h-5 w-5 dark:fill-slate-500"
            name="icon-search"
            :class="{ 'fill-white/70': computedTheme }"
        ></svg-loader>
    </a>
    <transition-root :show="open" appear as="div" @after-enter="() => (query = '')">
        <headless-dialog class="relative z-[60]" @close="open = false">
            <base-dialog-panel class="rounded-xl" size="md">
                <headless-combobox
                    v-slot="{ activeIndex }"
                    as="div"
                    class="divide-y divide-gray-100 overflow-hidden rounded-xl dark:divide-darkmode-400"
                >
                    <div class="flex items-center px-4">
                        <svg-loader class="h-6 w-6 text-slate-500" name="icon-search"></svg-loader>
                        <combobox-input
                            v-model="query"
                            :as="BaseFormInput"
                            class="h-12 border-transparent bg-transparent shadow-none ring-0 ring-black/5 focus:border-transparent focus:ring-0 dark:bg-transparent"
                            placeholder="Search..."
                            @change="query = $event.target.value"
                            @keydown.esc="open = false"
                        ></combobox-input>
                    </div>

                    <the-search-results :query="query" :active-index="activeIndex">
                        <template #notFound>
                            <the-no-results-found></the-no-results-found>
                        </template>
                    </the-search-results>
                </headless-combobox>
            </base-dialog-panel>
        </headless-dialog>
    </transition-root>
</template>
