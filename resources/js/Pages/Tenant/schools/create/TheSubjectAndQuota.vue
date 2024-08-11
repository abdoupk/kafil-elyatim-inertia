<script lang="ts" setup>
import type { SubjectType } from '@/types/lessons'

import { useAcademicLevelsStore } from '@/stores/academic-level'
import type { Form } from 'laravel-precognition-vue/dist/types'
import { onMounted, ref, watch } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormLabel from '@/Components/Base/form/BaseFormLabel.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'
import TheAcademicLevelSelector from '@/Components/Global/TheAcademicLevelSelector.vue'
import SvgLoader from '@/Components/SvgLoader.vue'

const props = defineProps<{
    subjects: SubjectType[]
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    form: Form<Record<string, any>>
    index: number
}>()

const emit = defineEmits(['removeLesson'])

const vueSelectSubject = ref({})

const subject = defineModel('subject')

const academicLevel = defineModel('academicLevel')

const quota = defineModel('quota')

watch(
    () => props.form,
    () => {
        vueSelectSubject.value =
            props.subjects.find((subject) => subject.id == props.form.lessons[props.index].subject_id) ?? ''
    },
    { immediate: true }
)

const academicLevels = ref([])

const academicLevelsStore = useAcademicLevelsStore()

onMounted(async () => {
    await academicLevelsStore.getAcademicLevels()

    academicLevels.value = academicLevelsStore.academicLevels
})
</script>

<template>
    <div class="col-span-12 grid grid-cols-13 gap-4">
        <!-- Begin: Academic Level-->
        <div class="col-span-12 sm:col-span-4">
            <base-form-label htmlFor="academic_level">
                {{ $t('academic_level') }}
            </base-form-label>

            <div>
                <the-academic-level-selector
                    v-model:academic-level="academicLevel"
                    :academicLevels
                ></the-academic-level-selector>
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
                    :placeholder="$t('auth.placeholders.tomselect', { attribute: $t('the_subject') })"
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

        <div class="col-span-1 -ms-6 mt-6 flex items-center justify-center">
            <svg-loader
                class="h-5 w-5 cursor-pointer fill-danger"
                name="icon-trash-can"
                @click.prevent="emit('removeLesson', index)"
            ></svg-loader>
        </div>
    </div>
</template>
