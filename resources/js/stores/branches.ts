import type { Branch } from '@/types/types'

import axios from 'axios'
import { useForm } from 'laravel-precognition-vue'
import type { Form } from 'laravel-precognition-vue/dist/types'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'

interface State {
    branch: {
        id: string,
        name: string,
        city_id: string,
        president_id: string
    }
    errors: {
        name: string[]
        city_id: string[]
    }
}

export const useBranchesStore = defineStore('branches', {
    state: (): State => ({
        branch: {
            id: '',
            name: '',
            city_id: '',
            president_id: ''
        },
        errors: []
    }),
    getters: {
        getCreateBranchForm(): Form<Branch> {
            return useForm('post', route('tenant.branches.store'), { ...omit(this.branch, ['id']) })
        },
        getUpdateBranchForm(): Form<Branch> {
            return useForm('post', route('tenant.branches.update'), { ...omit(this.branch, ['id']) })
        }
    },
    actions: {
        async getBranch(branchId: string) {
            await axios.get(`branches/show/${branchId}`).then((res) => {
                this.branch = res.data.branch
            })
        },

        async updateBranch() {
            await this.getUpdateBranchForm.submit({
                onSuccess: () => {
                    this.errors = []
                },
                onValidationError: (res) => {
                    if (res.status == 422) {
                        this.errors = res.data.errors
                    }
                }
            })
        },

        async createBranch() {
            await this.getCreateBranchForm.submit({
                onSuccess: () => {
                    this.errors = []
                },
                onValidationError: (res) => {
                    if (res.status == 422) {
                        this.errors = res.data.errors
                    }
                }
            })
        }
    }
})
