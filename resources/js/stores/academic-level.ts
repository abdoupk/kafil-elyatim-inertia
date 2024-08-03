import axios from 'axios'
import { defineStore } from 'pinia'

export const useAcademicLevelsStore = defineStore('academic-levels', {
    state: () => ({
        academicLevels: []
    }),
    getters: {
        // GetAcademicLevels: (state) => state.academicLevels
        // GetAcademicLevelByID: (state) => (id) => state.academicLevels.find((academicLevel) => academicLevel.id === id)
    },
    actions: {
        async getAcademicLevels() {
            if (this.academicLevels.length == 0) {
                const { data: academicLevels } = await axios.get(route('tenant.list-academic-levels'))

                this.academicLevels = academicLevels
            }
        },

        async getAcademicLevelsForOrphans() {
            if (this.academicLevels.length == 0) {
                await this.getAcademicLevels()
            }

            return this.academicLevels
        }
    }
})
