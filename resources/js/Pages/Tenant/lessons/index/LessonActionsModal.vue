<script lang="ts" setup>
import { useLessonsStore } from '@/stores/lessons'
import type { EventApi } from '@fullcalendar/core'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseDialog from '@/Components/Base/headless/Dialog/BaseDialog.vue'
import BaseDialogPanel from '@/Components/Base/headless/Dialog/BaseDialogPanel.vue'
import BaseTable from '@/Components/Base/table/BaseTable.vue'
import BaseTbodyTable from '@/Components/Base/table/BaseTbodyTable.vue'
import BaseTdTable from '@/Components/Base/table/BaseTdTable.vue'
import BaseThTable from '@/Components/Base/table/BaseThTable.vue'
import BaseTheadTable from '@/Components/Base/table/BaseTheadTable.vue'
import BaseTrTable from '@/Components/Base/table/BaseTrTable.vue'

defineProps<{
    open: boolean
    deleteProgress: boolean
    eventInfo: EventApi | null
}>()

const emit = defineEmits(['close', 'delete', 'edit'])

const lessonsStore = useLessonsStore()
</script>

<template>
    <base-dialog :open size="xl" @close="emit('close')">
        <base-dialog-panel>
            <div class="p-5 leading-8 text-2xl text-center">
                {{ eventInfo?.title }}
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-4">
                    <h1 class="col-span-3">{{ $t('date_and_time') }}</h1>
                    <p class="col-span-9">{{ lessonsStore.lesson?.formated_date }}</p>
                </div>

                <div class="grid grid-cols-12 mt-4 gap-4">
                    <h1 class="col-span-3">{{ $t('quota_total') }}</h1>
                    <p class="col-span-9">{{ lessonsStore.lesson.lesson?.quota }}</p>
                </div>

                <div class="grid grid-cols-12 mt-4 gap-4">
                    <h1 class="col-span-3">{{ $t('school_name') }}</h1>
                    <p class="col-span-9">{{ lessonsStore.lesson?.formatted_school?.name }}</p>
                </div>

                <div class="grid grid-cols-12 mt-4 gap-4">
                    <h1 class="col-span-3">{{ $t('validation.attributes.subject') }}</h1>
                    <p class="col-span-9">{{ lessonsStore.lesson?.formatted_subject?.name }}</p>
                </div>

                <div class="grid grid-cols-12 mt-4 gap-4">
                    <h1 class="col-span-3">{{ $t('academic_level') }}</h1>
                    <p class="col-span-9">{{ lessonsStore.lesson?.formatted_academic_level?.name }}</p>
                </div>
            </div>

            <div class="overflow-x-auto px-5 pb-5">
                <base-table striped>
                    <base-thead-table>
                        <base-tr-table>
                            <base-th-table class="whitespace-nowrap">#</base-th-table>
                            <base-th-table class="whitespace-nowrap">
                                {{ $t('validation.attributes.first_name') }}
                            </base-th-table>
                            <base-th-table class="whitespace-nowrap">
                                {{ $t('validation.attributes.last_name') }}
                            </base-th-table>
                            <base-th-table class="whitespace-nowrap"> {{ $t('sponsor_phone_number') }}</base-th-table>
                        </base-tr-table>
                    </base-thead-table>

                    <base-tbody-table>
                        <base-tr-table
                            v-for="(orphan, index) in lessonsStore.lesson.formatted_orphans"
                            :key="orphan.id"
                            class="text-center"
                        >
                            <base-td-table>{{ index + 1 }}</base-td-table>
                            <base-td-table>{{ orphan.first_name }}</base-td-table>
                            <base-td-table>{{ orphan.last_name }}</base-td-table>
                            <base-td-table>{{ orphan.sponsor_phone }}</base-td-table>
                        </base-tr-table>
                    </base-tbody-table>
                </base-table>
            </div>

            <div class="flex justify-center px-5 pb-8 text-center">
                <base-button class="me-2 w-24" type="button" variant="outline-secondary" @click="emit('close')">
                    {{ $t('cancel') }}
                </base-button>

                <base-button
                    ref="{deleteButtonRef}"
                    class="w-24 me-2"
                    type="button"
                    variant="soft-warning"
                    @click.prevent="emit('edit')"
                >
                    {{ $t('edit') }}
                </base-button>

                <base-button
                    ref="{deleteButtonRef}"
                    class="w-24"
                    type="button"
                    variant="danger"
                    @click="emit('delete')"
                >
                    <spinner-button-loader :show="deleteProgress"></spinner-button-loader>

                    {{ $t('delete') }}
                </base-button>
            </div>
        </base-dialog-panel>
    </base-dialog>
</template>
