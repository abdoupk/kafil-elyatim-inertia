<script lang="ts" setup>
import type { FamilyShowType } from '@/types/families'

import { Link } from '@inertiajs/vue3'

import MenuLink from '@/Pages/Tenant/families/details/MenuLink.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'

defineProps<{ family: FamilyShowType }>()
</script>

<template>
    <!-- BEGIN: Profile Menu -->
    <div class="flex flex-col-reverse col-span-12 lg:col-span-4 2xl:col-span-3 lg:block">
        <div class="mt-5 intro-y box lg:mt-0">
            <div class="relative flex items-center p-5">
                <div class="ms-4 me-auto">
                    <div class="text-base font-bold">{{ family.name }}</div>
                    <Link
                        :href="route('tenant.members.show', family.sponsor.creator?.id)"
                        class="text-slate-500 font-semibold"
                    >
                        {{ family.sponsor.creator?.name }}
                    </Link>
                </div>
            </div>

            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <menu-link class="!mt-0" icon="icon-memo-circle-info" view-name="general_information"></menu-link>

                <menu-link icon="icon-couple" view-name="spouse_information"></menu-link>

                <menu-link icon="icon-hands-holding-child" view-name="sponsor_information"></menu-link>

                <menu-link icon="icon-hands-holding-heart" view-name="second_sponsor_information"></menu-link>

                <menu-link icon="icon-children" view-name="orphans_information"></menu-link>

                <menu-link icon="icon-house" view-name="housing_information"></menu-link>
            </div>

            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <menu-link class="!mt-0" icon="icon-file-lines" view-name="the_report"></menu-link>

                <menu-link icon="icon-handshake-angle" view-name="family_sponsorship"></menu-link>

                <menu-link icon="icon-person-dress" view-name="sponsor_sponsorship"></menu-link>

                <menu-link icon="icon-child-reaching" view-name="orphans_sponsorship"></menu-link>
            </div>

            <div class="flex p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <base-button
                    :as="Link"
                    :href="route('tenant.families.create')"
                    class="px-2 py-1"
                    type="button"
                    variant="primary"
                >
                    {{ $t('new need') }}
                </base-button>
            </div>
        </div>
    </div>
    <!-- END: Profile Menu -->
</template>
