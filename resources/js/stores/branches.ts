import type { CreateBranchForm } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'


interface State {
    branch: CreateBranchForm & { id: string }
    branches: { id: string; name: string }[]
}

export const useBranchesStore = defineStore('branches', {
    state: (): State => ({
        branch: {
            id: '',
            name: '',
            city_id: '',
            president_id: '',
            city: {},
            created_at: new Date()
        },
        branches: []
    }),
    actions: {
        async getBranch(branchId: string) {
            await axios.get(`branches/show/${branchId}`).then((res) => {
                this.branch = omit(res.data.branch, [])
            })
        },

        async getBranches() {
            const { data: branches } = await axios.get(route('tenant.branches.list-branches'))

            this.branches = branches
        },

        findBranchById(id: string) {
            return this.branches.find((branch) => branch.id === id)
        }
    }
})
