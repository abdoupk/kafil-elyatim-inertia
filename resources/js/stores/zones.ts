import type { Zone } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'

interface State {
    zone: Zone
    errors: {
        name: string[]
        description: string[]
    }
}

export const useZonesStore = defineStore('zones', {
    state: (): State => ({
        zone: {
            name: '',
            id: '',
            description: ''
        },
        errors: []
    }),
    getters: {},
    actions: {
        async getZone(zoneId: string) {
            await axios.get(`zones/show/${zoneId}`).then((res) => {
                this.zone = res.data.zone
            })
        },

        async updateZone() {
            await axios
                .put(`zones/${this.zone.id}`, { ...omit(this.zone, ['id']) })
                .then(() => {
                    this.errors = []
                })
                .catch((res) => {
                    if (res.response.status == 422) {
                        this.errors = res.response.data.errors
                    }
                })
        },

        async createZone() {
            await axios
                .post('zones/create', { ...omit(this.zone, ['id']) })
                .then(() => {
                    this.errors = []
                })
                .catch((res) => {
                    if (res.response.status == 422) {
                        this.errors = res.response.data.errors
                    }
                })
        }
    }
})
