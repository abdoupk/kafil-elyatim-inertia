<script lang="ts" setup>
import type { SponsorSponsorshipType } from '@/types/families'

import { handleSponsorship, omit } from '@/utils/helper'

defineProps<{ sponsorships: SponsorSponsorshipType }>()
</script>

<template>
    <!-- BEGIN: Sponsor SponsorShip -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('family_sponsorship') }}</h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div v-for="(sponsorship, key) in omit(sponsorships, ['id'])" :key class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">
                    {{ $t(`sponsorships.${key}`) }}
                </h2>

                <p class="font-medium text-base">
                    {{ handleSponsorship(sponsorship) }}
                </p>
            </div>
        </div>
    </div>
    <!-- END: Sponsor SponsorShip -->
</template>
