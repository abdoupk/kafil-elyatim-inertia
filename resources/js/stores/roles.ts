import type { RoleType } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'


export const useRolesStore = defineStore('roles', {
    state: () => ({
        roles: []
    }),
    actions: {
        async getRoles() {
            if (this.roles.length > 0) {
                return
            }

            const response = await axios.get(route('tenant.list.roles'))

            this.roles = response.data
        },
        getFormattedRoles(ids: string[] | undefined): RoleType[] | undefined {
            return this.roles.filter((role: RoleType) => ids?.includes(role.uuid))
        }
    }
})
