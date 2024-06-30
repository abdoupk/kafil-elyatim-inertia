<script lang="ts" setup>
import type { Hit } from 'meilisearch'
import { ref, watch } from 'vue'

import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{ results: Record<string, Hit[]>; selectedIndex: number; resultsRefs: any[] }>()

const _selectedIndex = ref(props.selectedIndex)
watch(
    () => props.selectedIndex,
    (value) => {
        _selectedIndex.value = value
    }
)
</script>

<template>
    <div v-for="(result, key, index) in results" :key="`${key}_${index}`">
        <div v-if="result[0]?.index" :class="{ 'mb-0': Object.keys(results).length - 1 === index }" class="mb-5">
            <div class="mb-2 font-medium ltr:capitalize">
                <!-- TODO: change breadcrumb -->
                {{ $t(`breadcrumb.${result[0]?.index}`) }}
            </div>

            <div
                v-for="(info, i_index) in result"
                :key="`${info.title}_${i_index}`"
                :ref="
                    (el) => {
                        resultsRefs[Number(key) * result.length + Number(i_index)] = el
                    }
                "
                :class="{
                    '-ms-1 rounded-md bg-slate-200 ps-1 dark:bg-darkmode-300':
                        _selectedIndex === Number(key) * result.length + Number(i_index)
                }"
                @mousemove="_selectedIndex = Number(key) * result.length + Number(i_index)"
            >
                <a class="-my-2 mt-2.5 flex items-center py-1 pe-1" href="javascript:void(0)">
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
</template>
