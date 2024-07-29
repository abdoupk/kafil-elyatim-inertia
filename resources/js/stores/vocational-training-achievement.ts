import type { CreateCollegeAchievementForm } from '@/types/college-achievement'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    collegeAchievement: CreateCollegeAchievementForm & {
        id: string
    }
}

export const useCollegeAchievementsStore = defineStore('college-achievements', {
    state: (): State => ({
        collegeAchievement: {
            id: '',
            average: null,
            orphan_id: '',
            note: '',
            academic_level_id: null,
            academic_year: null,
            first_semester: null,
            second_semester: null,
            speciality: null,
            university: null
        }
    }),
    actions: {
        async getCollegeAchievement(CollegeAchievementID: string) {
            await axios.get(route('tenant.vocational-training-achievements.show', CollegeAchievementID)).then((res) => {
                this.collegeAchievement = { ...res.data.college_achievement }

                console.log(this.collegeAchievement)
            })
        }
    }
})
