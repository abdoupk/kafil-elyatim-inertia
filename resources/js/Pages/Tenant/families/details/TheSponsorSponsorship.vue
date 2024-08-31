<script lang="ts" setup>
import type { SponsorSponsorshipType } from '@/types/families'

import { handleSponsorship, omit } from '@/utils/helper'
import { $t } from '@/utils/i18n'

defineProps<{ sponsorships: SponsorSponsorshipType }>()
</script>

<template>
    <!-- BEGIN: Sponsor SponsorShip -->
    <div class="intro-y box col-span-12 @container 2xl:col-span-6">
        <div class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">
            <h2 class="me-auto text-xl font-bold">{{ $t('sponsor_sponsorship') }}</h2>
        </div>

        <div class="grid grid-cols-12 gap-4 p-5">
            <div v-for="(sponsorship, key) in omit(sponsorships, ['id'])" :key class="col-span-12 @xl:col-span-6">
                <h2 class="text-lg font-semibold">
                    {{ $t(`sponsorships.${key}`) }}
                </h2>

                <p class="text-base font-medium">
                    {{ handleSponsorship(sponsorship) }}
                </p>
            </div>
        </div>
    </div>
    <!-- END: Sponsor SponsorShip -->
</template>
