import { __, n__ } from '@/utils/i18n'
import { defineStore } from 'pinia'
import type { IFormattedMenu } from '@/types/types'

export const useMenuStore = defineStore('menu', {
    state: (): { menu: Array<IFormattedMenu | 'divider'> } => ({
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
                title: __('the_families'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        title: __('list', { attribute: __('the_families') }),
                        routeName: 'tenant.families.index',
                        url: route('tenant.families.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: n__(__('add new'), 0, { attribute: __('family') }),
                        routeName: 'tenant.families.create',
                        url: route('tenant.families.create')
                    }
                ]
            },
            {
                icon: 'icon-branches',
                routeName: '',
                title: __('branches'),
                subMenu: [
                    {
                        icon: 'icon-code-merge',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-grid-round-2-plus',
                        title: n__('add new', 1, { attribute: __('branch') }),
                        routeName: 'tenant.branches.create',
                        url: route('tenant.branches.create')
                    }
                ]
            },
            {
                icon: 'icon-users-gear',
                routeName: '',
                title: __('members'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-user-plus',
                        title: __('add new', { attribute: __('family') }),
                        routeName: 'tenant.branches.create',
                        url: route('tenant.branches.create')
                    }
                ]
            },
            {
                icon: 'icon-children',
                routeName: '',
                title: __('orphans'),
                subMenu: [
                    {
                        icon: 'icon-branches',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: __('add new', { attribute: __('family') }),
                        routeName: 'tenant.branches.create',
                        url: route('tenant.branches.create')
                    }
                ]
            },
            {
                icon: 'icon-gear',
                routeName: 'tenant.settings.index',
                title: __('settings'),
                url: route('tenant.families.index')
            },
            {
                icon: 'icon-chart-pie-simple',
                routeName: '',
                title: __('statistics'),
                subMenu: [
                    {
                        icon: 'icon-branches',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: __('add new', { attribute: __('family') }),
                        routeName: 'tenant.branches.create',
                        url: route('tenant.branches.create')
                    }
                ]
            },
            {
                icon: 'icon-calendar-star',
                routeName: '',
                title: __('occasions'),
                subMenu: [
                    {
                        icon: 'icon-branches',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: __('add new', { attribute: __('family') }),
                        routeName: 'tenant.branches.create',
                        url: route('tenant.branches.create')
                    }
                ]
            },
            {
                icon: 'icon-hands-holding-dollar',
                routeName: '',
                title: __('financial'),
                subMenu: [
                    {
                        icon: 'icon-branches',
                        title: __('list', { attribute: __('branches') }),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-users-plus',
                        title: __('add new', { attribute: __('family') }),
                        routeName: 'tenant.branches.create',
                        url: route('tenant.branches.create')
                    }
                ]
            }
        ]
    })
})
