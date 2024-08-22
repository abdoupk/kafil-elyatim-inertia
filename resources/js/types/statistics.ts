export type FamiliesByZoneType = {
    labels: string[]
    data: number[]
}

export type FamiliesByBranchType = {
    labels: string[]
    data: number[]
}

export type FamiliesByOrphansCountType = {
    total_families: number[]
    orphans_count: number[]
}

export type FamiliesSponsorShipsType = {
    ramadan_basket_count: number
    zakat_count: number
    housing_assistance_count: number
    eid_al_adha_count: number
}

export type FamiliesGroupByDateType = number[]

export type OrphansByFamilyStatusType = {
    labels: string[]
    data: number[]
}

export type OrphansByAcademicLevelType = {
    labels: string[]
    data: number[]
}

export type OrphansBySponsorshipType = number[]

export type OrphansByGenderType = {
    labels: string[]
    data: number[]
}

export type OrphansByAgeType = number[]

export type OrphansByZoneType = number[]

export type OrphansByBranchType = number[]

export type OrphansByPantsAndShirtSizeType = number[]

export type OrphansByShoeSizeType = number[]

export type OrphansByVocationalTrainingType = number[]

export type OrphansByCreatedDateType = number[]

export type OrphansGroupHealthStatusType = number[]

export type SponsorsBySponsorTypeType = number[]

export type SponsorsByAcademicLevelType = number[]

export type SponsorsBySponsorshipType = number[]

export type SponsorsByDiplomaType = number[]
