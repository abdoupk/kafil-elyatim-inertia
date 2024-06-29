<template>
    <multiselect v-model="value" :options="options" :show-labels="false" multiple></multiselect>
</template>

<script lang="ts" setup>
import Multiselect from 'vue-multiselect'

defineProps<{ options: string[] | Record<string, string> }>()

const value = defineModel('value')
</script>

<!-- TODO change vue-multiselect.ssr.css  -->
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style lang="postcss">
@import '/resources/css/vendors/vue-multiselect.css';
</style>
