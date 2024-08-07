<script lang="ts" setup>
import { useCityStore } from '@/stores/city'
import { onMounted, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

const props = defineProps<{
    errorMessage?: string | string[]
    city: any
}>()

const commune = defineModel('commune', { default: '' })

const selectedCommune = defineModel('selectedCommune', { default: '' })

const cityStore = useCityStore()

onMounted(async () => {
    if (props.city) {
        await cityStore.fetchCommunes(props.city.daira_name, props.city.wilaya_code)

        selectedCommune.value = cityStore.getCommune(props.city.id)
    }
})

const emit = defineEmits(['update:modelValue'])

const handleChange = () => {
    commune.value = selectedCommune.value
}

watch(
    () => commune.value,
    (value) => {
        selectedCommune.value = value
    }
)
</script>

<template>
    <div>
        <base-form-label for="communes">
            {{ $t('commune') }}
        </base-form-label>

        <div>
            <!-- @vue-ignore -->
            <base-vue-select
                id="communes"
                v-model:value="selectedCommune"
                :options="cityStore.communes"
                :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('commune') })"
                class="tom-select w-full"
                label="commune_name"
                track-by="id"
                @update:value="handleChange"
            ></base-vue-select>
        </div>

        <base-form-input-error>
            <div v-if="errorMessage" class="mt-2 text-danger">
                {{ Array.isArray(errorMessage) ? errorMessage[0] : errorMessage }}
            </div>
        </base-form-input-error>
    </div>
</template>
