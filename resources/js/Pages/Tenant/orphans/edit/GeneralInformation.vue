<script lang="ts" setup>
import type { OrphanUpdateFormType } from '@/types/orphans'
import type { ClothesSizesType, ShoesSizesType } from '@/types/types'

import dayjs from 'dayjs'
import { useForm } from 'laravel-precognition-vue'
import { computed, reactive, ref } from 'vue'

import SpinnerButtonLoader from '@/Pages/Shared/SpinnerButtonLoader.vue'
import SuccessNotification from '@/Pages/Shared/SuccessNotification.vue'

import BaseVCalendar from '@/Components/Base/VCalendar/BaseVCalendar.vue'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseFormSelect from '@/Components/Base/form/BaseFormSelect.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

import { omit } from '@/utils/helper'

const props = defineProps<{
    orphan: OrphanUpdateFormType
    shoesSizes: ShoesSizesType
    clothesSizes: ClothesSizesType
}>()

const emit = defineEmits(['orphan-updated'])
console.log(props.orphan)
const isStillBaby = computed(() => {
    return dayjs().diff(dayjs(form.birth_date), 'year') < 2
})

// eslint-disable-next-line array-element-newline
const inputs = reactive<OrphanUpdateFormType>(
    // eslint-disable-next-line array-element-newline
    omit(props.orphan, ['sponsorships', 'academicAchievements', 'id', 'creator'])
)

const form = useForm('put', route('tenant.orphans.infos-update', props.orphan.id), inputs)

const updateSuccess = ref(false)

const submit = () => {
    form.submit({
        onSuccess() {
            updateSuccess.value = true

            Object.keys(form.errors).forEach((error) => {
                form.forgetError(error as keyof OrphanUpdateFormType)
            })

            emit('orphan-updated', { ...props.orphan, ...form.data() })
        },
        onFinish() {
            updateSuccess.value = false
        }
    })
}
</script>

<template>
    <!-- BEGIN: Orphan Information -->
    <div class="col-span-12 intro-y box 2xl:col-span-6 @container">
        <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
            <h2 class="me-auto text-xl font-bold">{{ $t('display information') }}</h2>
        </div>
        <form @submit.prevent="submit">
            <div class="p-5 grid grid-cols-12 gap-4">
                <!-- BEGIN: First Name -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="first_name">
                        {{ $t('validation.attributes.first_name') }}
                    </base-form-label>

                    <base-form-input
                        id="first_name"
                        v-model="form.first_name"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.first_name')
                            })
                        "
                        data-test="orphan_first_name"
                        type="text"
                        @change="form?.validate('first_name')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('first_name')"
                            class="mt-2 text-danger"
                            data-test="error_first_name_message"
                        >
                            {{ form.errors.first_name }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: First Name -->

                <!-- BEGIN: Last Name -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="last_name">
                        {{ $t('validation.attributes.last_name') }}
                    </base-form-label>

                    <base-form-input
                        id="last_name"
                        v-model="form.last_name"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.last_name')
                            })
                        "
                        data-test="orphan_last_name"
                        type="text"
                        @change="form?.validate('last_name')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('last_name')"
                            class="mt-2 text-danger"
                            data-test="error_last_name_message"
                        >
                            {{ form.errors.last_name }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Last Name -->

                <!-- BEGIN: BirthDate -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="birth_date">
                        {{ $t('validation.attributes.spouse.birth_date') }}
                    </base-form-label>

                    <base-v-calendar v-model:date="form.birth_date"></base-v-calendar>
                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('birth_date')"
                            class="mt-2 text-danger"
                            data-test="error_birth_date_message"
                        >
                            {{ form.errors.birth_date }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: BirthDate -->

                <!-- BEGIN: Family Status -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="family_status">
                        {{ $t('family_status') }}
                    </base-form-label>

                    <base-form-input
                        id="family_status"
                        v-model="form.family_status"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('family_status')
                            })
                        "
                        data-test="orphan_family_status"
                        type="text"
                        @change="form?.validate('family_status')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('family_status')"
                            class="mt-2 text-danger"
                            data-test="error_family_status_message"
                        >
                            {{ form.errors.family_status }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Family Status -->

                <!-- BEGIN: Academic Level -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="academic_level">
                        {{ $t('academic_level') }}
                    </base-form-label>

                    <base-form-input
                        id="academic_level"
                        v-model="form.academic_level"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('academic_level')
                            })
                        "
                        data-test="orphan_academic_level"
                        type="text"
                        @change="form?.validate('academic_level')"
                    ></base-form-input>

                    <base-form-input-error>
                        <div
                            v-if="form?.invalid('academic_level')"
                            class="mt-2 text-danger"
                            data-test="error_academic_level_message"
                        >
                            {{ form.errors.academic_level }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Academic Level -->

                <!-- BEGIN: Gender -->
                <div class="@xl:col-span-6 col-span-12">
                    <base-form-label for="gender">
                        {{ $t('validation.attributes.gender') }}
                    </base-form-label>

                    <base-form-select
                        id="gender"
                        v-model="form.gender"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.gender')
                            })
                        "
                        data-test="orphan_gender"
                        @change="form?.validate('gender')"
                    >
                        <option value="male">{{ $t('male') }}</option>
                        <option value="female">{{ $t('female') }}</option>
                    </base-form-select>

                    <base-form-input-error>
                        <div v-if="form?.invalid('gender')" class="mt-2 text-danger" data-test="error_gender_message">
                            {{ form.errors.gender }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Gender -->

                <template v-if="!isStillBaby">
                    <!-- BEGIN: Pants Size -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="pants_size">
                            {{ $t('pants_size') }}
                        </base-form-label>

                        <base-vue-select
                            id="pants_size"
                            :options="clothesSizes"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('pants_size')
                                })
                            "
                            data-test="orphan_pants_size"
                            label="label"
                            track-by="id"
                            v-model="form.pants_size"
                            @change="form.validate('pants_size')"
                        ></base-vue-select>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('pants_size')"
                                class="mt-2 text-danger"
                                data-test="error_pants_size_message"
                            >
                                {{ form.errors.pants_size }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Pants Size -->

                    <!-- BEGIN: Shirt Size -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="shirt_size">
                            {{ $t('shirt_size') }}
                        </base-form-label>

                        <base-vue-select
                            id="shirt_size"
                            :options="clothesSizes"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('shirt_size')
                                })
                            "
                            data-test="orphan_shirt_size"
                            label="label"
                            track-by="id"
                            v-model="form.shirt_size"
                            @change="form.validate('shirt_size')"
                        ></base-vue-select>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('shirt_size')"
                                class="mt-2 text-danger"
                                data-test="error_shirt_size_message"
                            >
                                {{ form.errors.shirt_size }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Shirt Size -->

                    <!-- BEGIN: Shoes Size -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="shoes_size">
                            {{ $t('shoes_size') }}
                        </base-form-label>

                        <base-vue-select
                            id="shoes_size"
                            :options="shoesSizes"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('shoes_size')
                                })
                            "
                            data-test="orphan_shoes_size"
                            label="label"
                            track-by="id"
                            v-model="form.shoes_size"
                            @change="form.validate('shoes_size')"
                        ></base-vue-select>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('shoes_size')"
                                class="mt-2 text-danger"
                                data-test="error_shoes_size_message"
                            >
                                {{ form.errors.shoes_size }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Shoes Size -->
                </template>

                <template v-else>
                    <!-- BEGIN: Diapers Type -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="diapers_type">
                            {{ $t('diapers_type') }}
                        </base-form-label>

                        <base-form-input
                            id="diapers_type"
                            v-model="form.diapers_type"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('diapers_type')
                                })
                            "
                            data-test="orphan_diapers_type"
                            type="text"
                            @change="form?.validate('diapers_type')"
                        ></base-form-input>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('diapers_type')"
                                class="mt-2 text-danger"
                                data-test="error_diapers_type_message"
                            >
                                {{ form.errors.diapers_type }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Diapers Type -->

                    <!-- BEGIN: Diapers Quantity -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="diapers_quantity">
                            {{ $t('diapers_quantity') }}
                        </base-form-label>

                        <base-form-input
                            id="diapers_quantity"
                            v-model="form.diapers_quantity"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('diapers_quantity')
                                })
                            "
                            data-test="orphan_diapers_quantity"
                            type="text"
                            @change="form?.validate('diapers_quantity')"
                        ></base-form-input>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('diapers_quantity')"
                                class="mt-2 text-danger"
                                data-test="error_diapers_quantity_message"
                            >
                                {{ form.errors.diapers_quantity }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Diapers Quantity -->

                    <!-- BEGIN: Baby Milk Type -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="baby_milk_type">
                            {{ $t('baby_milk_type') }}
                        </base-form-label>

                        <base-form-input
                            id="baby_milk_type"
                            v-model="form.baby_milk_type"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('baby_milk_type')
                                })
                            "
                            data-test="orphan_baby_milk_type"
                            type="text"
                            @change="form?.validate('baby_milk_type')"
                        ></base-form-input>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('baby_milk_type')"
                                class="mt-2 text-danger"
                                data-test="error_baby_milk_type_message"
                            >
                                {{ form.errors.baby_milk_type }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Baby Milk Type -->

                    <!-- BEGIN: Baby Milk Quantity -->
                    <div class="@xl:col-span-6 col-span-12">
                        <base-form-label for="baby_milk_quantity">
                            {{ $t('baby_milk_quantity') }}
                        </base-form-label>

                        <base-form-input
                            id="baby_milk_quantity"
                            v-model="form.baby_milk_quantity"
                            :placeholder="
                                $t('auth.placeholders.fill', {
                                    attribute: $t('baby_milk_quantity')
                                })
                            "
                            data-test="orphan_baby_milk_quantity"
                            type="text"
                            @change="form?.validate('baby_milk_quantity')"
                        ></base-form-input>

                        <base-form-input-error>
                            <div
                                v-if="form?.invalid('baby_milk_quantity')"
                                class="mt-2 text-danger"
                                data-test="error_baby_milk_quantity_message"
                            >
                                {{ form.errors.baby_milk_quantity }}
                            </div>
                        </base-form-input-error>
                    </div>
                    <!-- END: Baby Milk Quantity -->
                </template>

                <!-- BEGIN: Notes -->
                <div class="col-span-12">
                    <base-form-label for="note">
                        {{ $t('validation.attributes.note') }}
                    </base-form-label>

                    <base-form-text-area
                        id="note"
                        v-model="form.note"
                        :placeholder="
                            $t('auth.placeholders.fill', {
                                attribute: $t('validation.attributes.note')
                            })
                        "
                        data-test="orphan_note"
                        rows="8"
                        @change="form?.validate('note')"
                    ></base-form-text-area>

                    <base-form-input-error>
                        <div v-if="form?.invalid('note')" class="mt-2 text-danger" data-test="error_note_message">
                            {{ form.errors.note }}
                        </div>
                    </base-form-input-error>
                </div>
                <!-- END: Notes -->

                <base-button :disabled="form.processing" class="w-20 !mt-0" type="submit" variant="primary">
                    {{ $t('save') }}

                    <spinner-button-loader :show="form.processing" class="ms-auto"></spinner-button-loader>
                </base-button>
            </div>
        </form>
    </div>
    <!-- END: Orphan Information -->

    <success-notification :open="updateSuccess" :title="$t('successfully_updated')"></success-notification>
</template>
