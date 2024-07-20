export type SchoolType = {
    id: string
    name: string
}

export type LessonType = {
    id: string
    name: string
}

export type OrphanType = {
    id: string
    name: string
}

export type SubjectType = {
    id: number
    name: string
}

export interface AddSchoolLessonType {
    academic_level_id: number | null
    quota: number | null
    subject_id: number | null
}

export type EventType = {
    id: string
    title: string
    color: string
    start: string | Date
    end: string | Date
}

export interface AcademicLevelType {
    levels: {
        id: string
        name: string
    }[]
    phase: string
}
