import type { AppearanceType, ColorSchemesType, LayoutsType, ThemesType } from '@/types/types'

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
        notifications: {
            data: T
            user: {
                id: string
                gender: 'male' | 'female'
                name: string
            }
            metadata: {
                created_at: string
                url: string
            }
        }[]
    }
    association: string
    ziggy: Config & { location: string }
}
