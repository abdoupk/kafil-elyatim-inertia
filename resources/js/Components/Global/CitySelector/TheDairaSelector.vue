<script lang="ts" setup>
import { useCityStore } from '@/stores/city'
import { onMounted, ref, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

const props = defineProps<{
    errorMessage?: string | string[]
    city: any
}>()

const cityStore = useCityStore()

const selectedDaira = ref('selectedDaira')

const daira = defineModel('daira')

const emit = defineEmits(['update:modelValue'])

onMounted(async () => {
    if (props.city) {
        await cityStore.fetchDairas(props.city.wilaya_code)

        selectedDaira.value = cityStore.getDaira(props.city.daira_name)
    }
})

const handleChange = async () => {
    cityStore.daira = cityStore.getDaira(selectedDaira.value.daira_name)

    selectedDaira.value = cityStore.getDaira(selectedDaira.value.daira_name)

    await cityStore.fetchCommunes(cityStore.daira.daira_name, cityStore.wilaya.wilaya_code)

    daira.value = selectedDaira.value

    emit('update:modelValue', selectedDaira.value)
}

watch(
    () => daira.value,
    (value) => {
        selectedDaira.value = value
    }
)
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
