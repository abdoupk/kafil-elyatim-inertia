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
            note: ''
        }
    }),
    actions: {
        async getNeed(needId: string) {
            const {
                data: { need }
            } = await axios.get(`needs/show/${needId}`)

            this.need = { ...need }

            this.need.formatted_status = { label: need.status, value: need.status }
        }
    }
})
