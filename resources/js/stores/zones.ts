import type { Zone } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    zone: Zone
}

export const useZonesStore = defineStore('zones', {
    state: (): State => ({
        zone: {
            name: '',
            id: '',
            description: ''
        }
    }),
    actions: {
        async getZone(zoneId: string) {
            await axios.get(`zones/show/${zoneId}`).then((res) => {
                this.zone = res.data.zone
            })
        }
    }
})
