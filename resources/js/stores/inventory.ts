import type { AddItemToInventoryForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    item: AddItemToInventoryForm & {
        id?: string
    }
}

export const useInventoryStore = defineStore('inventory', {
    state: (): State => ({
        item: {
            id: '',
            name: '',
            qty: 0,
            unit: 'kg',
            note: ''
        }
    }),
    actions: {
        async getItem(itemId: string) {
            const {
                data: { item }
            } = await axios.get(`inventory/show/${itemId}`)

            this.item = { ...item }
        }
    }
})
