<script lang="ts" setup>
import type { RecentActivitiesType } from '@/types/dashboard'

import { Link } from '@inertiajs/vue3'

import TheAvatar from '@/Components/Global/TheAvatar.vue'

defineProps<{
    recentActivities: RecentActivitiesType
}>()
</script>

<template>
    <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12">
        <div class="intro-x flex h-10 items-center">
            <h2 class="me-5 truncate text-lg font-medium">Recent Activities</h2>

            <Link :href="route('tenant.dashboard')" class="ms-auto truncate text-primary" only="recentActivities">
                Show More
            </Link>
        </div>

        <div
            class="relative mt-5 before:absolute before:ms-5 before:mt-5 before:block before:h-[85%] before:w-px before:bg-slate-200 before:dark:bg-darkmode-400"
        >
            <div
                v-for="activity in recentActivities"
                :key="activity.id"
                class="intro-x relative mb-3 flex items-center"
            >
                <div
                    class="before:absolute before:ms-5 before:mt-5 before:block before:h-px before:w-20 before:bg-slate-200 before:dark:bg-darkmode-400"
                >
                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                        <Link :href="route('tenant.members.index') + '?show=' + activity.user.id">
                            <the-avatar :gender="activity.user.gender" :name="activity.user.name"></the-avatar>
                        </Link>
                    </div>
                </div>

                <div class="box zoom-in ms-4 flex-1 px-5 py-3">
                    <div class="flex items-center">
                        <div class="font-medium">{{ activity.user.name }}</div>

                        <div class="ms-auto text-xs text-slate-500">{{ activity.formatted_date }}</div>
                    </div>

                    <div class="mt-1 text-slate-500" v-html="activity.message"></div>
                </div>
            </div>

            <div class="intro-x my-4 text-center text-xs text-slate-500">12 November</div>
        </div>
    </div>
</template>
