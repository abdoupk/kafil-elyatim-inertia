import type { Branch, Zone } from '@/types/types'

interface Stats {
    total: number
    percentageDifference: string
}

export interface GeneralReportsType {
    members: Stats
    orphans: Stats
    branches: Stats
    families: Stats
}

export type FinancialReportsType = {
    incomes: number[]
    expenses: number[]
    totalThisMonth: number
    totalLastMonth: number
}

export type RecentActivitiesType = {
    id: string
    date: Date
    formatted_date: string
    user: {
        id: string
        name: string
        gender: 'male' | 'female'
    }
    message: string
}[]

export type RecentTransactionsType = {
    id: string
    receiver: {
        id: string
        name: string
        gender: 'male' | 'female'
    }
    date: string
    amount: number
}[]

export type ComingEventsType = unknown

export type RecentFamiliesType = {
    id: string
    name: string
    address: string
    zone: Zone
    branch: Branch
    orphans_count: number
}[]

export type RecentNeedsType = unknown
