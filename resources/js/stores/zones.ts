import type { Zone } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    zone: Zone
    zones: Zone[]
}

export const useZonesStore = defineStore('zones', {
    state: (): State => ({
        zone: {
            name: '',
            id: '',
            description: ''
        },
        zones: []
    }),
    actions: {
        async getZone(zoneId: string) {
            await axios.get(`zones/show/${zoneId}`).then((res) => {
                this.zone = res.data.zone
            })
        },
        async getZones() {
            const { data: zones } = await axios.get(route('tenant.zones.list-zones'))

            this.zones = zones
        },
        findZoneById(id: string) {
            return this.zones.find((zone) => zone.id === id)
        }
    }
})
