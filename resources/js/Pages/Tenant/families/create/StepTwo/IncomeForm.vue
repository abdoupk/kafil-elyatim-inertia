<script setup lang="ts">
import type { CreateFamilyForm, IncomeType } from '@/types/types'

import type { Form } from 'laravel-precognition-vue/dist/types'
import { computed, ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseInputGroup from '@/Components/Base/form/InputGroup/BaseInputGroup.vue'
import BaseInputGroupText from '@/Components/Base/form/InputGroup/BaseInputGroupText.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'

import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

defineProps<{ form: Form<CreateFamilyForm> }>()

const cnr = defineModel('cnr')

const cnas = defineModel('cnas')

const casnos = defineModel('casnos')

const pension = defineModel('pension')

const account = defineModel('account')

const other_income = defineModel('other_income')

const totalIncome = computed(() => {
    let a =
        Number(cnr.value) +
        Number(cnas.value) +
        Number(casnos.value) +
        Number(pension.value) +
        Number(other_income.value) +
        Number(account.value)

    return new Intl.NumberFormat('ar-DZ', { style: 'currency', currency: 'DZD' }).format(a)
})

const items = ref<Record<keyof IncomeType, boolean>>({
    cnr: false,
    cnas: false,
    casnos: false,
    pension: false,
    other_income: false,
    account: true
})

const toggle = (key: keyof IncomeType) => {
    items.value[key] = !items.value[key]
}
</script>

<template>
    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input @click="toggle('cnr')" id="cnr" type="checkbox"></base-form-switch-input>

                <base-form-switch-label htmlFor="cnr">
                    {{ $t('incomes.label.cnr') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.cnr"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    @change="
                        form?.validate(
                            //@ts-ignore
                            'incomes.cnr'
                        )
                    "
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="cnr"
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
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'incomes.cnr'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['incomes.cnr']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input @click="toggle('cnas')" id="cnas" type="checkbox"></base-form-switch-input>

                <base-form-switch-label htmlFor="cnas">
                    {{ $t('incomes.label.cnas') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.cnas"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    @change="
                        form?.validate(
                            //@ts-ignore
                            'incomes.cnas'
                        )
                    "
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="cnas"
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
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'incomes.cnas'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['incomes.cnas']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input @click="toggle('casnos')" id="casnos" type="checkbox"></base-form-switch-input>

                <base-form-switch-label htmlFor="casnos">
                    {{ $t('incomes.label.casnos') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.casnos"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    @change="
                        form?.validate(
                            //@ts-ignore
                            'incomes.casnos'
                        )
                    "
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="casnos"
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
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'incomes.casnos'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['incomes.casnos']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input
                    @click="toggle('pension')"
                    id="pension"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="pension">
                    {{ $t('incomes.label.pension') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.pension"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    @change="
                        form?.validate(
                            //@ts-ignore
                            'incomes.pension'
                        )
                    "
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="pension"
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
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'incomes.pension'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['incomes.pension']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <base-form-switch class="text-lg w-1/4">
                <!-- TODO add tabindex = -1 to prevent focus -->
                <base-form-switch-input
                    @click="toggle('other_income')"
                    id="other"
                    type="checkbox"
                ></base-form-switch-input>

                <base-form-switch-label htmlFor="other">
                    {{ $t('incomes.label.other_income') }}
                </base-form-switch-label>
            </base-form-switch>

            <base-input-group>
                <base-form-input
                    :disabled="!items.other_income"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    @change="
                        form?.validate(
                            //@ts-ignore
                            'incomes.other_income'
                        )
                    "
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="other_income"
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
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'incomes.other_income'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['incomes.other_income']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <div class="intro-x mt-6">
        <div class="flex gap-16">
            <div class="text-lg w-1/4">
                <p class="ms-11">
                    {{ $t('incomes.label.account') }}
                </p>
            </div>

            <base-input-group>
                <base-form-input
                    @change="
                        form?.validate(
                            //@ts-ignore
                            'incomes.account'
                        )
                    "
                    @keydown="allowOnlyNumbersOnKeyDown"
                    type="text"
                    maxlength="6"
                    :placeholder="$t('the_amount')"
                    v-model="account"
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
                    v-if="
                        form?.invalid(
                            //@ts-ignore
                            'incomes.account'
                        )
                    "
                >
                    {{
                        //@ts-ignore
                        form.errors['incomes.account']
                    }}
                </div>
            </base-form-input-error>
        </div>
    </div>

    <hr class="mt-6 mb-4" />

    <div class="flex gap-16 intro-x">
        <div class="text-lg w-1/4">
            <p class="ms-11">
                {{ $t('incomes.label.total_income') }}
            </p>
        </div>

        <p class="font-bold text-base">{{ totalIncome }}</p>
    </div>
</template>
