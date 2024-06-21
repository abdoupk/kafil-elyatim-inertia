import type { Commune, Wilaya } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface Daira {
    daira_name: string
}

interface CityState {
    wilaya: Wilaya
    daira: Daira
    commune: Commune
}

export const useCityStore = defineStore('city', {
    state: (): CityState => ({
        wilaya: {
            wilaya_code: '',
            wilaya_name: ''
        },
        daira: {
            daira_name: ''
        },
        commune: {
            commune_name: '',
            id: ''
        }
    }),
    actions: {
        async fetchWilayas() {
            return await axios.get('https://kafil.elyatim.test/api/wilayas')
        },
        async fetchDairas(wilaya_code: string) {
            return await axios.post('https://kafil.elyatim.test/api/dairas/', { wilaya_code })
        },
        async fetchCommunes(daira_name: string, wilaya_code: string) {
            return await axios.post('https://kafil.elyatim.test/api/communes/', { daira_name, wilaya_code })
        }
    }
})
