<script lang="ts" setup>
import TheCommuneSelector from '@/Components/Global/CitySelector/TheCommuneSelector.vue'
import TheDairaSelector from '@/Components/Global/CitySelector/TheDairaSelector.vue'
import TheWilayaSelector from '@/Components/Global/CitySelector/TheWilayaSelector.vue'

const wilaya = defineModel('wilaya')

const daira = defineModel('daira')

const commune = defineModel('commune')

const cityId = defineModel('cityId')

defineProps<{ errorMessage?: string | string[] }>()
</script>

<template>
    <div class="grid w-full flex-1 grid-cols-1 gap-4 gap-y-5 lg:grid-cols-3">
        <the-wilaya-selector
            v-model:wilaya="wilaya"
            :errorMessage
            @update:wilaya="
                (event) => {
                    wilaya = event.wilaya_code
                }
            "
        ></the-wilaya-selector>

        <the-daira-selector
            v-model:daira="daira"
            v-model:wilaya="wilaya"
            :errorMessage
            @update:daira="
                (event) => {
                    daira = event.daira_name
                }
            "
        ></the-daira-selector>

        <the-commune-selector
            v-model:commune="commune"
            v-model:daira="daira"
            v-model:wilaya="wilaya"
            :errorMessage
            @update:commune="
                (value) => {
                    cityId = value
                }
            "
        ></the-commune-selector>
    </div>
</template>
