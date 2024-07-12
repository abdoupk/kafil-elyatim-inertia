export interface OrphanType {
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
}

export interface SpouseType {
    id: string
    name: string
    birth_date: string
    death_date: string
    function: string
    income: string
}

interface IncomeType {
    id: string
    cnr: string
    cnas: string
    casnos: string
    pension: string
    account: string
    other_income: string
    total_income: number
}

export interface SponsorType {
    name: string
    phone_number: string
    sponsor_type: string
    birth_date: string
    father_name: string
    mother_name: string
    birth_certificate_number: string
    academic_level: string
    function: string
    health_status: string
    diploma: string
    card_number: string
    ccp: string
    id: string
    creator: {
        id: string
        name: string
    }
    incomes: IncomeType
}

export interface SecondSponsorType {
    id: string
    name: string
    degree_of_kinship: string
    phone_number: string
    address: string
    income: string
}

export interface FurnishingType {
    id: string
    television: string
    refrigerator: string
    fireplace: string
    washing_machine: string
    water_heater: string
    oven: string
    wardrobe: string
    cupboard: string
    covers: string
    mattresses: string
    other_furnishings: string
}

export interface HousingType {
    id: string
    name: string
    value: string
    housing_receipt_number: string
    number_of_rooms: number
    other_properties: string
}

export interface FamilySponsorshipType {
    id: string
    monthly_allowance: string
    ramadan_basket: string
    zakat: string
    housing_assistance: string
    eid_al_adha: string
}

export interface OrphanSponsorshipType {
    id: string
    medical_sponsorship: boolean
    university_scholarship: boolean
    association_trips: boolean
    summer_camp: boolean
    eid_suit: boolean
    private_lessons: boolean
    school_bag: boolean
}

export interface SponsorSponsorshipType {
    id: string
    medical_sponsorship: string
    literacy_lessons: string
    direct_sponsorship: string
    project_support: string
}

export interface PreviewType {
    id: string
    report: string
    preview_date: string
    inspectors: {
        id: string
        name: string
    }[]
}

export interface FamilyShowType {
    id: string
    name: string
    address: string
    file_number: string
    start_date: Date
    branch: string
    zone: string
    orphans: OrphanType[]
    spouse: SpouseType
    sponsor: SponsorType
    second_sponsor: SecondSponsorType
    furnishings: FurnishingType
    housing: HousingType
    family_sponsorships: FamilySponsorshipType
    orphans_sponsorships: OrphanSponsorshipType[]
    sponsor_sponsorships: SponsorSponsorshipType
    preview: PreviewType
}
