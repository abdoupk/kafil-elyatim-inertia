<script lang="ts" setup>
import type { ListBoxFilter, ListBoxOperator } from '@/types/types'

import { ref } from 'vue'

import FilterRule from '@/Pages/Shared/filters/FilterRule.vue'
import FilterValue from '@/Pages/Shared/filters/FilterValue.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BasePopover from '@/Components/Base/headless/Popover/BasePopover.vue'
import BasePopoverButton from '@/Components/Base/headless/Popover/BasePopoverButton.vue'
import BasePopoverPanel from '@/Components/Base/headless/Popover/BasePopoverPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{ filters: ListBoxFilter[] }>()

const emit = defineEmits(['update:value'])

const field = ref<ListBoxFilter>()

const operator = ref<ListBoxOperator>()

const value = ref('')

const filterRules = ref([
    {
        field: field.value,
        operator: operator.value,
        value: value.value
    }
])

const removeFilterRule = () => {
    if (filterRules.value.length > 1) {
        filterRules.value.pop()
    }

    emit('update:value', filterRules.value)
}

const addFilterRule = () => {
    filterRules.value.push({
        field: field.value,
        operator: operator.value,
        value: ''
    })
}

const handleChange = (value: string, index: number) => {
    filterRules.value[index].value = value

    emit('update:value', filterRules.value)
}

const handleOperatorChange = (operator: ListBoxOperator, index: number) => {
    if (operator) {
        filterRules.value[index].operator = operator

        emit('update:value', filterRules.value)
    }
}
</script>

<template>
    <div>
        <base-popover class="inline-block">
            <base-popover-button :as="BaseButton" variant="outline-secondary">
                <svg-loader class="fill-primary" name="icon-filters"></svg-loader>
            </base-popover-button>

            <base-popover-panel placement="bottom-start">
                <div class="w-[400px] md:w-[505px] lg:w-[580px] px-2 pt-2">
                    <div class="grid grid-cols-12 gap-4">
                        <filter-rule
                            v-for="(rule, index) in filterRules"
                            :key="index"
                            v-model:field="rule.field"
                            v-model:operator="rule.operator"
                            :filters
                        >
                            <template #default>
                                <filter-value
                                    v-model:value="rule.value"
                                    @update:value="handleChange($event, index)"
                                    :field="rule.field?.field"
                                ></filter-value>
                            </template>
                        </filter-rule>
                    </div>

                    <a
                        class="mt-2 -ms-1 p-1 rounded-md flex dark:hover:bg-darkmode-400 hover:bg-slate-200/60"
                        href="#"
                        @click.prevent="addFilterRule"
                    >
                        <svg-loader class="w-4 h-4 fill-slate-500 dark:fill-slate-400" name="icon-plus"></svg-loader>

                        <span class="ms-0.5 font-medium dark:text-slate-400 text-slate-500">
                            {{ $t('add_filter') }}
                        </span>
                    </a>
                </div>

                <div class="mt-2 -mx-2 border-t border-slate-200">
                    <a
                        class="mt-2 mx-2 p-1 group rounded-md flex dark:hover:bg-darkmode-400 hover:bg-slate-200/60"
                        href="#"
                        @click.prevent="removeFilterRule"
                    >
                        <svg-loader
                            class="w-4 h-4 fill-slate-500 dark:fill-slate-300 group-hover:fill-red-500 ms-1"
                            name="icon-trash-can"
                        ></svg-loader>

                        <span class="ms-1 font-medium dark:text-slate-300 text-slate-500 group-hover:text-red-500">{{
                            $t('delete_filter')
                        }}</span>
                    </a>
                </div>
            </base-popover-panel>
        </base-popover>
    </div>
</template>
