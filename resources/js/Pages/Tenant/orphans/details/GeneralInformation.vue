<script lang="ts" setup>
import type { OrphanShowType } from '@/types/orphans'

import dayjs from 'dayjs'
import { computed } from 'vue'

import { formatDate } from '@/utils/helper'

const props = defineProps<{ orphan: OrphanShowType }>()

const isStillBaby = computed(() => {
    return dayjs().diff(dayjs(props.orphan.birth_date), 'year') < 2
})
</script>

<template>
    <!-- BEGIN: Orphan Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ orphan.name }}</h2>
        </div>

        <div class="p-5 grid grid-cols-12 gap-4">
            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.date_of_birth') }}</h2>

                <h3 class="font-medium text-base">
                    {{ formatDate(orphan.birth_date, 'long') }}
                </h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('health_status') }}</h2>

                <h3 class="font-medium text-base">
                    {{ orphan.health_status }}
                </h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('family_status') }}</h2>

                <h3 class="font-medium text-base">
                    {{ orphan.family_status }}
                </h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('academic_level') }}</h2>

                <h3 class="font-medium text-base">
                    {{ orphan.academic_level }}
                </h3>
            </div>

            <div class="@xl:col-span-6 col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('validation.attributes.sex') }}</h2>

                <h3 class="font-medium text-base">
                    {{ $t(orphan.gender) }}
                </h3>
            </div>

            <template v-if="!isStillBaby">
                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('pants_size') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.pants_size }}
                    </h3>
                </div>

                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('shirt_size') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.shirt_size }}
                    </h3>
                </div>

                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('shoes_size') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.shoes_size }}
                    </h3>
                </div>
            </template>

            <template v-else>
                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('diapers_type') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.baby_needs.diapers_type }}
                    </h3>
                </div>

                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('diapers_quantity') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.baby_needs.diapers_quantity }}
                    </h3>
                </div>

                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('baby_milk_type') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.baby_needs.baby_milk_type }}
                    </h3>
                </div>

                <div class="@xl:col-span-6 col-span-12">
                    <h2 class="text-lg font-semibold">{{ $t('baby_milk_quantity') }}</h2>

                    <h3 class="font-medium text-base">
                        {{ orphan.baby_needs.baby_milk_quantity }}
                    </h3>
                </div>
            </template>

            <div class="col-span-12">
                <h2 class="text-lg font-semibold">{{ $t('notes') }}</h2>

                <div class="font-normal text-base" v-html="orphan.note"></div>
            </div>
        </div>
    </div>
    <!-- END: Orphan Information -->
</template>
