<script lang="ts" setup>
import { Link } from '@inertiajs/vue3'
import type { Hit } from 'meilisearch'
import { ref, watch } from 'vue'

import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{
    results: Record<string, Hit[]>
    resultsRefs: unknown[]
    currentIndex: {
        group: number
        item: number
    }
}>()

const _currentIndex = ref(props.currentIndex)

const _resultsRefs = ref(props.resultsRefs)

const emit = defineEmits(['hover'])

watch(
    () => props.currentIndex,
    (value) => {
        _currentIndex.value = value
    }
)
</script>

<template>
    <div v-for="(result, key, index) in results" :key="`${key}_${index}`">
        <div v-if="result[0]?.index" :class="{ 'mb-0': Object.keys(results).length - 1 === index }" class="mb-5">
            <div class="mb-2 font-medium ltr:capitalize">
                {{ $t(`breadcrumb.${result[0]?.index}`) }}
            </div>

            <div
                v-for="(info, i_index) in result"
                :key="`${info.title}_${i_index}`"
                :ref="
                    (el) => {
                        _resultsRefs[Number(key) * result.length + Number(i_index)] = el
                    }
                "
                :class="{
                    '-mx-1 rounded-md bg-slate-200 px-1 dark:bg-darkmode-300':
                        Number(key) === _currentIndex.group && i_index === _currentIndex.item
                }"
                class="mb-1 py-1"
                @mousemove="
                    () => {
                        _currentIndex = {
                            item: Number(i_index),
                            group: Number(key)
                        }

                        emit('hover', _currentIndex)
                    }
                "
            >
                <Link :href="info.url" class="flex items-center" preserve-state>
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
                </Link>
            </div>
        </div>
    </div>
</template>
