import axios from 'axios'
import { defineStore } from 'pinia'

export const useOrphansStore = defineStore('orphan', {
    state: () => ({
        orphan: []
    }),
    actions: {
        async getOrphans() {
            const { data: orphan } = await axios.get(route('tenant.orphan.list-orphan'))

            this.orphan = orphan
        }
    }
})
