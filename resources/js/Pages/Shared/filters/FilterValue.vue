<script setup lang="ts">
import SponsorsFilterDropDown from '@/Pages/Shared/filters/SponsorsFilterDropDown.vue'
import { useSponsorsStore } from '@/stores/sponsors'
import { onMounted } from 'vue'

defineProps<{ field?: string }>()

const value = defineModel<string>('value')

const sponsorsStore = useSponsorsStore()

onMounted(() => {
    sponsorsStore.getSponsors()
})
</script>

<template>
    <sponsors-filter-drop-down
        :people="sponsorsStore.sponsors"
        v-if="field === 'name'"
        @update:value="value = $event?.id"
        class="col-span-4 text-sm"
    ></sponsors-filter-drop-down>
</template>
