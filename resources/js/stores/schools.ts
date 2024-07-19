import type { CreateSchoolForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    school: CreateSchoolForm & {
        id?: string
    }
}

export const useSchoolsStore = defineStore('schools', {
    state: (): State => ({
        school: {
            id: '',
            name: ''
        }
    }),
    actions: {
        async getSchool(schoolId: string) {
            const {
                data: { school }
            } = await axios.get(`schools/show/${schoolId}`)
            this.school = { ...school }
        }
    }
})
