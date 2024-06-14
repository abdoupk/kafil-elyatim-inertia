import type { LitepickerElement } from '@/Components/Base/lite-picker'
import type { Form } from 'laravel-precognition-vue/dist/types'

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
    links: { [key: string]: string }
}

export interface RegistrationStepProps {
    currentStep: number
    totalSteps: number
    form?: Form<RegisterForm>
}

export type RegisterStepOneProps = 'association' | 'domain' | 'address' | 'city'

export type RegisterStepTwoProps = 'email' | 'first_name' | 'last_name' | 'phone' | 'password_confirmation' | 'password'

export type RegisterStepThreeProps = 'association_email' | 'landline' | 'phones' | 'links'

export interface PaginationData<T> {
    current_page: number
    data: Array<T>
    first_page_url: string
    from: number
    last_page: number
    last_page_url: string
    links: Array<{
        url: string
        label: string
        active: boolean
    }>
    next_page_url: string | null
    path: string
    per_page: number
    prev_page_url: string | null
    to: number
    total: number
}
