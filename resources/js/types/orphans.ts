import type { OrphanSponsorshipType } from '@/types/families'

export interface OrphanShowType {
    id: string
    name: string
    birth_date: string
    family_status: string
    health_status: string
    academic_level: string
    shoes_size: string
    pants_size: string
    shirt_size: string
    note: string
    gender: string
    creator: {
        id: string
        name: string
    }
    sponsorships: OrphanSponsorshipType
}
