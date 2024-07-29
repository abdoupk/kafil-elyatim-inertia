<script lang="ts" setup>
import type { OrphanUpdateFormType } from '@/types/orphans'

import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'
import BaseTippy from '@/Components/Base/tippy/BaseTippy.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{
    orphan: OrphanUpdateFormType
}>()

const emit = defineEmits(['showDeleteModal', 'showEditModal'])
</script>

<template>
    <div v-if="orphan.vocational_training_achievements.length" class="flex-1 w-full mt-3 overflow-x-auto pb-2">
        <base-table class="border">
            <base-thead-table>
                <base-tr-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                        #
                    </base-th-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                        {{ $t('speciality') }}
                    </base-th-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                        <div class="flex items-center">
                            {{ $t('validation.attributes.year') }}
                        </div>
                    </base-th-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !px-2">
                        {{ $t('institute') }}
                    </base-th-table>

                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !ps-2">
                        {{ $t('validation.attributes.note') }}
                    </base-th-table>

                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !ps-2">
                        {{ $t('actions') }}
                    </base-th-table>
                </base-tr-table>
            </base-thead-table>

            <base-tbody-table>
                <base-tr-table
                    v-for="(vocational_training_achievement, index) in orphan.vocational_training_achievements"
                    :key="vocational_training_achievement.id"
                >
                    <base-td-table>
                        {{ index + 1 }}
                    </base-td-table>

                    <base-td-table class="text-center truncate !max-w-40">
                        {{ vocational_training_achievement.speciality }}

                        <p class="mt-0.5 block whitespace-nowrap text-xs text-slate-500">
                            {{ vocational_training_achievement.division }}
                        </p>
                    </base-td-table>

                    <base-td-table>
                        {{ vocational_training_achievement.year }}
                    </base-td-table>

                    <base-td-table>
                        {{ vocational_training_achievement.institute }}
                    </base-td-table>

                    <base-td-table class="text-center">
                        <base-tippy
                            v-if="vocational_training_achievement?.note"
                            :content="vocational_training_achievement?.note"
                        >
                            <svg-loader class="block mx-auto h-6 w-6" name="icon-note"></svg-loader>
                        </base-tippy>

                        <span v-else> - </span>
                    </base-td-table>

                    <base-td-table>
                        <div class="flex items-center justify-center">
                            <a
                                class="me-3 flex items-center"
                                href="javascript:void(0)"
                                @click.prevent="emit('showEditModal', vocational_training_achievement.id)"
                            >
                                <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-pen" />
                            </a>
                            <a
                                class="flex items-center text-danger"
                                href="javascript:void(0)"
                                @click.prevent="emit('showDeleteModal', vocational_training_achievement.id)"
                            >
                                <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-trash-can" />
                            </a>
                        </div>
                    </base-td-table>
                </base-tr-table>
            </base-tbody-table>
        </base-table>
    </div>
</template>

<style lang="postcss" scoped></style>
