<script lang="ts" setup>
import { useNeedsStore } from '@/stores/needs'
import { onMounted, ref, watch } from 'vue'

import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { __ } from '@/utils/i18n'

const needableType = defineModel('needableType', { default: 'orphan' })

const needable = defineModel('needable', { default: '' })

const needStore = useNeedsStore()

const people = ref([])

defineProps<{ errorMessage?: string | string[] }>()

watch(
    () => needableType.value,
    (needableType) => {
        needable.value = ''

        people.value = []

        if (needableType === 'orphan') {
            needStore.getOrphans().then((res) => {
                people.value = res.data
            })
        } else {
            needStore.getSponsors().then((res) => {
                people.value = res.data
            })
        }
    }
)

const needableTypes = [
    {
        label: 'the_orphan',
        value: 'orphan'
    },
    {
        label: 'the_sponsor',
        value: 'sponsor'
    }
]

const needableTypesLabels = ({ label }: { label: string }) => {
    return __(label)
}

onMounted(() => {
    needStore.getOrphans().then((res) => {
        people.value = res.data
    })
})
</script>

<template>
    <div class="grid w-full flex-1 grid-cols-1 gap-4 gap-y-5 lg:grid-cols-2">
        <div>
            <base-form-label for="needable_type">
                {{ $t('needable_type') }}
            </base-form-label>

            <div>
                <base-vue-select
                    id="needable_type"
                    :custom-label="needableTypesLabels"
                    :options="needableTypes"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('needable_type') })"
                    class="h-full w-full"
                    label="label"
                    track_by="value"
                    @update:value="
                        (type) => {
                            needableType = type.value
                        }
                    "
                >
                </base-vue-select>
            </div>
        </div>

        <div>
            <base-form-label for="needable">{{ $t('the_requester') }}</base-form-label>

            <div>
                <base-vue-select
                    id="needable"
                    v-model:value="needable"
                    :options="people"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_requester') })"
                    class="tom-select w-full"
                    label="name"
                    track-by="id"
                ></base-vue-select>
            </div>

            <base-form-input-error>
                <div v-if="errorMessage" class="mt-2 text-danger">
                    {{ $t('validation.required', { attribute: $t('the_requester') }) }}
                </div>
            </base-form-input-error>
        </div>
    </div>
</template>
