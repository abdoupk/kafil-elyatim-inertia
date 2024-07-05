<script lang="ts" setup>
import type { OrphanSponsorshipType } from '@/types/families'

import { Link } from '@inertiajs/vue3'

import { groupByKey } from '@/utils/helper'

const props = defineProps<{ sponsorShips: OrphanSponsorshipType[] }>()

const schoolBagBeneficiaries = groupByKey(props.sponsorShips, 'school_bag')['true']

const medicalSponsorshipBeneficiaries = groupByKey(props.sponsorShips, 'medical_sponsorship')['true']

const eidSuitBeneficiaries = groupByKey(props.sponsorShips, 'eid_suit')['true']

const associationTripsBeneficiaries = groupByKey(props.sponsorShips, 'association_trips')['true']

const privateLessonsBeneficiaries = groupByKey(props.sponsorShips, 'private_lessons')['true']

const summerCampBeneficiaries = groupByKey(props.sponsorShips, 'summer_camp')['true']

const universityScholarshipBeneficiaries = groupByKey(props.sponsorShips, 'university_scholarship')['true']
</script>

<template>
    <!-- BEGIN: Orphans Sponsorships (School Bags) -->
    <div v-if="schoolBagBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsorships.school_bags') }}</h2>
        </div>

        <Link
            v-for="beneficiary in schoolBagBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (School Bags) -->

    <!-- BEGIN: Orphans Sponsorships (Private lessons) -->
    <div v-if="privateLessonsBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsorships.private_lessons') }}</h2>
        </div>

        <Link
            v-for="beneficiary in privateLessonsBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (Private lessons) -->

    <!-- BEGIN: Orphans Sponsorships (Medical Sponsorship) -->
    <div v-if="medicalSponsorshipBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsorships.medical_sponsorship') }}</h2>
        </div>

        <Link
            v-for="beneficiary in medicalSponsorshipBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (Medical Sponsorship) -->

    <!-- BEGIN: Orphans Sponsorships (Eid Suits) -->
    <div v-if="eidSuitBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsorships.eid_suit') }}</h2>
        </div>

        <Link
            v-for="beneficiary in eidSuitBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (Eid Suits) -->

    <!-- BEGIN: Orphans Sponsorships (association Trips) -->
    <div v-if="associationTripsBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsorships.association_trips') }}</h2>
        </div>

        <Link
            v-for="beneficiary in associationTripsBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (association Trips) -->

    <!-- BEGIN: Orphans Sponsorships (summer Camp) -->
    <div v-if="summerCampBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsorships.summer_camp') }}</h2>
        </div>

        <Link
            v-for="beneficiary in summerCampBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (summer Camp) -->

    <!-- BEGIN: Orphans Sponsorships (university Scholarship) -->
    <div v-if="universityScholarshipBeneficiaries?.length" class="col-span-12 intro-y box 2xl:col-span-6">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">
                {{ $t('sponsorships.university_scholarship') }}
            </h2>
        </div>

        <Link
            v-for="beneficiary in universityScholarshipBeneficiaries"
            :key="beneficiary.id"
            :href="route('tenant.orphans.show', beneficiary.id)"
            class="flex items-center px-5 mt-2 first:mt-0 rounded-md last:mb-3"
        >
            <div class="w-2 h-2 bg-current rounded-full me-3"></div>

            <span class="font-semibold text-base">{{ beneficiary.orphan.name }}</span>
        </Link>
    </div>
    <!-- END: Orphans Sponsorships (university Scholarship) -->
</template>
