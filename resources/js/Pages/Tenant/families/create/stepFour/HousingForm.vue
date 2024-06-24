<script setup lang="ts">
/* eslint-disable vue/no-parsing-error */
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'
import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'

type HousingType = 'independent' | 'with_family' | 'tenant' | 'inheritance' | 'other'

defineProps<{ form: Form<CreateFamilyForm> }>()

const emit = defineEmits(['setHouseType'])

const numberOfRooms = defineModel('numberOfRooms')

const housingReceiptNumber = defineModel('housingReceiptNumber')

const items = ref<Record<HousingType, boolean>>({
    independent: false,
    with_family: false,
    tenant: false,
    inheritance: false,
    other: false
})

const housingType = ref<{ name: HousingType; value: boolean | string | number | null }>({
    name: 'independent',
    value: false
})

const toggle = (key: HousingType, value?: string | number | boolean) => {
    housingType.value.name = key

    items.value[key] = !items.value[key]

    Object.keys(items.value).forEach((item) => {
        if (item !== key) items.value[item as HousingType] = false
    })

    if (value) housingType.value.value = value
    else housingType.value.value = null

    emit('setHouseType', housingType.value)
}

const setValue = (event: Event) => {
    housingType.value.value = (event.target as HTMLInputElement).value

    emit('setHouseType', housingType.value)
}
</script>

<template>
    <div class="intro-x mt-2">
        <div class="flex gap-16">
            <base-form-switch class="text-lg">
                <base-form-switch-input
                    @change="(event: Event) => toggle('independent', (event.target as HTMLInputElement).checked)"
                    :checked="housingType.name === 'independent' && housingType.value === true"
                    id="independent"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="independent">
                    {{ $t('housing.label.independent') }}
                </base-form-switch-label>
            </base-form-switch>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.independent'
                        )
                    "
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.independent']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg">
                <base-form-switch-input
                    @change="(event: Event) => toggle('with_family', (event.target as HTMLInputElement).checked)"
                    id="with_family"
                    :checked="housingType.name === 'with_family' && housingType.value === true"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="with_family">
                    {{ $t('housing.label.with_family') }}
                </base-form-switch-label>
            </base-form-switch>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.with_family'
                        )
                    "
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.with_family']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex flex-col md:gap-16 md:flex-row mt-6">
            <base-form-switch class="text-lg md:w-1/2 w-full">
                <base-form-switch-input
                    @change="toggle('inheritance')"
                    id="inheritance"
                    :checked="housingType.name === 'inheritance'"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="inheritance">
                    {{ $t('housing.label.inheritance') }}
                </base-form-switch-label>
            </base-form-switch>

            <div class="w-full mt-2 md:mt-0">
                <base-form-input
                    :disabled="!items.inheritance"
                    class="w-full md:w-3/4"
                    @input="setValue"
                    type="text"
                    :placeholder="$t('housing.placeholders.inheritance')"
                ></base-form-input>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.inheritance'
                        )
                    "
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.inheritance']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex flex-col md:gap-16 md:flex-row mt-6">
            <base-form-switch class="text-lg md:w-1/2 w-full">
                <base-form-switch-input
                    @change="toggle('tenant')"
                    id="tenant"
                    :checked="housingType.name === 'tenant'"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="tenant">
                    {{ $t('housing.label.tenant') }}
                </base-form-switch-label>
            </base-form-switch>

            <div class="w-full mt-2 md:mt-0">
                <base-form-input
                    :disabled="!items.tenant"
                    class="w-full md:w-3/4"
                    @input="setValue"
                    type="text"
                    :placeholder="$t('housing.placeholders.tenant')"
                ></base-form-input>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.tenant'
                        )
                    "
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.tenant']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex flex-col md:gap-16 md:flex-row mt-6">
            <base-form-switch class="text-lg md:w-1/2 w-full">
                <base-form-switch-input
                    @change="toggle('other')"
                    id="other"
                    :checked="housingType.name === 'other'"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="other">
                    {{ $t('housing.label.other') }}
                </base-form-switch-label>
            </base-form-switch>

            <div class="w-full mt-2 md:mt-0">
                <base-form-input
                    :disabled="!items.other"
                    class="w-full md:w-3/4"
                    @input="setValue"
                    type="text"
                    :placeholder="$t('housing.placeholders.other')"
                ></base-form-input>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.other'
                        )
                    "
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.other']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="flex flex-col md:gap-16 md:flex-row mt-6">
        <div class="text-lg md:w-1/2 w-full">
            <p class="md:ms-11">
                {{ $t('housing.label.number_of_rooms') }}
            </p>
        </div>

        <div class="w-full">
            <base-form-input
                v-model="numberOfRooms"
                class="w-full md:w-3/4"
                @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                type="text"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('housing.label.number_of_rooms')
                    })
                "
            ></base-form-input>
        </div>
    </div>

    <div class="flex flex-col md:gap-16 md:flex-row mt-6">
        <div class="text-lg md:w-1/2 w-full">
            <p class="md:ms-11">
                {{ $t('housing.label.housing_receipt_number') }}
            </p>
        </div>

        <div class="w-full mt-2 md:mt-0">
            <base-form-input
                v-model="housingReceiptNumber"
                class="w-full md:w-3/4"
                :placeholder="$t('housing.placeholders.housing_receipt_number')"
                @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                type="text"
            ></base-form-input>
        </div>
    </div>
</template>
