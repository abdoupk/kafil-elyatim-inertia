import { __ } from '@/utils/i18n'
import { defineStore } from 'pinia'

export const useMenuStore = defineStore('menu', {
    state: () => ({
        menu: [
            {
                icon: 'icon-house',
                routeName: 'tenant.dashboard',
                url: route('tenant.dashboard'),
                title: __('dashboard')
            },
            'divider',
            {
                icon: 'icon-user-lock',
                routeName: 'tenant.roles.index',
                url: route('tenant.roles.index'),
                title: __('roles')
            },
            {
                icon: 'icon-family',
                routeName: '',
                title: __('families'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        title: __('list', { attribute: __('families') }),
                        routeName: 'tenant.families.index',
                        url: route('tenant.families.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: __('add new family'),
                        routeName: 'tenant.families.create',
                        url: route('tenant.families.create')
                    }
                ]
            },
            {
                icon: 'icon-family',
                routeName: '',
                title: __('branches'),
                subMenu: [
                    {
                        icon: 'icon-branches',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: __('add new family'),
                        routeName: 'tenant.families.create',
                        url: route('tenant.families.create')
                    }
                ]
            }
        ]
    })
})
