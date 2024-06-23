<script setup lang="ts">
import type { RegistrationStepProps } from '@/types/types'

import { twMerge } from 'tailwind-merge'

import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormInline from '@/Components/Base/form/BaseFormInline.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormInputError from '@/Components/Base/form/BaseFormInputError.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

import { associationSocialMediaLinks } from '@/utils/constants'
import { allowOnlyNumbersOnKeyDown } from '@/utils/helper'

defineProps<RegistrationStepProps>()

const associationEmail = defineModel('association_email')

const landline = defineModel('landline')

const ccp = defineModel('ccp')

const cpa = defineModel('cpa')

const links = defineModel('links', { default: associationSocialMediaLinks })

const phones = defineModel('phones', { default: [''] })

const addPhone = () => {
    if (phones.value.length < 3) phones.value.push('')
}

const removePhone = (index: number) => {
    if (phones.value.length > 1) phones.value.splice(index, 1)
}
</script>

<template>
    <div
        class="mt-10 border-t border-slate-200/60 px-5 pt-10 dark:border-darkmode-400 sm:px-20"
        v-if="currentStep === 3"
    >
        <div class="text-base font-medium">
            {{ $t('auth.register.stepThree.title') }}
        </div>

        <div class="mt-5 grid grid-cols-12 gap-4 gap-y-5">
            <div class="intro-y col-span-12 md:col-span-6">
                <base-form-label for="association_email">
                    {{ $t('association_email') }}
                </base-form-label>

                <base-form-input
                    autofocus
                    id="association_email"
                    type="email"
                    dir="ltr"
                    v-model="associationEmail"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('association_email')
                        })
                    "
                    @change="form?.validate('association_email')"
                ></base-form-input>

                <base-form-input-error>
                    <div
                        data-test="error_association_email_message"
                        class="mt-2 text-danger"
                        v-if="form?.invalid('association_email')"
                    >
                        {{ form.errors.association_email }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 md:col-span-6">
                <base-form-label for="landline">
                    {{ $t('landline') }}
                </base-form-label>

                <base-form-input
                    id="landline"
                    type="text"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    dir="ltr"
                    maxlength="9"
                    v-model="landline"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('landline')
                        })
                    "
                    @change="form?.validate('landline')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_landline_message" class="mt-2 text-danger" v-if="form?.invalid('landline')">
                        {{ form.errors.landline }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 md:col-span-6">
                <base-form-label for="ccp">
                    {{ $t('ccp') }}
                </base-form-label>

                <base-form-input
                    id="ccp"
                    type="text"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    dir="ltr"
                    maxlength="12"
                    v-model="ccp"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('ccp')
                        })
                    "
                    @change="form?.validate('ccp')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_ccp_message" class="mt-2 text-danger" v-if="form?.invalid('ccp')">
                        {{ form.errors.ccp }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 md:col-span-6">
                <base-form-label for="cpa">
                    {{ $t('cpa') }}
                </base-form-label>

                <base-form-input
                    id="cpa"
                    type="text"
                    @keydown="allowOnlyNumbersOnKeyDown"
                    dir="ltr"
                    maxlength="12"
                    v-model="cpa"
                    :placeholder="
                        $t('auth.placeholders.fill', {
                            attribute: $t('cpa')
                        })
                    "
                    @change="form?.validate('cpa')"
                ></base-form-input>

                <base-form-input-error>
                    <div data-test="error_cpa_message" class="mt-2 text-danger" v-if="form?.invalid('cpa')">
                        {{ form.errors.cpa }}
                    </div>
                </base-form-input-error>
            </div>

            <div class="intro-y col-span-12 md:col-span-10 lg:col-span-8 xl:col-span-6">
                <base-form-label for="phones[0]">
                    {{ $t('phones') }}
                </base-form-label>

                <!--suppress JSUnusedLocalSymbols -->
                <template v-for="(_, index) in phones" :key="`phone_${index}`">
                    <div
                        class="mt-3 flex items-center"
                        :class="twMerge(['mt-3 flex items-center', index === 0 && '!mt-0'])"
                    >
                        <base-form-input
                            type="text"
                            dir="ltr"
                            placeholder="066495XXXX"
                            @keydown="allowOnlyNumbersOnKeyDown"
                            maxlength="10"
                            :id="`phones_${index}`"
                            v-model="phones[index]"
                        >
                        </base-form-input>
                        <a
                            tabindex="-1"
                            class="ms-2 inline-block"
                            :class="{ 'cursor-not-allowed': phones.length === 1 }"
                            href="#"
                            @click.prevent="removePhone(index)"
                        >
                            <svg-loader class="fill-danger" name="icon-trash-can"></svg-loader>
                        </a>
                    </div>

                    <base-form-input-error>
                        <div
                            :data-test="`error_phones_${index}_message`"
                            class="mt-2 text-danger"
                            v-if="
                                form?.invalid(
                                    //@ts-ignore
                                    'phones.' + index
                                )
                            "
                        >
                            {{
                                //@ts-ignore
                                form.errors[`phones.${index}`]
                            }}
                        </div>
                    </base-form-input-error>
                </template>
                <base-button
                    type="button"
                    variant="outline-primary"
                    class="mx-auto mt-3 block w-1/2 border-dashed dark:text-slate-500"
                    data-test="add_phone_number"
                    @click="addPhone"
                >
                    <svg-loader name="icon-plus" class="inline fill-primary dark:fill-slate-500"></svg-loader>

                    {{ $t('auth.register.stepThree.add_new_phone') }}
                </base-button>
            </div>

            <div class="intro-y col-span-12 md:col-span-10 lg:col-span-8 xl:col-span-7">
                <div class="mb-2 text-base">
                    {{ $t('social media links') }}
                </div>

                <template v-for="link in Object.keys(links)" :key="`link_${link}`">
                    <base-form-inline class="mt-3" :class="{ '!mt-0': link === 'facebook' }">
                        <base-form-label :for="link" class="sm:w-20">
                            {{ $t(`${link}`) }}
                        </base-form-label>

                        <base-form-input
                            class="me-1.5"
                            :id="link"
                            type="url"
                            dir="ltr"
                            v-model="links[link]"
                            :placeholder="$t(`auth.placeholders.${link}`)"
                        />
                    </base-form-inline>

                    <base-form-input-error>
                        <div
                            :data-test="`error_links_${link}_message`"
                            class="ms-24 mt-2 text-danger"
                            v-if="
                                form?.invalid(
                                    //@ts-ignore
                                    `links.${link}`
                                )
                            "
                        >
                            <p class="ms-2">
                                {{
                                    //@ts-ignore
                                    form.errors[`links.${link}`]
                                }}
                            </p>
                        </div>
                    </base-form-input-error>
                </template>
            </div>

            <slot></slot>
        </div>
    </div>
</template>
