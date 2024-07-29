<script lang="ts" setup>
import type { AcademicLevelType } from '@/types/lessons'
import type { OrphanUpdateFormType } from '@/types/orphans'

import { useAcademicAchievementsStore } from '@/stores/academic-achievement'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import AcademicAchievementCreateEditModal from '@/Pages/Tenant/orphans/edit/academic-achievement/AcademicAchievementCreateEditModal.vue'
import DataTable from '@/Pages/Tenant/orphans/edit/academic-achievement/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{
    orphan: OrphanUpdateFormType
    academicLevels: AcademicLevelType[]
}>()

const createEditModalStatus = ref(false)

const deleteModalStatus = ref(false)

const deleteAcademicAchievement = () => {
    deleteProgress.value = true

    router.delete(route('tenant.academic-achievements.destroy', selectedAcademicAchievementId.value), {
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
    })
}

const selectedAcademicAchievementId = ref('')

const academicAchievementsStore = useAcademicAchievementsStore()

const deleteProgress = ref(false)

const showDeleteModal = (id: string) => {
    selectedAcademicAchievementId.value = id

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    academicAchievementsStore.$reset()

    academicAchievementsStore.academicAchievement.orphan_id = props.orphan.id

    createEditModalStatus.value = true
}

const showEditModal = (id: string) => {
    selectedAcademicAchievementId.value = id

    academicAchievementsStore.getAcademicAchievement(selectedAcademicAchievementId.value)

    createEditModalStatus.value = true
}
</script>

<template>
    <!-- BEGIN: Academic Achievement -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="text-base font-bold">{{ orphan?.last_academic_year_achievement }}</h2>

            <base-button class="w-20 ms-auto border-dashed" variant="outline-primary" @click="showCreateModal">
                <svg-loader name="icon-plus" class="w-4 h-4 fill-slate-300/40"></svg-loader>
            </base-button>
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

    <academic-achievement-create-edit-modal
        :academicLevels
        :open="createEditModalStatus"
        @close="createEditModalStatus = false"
    ></academic-achievement-create-edit-modal>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="deleteModalStatus = false"
        @delete="deleteAcademicAchievement"
    ></delete-modal>
</template>
