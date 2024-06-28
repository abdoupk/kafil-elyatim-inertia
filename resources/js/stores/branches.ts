import type { CreateBranchForm } from '@/types/types'

import { useCityStore } from '@/stores/city'
import axios from 'axios'
import { useForm } from 'laravel-precognition-vue'
import type { Form } from 'laravel-precognition-vue/dist/types'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'

interface State {
    branch: CreateBranchForm & { id: string }
}

export const useBranchesStore = defineStore('branches', {
    state: (): State => ({
        branch: {
            id: '',
            name: '',
            city_id: '',
            president_id: '',
            created_at: ''
        }
    }),
    getters: {
        getCreateBranchForm(): Form<CreateBranchForm> {
            const cityStore = useCityStore()

            cityStore.$reset()

            return useForm('post', route('tenant.branches.store'), { ...omit(this.branch, ['id']) })
        },

        getUpdateBranchForm(): Form<CreateBranchForm> {
            return useForm('put', route('tenant.branches.update', this.branch.id), { ...omit(this.branch, ['id']) })
        }
    },
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

        async updateBranch() {
            await this.getUpdateBranchForm.submit()
        },

        async createBranch() {
            await this.getCreateBranchForm.submit()
        }
    }
})
