import type { CreateMemberForm } from '@/types/types'

import axios from 'axios'
import { useForm } from 'laravel-precognition-vue'
import type { Form } from 'laravel-precognition-vue/dist/types'
import { defineStore } from 'pinia'

import { omit } from '@/utils/helper'

interface State {
    member: CreateMemberForm & { id: string }
}

export const useMembersStore = defineStore('members', {
    state: (): State => ({
        member: {
            id: '',
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            zone_id: '',
            qualification: '',
            gender: 'male',
            roles: [''],
            branch_id: '',
            password: '',
            password_confirmation: ''
        }
    }),
    getters: {
        getCreateMemberForm(): Form<CreateMemberForm> {
            return useForm('post', route('tenant.members.store'), { ...omit(this.member, ['id']) })
        },

        getUpdateMemberForm(): Form<CreateMemberForm> {
            return useForm('put', route('tenant.members.update', this.member.id), { ...omit(this.member, ['id']) })
        }
    },
    actions: {
        async getMember(memberId: string) {
            await axios.get(`members/show/${memberId}`).then((res) => {
                this.member = res.data.member
            })
        },

        async updateMember() {
            await this.getUpdateMemberForm.submit()
        },

        async createMember() {
            await this.getCreateMemberForm.submit()
        }
    }
})
