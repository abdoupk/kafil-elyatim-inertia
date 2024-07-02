import type { Form } from 'laravel-precognition-vue/dist/types'

import type { HousingType } from '@/Pages/Tenant/families/create/stepFour/HousingForm.vue'

import type { LitepickerElement } from '@/Components/Base/lite-picker'

import {
    colorSchemes,
    createFamilyStepOneErrorProps,
    createFamilyStepTwoErrorProps,
    layouts,
    registerStepOneErrorProps,
    registerStepThreeErrorProps,
    registerStepTwoErrorProps,
    themes
} from '@/utils/constants'

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

export type ColorSchemesType = typeof colorSchemes

export type ThemesType = typeof themes

export type LayoutsType = typeof layouts

export interface ISettingState {
    appearance: AppearanceType
    colorScheme: ColorSchemesType
    theme: ThemesType
    layout: LayoutsType
}

export type SVGType =
    | 'icon-hands-holding-child'
    | 'icon-shelves'
    | 'icon-note'
    | 'icon-filters'
    | 'icon-filter-list'
    | 'icon-couple'
    | 'icon-notes'
    | 'icon-calendar'
    | 'icon-circle-exclamation'
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
    wilaya_name: string
}

export interface Daira {
    id: number
    wilaya_code: string
    daira_name: string
}

export interface Commune {
    id: number
    commune_name: string
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

export type RegisterStepOneProps = typeof registerStepOneErrorProps

export type RegisterStepTwoProps = typeof registerStepTwoErrorProps

export type RegisterStepThreeProps = typeof registerStepThreeErrorProps

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

export interface Branch {
    id: string
    name: string
}

export interface Role {
    uuid: string
    name: string
}

export interface CreateBranchForm {
    name: string
    city_id: string
    president_id: string
    created_at: string
}

export interface CreateMemberForm {
    first_name: string
    last_name: string
    email: string
    phone: string
    zone_id: string
    qualification: string
    password: string
    password_confirmation: string
    branch_id: string
    roles: string[]
    gender: 'male' | 'female'
}

export interface AddItemToInventoryForm {
    name: string
    qty: number
    unit: 'kg' | 'piece' | 'liter'
    note: string
}

export interface FamiliesIndexResource {
    id: string
    name: string
    start_date: Date
    file_number: number
    zone: Zone
    address: string
}

export interface InventoryIndexResource {
    id: string
    name: string
    qty: number
    unit: string
    note?: string
    created_at: string
}

export interface OrphansIndexResource {
    id: string
    name: string
    birth_date: string
    family_status: string
    health_status: string
    academic_level: string
    shoes_size: string
    pants_size: string
    shirt_size: string
}

export interface SponsorsIndexResource {
    id: string
    name: string
    phone_number: string
    birth_date: string
    academic_level: string
    function: string
    health_status: string
    sponsor_type: string
}

export interface RolesIndexResource {
    uuid: string
    name: string
    created_at: string
    permissions_count: string
    users_count: string
}

export interface IndexParams {
    perPage: number
    search?: string
    page: number
    fields?: string[]
    directions?: {
        [key: string]: 'asc' | 'desc'
    }
    filters?: {
        [key: string]: {
            operator: 'like' | 'eq' | 'neq'
        }
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
    sponsor_type: string
    gender: 'male' | 'female'
    ccp: string
}

type SecondSponsorType = {
    first_name: string
    last_name: string
    phone_number: string
    income: number
    address: string
    degree_of_kinship: string
}

type SpouseType = {
    first_name: string
    last_name: string
    birth_date: string
    death_date: string
    function: string
    income: number
}

export type OrphanType = {
    first_name: string
    last_name: string
    birth_date: string
    family_status: string
    health_status: string
    academic_level: string
    shoes_size: string
    pants_size: string
    shirt_size: string
    note: string
    gender: 'male' | 'female'
    baby_milk_quantity: number
    baby_milk_type: string
    diapers_type: string
    diapers_quantity: number
}

export type IncomeType = {
    cnr: number
    casnos: number
    cnas: number
    pension: number
    other_income: number
    account: number
}

export type FamilySponsorship = 'monthly_allowance' | 'ramadan_basket' | 'zakat' | 'housing_assistance' | 'eid_al_adha'

export type SponsorSponsorship = 'medical_sponsorship' | 'literacy_lessons' | 'direct_sponsorship' | 'project_support'

export type OrphanSponsorship =
    | 'medical_sponsorship'
    | 'university_scholarship'
    | 'university_trips'
    | 'summer_camp'
    | 'eid_suit'
    | 'private_lessons'
    | 'school_bag'

export type FurnishingsType =
    | 'television'
    | 'refrigerator'
    | 'fireplace'
    | 'washing_machine'
    | 'water_heater'
    | 'oven'
    | 'wardrobe'
    | 'cupboard'
    | 'covers'
    | 'mattresses'
    | 'other_furnishings'

export type CreateFamilyForm = {
    address: string
    zone_id: string
    start_date: string
    file_number: string
    sponsor: SponsorType
    incomes: IncomeType
    second_sponsor: SecondSponsorType
    spouse: SpouseType
    orphans: OrphanType[]
    housing: {
        housing_type: {
            name: HousingType
            value: string | number | boolean | null
        }
        number_of_rooms?: number
        housing_receipt_number?: string
    }
    other_properties?: string
    furnishings: Record<FurnishingsType, any> & { notes: { [key in FurnishingsType]?: string } }
    report: string
    preview_date: string
    inspectors_members: string | string[]
    branch_id: string
    family_sponsorship: Record<FamilySponsorship, any> & { notes: { [key in FamilySponsorship]?: string } }
    sponsor_sponsorship: Record<SponsorSponsorship, any> & { notes: { [key in SponsorSponsorship]?: string } }
    orphans_sponsorship: Array<Record<OrphanSponsorship, any>>
}

export type InspectorsMembersType = Array<{ id: string; name: string }>

export type MembersType = Array<{ id: string; name: string }>

export interface CreateFamilyStepProps {
    currentStep: number
    totalSteps: number
    zones: Zone[]
    branches: Branch[]
    members: InspectorsMembersType
    form?: Form<CreateFamilyForm>
}

export type CreateFamilyStepOneProps = typeof createFamilyStepOneErrorProps

export type CreateFamilyStepTwoProps = typeof createFamilyStepTwoErrorProps

export interface MembersIndexResource {
    id: string
    name: string
    email: string
    phone: string
    zone: Zone
}

export interface BranchesIndexResource {
    id: string
    name: string
    city?: string
    president?: {
        id: string
        name?: string
    }
    families_count?: string
    created_at: string
}

export interface ZonesIndexResource extends Zone {
    created_at: string
    description: string
}
