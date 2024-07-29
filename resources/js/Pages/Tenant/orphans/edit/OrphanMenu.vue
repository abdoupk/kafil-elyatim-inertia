<script lang="ts" setup>
import type { OrphanUpdateFormType } from '@/types/orphans'

import { useNeedsStore } from '@/stores/needs'
import { Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

import NeedCreateUpdateModal from '@/Pages/Tenant/needs/NeedCreateUpdateModal.vue'
import MenuLink from '@/Pages/Tenant/orphans/details/MenuLink.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'

const props = defineProps<{ orphan: OrphanUpdateFormType }>()

const name = computed(() => {
    return props.orphan.first_name + ' ' + props.orphan.last_name
})

const needsStore = useNeedsStore()

const needCreateModalStatus = ref<boolean>(false)

const showNeedCreateModal = () => {
    needsStore.$reset()

    needsStore.need.needable_type = 'orphan'

    needsStore.need.needable_id = props.orphan.id

    needCreateModalStatus.value = true
}
</script>

<template>
    <!-- BEGIN: Profile Menu -->
    <div class="flex flex-col-reverse col-span-12 lg:col-span-4 2xl:col-span-3 lg:block">
        <div class="mt-5 intro-y box lg:mt-0">
            <div class="relative flex items-center p-5">
                <div class="ms-4 me-auto">
                    <div class="text-base font-bold">{{ name }}</div>

                    <Link :href="route('tenant.members.show', orphan.creator.id)" class="text-slate-500 font-semibold">
                        {{ orphan.creator?.name }}
                    </Link>
                </div>
            </div>

            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <menu-link class="!mt-0" icon="icon-memo-circle-info" view-name="general_information"></menu-link>

                <menu-link icon="icon-couple" view-name="sponsorships_information"></menu-link>
            </div>

            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <menu-link icon="icon-books" class="!mt-0" view-name="academic_achievement"></menu-link>

                <menu-link icon="icon-diploma" view-name="college_achievement"></menu-link>

                <menu-link icon="icon-file-certificate" view-name="vocational_training_achievement"></menu-link>
            </div>

            <div class="flex p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <base-button class="px-2 py-1" type="button" variant="primary" @click.prevent="showNeedCreateModal">
                    {{ $t('new need') }}
                </base-button>
            </div>
        </div>
    </div>
    <!-- END: Profile Menu -->

    <need-create-update-modal
        :close-only="true"
        :open="needCreateModalStatus"
        @close="needCreateModalStatus = false"
    ></need-create-update-modal>
</template>
