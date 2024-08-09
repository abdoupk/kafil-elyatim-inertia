interface Stats {
    total: number
    percentageDifference: string
}

export interface GeneralReports {
    members: Stats
    orphans: Stats
    branches: Stats
    families: Stats
}
