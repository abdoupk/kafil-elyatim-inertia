<script setup lang="ts">
import SpinnerLoader from '@/Components/Global/SpinnerLoader.vue'
import { TransitionRoot } from '@headlessui/vue'

defineProps<{ show: boolean }>()
</script>

<template>
    <!-- TODO: Fix This its too late to appear or disappear -->
    <transition-root appear :show enter="transition ease-out" enterFrom="scale-0" enterTo="scale-100">
        <spinner-loader class="me-1 h-4 w-4 animate-spin text-white"></spinner-loader>
    </transition-root>
</template>
