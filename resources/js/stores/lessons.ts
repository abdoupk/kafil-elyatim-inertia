import type { CreateLessonForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    lesson: CreateLessonForm & {
        id?: string
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
            frequency: 'weekly',
            interval: 1,
            until: ''
        }
    }),
    actions: {
        async getLesson(lessonId: string) {
            const {
                data: { lesson }
            } = await axios.get(`lessons/show/${lessonId}`)
            this.lesson = { ...lesson }
        }
    }
})
