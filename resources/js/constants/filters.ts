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

const filterStringNumberOperators: Array<ListBoxOperator> = [
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

export const familiesFilters: ListBoxFilter[] = [
    {
        icon: 'icon-users',
        field: 'family_id',
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
        field: 'zone.id',
        label: 'zone',
        type: 'object',
        operators: filterObjectOperators
    },
    {
        icon: 'icon-children',
        field: 'orphans_count',
        label: 'orphans_count',
        type: 'string',
        operators: filterStringNumberOperators
    },
    {
        icon: 'icon-calendar',
        field: 'start_date',
        label: 'start_date',
        type: 'date',
        operators: filterDateOperators
    }
]
