import type { CreateMemberForm, Role } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    member: CreateMemberForm & {
        id?: string
        formatted_roles?: {
            id: string
            name: string
        }[]
        branch?: {
            id: string
            name: string
        }
        zone?: {
            id: string
            name: string
        }
    }
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
    actions: {
        async getMember(memberId: string) {
            const {
                data: { member }
            } = await axios.get(`members/show/${memberId}`)

            this.member = { ...member }

            this.member.formatted_roles = member.roles

            this.member.roles = member.roles.map((role: Role) => role.uuid)

            this.member.branch_id = member.branch.id

            this.member.branch = { ...member.branch }

            this.member.zone_id = member.zone.id

            this.member.zone = { ...member.zone }
        }
    }
})
