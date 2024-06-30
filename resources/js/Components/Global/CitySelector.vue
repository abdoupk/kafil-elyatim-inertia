<script lang="ts" setup>
import type { Commune, Daira, Wilaya } from '@/types/types'

import { useCityStore } from '@/stores/city'
import { onMounted, ref, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

const wilaya = ref()

const daira = ref()

const commune = ref()

const cityId = defineModel('cityId')

const wilayas = ref<Wilaya[]>([])

const dairas = ref<Daira[]>([])

const communes = ref<Commune[]>([])

const cityStore = useCityStore()

defineProps<{ errorMessage?: string | string[] }>()

watch(
    () => wilaya.value,
    (wilaya) => {
        cityStore.fetchDairas(wilaya.wilaya_code).then((res) => {
            dairas.value = res.data

            daira.value = ''
        })
    }
)

watch(() => daira.value, (daira) => {
    cityStore.fetchCommunes(daira.daira_name, wilaya.value.wilaya_code).then((res) => {
        commune.value = ''

        communes.value = res.data
    })
})

watch(() => commune.value, (value) => {
    cityId.value = value
})

onMounted(() => {
    cityStore.fetchWilayas().then((res) => {
        wilayas.value = res.data.wilayas
    })
})
</script>

<template>
    <div class="grid w-full flex-1 grid-cols-1 gap-4 gap-y-5 lg:grid-cols-3">
        <div>
            <base-form-label for="wilayas">
                {{ $t('wilaya') }}
            </base-form-label>

            <div>
                <base-vue-select
                    id="wilayas"
                    v-model:value="wilaya"
                    :options="wilayas"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('wilaya') })"
                    class="h-full w-full"
                    label="wilaya_name"
                    track-by="wilaya_code"
                >
                    <option v-for="wilaya in wilayas" :key="wilaya.wilaya_code" :value="wilaya.wilaya_code">
                        {{ wilaya.wilaya_name }}
                    </option>
                </base-vue-select>
            </div>

            <base-form-input-error>
                <div v-show="errorMessage && cityStore.wilaya.wilaya_code === ''" class="mt-2 text-danger">
                    {{ $t('validation.required', { attribute: $t('wilaya') }) }}
                </div>
            </base-form-input-error>
        </div>

        <div>
            <base-form-label for="dairas">{{ $t('daira') }}</base-form-label>

            <div>
                <base-vue-select
                    id="dairas"
                    v-model:value="daira"
                    :options="dairas"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('daira') })"
                    class="tom-select w-full"
                    label="daira_name"
                    track-by="id"
                ></base-vue-select>
            </div>

            <base-form-input-error>
                <div v-if="errorMessage && cityStore.daira.daira_name === ''" class="mt-2 text-danger">
                    {{ $t('validation.required', { attribute: $t('daira') }) }}
                </div>
            </base-form-input-error>
        </div>

        <div>
            <base-form-label for="communes">
                {{ $t('commune') }}
            </base-form-label>

            <div>
                <base-vue-select
                    id="communes"
                    v-model:value="commune"
                    :options="communes"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('commune') })"
                    class="tom-select w-full"
                    label="commune_name"
                    track-by="id"
                ></base-vue-select>
            </div>

            <base-form-input-error>
                <div v-if="errorMessage" class="mt-2 text-danger">
                    {{ Array.isArray(errorMessage) ? errorMessage[0] : errorMessage }}
                </div>
            </base-form-input-error>
        </div>
    </div>
</template>
