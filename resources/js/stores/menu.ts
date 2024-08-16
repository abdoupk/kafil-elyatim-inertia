import type { IFormattedMenu } from '@/types/types'

import { defineStore } from 'pinia'

import { hasPermission } from '@/utils/helper'
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
                ignore: hasPermission('read_roles'),
                routeName: 'tenant.roles.index',
                url: '/dashboard/roles',
                title: __('roles')
            },
            {
                icon: 'icon-users-gear',
                ignore: hasPermission('read_members'),
                title: __('the_members'),
                routeName: 'tenant.members.index',
                url: '/dashboard/members'
            },
            {
                icon: 'icon-branches',
                ignore: hasPermission('read_branches'),
                title: __('branches'),
                routeName: 'tenant.branches.index',
                url: '/dashboard/branches'
            },
            'divider',
            {
                icon: 'icon-family',
                ignore: hasPermission('read_families') || hasPermission('create_families'),
                routeName: '',
                title: __('the_families'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        ignore: hasPermission('read_families'),
                        title: __('list', { attribute: __('the_families') }),
                        routeName: 'tenant.families.index',
                        url: '/dashboard/families'
                    },
                    {
                        icon: 'icon-users-plus',
                        ignore: hasPermission('create_families'),
                        title: n__(__('add new'), 0, { attribute: __('family') }),
                        routeName: 'tenant.families.create',
                        url: '/dashboard/families/create'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: __('statistics'),
                        routeName: 'tenant.families.statistics',
                        url: '/dashboard/families/statistics'
                    }
                ]
            },
            {
                icon: 'icon-children',
                ignore: hasPermission('read_orphans'),
                title: __('orphans'),
                routeName: '',
                subMenu: [
                    {
                        icon: 'icon-children',
                        ignore: hasPermission('read_orphans'),
                        title: __('list', { attribute: __('orphans') }),
                        routeName: 'tenant.orphans.index',
                        url: '/dashboard/orphans'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: __('statistics'),
                        routeName: 'tenant.orphans.statistics',
                        url: '/dashboard/orphans/statistics'
                    }
                ]
            },
            {
                icon: 'icon-hands-holding-child',
                ignore: hasPermission('read_sponsors'),
                title: __('the_sponsors'),
                routeName: '',
                url: '',
                subMenu: [
                    {
                        icon: 'icon-hands-holding-child',
                        ignore: hasPermission('read_sponsors'),
                        title: __('list', { attribute: __('sponsors') }),
                        routeName: 'tenant.sponsors.index',
                        url: '/dashboard/sponsors'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: __('statistics'),
                        routeName: 'tenant.sponsors.statistics',
                        url: '/dashboard/sponsors/statistics'
                    }
                ]
            },
            {
                icon: 'icon-calendar-star',
                // TODO check how to handle it ignore: hasPermission('read_permission'),
                routeName: '',
                title: __('occasions'),
                subMenu: [
                    {
                        icon: 'icon-ram',
                        // Ignore: hasPermission('read_permission'),
                        title: __('eid_el_adha'),
                        routeName: 'tenant.occasions.eid-al-adha.index',
                        url: '/dashboard/occasions/eid-al-adha'
                    },
                    {
                        icon: 'icon-backpack',
                        // Ignore: hasPermission('read_permission'),
                        title: __('school_entry'),
                        routeName: 'tenant.occasions.school-entry.index',
                        url: '/dashboard/occasions/school-entry'
                    },
                    {
                        icon: 'icon-moon-stars',
                        // Ignore: hasPermission('read_permission'),
                        title: __('eid_el_fitr'),
                        routeName: 'tenant.occasions.eid-suit.index',
                        url: '/dashboard/occasions/eid-suit'
                    },
                    {
                        icon: 'icon-moon',
                        // Ignore: hasPermission('read_permission'),
                        title: __('ramadan basket'),
                        routeName: 'tenant.occasions.ramadan-basket.index',
                        url: '/dashboard/occasions/ramadan-basket'
                    },
                    {
                        icon: 'icon-basket-shopping',
                        // Ignore: hasPermission('read_permission'),
                        title: __('monthly basket'),
                        routeName: 'tenant.occasions.monthly-basket.index',
                        url: '/dashboard/occasions/monthly-basket'
                    },
                    {
                        icon: 'icon-baby-carriage',
                        // Ignore: hasPermission('read_permission'),
                        title: __('milk and diapers'),
                        routeName: 'tenant.occasions.babies-milk-and-diapers.index',
                        url: '/dashboard/occasions/babies-milk-and-diapers'
                    }
                ]
            },
            'divider',
            {
                icon: 'icon-map-location-dot',
                ignore: hasPermission('read_zones'),
                title: __('the_zones'),
                routeName: 'tenant.zones.index',
                url: '/dashboard/zones'
            },
            {
                icon: 'icon-hands-holding-dollar',
                title: __('financial'),
                routeName: '',
                subMenu: [
                    {
                        icon: 'icon-hands-holding-dollar',
                        ignore: hasPermission('read_financial'),
                        title: __('financial'),
                        routeName: 'tenant.financial.index',
                        url: '/dashboard/financial'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: __('statistics'),
                        routeName: 'tenant.financial.statistics',
                        url: '/dashboard/financial/statistics'
                    }
                ]
            },
            {
                icon: 'icon-shelves',
                ignore: hasPermission('read_inventory'),
                title: __('the_inventory'),
                routeName: 'tenant.inventory.index',
                url: '/dashboard/inventory'
            },
            {
                icon: 'icon-handshake-angle',
                ignore: hasPermission('read_needs'),
                title: __('the_needs'),
                routeName: 'tenant.needs.index',
                url: '/dashboard/needs'
            },
            {
                icon: 'icon-gear',
                ignore: hasPermission('read_settings'),
                routeName: 'tenant.settings.index',
                title: __('settings'),
                url: '/dashboard/settings'
            },
            {
                icon: 'icon-graduation-cap',
                ignore: hasPermission('read_lessons'),
                routeName: 'tenant.lessons.index',
                title: __('private_lessons'),
                url: '/dashboard/lessons'
            },
            {
                icon: 'icon-school-lock',
                ignore: hasPermission('read_schools'),
                routeName: 'tenant.schools.index',
                title: __('private_schools'),
                url: '/dashboard/schools'
            },
            {
                icon: 'icon-trash-list',
                ignore: hasPermission('read_permission'),
                routeName: 'tenant.trash',
                title: __('the_trash'),
                url: '/dashboard/trash'
            },
            {
                icon: 'icon-box-archive',
                ignore: hasPermission('read_archive'),
                routeName: 'tenant.archive.index',
                title: __('the_archive'),
                url: '/dashboard/archive'
            }
        ]
    })
})
