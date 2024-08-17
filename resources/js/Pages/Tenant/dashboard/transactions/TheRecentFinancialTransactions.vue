<script lang="ts" setup></script>

<template>
    <!-- BEGIN: Transactions -->
    <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12 2xl:mt-8">
        <div class="intro-x flex h-10 items-center">
            <h2 class="mr-5 truncate text-lg font-medium">Transactions</h2>
        </div>
        <div class="mt-5">
            <!--            <div v-for="(faker, fakerKey) in _.take(fakerData, 5)" :key="fakerKey" class="intro-x">-->
            <!--                <div class="box zoom-in mb-3 flex items-center px-5 py-3">-->
            <!--                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">-->
            <!--                        <img :src="faker.photos[0]" alt="Midone Tailwind HTML Admin Template" />-->
            <!--                    </div>-->
            <!--                    <div class="ml-4 mr-auto">-->
            <!--                        <div class="font-medium">{{ faker.users[0].name }}</div>-->
            <!--                        <div class="mt-0.5 text-xs text-slate-500">-->
            <!--                            {{ faker.dates[0] }}-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div-->
            <!--                        :class="{-->
            <!--                            'text-success': faker.trueFalse[0],-->
            <!--                            'text-danger': !faker.trueFalse[0]-->
            <!--                        }"-->
            <!--                    >-->
            <!--                        {{ faker.trueFalse[0] ? '+' : '-' }}${{ faker.totals[0] }}-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <a
                class="intro-x block w-full rounded-md border border-dotted border-slate-400 py-3 text-center text-slate-500 dark:border-darkmode-300"
                href=""
            >
                View More
            </a>
        </div>
    </div>
    <!-- END: Transactions -->
</template>
