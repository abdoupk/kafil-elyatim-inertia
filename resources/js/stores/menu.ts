import type { IFormattedMenu } from '@/types/types'

import { defineStore } from 'pinia'

import { __, n__ } from '@/utils/i18n'

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
                icon: 'icon-users-gear',
                routeName: '',
                title: __('the_members'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        title: __('list', { attribute: __('the_members') }),
                        routeName: 'tenant.members.index',
                        url: route('tenant.members.index')
                    },
                    {
                        icon: 'icon-user-plus',
                        title: n__('add new', 1, { attribute: __('member') }),
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
                        routeName: 'tenant.families.create',
                        url: route('tenant.families.create')
                    }
                ]
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
                icon: 'icon-children',
                title: __('orphans'),
                routeName: 'tenant.orphans.index',
                url: route('tenant.orphans.index')
            },
            {
                icon: 'icon-hands-holding-child',
                title: __('the_sponsors'),
                routeName: 'tenant.sponsors.index',
                url: route('tenant.sponsors.index')
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
                        url: route('tenant.occasions.eid-al-adha.index')
                    },
                    {
                        icon: 'icon-backpack',
                        title: __('school entry'),
                        routeName: 'tenant.occasions.school-entry.index',
                        url: route('tenant.occasions.school-entry.index')
                    },
                    {
                        icon: 'icon-moon-stars',
                        title: __('eid_el_fitr'),
                        routeName: 'tenant.branches.index',
                        url: route('tenant.branches.index')
                    },
                    {
                        icon: 'icon-moon',
                        title: __('ramadan basket'),
                        routeName: 'tenant.occasions.ramadan-basket.index',
                        url: route('tenant.occasions.ramadan-basket.index')
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
                url: route('tenant.statistics.index')
            },
            {
                icon: 'icon-map-location-dot',
                title: __('the_zones'),
                routeName: 'tenant.zones.index',
                url: route('tenant.zones.index')
            },
            {
                icon: 'icon-hands-holding-dollar',
                title: __('financial'),
                routeName: 'tenant.financial.index',
                url: route('tenant.financial.index')
            },
            {
                icon: 'icon-shelves',
                title: __('the_inventory'),
                routeName: 'tenant.inventory.index',
                url: route('tenant.inventory.index')
            },
            {
                icon: 'icon-gear',
                routeName: 'tenant.settings.index',
                title: __('settings'),
                url: route('tenant.settings.index')
            }
        ]
    })
})
