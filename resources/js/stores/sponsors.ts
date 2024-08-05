import axios from 'axios'
import { defineStore } from 'pinia'

export const useSponsorsStore = defineStore('sponsors', {
    state: () => ({
        sponsors: []
    }),
    actions: {
        async getSponsors() {
            const { data: sponsors } = await axios.get(route('tenant.sponsors.list-sponsors'))

            this.sponsors = sponsors
        },

        async searchSponsors(query: string) {
            const { data: sponsors } = await axios.get(route('tenant.sponsors.search', query))

            return sponsors
        }
    }
})
