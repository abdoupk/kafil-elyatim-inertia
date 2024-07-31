import type { CreateBranchForm } from '@/types/types'

import { useCityStore } from '@/stores/city'
import axios from 'axios'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'

interface State {
    branch: CreateBranchForm & { id: string }
    branches: { id: string, name: string }[]
}

export const useBranchesStore = defineStore('branches', {
    state: (): State => ({
        branch: {
            id: '',
            name: '',
            city_id: '',
            president_id: '',
            created_at: new Date()
        },
        branches: []
    }),
    actions: {
        async getBranch(branchId: string) {
            await axios.get(`branches/show/${branchId}`).then((res) => {
                const cityStore = useCityStore()

                cityStore.wilaya.wilaya_code = res.data.branch.city.wilaya_code

                cityStore.commune.commune_name = res.data.branch.city.commune_name

                cityStore.commune.id = res.data.branch.city.id

                cityStore.daira.daira_name = res.data.branch.city.daira_name

                this.branch = omit(res.data.branch, ['city'])
            })
        },

        async getBranches() {
            const { data: branches } = await axios.get(route('tenant.branches.list-branches'))

            this.branches = branches
        }
    }
})
