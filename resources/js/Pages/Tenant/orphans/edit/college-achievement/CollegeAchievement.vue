<script lang="ts" setup>
import type { AcademicLevelType } from '@/types/lessons'
import type { OrphanUpdateFormType } from '@/types/orphans'

import { useCollegeAchievementsStore } from '@/stores/college-achievement'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

import DeleteModal from '@/Pages/Shared/DeleteModal.vue'
import CollegeAchievementCreateEditModal from '@/Pages/Tenant/orphans/edit/college-achievement/CollegeAchievementCreateEditModal.vue'
import DataTable from '@/Pages/Tenant/orphans/edit/college-achievement/DataTable.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import NoResultsFound from '@/Components/Global/NoResultsFound.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{
    orphan: OrphanUpdateFormType
    academicLevels: AcademicLevelType[]
}>()

const createEditModalStatus = ref(false)

const deleteModalStatus = ref(false)

const deleteCollegeAchievement = () => {
    deleteProgress.value = true

    router.delete(route('tenant.college-achievements.destroy', selectedCollegeAchievementId.value), {
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

const selectedCollegeAchievementId = ref('')

const collegeAchievementsStore = useCollegeAchievementsStore()

const deleteProgress = ref(false)

const showDeleteModal = (id: string) => {
    selectedCollegeAchievementId.value = id

    deleteModalStatus.value = true
}

const showCreateModal = () => {
    collegeAchievementsStore.$reset()

    collegeAchievementsStore.collegeAchievement.orphan_id = props.orphan.id

    createEditModalStatus.value = true
}

const showEditModal = (id: string) => {
    selectedCollegeAchievementId.value = id

    collegeAchievementsStore.getCollegeAchievement(selectedCollegeAchievementId.value)

    createEditModalStatus.value = true
}
</script>

<template>
    <!-- BEGIN: College Achievement -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <base-button
                class="w-20 ms-auto border-dashed"
                variant="outline-primary"
                @click="showCreateModal"
            >
                <svg-loader class="w-4 h-4 fill-slate-300/40" name="icon-plus"></svg-loader>
            </base-button>
        </div>

        <div class="p-5">
            <data-table
                v-if="orphan.college_achievements.length > 0"
                :orphan
                @show-delete-modal="showDeleteModal"
                @show-edit-modal="showEditModal"
            ></data-table>

            <div v-else class="intro-x mt-12 flex flex-col items-center justify-center">
                <no-results-found></no-results-found>
            </div>
        </div>
    </div>
    <!-- END: College Achievement -->

    <college-achievement-create-edit-modal
        :academicLevels
        :open="createEditModalStatus"
        @close="createEditModalStatus = false"
    ></college-achievement-create-edit-modal>

    <delete-modal
        :deleteProgress
        :open="deleteModalStatus"
        @close="deleteModalStatus = false"
        @delete="deleteCollegeAchievement"
    ></delete-modal>
</template>
