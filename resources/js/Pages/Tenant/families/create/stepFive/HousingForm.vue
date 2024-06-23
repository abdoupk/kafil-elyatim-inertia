<script setup lang="ts">
import type { CreateFamilyForm, HousingType } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'
import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseInputGroup from '@/Components/Base/form/InputGroup/BaseInputGroup.vue'
import BaseInputGroupText from '@/Components/Base/form/InputGroup/BaseInputGroupText.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'

defineProps<{ form: Form<CreateFamilyForm> }>()

const independent = defineModel('independent')

const withFamily = defineModel('withFamily')

const inheritance = defineModel('inheritance')

const tenant = defineModel('tenant')

const other = defineModel('other')

const numberOfRooms = defineModel('numberOfRooms')

const housingReceiptNumber = defineModel('housingReceiptNumber')

const items = ref<Record<keyof HousingType, boolean>>({
    with_family: false,
    independent: false,
    Inheritance: false,
    tenant: false,
    other: false,
    number_of_rooms: false,
    housing_receipt_number: false
})

const toggle = (key: keyof HousingType) => {
    items.value[key] = !items.value[key]
}
</script>

<template>
    <div class="intro-x mt-2">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input
                    @click="toggle('independent')"
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
                <div class="mt-2 text-danger col-start-5 -ms-1 col-end-12" v-if="form?.invalid('housing.independent')">
                    {{ form.errors['housing.independent'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input
                    @click="toggle('with_family')"
                    id="with_family"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="with_family">
                    {{ $t('housing.label.with_family') }}
                </base-form-switch-label>
            </base-form-switch>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div class="mt-2 text-danger col-start-5 -ms-1 col-end-12" v-if="form?.invalid('housing.with_family')">
                    {{ form.errors['housing.with_family'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input
                    @click="toggle('inheritance')"
                    id="inheritance"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="inheritance">
                    {{ $t('housing.label.inheritance') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-form-input
                class="w-3/4"
                formInputSize="sm"
                :disabled="!items.inheritance"
                @change="form?.validate('housing.inheritance')"
                type="text"
                maxlength="6"
                :placeholder="$t('')"
                v-model="inheritance"
            ></base-form-input>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div class="mt-2 text-danger col-start-5 -ms-1 col-end-12" v-if="form?.invalid('housing.inheritance')">
                    {{ form.errors['housing.inheritance'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input @click="toggle('tenant')" id="tenant" type="checkbox"></base-form-switch-input>

                <base-form-switch-label htmlFor="tenant">
                    {{ $t('housing.label.tenant') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.tenant"
                    @change="form?.validate('housing.tenant')"
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="tenant"
                    class="w-full"
                ></base-form-input>
            </base-input-group>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div class="mt-2 text-danger col-start-5 -ms-1 col-end-12" v-if="form?.invalid('housing.tenant')">
                    {{ form.errors['housing.tenant'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input @click="toggle('other')" id="other" type="checkbox"></base-form-switch-input>

                <base-form-switch-label htmlFor="other">
                    {{ $t('housing.label.other') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.other"
                    @change="form?.validate('housing.other')"
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="other"
                ></base-form-input>

                <base-input-group-text>
                    {{ $t('DA') }}
                </base-input-group-text>
            </base-input-group>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div class="mt-2 text-danger col-start-5 -ms-1 col-end-12" v-if="form?.invalid('housing.other')">
                    {{ form.errors['housing.other'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <div class="text-lg w-1/4">
                <p class="ms-11">
                    {{ $t('housing.label.number_of_rooms') }}
                </p>
            </div>

            <base-input-group>
                <base-form-input
                    @change="form?.validate('housing.number_of_rooms')"
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="number_of_rooms"
                ></base-form-input>

                <base-input-group-text>
                    {{ $t('DA') }}
                </base-input-group-text>
            </base-input-group>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="form?.invalid('housing.number_of_rooms')"
                >
                    {{ form.errors['housing.number_of_rooms'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <div class="text-lg w-1/4">
                <p class="ms-11">
                    {{ $t('housing.label.housing_receipt_number') }}
                </p>
            </div>

            <base-input-group>
                <base-form-input
                    @change="form?.validate('housing.housing_receipt_number')"
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="housing_receipt_number"
                ></base-form-input>

                <base-input-group-text>
                    {{ $t('DA') }}
                </base-input-group-text>
            </base-input-group>
        </div>

        <div class="grid grid-cols-12">
            <base-form-input-error>
                <div
                    class="mt-2 text-danger col-start-5 -ms-1 col-end-12"
                    v-if="form?.invalid('housing.housing_receipt_number')"
                >
                    {{ form.errors['housing.housing_receipt_number'] }}
                </div>
            </base-form-input-error>
        </div>
    </div>
</template>
