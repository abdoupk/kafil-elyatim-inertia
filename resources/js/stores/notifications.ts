import type { DatabaseNotification, PaginationData } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'

interface State {
    notification: DatabaseNotification | null
    notifications: PaginationData<DatabaseNotification>
}

export const useNotificationsStore = defineStore('notifications', {
    state: (): State => ({
        notification: null,
        notifications: {
            data: [],
            links: {
                next: '',
                url: '',
                label: '',
                active: false
            }
        }
    }),
    actions: {
        async getNotifications() {
            const { data: notifications } = await axios.get<PaginationData<DatabaseNotification>>(
                route('tenant.notifications.index')
            )

            this.notifications = notifications

            console.log(this.notifications)
        },

        async loadMoreNotifications() {
            if (this.notifications && this.notifications.links.next) {
                const { data: notifications } = await axios.get<PaginationData<DatabaseNotification>>(
                    this.notifications.links.next
                )

                this.notifications = {
                    ...this.notifications,
                    data: [...this.notifications.data, ...notifications.data],
                    links: notifications.links
                }
            }
        },

        addNotification(notification: DatabaseNotification) {
            console.log(this.notifications?.data?.length)

            this.notifications.data.unshift(notification)

            console.log(this.notifications?.data?.length)
        }
    }
})
