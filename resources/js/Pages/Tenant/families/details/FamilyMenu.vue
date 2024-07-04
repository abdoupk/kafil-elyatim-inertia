<script lang="ts" setup>
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import { Link } from '@inertiajs/vue3'
import MenuLink from '@/Pages/Tenant/families/details/MenuLink.vue'

defineProps<{ family: object }>()
</script>

<template>
    <!-- BEGIN: Profile Menu -->
    <div
        class="flex flex-col-reverse col-span-12 lg:col-span-4 2xl:col-span-3 lg:block"
    >
        <div class="mt-5 intro-y box lg:mt-0">
            <div class="relative flex items-center p-5">
                <div class="ms-4 me-auto">
                    <div class="text-base font-medium">
                        5655656
                    </div>
                    <div class="text-slate-500">6565656</div>
                </div>
            </div>

            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <menu-link icon="icon-backpack" view-name="general_information"
                ></menu-link>

                <menu-link icon="icon-note" view-name="sponsor_information"
                ></menu-link>
            </div>

            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <a class="flex items-center" href="">
                    <Lucide class="w-4 h-4 me-2" icon="Activity" />
                    {{ $t('the_report') }}
                </a>
                <a class="flex items-center mt-5" href="">
                    <Lucide class="w-4 h-4 me-2" icon="Box" />
                    {{ $t('sponsorship for the orphans') }}
                </a>
                <a class="flex items-center mt-5" href="">
                    <Lucide class="w-4 h-4 me-2" icon="Lock" />
                    {{ $t('sponsorship for the family') }}
                </a>
                <a class="flex items-center mt-5" href="">
                    <Lucide class="w-4 h-4 me-2" icon="Settings" />
                    {{ $t('family sponsorship') }}
                </a>
            </div>
            <div
                class="flex p-5 border-t border-slate-200/60 dark:border-darkmode-400"
            >
                <base-button :as="Link" :href="route('tenant.families.create')" class="px-2 py-1" type="button"
                             variant="primary">
                    {{ $t('new need') }}
                </base-button>
            </div>
        </div>


    </div>
    <!-- END: Profile Menu -->
</template>
