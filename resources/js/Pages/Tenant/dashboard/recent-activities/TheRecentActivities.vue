<script lang="ts" setup>
import BaseTippy from '@/Components/Base/tippy/BaseTippy.vue'
import TheAvatar from '@/Components/Global/TheAvatar.vue'
</script>

<template>
    <div class="col-span-12 mt-3 md:col-span-6 xl:col-span-4 2xl:col-span-12">
        <div class="intro-x flex h-10 items-center">
            <h2 class="me-5 truncate text-lg font-medium">Recent Activities</h2>
            <a class="ms-auto truncate text-primary" href=""> Show More </a>
        </div>
        <div
            class="relative mt-5 before:absolute before:ms-5 before:mt-5 before:block before:h-[85%] before:w-px before:bg-slate-200 before:dark:bg-darkmode-400"
        >
            <div class="intro-x relative mb-3 flex items-center">
                <div
                    class="before:absolute before:ms-5 before:mt-5 before:block before:h-px before:w-20 before:bg-slate-200 before:dark:bg-darkmode-400"
                >
                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                        <the-avatar name="hello"></the-avatar>
                    </div>
                </div>
                <div class="box zoom-in ms-4 flex-1 px-5 py-3">
                    <div class="flex items-center">
                        <div class="font-medium">test</div>
                        <div class="ms-auto text-xs text-slate-500">07:00 PM</div>
                    </div>
                    <div class="mt-1 text-slate-500">Has joined the team</div>
                </div>
            </div>
            <div class="intro-x relative mb-3 flex items-center">
                <div
                    class="before:absolute before:ms-5 before:mt-5 before:block before:h-px before:w-20 before:bg-slate-200 before:dark:bg-darkmode-400"
                >
                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                        <the-avatar name="hello"></the-avatar>
                    </div>
                </div>
                <div class="box zoom-in ms-4 flex-1 px-5 py-3">
                    <div class="flex items-center">
                        <div class="font-medium">test</div>
                        <div class="ms-auto text-xs text-slate-500">07:00 PM</div>
                    </div>
                    <div class="text-slate-500">
                        <div class="mt-1">Added 3 new photos</div>
                        <div class="mt-2 flex">
                            <base-tippy
                                as="div"
                                class="image-fit zoom-in me-1 h-8 w-8"
                                content="fakerData[0].products[0].name"
                            >
                                <the-avatar name="s"></the-avatar>
                            </base-tippy>
                            <base-tippy
                                as="div"
                                class="image-fit zoom-in me-1 h-8 w-8"
                                content="fakerData[1].products[0].name"
                            >
                                <the-avatar name="4545"></the-avatar>
                            </base-tippy>
                            <base-tippy
                                as="div"
                                class="image-fit zoom-in me-1 h-8 w-8"
                                content="fakerData[2].products[0].name"
                            >
                                <the-avatar name="hello"></the-avatar>
                            </base-tippy>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-x my-4 text-center text-xs text-slate-500">12 November</div>
            <div class="intro-x relative mb-3 flex items-center">
                <div
                    class="before:absolute before:ms-5 before:mt-5 before:block before:h-px before:w-20 before:bg-slate-200 before:dark:bg-darkmode-400"
                >
                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                        <the-avatar name="hello"></the-avatar>
                    </div>
                </div>
                <div class="box zoom-in ms-4 flex-1 px-5 py-3">
                    <div class="flex items-center">
                        <div class="font-medium">test</div>
                        <div class="ms-auto text-xs text-slate-500">07:00 PM</div>
                    </div>
                    <div class="mt-1 text-slate-500">
                        Has changed
                        <a class="text-primary" href=""> test </a>
                        price and description
                    </div>
                </div>
            </div>
            <div class="intro-x relative mb-3 flex items-center">
                <div
                    class="before:absolute before:ms-5 before:mt-5 before:block before:h-px before:w-20 before:bg-slate-200 before:dark:bg-darkmode-400"
                >
                    <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-full">
                        <the-avatar name="hello"></the-avatar>
                    </div>
                </div>
                <div class="box zoom-in ms-4 flex-1 px-5 py-3">
                    <div class="flex items-center">
                        <div class="font-medium">test</div>
                        <div class="ms-auto text-xs text-slate-500">07:00 PM</div>
                    </div>
                    <div class="mt-1 text-slate-500">
                        Has changed
                        <a class="text-primary" href=""> test </a>
                        description
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
