import { defineStore } from 'pinia'

export const useMenuStore = defineStore('menu', {
    state: () => ({
        menu: [
            {
                icon: 'icon-bell',
                routeName: 'tenant.dashboard',
                url: '/',
                title: 'Home'
            },
            'divider',
            {
                icon: 'icon-bell',
                routeName: '',
                url: '/welcome',
                title: 'Welcome',
                subMenu: [
                    {
                        icon: 'icon-bell',
                        routeName: '',
                        url: '/welcome/create',
                        title: 'welcome create',
                        subMenu: [
                            {
                                icon: 'icon-bell',
                                routeName: 'tenant.test',
                                url: '/welcome/create/new',
                                title: 'welcome create new'
                            }
                        ]
                    }
                ]
            }
        ]
    })
})
