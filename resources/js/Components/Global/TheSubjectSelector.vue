<script lang="ts" setup>
import type { SubjectType } from '@/types/types'

import { useSubjectsStore } from '@/stores/subjects'
import { onMounted, ref, watch } from 'vue'

import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

const subject = defineModel<number | undefined>('subject')

const selectedSubject = ref<SubjectType | number | undefined>()

const subjectsStore = useSubjectsStore()

const handleUpdate = (value: SubjectType) => {
    subject.value = value?.id
}

onMounted(async () => {
    await subjectsStore.getSubjects()

    selectedSubject.value = subjectsStore.findSubjectById(subject.value)
})

watch(
    () => subject.value,
    () => {
        selectedSubject.value = subjectsStore.findSubjectById(subject.value)
    }
)
</script>

<template>
    <!--  @vue-ignore  -->
    <base-vue-select
        v-model:value="selectedSubject"
        :options="subjectsStore.subjects"
        label="name"
        track-by="id"
        @update:value="handleUpdate"
    ></base-vue-select>
</template>
