import type { Form } from 'laravel-precognition-vue/dist/types'

import type { LitepickerElement } from '@/Components/Base/lite-picker'

import { createFamilyStepTwoErrorProps } from '@/utils/constants'

export interface IPlacement {
    placement:
        | 'top-start'
        | 'top'
        | 'top-end'
        | 'right-start'
        | 'right'
        | 'right-end'
        | 'bottom-end'
        | 'bottom'
        | 'bottom-start'
        | 'left-start'
        | 'left'
        | 'left-end'
}

export interface IMenu {
    icon: SVGType
    title: string
    url: string
    routeName: string
    subMenu?: IMenu[]
    ignore?: boolean
}

export interface IFormattedMenu extends IMenu {
    active?: boolean
    activeDropdown?: boolean
    subMenu?: IFormattedMenu[]
}

export interface ILocation {
    routeName: string
    forceActiveMenu?: string
}

export type AppearanceType = 'light' | 'dark'

export type ColorSchemesType = 'default' | 'theme_1' | 'theme_2' | 'theme_3' | 'theme_4'

export type ThemesType = 'enigma' | 'icewall' | 'tinker' | 'rubick'

export type LayoutsType = 'simple_menu' | 'side_menu' | 'top_menu'

export interface ISettingState {
    appearance: AppearanceType
    colorScheme: ColorSchemesType
    theme: ThemesType
    layout: LayoutsType
}

export type SVGType =
    | 'icon-hands-holding-child'
    | 'icon-circle-question'
    | 'icon-left-from-bracket'
    | 'icon-backpack'
    | 'icon-ram'
    | 'icon-moon-stars'
    | 'icon-moon'
    | 'icon-map-location-dot'
    | 'icon-chart-pie-simple'
    | 'icon-hand-holding-circle-dollar'
    | 'icon-grid-round-2-plus'
    | 'icon-code-merge'
    | 'icon-children'
    | 'icon-user-plus'
    | 'icon-gears'
    | 'icon-calendar-star'
    | 'icon-hands-holding-dollar'
    | 'icon-basket-shopping'
    | 'icon-house'
    | 'icon-users'
    | 'icon-user-lock'
    | 'icon-branches'
    | 'icon-file-export'
    | 'icon-family'
    | 'icon-users-gear'
    | 'icon-circle-nodes'
    | 'icon-file-pdf'
    | 'icon-pen'
    | 'icon-file-excel'
    | 'icon-print'
    | 'icon-square-check'
    | 'icon-arrows-up-down'
    | 'icon-bars-staggered'
    | 'icon-bell'
    | 'icon-check-circle'
    | 'icon-chevron-down'
    | 'icon-chevron-left'
    | 'icon-chevron-right'
    | 'icon-chevrons-left'
    | 'icon-chevrons-right'
    | 'icon-circle-x-mark'
    | 'icon-gear'
    | 'icon-gear-complex'
    | 'icon-image'
    | 'icon-pagination-dots'
    | 'icon-search'
    | 'icon-sort'
    | 'icon-sort-down'
    | 'icon-sort-up'
    | 'icon-spin'
    | 'icon-x'
    | 'icon-x-mark'
    | 'icon-trash-can'
    | 'icon-plus'
    | 'loader-oval'
    | 'no-data'
    | 'no-data-astro'

export interface Wilaya {
    wilaya_code: string
    wilaya_name: string | undefined
}

export interface Daira {
    id: number
    wilaya_code: string
    daira_name: string
}

export interface Commune {
    id: number
    commune_name: string | null | undefined
}

export type LangType = 'ar' | 'en' | 'fr' | 'tam'

export type RegisterForm = {
    association: string
    domain: string
    address: string
    city: string
    first_name: string
    last_name: string
    phone: string
    email: string
    password: string
    password_confirmation: string
    association_email: string
    landline: string
    phones: string[]
    ccp: string
    cpa: string
    links: { [key: string]: string }
}

export interface RegistrationStepProps {
    currentStep: number
    totalSteps: number
    form?: Form<RegisterForm>
}

export type RegisterStepOneProps = 'association' | 'domain' | 'address' | 'city'

export type RegisterStepTwoProps = 'email' | 'first_name' | 'last_name' | 'phone' | 'password_confirmation' | 'password'

export type RegisterStepThreeProps = 'association_email' | 'landline' | 'phones.0' | 'links'

export interface PaginationData<T> {
    data: Array<T>
    meta: {
        current_page: number
        first_page_url: string
        from: number
        last_page: number
        last_page_url: string
        next_page_url: string | null
        path: string
        per_page: number
        prev_page_url: string | null
        to: number
        total: number
    }
    links: Array<{
        url: string
        label: string
        active: boolean
    }>
}

export interface Zone {
    id: string
    name: string
    description?: string
}

export interface FamilyIndexResource {
    id: string
    name: string
    start_date: Date
    file_number: number
    zone: Zone
    address: string
}

export interface IndexFilters {
    perPage: number
    search?: string
    page: number
    fields?: string[]
    directions?: {
        [key: string]: 'asc' | 'desc'
    }
}

type SponsorType = {
    first_name: string
    last_name: string
    phone_number: string
    sponsorship_type: string
    birth_date: string
    father_name: string
    mother_name: string
    birth_certificate_number: string
    academic_level: string
    function: string
    health_status: string
    diploma: string
    card_number: string
}

export type CreateFamilyForm = {
    address: string
    zone: string
    start_date: string
    file_number: string
    sponsor: SponsorType
}

export interface CreateFamilyStepProps {
    currentStep: number
    totalSteps: number
    zones?: Zone[]
    form?: Form<CreateFamilyForm>
}

export type CreateFamilyStepOneProps = 'zone' | 'start_date' | 'address' | 'file_number'

export type CreateFamilyStepTwoProps = typeof createFamilyStepTwoErrorProps

export interface MembersIndexResource {
    id: string
    name: string
    email: string
    phone: string
    zone: Zone
}

export interface ZonesIndexResource extends Zone {
    created_at: string
    description: string
}
