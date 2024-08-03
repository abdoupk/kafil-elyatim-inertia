<script lang="ts" setup>
import type { CreateFamilyForm } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'
import { onMounted, ref } from 'vue'

import BaseAlert from '@/Components/Base/Alert/BaseAlert.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

export type HousingType = 'independent' | 'with_family' | 'tenant' | 'inheritance' | 'other'

defineProps<{ form: Form<CreateFamilyForm> }>()

const numberOfRooms = defineModel('numberOfRooms')

const housingReceiptNumber = defineModel('housingReceiptNumber')

const items = ref<Record<HousingType, boolean>>({
    independent: false,
    with_family: false,
    tenant: false,
    inheritance: false,
    other: false
})

const housingType = defineModel<{
    name: HousingType
    value: string | number | boolean | null
}>('housingType', {
    default: {
        value: null,
        name: 'independent'
    }
})

const toggle = (key: HousingType, value?: string | number | boolean) => {
    if (housingType.value) housingType.value.name = key

    items.value[key] = !items.value[key]

    Object.keys(items.value).forEach((item) => {
        if (item !== key) items.value[item as HousingType] = false
    })

    if (housingType.value) {
        value ? (housingType.value.value = value) : (housingType.value.value = null)
    }
}

const setValue = (event: Event) => {
    if (housingType.value) housingType.value.value = (event.target as HTMLInputElement).value
}

onMounted(() => {
    if (housingType.value) items.value[housingType.value.name] = true
})
</script>

<template>
    <base-form-input-error>
        <base-alert
            v-if="
                form.invalid(
                    // @ts-ignore
                    'housing.housing_type.value'
                )
            "
            class="flex items-center mb-2 w-full sm:w-1/2"
            variant="soft-danger"
        >
            <svg-loader class="w-6 h-6 me-2 fill-current" name="icon-circle-exclamation"></svg-loader>
            {{
                // @ts-ignore
                form.errors['housing.housing_type.value']
            }}
        </base-alert>
    </base-form-input-error>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg">
                <base-form-switch-input
                    id="independent"
                    :checked="housingType?.name === 'independent' && housingType?.value === true"
                    type="checkbox"
                    @change="(event: Event) => toggle('independent', (event.target as HTMLInputElement).checked)"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="independent">
                    {{ $t('housing.label.independent') }}
                </base-form-switch-label>
            </base-form-switch>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.independent'
                        )
                    "
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
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
                    id="with_family"
                    :checked="housingType?.name === 'with_family' && housingType?.value === true"
                    type="checkbox"
                    @change="(event: Event) => toggle('with_family', (event.target as HTMLInputElement).checked)"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="with_family">
                    {{ $t('housing.label.with_family') }}
                </base-form-switch-label>
            </base-form-switch>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.with_family'
                        )
                    "
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
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
                    id="inheritance"
                    :checked="housingType?.name === 'inheritance'"
                    type="checkbox"
                    @change="toggle('inheritance')"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="inheritance">
                    {{ $t('housing.label.inheritance') }}
                </base-form-switch-label>
            </base-form-switch>

            <div class="w-full mt-2 md:mt-0">
                <base-form-input
                    :disabled="housingType?.name !== 'inheritance' || !items.inheritance"
                    :placeholder="$t('housing.placeholders.inheritance')"
                    :value="housingType?.name === 'inheritance' ? housingType?.value : null"
                    class="w-full md:w-3/4"
                    type="text"
                    @input="setValue"
                ></base-form-input>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.inheritance'
                        )
                    "
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
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
                    id="tenant"
                    :checked="housingType?.name === 'tenant'"
                    type="checkbox"
                    @change="toggle('tenant')"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="tenant">
                    {{ $t('housing.label.tenant') }}
                </base-form-switch-label>
            </base-form-switch>

            <div class="w-full mt-2 md:mt-0">
                <base-form-input
                    :disabled="housingType?.name !== 'tenant' || !items.tenant"
                    :placeholder="$t('housing.placeholders.tenant')"
                    :value="housingType?.name === 'tenant' ? housingType?.value : null"
                    class="w-full md:w-3/4"
                    type="text"
                    @input="setValue"
                ></base-form-input>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.tenant'
                        )
                    "
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
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
                    id="other"
                    :checked="housingType?.name === 'other'"
                    type="checkbox"
                    @change="toggle('other')"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="other">
                    {{ $t('housing.label.other') }}
                </base-form-switch-label>
            </base-form-switch>

            <div class="w-full mt-2 md:mt-0">
                <base-form-input
                    :disabled="housingType?.name !== 'other' || !items.other"
                    :placeholder="$t('housing.placeholders.other')"
                    :value="housingType?.name === 'other' ? housingType.value : null"
                    class="w-full md:w-3/4"
                    type="text"
                    @input="setValue"
                ></base-form-input>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.other'
                        )
                    "
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.other']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="flex flex-col md:gap-16 md:flex-row mt-6 intro-x">
        <div class="text-lg md:w-1/2 w-full">
            <p class="md:ms-11">
                {{ $t('housing.label.number_of_rooms') }}
            </p>
        </div>

        <div class="w-full">
            <base-form-input
                v-model="numberOfRooms"
                :placeholder="
                    $t('auth.placeholders.fill', {
                        attribute: $t('housing.label.number_of_rooms')
                    })
                "
                class="w-full md:w-3/4"
                type="text"
                @keydown="allowOnlyNumbersOnKeyDown"
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.number_of_rooms'
                        )
                    "
                    class="mt-2 text-danger col-start-5 col-end-12"
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.number_of_rooms']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="flex flex-col md:gap-16 md:flex-row mt-6 intro-x">
        <div class="text-lg md:w-1/2 w-full">
            <p class="md:ms-11">
                {{ $t('housing.label.housing_receipt_number') }}
            </p>
        </div>

        <div class="w-full mt-2 md:mt-0">
            <base-form-input
                v-model="housingReceiptNumber"
                :placeholder="$t('housing.placeholders.housing_receipt_number')"
                class="w-full md:w-3/4"
                type="text"
            ></base-form-input>

            <base-form-input-error>
                <div
                    v-if="
                        form?.invalid(
                            // @ts-ignore
                            'housing.housing_receipt_number'
                        )
                    "
                    class="mt-2 text-danger col-start-5 col-end-12"
                >
                    {{
                        // @ts-ignore
                        form.errors['housing.housing_receipt_number']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>
</template>
