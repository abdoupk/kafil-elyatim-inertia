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
    <div v-if="orphan.academic_achievements.length" class="flex-1 w-full mt-3 overflow-x-auto pb-2">
        <base-table class="border">
            <base-thead-table>
                <base-tr-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                        #
                    </base-th-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                        {{ $t('academic_level') }}
                    </base-th-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap">
                        <div class="flex items-center">
                            {{ $t('validation.attributes.first_trimester') }}
                        </div>
                    </base-th-table>
                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !px-2">
                        {{ $t('validation.attributes.second_trimester') }}
                    </base-th-table>

                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !ps-2">
                        {{ $t('validation.attributes.third_trimester') }}
                    </base-th-table>

                    <base-th-table class="bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap !ps-2">
                        {{ $t('general_average') }}
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
                    v-for="(academic_achievement, index) in orphan.academic_achievements"
                    :key="academic_achievement.id"
                >
                    <base-td-table>
                        {{ index + 1 }}
                    </base-td-table>

                    <base-td-table class="text-center">
                        {{ academic_achievement.academic_level }}
                    </base-td-table>

                    <base-td-table>
                        {{ academic_achievement.first_trimester }}
                    </base-td-table>

                    <base-td-table>
                        {{ academic_achievement.second_trimester }}
                    </base-td-table>

                    <base-td-table>
                        {{ academic_achievement.third_trimester }}
                    </base-td-table>

                    <base-td-table>
                        {{ academic_achievement.average }}
                    </base-td-table>

                    <base-td-table class="text-center">
                        <base-tippy v-if="academic_achievement?.note" :content="academic_achievement?.note">
                            <svg-loader class="block mx-auto h-6 w-6" name="icon-note"></svg-loader>
                        </base-tippy>

                        <span v-else> - </span>
                    </base-td-table>

                    <base-td-table>
                        <div class="flex items-center justify-center">
                            <a
                                class="me-3 flex items-center"
                                href="javascript:void(0)"
                                @click.prevent="emit('showEditModal', academic_achievement.id)"
                            >
                                <svg-loader class="me-1 h-4 w-4 fill-current" name="icon-pen" />
                            </a>
                            <a
                                class="flex items-center text-danger"
                                href="javascript:void(0)"
                                @click.prevent="emit('showDeleteModal', academic_achievement.id)"
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
