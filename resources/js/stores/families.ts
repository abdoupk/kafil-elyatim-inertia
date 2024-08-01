import axios from 'axios'
import { defineStore } from 'pinia'

export const useFamiliesStore = defineStore('families', {
    state: () => ({
        families: []
    }),
    actions: {
        async getFamilies() {
            console.log('get families')

            const { data: families } = await axios.get(route('tenant.families.list-families'))

            this.families = families
        }
    }
})
