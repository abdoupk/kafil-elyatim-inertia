<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3'
import { useForm } from 'laravel-precognition-vue'

import TheNotificationItem from '@/Pages/Profile/notifications/TheNotificationItem.vue'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import SpinnerButtonLoader from '@/Components/Global/SpinnerButtonLoader.vue'

const form = useForm('put', route('tenant.profile.notifications.update'), {
    families_changes: usePage().props.auth.settings.notifications.families_changes,
    branches_and_zones_changes: usePage().props.auth.settings.notifications.branches_and_zones_changes,
    schools_and_lessons_changes: usePage().props.auth.settings.notifications.schools_and_lessons_changes,
    occasions_saves: usePage().props.auth.settings.notifications.occasions_saves,
    financial_changes: usePage().props.auth.settings.notifications.financial_changes
})
</script>

<template>
    <div class="border-b pb-5">
        <h2 class="rtl:text-xl rtl:font-semibold">{{ $t('appearance') }}</h2>

        <p class="mt-1 text-slate-600 dark:text-slate-400">
            {{ $t('theme.profile_appearance_hint') }}
        </p>
    </div>

    <p class="py-5 rtl:text-lg rtl:font-semibold">{{ $t('profile.notifications.Notify me about') }}</p>

    <form @submit.prevent="form.submit()">
        <div class="space-y-4">
            <the-notification-item
                v-model:status="form.families_changes"
                description="families_changes_description"
                label="families_changes"
            ></the-notification-item>

            <the-notification-item
                v-model:status="form.branches_and_zones_changes"
                description="branches_and_zones_changes_description"
                label="branches_and_zones_changes"
            ></the-notification-item>

            <the-notification-item
                v-model:status="form.financial_changes"
                description="financial_changes_description"
                label="financial_changes"
            ></the-notification-item>

            <the-notification-item
                v-model:status="form.schools_and_lessons_changes"
                description="schools_and_lessons_changes_description"
                label="schools_and_lessons_changes"
            ></the-notification-item>

            <the-notification-item
                v-model:status="form.occasions_saves"
                description="occasions_saves_description"
                label="occasions_saves"
            ></the-notification-item>
        </div>

        <base-button :disabled="form.processing" class="col-span-12 !mt-5 w-20" type="submit" variant="primary">
            {{ $t('update') }}

            <spinner-button-loader :show="form.processing" class="ms-auto"></spinner-button-loader>
        </base-button>
    </form>
</template>
