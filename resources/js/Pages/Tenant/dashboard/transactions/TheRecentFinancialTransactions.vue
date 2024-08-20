<script lang="ts" setup>
import type { RecentTransactionsType } from '@/types/dashboard'

import { Link } from '@inertiajs/vue3'

import TheAvatar from '@/Components/Global/TheAvatar.vue'

import { formatCurrency } from '@/utils/helper'

defineProps<{
    recentTransactions: RecentTransactionsType
}>()
</script>

<template>
    <!-- BEGIN: Transactions -->
    <suspense suspensible>
        <div class="mt-5">
            <div v-for="transaction in recentTransactions" :key="transaction.id" class="intro-x">
                <div class="box zoom-in mb-3 flex items-center px-5 py-3">
                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                        <Link :href="route('tenant.members.index') + '?show=' + transaction.receiver.id">
                            <the-avatar
                                :gender="transaction.receiver.gender"
                                :name="transaction.receiver.name"
                            ></the-avatar>
                        </Link>
                    </div>
                    <div class="me-auto ms-4">
                        <div class="font-medium">{{ transaction.receiver.name }}</div>
                        <div class="mt-0.5 text-xs text-slate-500">
                            {{ transaction.date }}
                        </div>
                    </div>
                    <div
                        :class="{
                            'text-success': transaction.amount > 0,
                            'text-danger': transaction.amount < 0
                        }"
                    >
                        {{ formatCurrency(Math.abs(transaction.amount)) }}
                    </div>
                </div>
            </div>

            <a
                class="intro-x block w-full rounded-md border border-dotted border-slate-400 py-3 text-center text-slate-500 dark:border-darkmode-300"
                href=""
            >
                View More
            </a>
        </div>
    </suspense>
    <!-- END: Transactions -->
</template>
