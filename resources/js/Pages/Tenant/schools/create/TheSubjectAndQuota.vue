<script lang="ts" setup>
import type { AcademicLevelType, SubjectType } from '@/types/lessons'

import type { Form } from 'laravel-precognition-vue/dist/types'
import { ref, watch } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{
    subjects: SubjectType[]
    academicLevels: AcademicLevelType[]
    form: Form<any>
    index: number
}>()

const emit = defineEmits(['removeLesson'])

const vueSelectSubject = ref({})

const vueSelectAcademicLevel = ref({})

const subject = defineModel('subject')

const academicLevel = defineModel('academicLevel')

const quota = defineModel('quota')

watch(
    () => props.form,
    () => {
        vueSelectSubject.value =
            props.subjects.find((subject) => subject.id == props.form.lessons[props.index].subject_id) ?? {}

        vueSelectAcademicLevel.value = props.academicLevels.reduce((acc, curr) => {
            const level = curr.levels.find((level) => level.id === props.form.lessons[props.index].academic_level_id)

            if (level) acc = level

            return acc
        }, {})
    },
    { immediate: true }
)
</script>

<template>
    <div class="grid grid-cols-13 gap-4 col-span-12">
        <!-- Begin: Academic Level-->
        <div class="col-span-12 sm:col-span-4">
            <base-form-label htmlFor="academic_level">
                {{ $t('the_academic_level') }}
            </base-form-label>

            <div>
                <base-vue-select
                    id="academic_level"
                    v-model:value="vueSelectAcademicLevel"
                    :allow-empty="false"
                    :options="academicLevels"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_child') })"
                    class="h-full w-full"
                    group-label="phase"
                    group-values="levels"
                    label="name"
                    track-by="id"
                    @update:value="
                        (value) => {
                            academicLevel = value.id

                            form?.validate(`lessons.${index}.academic_level_id`)
                        }
                    "
                >
                </base-vue-select>
            </div>

            <div v-if="form.invalid(`lessons.${index}.academic_level_id`)" class="mt-2">
                <base-input-error :message="form.errors[`lessons.${index}.academic_level_id`]"></base-input-error>
            </div>
        </div>
        <!-- End: Academic Level-->

        <!-- Begin: Subject-->
        <div class="col-span-12 sm:col-span-4">
            <base-form-label htmlFor="subject">
                {{ $t('the_subject') }}
            </base-form-label>

            <div>
                <base-vue-select
                    id="subject"
                    v-model:value="vueSelectSubject"
                    :allow-empty="false"
                    :options="subjects"
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_child') })"
                    class="h-full w-full"
                    label="name"
                    track-by="id"
                    @update:value="
                        (value) => {
                            subject = value.id

                            form?.validate(`lessons.${index}.subject_id`)
                        }
                    "
                >
                </base-vue-select>
            </div>

            <div v-if="form.invalid(`lessons.${index}.subject_id`)" class="mt-2">
                <base-input-error :message="form.errors[`lessons.${index}.subject_id`]"></base-input-error>
            </div>
        </div>
        <!-- End: Subject-->

        <!-- Begin: Quota-->
        <div class="col-span-12 sm:col-span-4">
            <base-form-label htmlFor="quota">
                {{ $t('validation.attributes.quota') }}
            </base-form-label>

            <base-form-input
                id="quota"
                ref="firstInputRef"
                v-model="quota"
                :placeholder="$t('auth.placeholders.fill', { attribute: $t('validation.attributes.quota') })"
                type="text"
                @change="form.validate(`lessons.${index}.quota`)"
            />

            <div v-if="form.invalid(`lessons.${index}.quota`)" class="mt-2">
                <base-input-error :message="form.errors[`lessons.${index}.quota`]"></base-input-error>
            </div>
        </div>
        <!-- End: Quota-->

        <div class="col-span-1 flex justify-center items-center mt-6 -ms-6">
            <svg-loader
                :class="{ '!cursor-not-allowed': index === 0 }"
                class="h-5 w-5 fill-danger cursor-pointer"
                name="icon-trash-can"
                @click.prevent="emit('removeLesson', index)"
            ></svg-loader>
        </div>
    </div>
</template>
