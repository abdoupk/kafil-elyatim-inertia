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

const selectedDaira = ref('')

const daira = defineModel('daira', { default: '' })

const wilaya = defineModel('wilaya', { default: '' })

onMounted(async () => {
    if (wilaya.value.daira_name) {
        await cityStore.fetchDairas(wilaya.value.wilaya_code)

        selectedDaira.value = cityStore.getDaira(wilaya.value.daira_name)
    }
})

const handleChange = (value: string) => {
    daira.value = value
}

watch(
    () => selectedDaira.value,
    (value) => {
        selectedDaira.value = value
    }
)

// Watch(
//     () => wilaya.value,
//     () => {
//         SelectedDaira.value = ''
//     }
// )
</script>

<template>
    <div>
        <base-form-label for="dairas">
            {{ $t('daira') }}
        </base-form-label>

        <div>
            <!-- @vue-ignore -->
            <base-vue-select
                id="dairas"
                v-model:value="selectedDaira"
                :options="cityStore.dairas"
                :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('daira') })"
                class="h-full w-full"
                label="daira_name"
                track-by="id"
                @update:value="handleChange"
            >
            </base-vue-select>
        </div>

        <base-form-input-error>
            <div v-show="errorMessage && cityStore.daira.daira_name === ''" class="mt-2 text-danger">
                {{ $t('validation.required', { attribute: $t('daira') }) }}
            </div>
        </base-form-input-error>
    </div>
</template>
