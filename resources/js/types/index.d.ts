import { Config } from 'ziggy-js'
import type { AppearanceType, ColorSchemesType, LayoutsType, ThemesType } from '@/types/types'
export interface User {
    id: number
    name: string
    email: string
    email_verified_at: string
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
    }
    ziggy: Config & { location: string }
}
