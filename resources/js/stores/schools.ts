import type { CreateSchoolForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    school: CreateSchoolForm & {
        id?: string
    }
    schools: CreateSchoolForm &
        {
            id: string
        }[]
}

export const useSchoolsStore = defineStore('schools', {
    state: (): State => ({
        school: {
            id: '',
            name: '',
            lessons: [
                {
                    quota: null,
                    academic_level_id: null,
                    subject_id: null
                }
            ]
        },
        schools: []
    }),
    actions: {
        async getSchool(schoolId: string) {
            const {
                data: { school }
            } = await axios.get(`schools/show/${schoolId}`)

            this.school = { ...school }
        },

        async getSchools() {
            const { data: schools } = await axios.get(route('tenant.list.schools'))

            this.schools = schools
        },

        async findSchoolById(id: string) {
            console.log(id)

            console.log(this.schools.find((school) => school.id === id))

            return this.schools.find((school) => school.id === id)
        }
    }
})
