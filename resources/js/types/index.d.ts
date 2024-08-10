import type { AppearanceType, ColorSchemesType, DatabaseNotification, LayoutsType, ThemesType } from '@/types/types'

import { Config } from 'ziggy-js'

export interface User {
    id: number
    first_name: string
    last_name: string
    gender?: 'male' | 'female'
    email: string
    email_verified_at: string
    roles: string[]
    tenant_id: string
    permissions: string[]
}

export interface UserSettings {
    layout: LayoutsType
    color_scheme: ColorSchemesType
    theme: ThemesType
    appearance: AppearanceType
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User
        settings: UserSettings
        notifications: DatabaseNotification[]
    }
    association: string
    ziggy: Config & { location: string }
}
