import type { Zone } from '@/types/types'

import axios from 'axios'
import { useForm } from 'laravel-precognition-vue'
import type { Form } from 'laravel-precognition-vue/dist/types'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'

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
    getters: {
        getCreateZoneForm(): Form<Zone> {
            return useForm('post', route('tenant.zones.store'), { ...omit(this.zone, ['id']) })
        },

        getUpdateZoneForm(): Form<Zone> {
            return useForm('put', route('tenant.zones.update', this.zone.id), { ...omit(this.zone, ['id']) })
        }
    },
    actions: {
        async getZone(zoneId: string) {
            await axios.get(`zones/show/${zoneId}`).then((res) => {
                this.zone = res.data.zone
            })
        },

        async updateZone() {
            await this.getUpdateZoneForm.submit()
        },

        async createZone() {
            await this.getCreateZoneForm.submit()
        }
    }
})
