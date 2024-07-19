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
        formatted_orphans?: {
            id: string
            name: string
        }[]
    }
}

export const useLessonsStore = defineStore('lessons', {
    state: (): State => ({
        lesson: {
            orphans: [],
            id: '',
            subject: {
                id: '',
                name: ''
            },
            school: {
                id: '',
                name: ''
            },
            description: '',
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
        },
        async updateLesson(id: string, data: { start_date: string; end_date: string }) {
            await axios.put(route('tenant.lessons.update-dates', id), data)
        }
    }
})
