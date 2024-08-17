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
            await axios.get(route('tenant.zones.show', zoneId)).then((res) => {
                this.zone = res.data.zone
            })
        },

        async getZoneDetails(zoneId: string) {
            const { data } = await axios.get(route('tenant.zones.details', zoneId))

            this.zone = data.zone
        },

        async getZones() {
            if (this.zones.length > 0) {
                return
            }

            const { data: zones } = await axios.get(route('tenant.list.zones'))

            this.zones = zones
        },

        findZoneById(id: string) {
            return this.zones.find((zone) => zone.id === id)
        }
    }
})
