<script lang="ts" setup>
import type { Commune, Daira, Wilaya } from '@/types/types'

import { useCityStore } from '@/stores/city'
import TomSelect from 'tom-select'
import { onMounted, ref, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseTomSelect from '@/Components/Base/tom-select/BaseTomSelect.vue'

const communesTom = ref<TomSelect>()

const dairasTom = ref<TomSelect>()

const wilaya = ref('')

const wilayas = ref<Wilaya[]>([])

const cityStore = useCityStore()

defineProps<{ errorMessage?: string | string[] }>()

const emit = defineEmits(['select:commune'])

const updateWilaya = (wilaya: string | string[]) => {
    if (typeof wilaya === 'string') {
        cityStore.fetchDairas(wilaya).then((res) => {
            dairasTom.value?.clear()

            dairasTom.value?.clearOptions()

            res.data.forEach((daira: Daira) => {
                dairasTom.value?.addOption({
                    text: daira.daira_name,
                    value: daira.daira_name
                })

                if (wilaya !== '') {
                    dairasTom.value?.open()
                }
            })
        })
    }
}

const updateDaira = (daira_name: string) => {
    cityStore.fetchCommunes(daira_name, wilaya.value).then((res) => {
        communesTom.value?.clear()

        communesTom.value?.clearOptions()

        res.data.forEach((commune: Commune) => {
            communesTom.value?.addOption({
                text: commune.commune_name,
                value: commune.id
            })
        })

        if (daira_name != '') {
            communesTom.value?.open()
        }
    })
}

watch(
    () => wilaya.value,
    (wilaya) => {
        cityStore.wilaya = {
            wilaya_name: wilayas.value.find((w) => w.wilaya_code === wilaya)?.wilaya_name,
            wilaya_code: wilaya
        }
    }
)

const initTomSelects = () => {
    dairasTom.value = new TomSelect('#dairas', {
        plugins: {
            dropdown_input: {}
        }
    })

    communesTom.value = new TomSelect('#communes', {
        plugins: {
            dropdown_input: {}
        }
    })

    if (cityStore.wilaya.wilaya_code !== '') {
        wilaya.value = cityStore.wilaya.wilaya_code
    }

    if (cityStore.daira.daira_name !== '') {
        dairasTom.value?.addOption({
            text: cityStore.daira.daira_name,
            value: cityStore.daira.daira_name
        })

        dairasTom.value?.addItem(cityStore.daira.daira_name, true)

        // @ts-expect-error
        dairasTom.value?.setActiveItem(cityStore.daira.daira_name)
    }

    if (cityStore.commune.commune_name !== '') {
        communesTom.value?.addOption({
            text: cityStore.commune.commune_name,
            value: cityStore.commune.id
        })

        // @ts-expect-error
        communesTom.value?.addItem(cityStore.commune.id, true)

        // @ts-expect-error
        communesTom.value?.setActiveItem(cityStore.commune.id)
    }

    dairasTom.value.on('change', ($e: string) => {
        updateDaira($e)

        cityStore.daira = {
            daira_name: $e
        }
    })

    communesTom.value.on('change', ($e: string) => {
        emit('select:commune', $e)

        cityStore.commune = {
            id: parseInt($e),
            commune_name: communesTom.value?.getOption($e)?.textContent
        }

        emit('select:commune', $e)
    })
}

onMounted(() => {
    initTomSelects()

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
                <base-tom-select
                    id="wilayas"
                    v-model="wilaya"
                    :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('wilaya') })"
                    :options="{ maxOptions: 58 }"
                    class="h-full w-full"
                    @update:modelValue="updateWilaya"
                >
                    <option v-for="wilaya in wilayas" :key="wilaya.wilaya_code" :value="wilaya.wilaya_code">
                        {{ wilaya.wilaya_name }}
                    </option>
                </base-tom-select>
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
                <select
                    id="dairas"
                    :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('daira') })"
                    class="tom-select w-full"
                ></select>
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
                <select
                    id="communes"
                    :data-placeholder="$t('auth.placeholders.tomselect', { attribute: $t('commune') })"
                    class="tom-select w-full"
                ></select>
            </div>
            <base-form-input-error>
                <div v-if="errorMessage" class="mt-2 text-danger">
                    {{ Array.isArray(errorMessage) ? errorMessage[0] : errorMessage }}
                </div>
            </base-form-input-error>
        </div>
    </div>
</template>
