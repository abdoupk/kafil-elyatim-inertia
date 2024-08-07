<script lang="ts" setup>
import { useCityStore } from '@/stores/city'
import { onMounted, ref, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

defineProps<{
    errorMessage?: string | string[]
}>()

const commune = defineModel('commune', { default: '' })

const wilaya = defineModel('wilaya', { default: '' })

const daira = defineModel('daira', { default: '' })

const selectedCommune = ref('')

const cityStore = useCityStore()

onMounted(async () => {
    if (wilaya.value.wilaya_code && daira.value.daira_name && commune.value.id) {
        await cityStore.fetchCommunes(daira.value.daira_name, wilaya.value.wilaya_code)

        selectedCommune.value = cityStore.getCommune(commune.value.id)
    }
})

watch(
    () => [wilaya.value, daira.value],
    () => {
        selectedCommune.value = ''
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
                @update:value="(value) => (commune = value)"
            ></base-vue-select>
        </div>

        <base-form-input-error>
            <div v-if="errorMessage" class="mt-2 text-danger">
                {{ Array.isArray(errorMessage) ? errorMessage[0] : errorMessage }}
            </div>
        </base-form-input-error>
    </div>
</template>
