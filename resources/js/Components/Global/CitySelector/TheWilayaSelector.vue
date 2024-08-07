<script lang="ts" setup>
import { useCityStore } from '@/stores/city'
import { onMounted, ref, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

defineProps<{
    errorMessage?: string | string[]
}>()

const cityStore = useCityStore()

const selectedWilaya = ref('')

const wilaya = defineModel('wilaya', { default: '' })

const handleChange = (value: string) => {
    wilaya.value = value
}

onMounted(async () => {
    await cityStore.fetchWilayas()

    if (wilaya.value.wilaya_code) {
        selectedWilaya.value = cityStore.getWilaya(wilaya.value.wilaya_code)
    }
})

watch(
    () => wilaya.value,
    (value) => {
        if (value?.wilaya_code) {
            selectedWilaya.value = cityStore.getWilaya(value)

            cityStore.fetchDairas(value)
        }
    }
)
</script>

<template>
    <div>
        <base-form-label for="wilayas">
            {{ $t('wilaya') }}
        </base-form-label>

        <div>
            <!-- @vue-ignore -->
            <base-vue-select
                id="wilayas"
                v-model:value="selectedWilaya"
                :options="cityStore.wilayas"
                :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('wilaya') })"
                class="h-full w-full"
                label="wilaya_name"
                track-by="wilaya_code"
                @update:value="handleChange"
            >
            </base-vue-select>
        </div>

        <base-form-input-error>
            <div v-show="errorMessage && cityStore.wilaya.wilaya_code === ''" class="mt-2 text-danger">
                {{ $t('validation.required', { attribute: $t('wilaya') }) }}
            </div>
        </base-form-input-error>
    </div>
</template>
