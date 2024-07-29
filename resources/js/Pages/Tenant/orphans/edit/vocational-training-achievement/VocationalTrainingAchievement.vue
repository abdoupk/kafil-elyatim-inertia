<script lang="ts" setup>
import type { AcademicLevelType } from '@/types/lessons'
import type { OrphanUpdateFormType } from '@/types/orphans'

import { useVocationalTrainingAchievementsStore } from '@/stores/vocational-training-achievement'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import DataTable from '@/Pages/Tenant/orphans/edit/vocational-training-achievement/DataTable.vue'
import VocationalTrainingAchievementCreateEditModal from '@/Pages/Tenant/orphans/edit/vocational-training-achievement/VocationalTrainingAchievementCreateEditModal.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'

const props = defineProps<{
    orphan: OrphanUpdateFormType
    academicLevels: AcademicLevelType[]
}>()

const createEditModalStatus = ref(false)

const deleteModalStatus = ref(false)

const deleteVocationalTrainingAchievement = () => {
    deleteProgress.value = true

    router.delete(
        route('tenant.vocational-training-achievements.destroy', selectedVocationalTrainingAchievementId.value),
        {
            // TODO get only academic achievements and not reload entire page
            onSuccess: () => {
                router.get(
                    route('tenant.orphans.edit', props.orphan.id),
                    {},
                    {
                        only: ['orphan'],
                        preserveScroll: true,
                        preserveState: false,
                        onSuccess: () => {
                            deleteProgress.value = false

                            deleteModalStatus.value = false
                        }
                    }
                )
            }
        }
    )
}

const selectedVocationalTrainingAchievementId = ref('')

const vocationalTrainingAchievementsStore = useVocationalTrainingAchievementsStore()

const deleteProgress = ref(false)

const showDeleteModal = (id: string) => {
    selectedVocationalTrainingAchievementId.value = id

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    vocationalTrainingAchievementsStore.$reset()

    vocationalTrainingAchievementsStore.vocationalTrainingAchievement.orphan_id = props.orphan.id

    createEditModalStatus.value = true
}

const showEditModal = (id: string) => {
    selectedVocationalTrainingAchievementId.value = id

    vocationalTrainingAchievementsStore.getVocationalTrainingAchievement(selectedVocationalTrainingAchievementId.value)

    createEditModalStatus.value = true
}
</script>

<template>
    <!-- BEGIN: Academic Achievement -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="text-base font-bold">{{ orphan?.last_academic_year_achievement }}</h2>

            <base-button class="w-20 ms-auto" @click="showCreateModal">add</base-button>
        </div>

        <div class="p-5">
            <data-table
                v-if="orphan.academic_achievements.length > 0"
                :orphan
                @show-delete-modal="showDeleteModal"
                @show-edit-modal="showEditModal"
            ></data-table>

            <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
                <no-results-found></no-results-found>
            </div>
        </div>
    </div>
    <!-- END: Academic Achievement -->

    <vocational-training-achievement-create-edit-modal
        :academicLevels
        :open="createEditModalStatus"
        @close="createEditModalStatus = false"
    ></vocational-training-achievement-create-edit-modal>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="deleteModalStatus = false"
        @delete="deleteVocationalTrainingAchievement"
    ></delete-modal>
</template>
