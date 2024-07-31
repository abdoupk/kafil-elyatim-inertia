import type { CreateNeedForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    need: CreateNeedForm & {
        id?: string
        formatted_status?: {
            label: string
            value: string
        }
    }
}

export const useNeedsStore = defineStore('needs', {
    state: (): State => ({
        need: {
            id: '',
            demand: '',
            subject: '',
            status: '',
            note: '',
            needable_id: '',
            needable_type: 'orphan'
        }
    }),
    actions: {
        async getNeed(needId: string) {
            const {
                data: { need }
            } = await axios.get(`needs/show/${needId}`)

            this.need = { ...need }

            this.need.formatted_status = { label: need.status, value: need.status }
        },

        async getOrphans() {
            return await axios.get(route('tenant.needs.get-orphans'))
        },

        async getSponsors() {
            return await axios.get(route('tenant.sponsors.list-sponsors'))
        }
    }
})
