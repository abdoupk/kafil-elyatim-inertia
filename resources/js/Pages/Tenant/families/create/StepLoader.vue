<script lang="ts" setup>

import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
    >
        <div class="mt-5 w-full flex justify-center items-center">
            <spinner-loader class="w-8 h-8 animate-spin"></spinner-loader>
        </div>
    </div>
</template>
