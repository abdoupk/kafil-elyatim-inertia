export type CreateVocationalTrainingAchievementForm = {
    year: string | null
    vocational_training_id: number
    orphan_id: string
    institute: string
    note?: string
}

export type VocationalTrainingSpecialitiesType = {
    division: string
    speciality: {
        id: number
        name: string
    }[]
}
