<script setup lang="ts">
import { ref, watch } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogDescription from '@/Components/Base/headless/Dialog/BaseDialogDescription.vue'
import BaseDialogFooter from '@/Components/Base/headless/Dialog/BaseDialogFooter.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import BaseDialogTitle from '@/Components/Base/headless/Dialog/BaseDialogTitle.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{ open: boolean; processing: boolean }>()

const emit = defineEmits(['close', 'filter'])

const filterButtonRef = ref()

const filters = ref([
    {
        field: 'file_number',
        operator: '>',
        value: '0'
    }
])

const addFilter = () => {
    filters.value.push({
        field: 'number_of_children',
        operator: '>',
        value: '0'
    })
}

const removeFilter = (index: number) => {
    if (filters.value.length === 1) {
        return
    }

    filters.value.splice(index, 1)
}

watch(
    () => props.processing,
    (value) => {
        if (!value) {
            setTimeout(() => {
                emit('close')
            }, 100)
        }
    }
)
</script>

<template>
    <base-dialog size="xl" :open @close="emit('close')" :initialFocus="filterButtonRef">
        <base-dialog-panel>
            <base-dialog-title>
                <h2 class="me-auto text-base font-medium">
                    {{ $t('filter') }}
                </h2>

                <a @click="emit('close')" class="absolute top-0 end-0 mt-3 me-3" href="#">
                    <svg-loader name="icon-x-mark" class="h-5 w-5 fill-current"></svg-loader>
                </a>
            </base-dialog-title>
            <form @submit.prevent="emit('filter', filters)">
                <base-dialog-description class="grid grid-cols-12 gap-4 gap-y-3 max-h-96 overflow-y-auto">
                    <template v-for="(filter, index) in filters" :key="index">
                        <div class="col-span-12 sm:col-span-4">
                            <base-form-select id="field" v-model="filter.field">
                                <option value="file_number">number of children</option>
                                <option value="number_of_sponsor">number of children</option>
                            </base-form-select>
                        </div>

                        <div class="col-span-12 sm:col-span-4">
                            <base-form-select id="type" v-model="filter.operator">
                                <option value="=">equal (=)</option>
                                <option value="!=">not equal (!=)</option>
                                <option value=">">greater than (>)</option>
                                <option value="<">less than ()</option>
                                <option value=">=">greater than or equal (>=)</option>
                                <option value="<=">less than or equal</option>
                                <option value="like">like</option>
                            </base-form-select>
                        </div>

                        <div class="col-span-12 sm:col-span-4">
                            <div class="flex">
                                <base-form-input
                                    v-model="filter.value"
                                    id="value"
                                    type="text"
                                    placeholder="value to filter"
                                ></base-form-input>

                                <base-button
                                    type="button"
                                    class="ms-2"
                                    :disabled="filters.length === 1"
                                    variant="outline-secondary"
                                    @click="removeFilter(index)"
                                >
                                    <svg-loader name="icon-trash-can" class="h-4 w-4 fill-danger"></svg-loader>
                                </base-button>
                            </div>
                        </div>

                        <hr
                            :class="{ hidden: index === filters.length - 1 }"
                            class="col-span-12 border-dashed border-1 sm:hidden"
                            v-if="filters.length > 1"
                        />
                    </template>

                    <div class="col-span-12">
                        <base-button
                            type="button"
                            variant="outline-secondary"
                            @click="addFilter"
                            class="max-w-20 me-auto"
                        >
                            <svg-loader name="icon-filter-list" class="h-5 w-5 fill-current"></svg-loader>
                        </base-button>
                    </div>
                </base-dialog-description>

                <base-dialog-footer class="flex justify-end">
                    <base-button type="button" variant="outline-secondary" @click="emit('close')" class="w-20 me-1">
                        Cancel
                    </base-button>

                    <base-button
                        variant="primary"
                        :disabled="processing"
                        type="submit"
                        class="w-20"
                        ref="{sendButtonRef}"
                    >
                        <spinner-button-loader :show="processing"></spinner-button-loader>

                        {{ $t('filter') }}
                    </base-button>
                </base-dialog-footer>
            </form>
        </base-dialog-panel>
    </base-dialog>
</template>
