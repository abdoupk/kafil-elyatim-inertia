<script lang="ts" setup>
import type { FilterValueType, ListBoxFilter, ListBoxOperator, PopOverPlacementType } from '@/types/types'

import { ref } from 'vue'

import FilterRule from '@/Pages/Shared/filters/FilterRule.vue'
import FilterValue from '@/Pages/Shared/filters/FilterValue.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BasePopover from '@/Components/Base/headless/Popover/BasePopover.vue'
import BasePopoverButton from '@/Components/Base/headless/Popover/BasePopoverButton.vue'
import BasePopoverPanel from '@/Components/Base/headless/Popover/BasePopoverPanel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { __ } from '@/utils/i18n'

const { placement = 'bottom-start' } = defineProps<{
    filters: ListBoxFilter[]
    placement?: PopOverPlacementType
}>()

const emit = defineEmits(['update:value'])

const field = ref<ListBoxFilter>()

const operator = ref<ListBoxOperator>()

const value = ref<FilterValueType>('')

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

const handleOperatorChange = (index: number) => {
    filterRules.value[index].value = ''
}

const handleFieldChange = (index: number) => {
    if (filterRules.value[index].field?.operators[0])
        filterRules.value[index].operator = filterRules.value[index]?.field?.operators[0]

    if (filterRules.value[index].field?.type === 'string') {
        filterRules.value[index].value = ''
    }

    if (filterRules.value[index].field?.type === 'object') {
        if (
            filterRules.value[index].field?.label === 'family_sponsorships' ||
            filterRules.value[index].field?.label === 'sponsor_sponsorships' ||
            filterRules.value[index].field?.label === 'orphan_sponsorships' ||
            filterRules.value[index].field?.label === 'gender' ||
            filterRules.value[index].field?.label === 'sponsor_type'
        ) {
            filterRules.value[index].value = {
                value: '',
                label: __('filters.select_an_option')
            }
        } else
            filterRules.value[index].value = {
                id: '',
                name: __('filters.select_an_option')
            }
    }

    emit('update:value', filterRules.value)
}
</script>

<template>
    <div>
        <base-popover class="inline-block">
            <base-popover-button :as="BaseButton" variant="outline-secondary">
                <svg-loader class="fill-primary" name="icon-filters"></svg-loader>
            </base-popover-button>

            <base-popover-panel :placement>
                <div class="w-[400px] md:w-[505px] lg:w-[580px] px-2 pt-2">
                    <div class="grid grid-cols-12 gap-4">
                        <filter-rule
                            v-for="(rule, index) in filterRules"
                            :key="index"
                            v-model:field="filterRules[index].field"
                            v-model:operator="filterRules[index].operator"
                            :filters
                            @update:field-value="handleFieldChange(index)"
                            @update:operator-value="handleOperatorChange(index)"
                        >
                            <template #default>
                                <filter-value
                                    v-model:value="rule.value"
                                    :field="rule.field"
                                    @update:value="handleChange($event, index)"
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
