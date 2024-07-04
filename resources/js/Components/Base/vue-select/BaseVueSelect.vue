<template>
    <multiselect v-model="value" :options="options" :show-labels="false" placeholder="hello">

        <template #noResult>
            <span>{{$t('No results found.')}}</span>
        </template>
    </multiselect>
</template>

<script lang="ts" setup>
import Multiselect from 'vue-multiselect'

defineProps<{ options: Record<string, string | any> }>()

const value = defineModel('value')
</script>

<!-- TODO change vue-multiselect.ssr.css  -->
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style lang="postcss">
@import '/resources/css/vendors/vue-multiselect.css';
</style>
