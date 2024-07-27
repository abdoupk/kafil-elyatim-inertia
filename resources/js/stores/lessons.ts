import type { CreateLessonForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    lesson: CreateLessonForm & {
        id?: string
        formatted_subject?: {
            id: string
            name: string
        }
        formatted_school?: {
            id: string
            name: string
        }
        formatted_academic_level?: {
            id: string
            name: string
        }
        formatted_orphans?: {
            id: string
            first_name: string
            last_name: string
            sponsor_phone?: string
        }[]
        formated_date?: string
    }
}

export const useLessonsStore = defineStore('lessons', {
    state: (): State => ({
        lesson: {
            orphans: [],
            id: '',
            subject_id: null,
            academic_level_id: null,
            school_id: '',
            title: '',
            start_date: '',
            end_date: '',
            color: '',
            frequency: '',
            interval: null,
            until: ''
        }
    }),
    actions: {
        async getLesson(lessonId: string) {
            const {
                data: { lesson }
            } = await axios.get(`lessons/show/${lessonId}`)
            this.lesson = { ...lesson }
            this.lesson.formatted_academic_level = lesson.academic_level
            this.lesson.formatted_subject = lesson.subject
            this.lesson.formatted_school = lesson.school
            this.lesson.formatted_orphans = lesson.orphans

            console.log(this.lesson)
        },
        async updateLesson(id: string, data: { start_date: string; end_date: string }) {
            await axios.put(route('tenant.lessons.update-dates', id), data)
        },

        async getOrphans(search: string, academic_level_id: number) {
            return await axios.get(`lessons/list-orphans?search=${search} &academic_level_id=${academic_level_id}`)
        }
    }
})
