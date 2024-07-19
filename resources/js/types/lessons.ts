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

export type EventType = {
    id: string
    title: string
    color: string
    start: string | Date
    end: string | Date
}
