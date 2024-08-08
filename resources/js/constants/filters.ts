import type { ListBoxFilter, ListBoxOperator } from '@/types/types'

const filterObjectOperators: Array<ListBoxOperator> = [
    {
        label: 'filters.is',
        value: '='
    },
    {
        label: 'filters.is_not',
        value: '!='
    }
]

const filterDateOperators: Array<ListBoxOperator> = [
    {
        label: 'filters.before',
        value: '<'
    },
    {
        label: 'filters.after',
        value: '>'
    },
    {
        label: 'filters.on',
        value: '='
    },
    {
        label: 'filters.is_not_on',
        value: '!='
    },
    {
        label: 'filters.is_in_the_past',
        value: '<='
    },
    {
        label: 'filters.is_in_the_future',
        value: '>='
    }
]

const filterNumberOperators: Array<ListBoxOperator> = [
    {
        label: 'filters.equal_to',
        value: '='
    },
    {
        label: 'filters.not_equal_to',
        value: '!='
    },
    {
        label: 'filters.is_greater_than',
        value: '>'
    },
    {
        label: 'filters.is_less_than',
        value: '<'
    },
    {
        label: 'filters.is_greater_than_or_equal_to',
        value: '>='
    },
    {
        label: 'filters.is_less_than_or_equal_to',
        value: '<='
    }
]

const filterStringOperators: Array<ListBoxOperator> = [
    {
        label: 'filters.equal_to',
        value: '='
    },
    {
        label: 'filters.not_equal_to',
        value: '!='
    }
]

// TODO:add dzd icon add death date spouse
export const familiesFilters: ListBoxFilter[] = [
    {
        icon: 'icon-users',
        field: 'id',
        label: 'family',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-child',
        field: 'sponsor.id',
        label: 'sponsor',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-branches',
        field: 'branch.id',
        label: 'branch',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-map-location-dot',
        field: 'address.zone.id',
        label: 'zone',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-children',
        field: 'orphans_count',
        label: 'orphans_count',
        type: 'number',
        operators: filterNumberOperators
    },
    {
        icon: 'icon-children',
        field: 'spouse.function',
        label: 'spouse.function',
        type: 'string',
        operators: filterStringOperators
    },
    {
        icon: 'icon-children',
        field: 'total_income',
        label: 'total_income',
        type: 'number',
        operators: filterNumberOperators
    },
    {
        icon: 'icon-graduation-cap',
        field: 'sponsor.academic_level_id',
        label: 'sponsor_academic_level',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-calendar',
        field: 'start_date',
        label: 'starting_sponsorship_date',
        type: 'date',
        operators: filterDateOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'family_sponsorships',
        label: 'family_sponsorships',
        type: 'object',
        operators: filterObjectOperators
    }
]

export const sponsorsFilters: ListBoxFilter[] = [
    {
        icon: 'icon-hands-holding-child',
        field: 'id',
        label: 'sponsor',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-children',
        field: 'orphans_count',
        label: 'children_count',
        type: 'number',
        operators: filterNumberOperators
    },
    {
        icon: 'icon-children',
        field: 'income',
        label: 'income',
        type: 'number',
        operators: filterNumberOperators
    },
    {
        icon: 'icon-graduation-cap',
        field: 'academic_level_id',
        label: 'sponsor.academic_level',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-calendar',
        field: 'birth_date',
        label: 'birth_date',
        type: 'date',
        operators: filterDateOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'sponsorships',
        label: 'sponsor_sponsorships',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'health_status',
        label: 'health_status',
        type: 'string',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'sponsor_type',
        label: 'sponsor_type',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'gender',
        label: 'gender',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'function',
        label: 'function',
        type: 'string',
        operators: filterStringOperators
    }
]

export const orphansFilters: ListBoxFilter[] = [
    {
        icon: 'icon-hands-holding-child',
        field: 'id',
        label: 'orphan',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-children',
        field: 'income',
        label: 'income',
        type: 'number',
        operators: filterNumberOperators
    },
    {
        icon: 'icon-graduation-cap',
        field: 'academic_level.id',
        label: 'orphan.academic_level',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-calendar',
        field: 'birth_date',
        label: 'birth_date',
        type: 'date',
        operators: filterDateOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'sponsorships',
        label: 'orphan_sponsorships',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'health_status',
        label: 'health_status',
        type: 'string',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'family_status',
        label: 'family_status',
        type: 'string',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'gender',
        label: 'gender',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'shoes_size',
        label: 'shoes_size',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'pants_size',
        label: 'pants_size',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-hands-holding-heart',
        field: 'shirt_size',
        label: 'shirt_size',
        type: 'object',
        operators: filterObjectOperators
    }
]

export const eidAlAdhaFilters: ListBoxFilter[] = []
