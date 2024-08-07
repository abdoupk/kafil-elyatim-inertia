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
    wilayas: Wilaya[]
    dairas: Daira[]
    communes: Commune[]
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
        },
        wilayas: [],
        dairas: [],
        communes: []
    }),
    actions: {
        async fetchWilayas() {
            if (this.wilayas.length === 0) {
                const {
                    data: { wilayas }
                } = await axios.get(route('api.list-wilayas'))

                this.wilayas = wilayas
            }
        },

        async fetchDairas(wilaya_code: string) {
            await axios
                .post(
                    route('api.dairas', {
                        wilaya_code: wilaya_code
                    })
                )
                .then((res) => {
                    this.dairas = res.data
                })
        },

        async fetchCommunes(daira_name: string, wilaya_code: string) {
            await axios
                .post(
                    route('api.communes', {
                        daira_name,
                        wilaya_code
                    })
                )
                .then((res) => {
                    this.communes = res.data
                })
        },

        getWilaya(wilaya_code: string) {
            return this.wilayas.find((wilaya) => wilaya.wilaya_code == wilaya_code)
        },

        getDaira(daira_name: string) {
            return this.dairas.find((daira) => daira.daira_name == daira_name)
        },

        getCommune(id: number) {
            return this.communes.find((commune) => commune.id == id)
        }
    }
})
