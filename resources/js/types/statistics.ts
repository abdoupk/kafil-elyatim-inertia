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
