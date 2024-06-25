<script lang="ts" setup>
import { ComboboxOption, ComboboxOptions } from '@headlessui/vue'
import { router } from '@inertiajs/vue3'
import type { Hit } from 'meilisearch'
import { twMerge } from 'tailwind-merge'
import { computed, ref, watch } from 'vue'

import SvgLoader from '@/Components/SvgLoader.vue'

import { getResultsSize, isEmpty } from '@/utils/helper'
import { search } from '@/utils/search'
import { useComputedAttrs } from '@/utils/useComputedAttrs'

defineOptions({
    inheritAttrs: false
})

const { query = '', activeIndex = -1 } = defineProps<{
    query: string
    activeIndex: number | null
}>()

const results = ref<Hit[]>([])

watch(
    () => activeIndex,
    () => {
        const optionsRef = document.getElementById('optionsRef') as HTMLDivElement

        if (activeIndex === 0) optionsRef.scroll(0, 0)

        if (activeIndex === getResultsSize(results.value) - 1) optionsRef.scrollTop = optionsRef.scrollHeight
    }
)

watch(
    () => query,
    async (query: string) => {
        if (query != '') await search(query).then((res) => (results.value = res.map((r) => r.hits)))
    },
    { immediate: true }
)

const noResults = computed(() => results.value.every((a) => isEmpty(a)))

const attrs = useComputedAttrs()

const emit = defineEmits(['close'])

const goTo = (link: string) => {
    emit('close')

    setTimeout(() => {
        router.get(link)
    }, 100)
}
</script>

<template>
    <combobox-options
        v-if="!noResults"
        id="optionsRef"
        :class="twMerge(['box max-h-96 overflow-y-auto px-5 pt-5', typeof attrs.class === 'string' && attrs.class])"
        as="div"
        v-bind="attrs.attrs"
    >
        <div v-for="(result, key, index) in results" :key="`${key}_${index}`">
            <div :class="{ 'mb-0': Object.keys(results).length - 1 === index }" class="mb-5" v-if="result[0]?.index">
                <div class="mb-2 font-medium ltr:capitalize">
                    <!-- TODO: change breadcrumb -->
                    {{ $t(`breadcrumb.${result[0]?.index}`) }}
                </div>

                <combobox-option
                    v-for="(info, i_index) in result"
                    :key="`${info.title}_${i_index}`"
                    v-slot="{ active }"
                    as="div"
                >
                    <div :class="{ '-ms-1 rounded-md bg-slate-200 ps-1 dark:bg-darkmode-300': active }">
                        <a
                            class="-my-2 mt-2.5 flex items-center py-1 pe-1"
                            @click.prevent="goTo(info.link)"
                            href="javascript:void(0)"
                        >
                            <div
                                :class="info.icon.color"
                                v-if="info.icon"
                                class="flex h-8 w-8 items-center justify-center rounded-full"
                            >
                                <svg-loader class="w-h h-4" :name="info.icon.icon"></svg-loader>
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
        </div>
    </combobox-options>
    <template v-else>
        <slot name="notFound"></slot>
    </template>
</template>
