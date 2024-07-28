import type { IFormattedMenu } from '@/types/types'

import { defineStore } from 'pinia'

import { __, n__ } from '@/utils/i18n'

export const useMenuStore = defineStore('menu', {
    state: (): { menu: Array<IFormattedMenu | 'divider'> } => ({
        menu: [
            {
                icon: 'icon-house',
                routeName: 'tenant.dashboard',
                url: '/dashboard',
                title: __('dashboard')
            },
            'divider',
            {
                icon: 'icon-user-lock',
                routeName: 'tenant.roles.index',
                url: '/dashboard/roles',
                title: __('roles')
            },
            {
                icon: 'icon-users-gear',
                title: __('the_members'),
                routeName: 'tenant.members.index',
                url: '/dashboard/members'
            },
            {
                icon: 'icon-branches',
                title: __('branches'),
                routeName: 'tenant.branches.index',
                url: '/dashboard/branches'
            },
            'divider',
            {
                icon: 'icon-family',
                routeName: '',
                title: __('the_families'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        title: __('list', { attribute: __('the_families') }),
                        routeName: 'tenant.families.index',
                        url:'/dashboard/families'
                    },
                    {
                        icon: 'icon-users-plus',
                        title: n__(__('add new'), 0, { attribute: __('family') }),
                        routeName: 'tenant.families.create',
                        url: '/dashboard/families/create'
                    }
                ]
            },
            {
                icon: 'icon-children',
                title: __('orphans'),
                routeName: 'tenant.orphans.index',
                url: '/dashboard/orphans'
            },
            {
                icon: 'icon-hands-holding-child',
                title: __('the_sponsors'),
                routeName: 'tenant.sponsors.index',
                url: '/dashboard/sponsors'
            },
            {
                icon: 'icon-calendar-star',
                routeName: '',
                title: __('occasions'),
                subMenu: [
                    {
                        icon: 'icon-ram',
                        title: __('eid_el_adha'),
                        routeName: 'tenant.occasions.eid-al-adha.index',
                        url:'/dashboard/occasions/eid-al-adha'
                    },
                    {
                        icon: 'icon-backpack',
                        title: __('school_entry'),
                        routeName: 'tenant.occasions.school-entry.index',
                        url: route('tenant.occasions.school-entry.index')
                    },
                    {
                        icon: 'icon-moon-stars',
                        title: __('eid_el_fitr'),
                        routeName: 'tenant.occasions.eid-suit.index',
                        url: '/dashboard/occasions/eid-suit'
                    },
                    {
                        icon: 'icon-moon',
                        title: __('ramadan basket'),
                        routeName: 'tenant.occasions.ramadan-basket.index',
                        url: '/dashboard/occasions/ramadan-basket'
                    },
                    {
                        icon: 'icon-basket-shopping',
                        title: __('monthly basket'),
                        routeName: 'tenant.families.create',
                        url: route('tenant.families.create')
                    }
                ]
            },
            'divider',
            {
                icon: 'icon-chart-pie-simple',
                title: __('statistics'),
                routeName: 'tenant.statistics.index',
                url: '/dashboard/statistics'
            },
            {
                icon: 'icon-map-location-dot',
                title: __('the_zones'),
                routeName: 'tenant.zones.index',
                url: '/dashboard/zones'
            },
            {
                icon: 'icon-hands-holding-dollar',
                title: __('financial'),
                routeName: 'tenant.financial.index',
                url: '/dashboard/financial'
            },
            {
                icon: 'icon-shelves',
                title: __('the_inventory'),
                routeName: 'tenant.inventory.index',
                url: '/dashboard/inventory'
            },
            {
                icon: 'icon-handshake-angle',
                title: __('the_needs'),
                routeName: 'tenant.needs.index',
                url: '/dashboard/needs'
            },
            {
                icon: 'icon-gear',
                routeName: 'tenant.settings.index',
                title: __('settings'),
                url: '/dashboard/settings'
            },
            {
                icon: 'icon-graduation-cap',
                routeName: 'tenant.lessons.index',
                title: __('private_lessons'),
                url:'/dashboard/lessons'
            },
            {
                icon: 'icon-school-lock',
                routeName: 'tenant.schools.index',
                title: __('private_schools'),
                url: '/dashboard/schools'
            }
        ]
    })
})
