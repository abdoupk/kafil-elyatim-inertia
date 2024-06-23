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

defineProps<{ form: Form<CreateFamilyForm> }>()

const housingType = ref<{ name: HousingType; value: boolean | string | number }>({
    name: 'independent',
    value: false
})

type HousingType = 'independent' | 'with_family' | 'tenant' | 'inheritance' | 'other'

const toggle = (key: HousingType, value?: string | number | boolean) => {
    housingType.value.name = key

    if (value) housingType.value.value = value
}
</script>

<template>
    {{ housingType }}
    <div class="intro-x mt-2">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <base-form-switch-input
                    @change="(event: Event) => toggle('independent', (event.target as HTMLInputElement).checked)"
                    :checked="housingType.name === 'independent'"
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
            <base-form-switch class="text-lg w-1/4">
                <base-form-switch-input
                    @change="(event: Event) => toggle('with_family', (event.target as HTMLInputElement).checked)"
                    id="with_family"
                    :checked="housingType.name === 'with_family'"
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
        <div class="flex gap-16">
            <base-form-switch class="text-lg md:w-1/2">
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

            <div class="w-full">
                <base-form-input
                    :disabled="housingType.name !== 'inheritance'"
                    class="w-3/4"
                    @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                    type="text"
                    :placeholder="$t('the_amount')"
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
        <div class="flex gap-16">
            <base-form-switch class="text-lg md:w-1/2">
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

            <div class="w-full">
                <base-form-input
                    :disabled="housingType.name !== 'tenant'"
                    class="w-3/4"
                    @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                    type="text"
                    :placeholder="$t('the_amount')"
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
        <div class="flex gap-16">
            <base-form-switch class="text-lg md:w-1/2">
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

            <div class="w-full">
                <base-form-input
                    :disabled="housingType.name !== 'other'"
                    class="w-3/4"
                    @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                    type="text"
                    :placeholder="$t('the_amount')"
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

    <div class="flex gap-16 mt-6">
        <div class="text-lg md:w-1/2">
            <p class="ms-11">
                {{ $t('housing.label.number_of_rooms') }}
            </p>
        </div>

        <div class="w-full">
            <base-form-input
                class="w-3/4"
                @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                type="text"
                :placeholder="$t('the_amount')"
            ></base-form-input>
        </div>
    </div>

    <div class="flex gap-16 mt-6">
        <div class="text-lg md:w-1/2">
            <p class="ms-11">
                {{ $t('housing.label.housing_receipt_number') }}
            </p>
        </div>

        <div class="w-full">
            <base-form-input
                class="w-3/4"
                @input="(event) => (housingType.value = (event.target as HTMLInputElement).value)"
                type="text"
                :placeholder="$t('the_amount')"
            ></base-form-input>
        </div>
    </div>
</template>
