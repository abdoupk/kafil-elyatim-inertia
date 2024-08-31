import type { IFormattedMenu } from '@/types/types'

import { defineStore } from 'pinia'

import { $t, $tc } from '@/utils/i18n'


export const useMenuStore = defineStore('menu', {
    state: (): { menu: Array<IFormattedMenu | 'divider'> } => ({
        menu: [
            {
                icon: 'icon-house',
                routeName: 'tenant.dashboard',
                url: '/dashboard',
                title: $t('dashboard')
            },
            'divider',
            {
                icon: 'icon-user-lock',
                // Ignore: !hasPermission('list_roles'),
                routeName: 'tenant.roles.index',
                url: '/dashboard/roles',
                title: $t('roles')
            },
            {
                icon: 'icon-users-gear',
                // Ignore: !hasPermission('list_members'),
                title: $t('the_members'),
                routeName: 'tenant.members.index',
                url: '/dashboard/members'
            },
            {
                icon: 'icon-branches',
                // Ignore: !hasPermission('list_branches'),
                title: $t('branches'),
                routeName: 'tenant.branches.index',
                url: '/dashboard/branches'
            },
            'divider',
            {
                icon: 'icon-family',
                // Ignore: !hasPermission('list_families') || hasPermission('create_families'),
                routeName: '',
                title: $t('the_families'),
                subMenu: [
                    {
                        icon: 'icon-users',
                        // Ignore: !hasPermission('list_families'),
                        title: $t('list', { attribute: $t('the_families') }),
                        routeName: 'tenant.families.index',
                        url: '/dashboard/families'
                    },
                    {
                        icon: 'icon-users-plus',
                        // Ignore: !hasPermission('create_families'),
                        title: $tc($t('add new'), 0, { attribute: $t('family') }),
                        routeName: 'tenant.families.create',
                        url: '/dashboard/families/create'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: $t('statistics'),
                        routeName: 'tenant.families.statistics',
                        url: '/dashboard/families/statistics'
                    }
                ]
            },
            {
                icon: 'icon-children',
                // Ignore: !hasPermission('list_orphans'),
                title: $t('orphans'),
                routeName: '',
                subMenu: [
                    {
                        icon: 'icon-children',
                        // Ignore: !hasPermission('list_orphans'),
                        title: $t('list', { attribute: $t('orphans') }),
                        routeName: 'tenant.orphans.index',
                        url: '/dashboard/orphans'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: $t('statistics'),
                        routeName: 'tenant.orphans.statistics',
                        url: '/dashboard/orphans/statistics'
                    }
                ]
            },
            {
                icon: 'icon-hands-holding-child',
                // Ignore: !hasPermission('list_sponsors'),
                title: $t('the_sponsors'),
                routeName: '',
                url: '',
                subMenu: [
                    {
                        icon: 'icon-hands-holding-child',
                        // Ignore: !hasPermission('list_sponsors'),
                        title: $t('list', { attribute: $t('sponsors') }),
                        routeName: 'tenant.sponsors.index',
                        url: '/dashboard/sponsors'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: $t('statistics'),
                        routeName: 'tenant.sponsors.statistics',
                        url: '/dashboard/sponsors/statistics'
                    }
                ]
            },
            {
                icon: 'icon-calendar-star',
                // // TODO check how to handle it ignore: !hasPermission('list_permission'),
                routeName: '',
                title: $t('occasions'),
                subMenu: [
                    {
                        icon: 'icon-ram',
                        // // Ignore: !hasPermission('list_permission'),
                        title: $t('eid_el_adha'),
                        routeName: 'tenant.occasions.eid-al-adha.index',
                        url: '/dashboard/occasions/eid-al-adha'
                    },
                    {
                        icon: 'icon-backpack',
                        // // Ignore: !hasPermission('list_permission'),
                        title: $t('school_entry'),
                        routeName: 'tenant.occasions.school-entry.index',
                        url: '/dashboard/occasions/school-entry'
                    },
                    {
                        icon: 'icon-moon-stars',
                        // // Ignore: !hasPermission('list_permission'),
                        title: $t('eid_el_fitr'),
                        routeName: 'tenant.occasions.eid-suit.index',
                        url: '/dashboard/occasions/eid-suit'
                    },
                    {
                        icon: 'icon-moon',
                        // // Ignore: !hasPermission('list_permission'),
                        title: $t('ramadan basket'),
                        routeName: 'tenant.occasions.ramadan-basket.index',
                        url: '/dashboard/occasions/ramadan-basket'
                    },
                    {
                        icon: 'icon-basket-shopping',
                        // // Ignore: !hasPermission('list_permission'),
                        title: $t('monthly basket'),
                        routeName: 'tenant.occasions.monthly-basket.index',
                        url: '/dashboard/occasions/monthly-basket'
                    },
                    {
                        icon: 'icon-baby-carriage',
                        // // Ignore: !hasPermission('list_permission'),
                        title: $t('milk and diapers'),
                        routeName: 'tenant.occasions.babies-milk-and-diapers.index',
                        url: '/dashboard/occasions/babies-milk-and-diapers'
                    }
                ]
            },
            'divider',
            {
                icon: 'icon-map-location-dot',
                // Ignore: !hasPermission('list_zones'),
                title: $t('the_zones'),
                routeName: 'tenant.zones.index',
                url: '/dashboard/zones'
            },
            {
                icon: 'icon-hands-holding-dollar',
                title: $t('financial'),
                routeName: '',
                subMenu: [
                    {
                        icon: 'icon-hands-holding-dollar',
                        // Ignore: !hasPermission('list_financial'),
                        title: $t('financial'),
                        routeName: 'tenant.financial.index',
                        url: '/dashboard/financial'
                    },
                    {
                        icon: 'icon-chart-pie-simple',
                        title: $t('statistics'),
                        routeName: 'tenant.financial.statistics',
                        url: '/dashboard/financial/statistics'
                    }
                ]
            },
            {
                icon: 'icon-shelves',
                // Ignore: !hasPermission('list_inventory'),
                title: $t('the_inventory'),
                routeName: 'tenant.inventory.index',
                url: '/dashboard/inventory'
            },
            {
                icon: 'icon-handshake-angle',
                // Ignore: !hasPermission('list_needs'),
                title: $t('the_needs'),
                routeName: 'tenant.needs.index',
                url: '/dashboard/needs'
            },
            {
                icon: 'icon-gear',
                // Ignore: !hasPermission('list_settings'),
                routeName: 'tenant.settings.index',
                title: $t('settings'),
                url: '/dashboard/settings'
            },
            {
                icon: 'icon-graduation-cap',
                // Ignore: !hasPermission('list_lessons'),
                routeName: 'tenant.lessons.index',
                title: $t('private_lessons'),
                url: '/dashboard/lessons'
            },
            {
                icon: 'icon-school-lock',
                // Ignore: !hasPermission('list_schools'),
                routeName: 'tenant.schools.index',
                title: $t('private_schools'),
                url: '/dashboard/schools'
            },
            {
                icon: 'icon-trash-list',
                // Ignore: !hasPermission('list_permission'),
                routeName: 'tenant.trash',
                title: $t('the_trash'),
                url: '/dashboard/trash'
            },
            {
                icon: 'icon-box-archive',
                // Ignore: !hasPermission('list_archive'),
                routeName: 'tenant.archive.index',
                title: $t('the_archive'),
                url: '/dashboard/archive'
            }
        ]
    })
})
