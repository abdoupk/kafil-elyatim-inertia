import type { SVGType } from '@/types/types'

import { usePage } from '@inertiajs/vue3'
import { type Hit, MeiliSearch } from 'meilisearch'

import { formatCurrency, formatDate, formatNumber } from '@/utils/helper'
import { __, getLocale, n__ } from '@/utils/i18n'

const client = new MeiliSearch({
    host: 'http://127.0.0.1:7700',
    apiKey: 'masterKey'
})

export const search = async (q: string) => {
    const a = await client.multiSearch({
        queries: [
            {
                indexUid: 'users',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name', 'email'],
                attributesToSearchOn: ['name', 'email', 'phone', 'gender']
            },
            {
                indexUid: 'zones',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name'],
                attributesToSearchOn: ['name']
            },
            {
                indexUid: 'branches',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name'],
                attributesToSearchOn: ['name']
            },
            {
                indexUid: 'orphans',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name', 'readable_birth_date'],
                attributesToSearchOn: [
                    'name',
                    'note',
                    'health_status',
                    'family_status',
                    'academic_level.level',
                    'academic_level.phase',
                    'shoes_size',
                    'shirt_size',
                    'pants_size',
                    'gender'
                ]
            },
            {
                indexUid: 'sponsors',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name', 'phone_number'],
                attributesToSearchOn: [
                    'name',
                    'function',
                    'birth_certificate_number',
                    'mother_name',
                    'academic_level.level',
                    'academic_level.phase',
                    'father_name',
                    'phone_number',
                    'sponsor_type',
                    'gender',
                    'diploma',
                    'ccp'
                ]
            },
            {
                indexUid: 'finances',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'specification', 'amount'],
                attributesToSearchOn: ['description', 'specification', 'creator']
            },
            {
                indexUid: 'families',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name', 'address.zone.name'],
                attributesToSearchOn: [
                    'name',
                    'phone',
                    'file_number',
                    'address.zone.name',
                    'address.address',
                    'start_date',
                    'second_sponsor.name',
                    'second_sponsor.degree_of_kinship',
                    'second_sponsor.address',
                    'spouse.name',
                    'spouse.function'
                ]
            },
            {
                indexUid: 'inventory',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name', 'qty', 'unit'],
                attributesToSearchOn: ['name', 'unit', 'note']
            },
            {
                indexUid: 'babies',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: [
                    'id',
                    'baby_milk_quantity',
                    'baby_milk_type',
                    'diapers_quantity',
                    'orphan.id',
                    'orphan.name',
                    'orphan.readable_birth_date',
                    'diapers_type'
                ],
                attributesToSearchOn: ['baby_milk_type', 'diapers_type']
            },
            {
                indexUid: 'needs',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'subject', 'needable.name', 'status'],
                attributesToSearchOn: ['subject', 'demand', 'needable.name', 'status', 'needable.type', 'note']
            },
            {
                indexUid: 'schools',
                q,
                limit: 5,
                sort: ['created_at:desc'],
                filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
                attributesToRetrieve: ['id', 'name', 'quota'],
                attributesToSearchOn: ['name']
            }
        ]
    })

    a.results.forEach((result) => {
        result.hits.forEach((hit) => {
            hit.index = result.indexUid
            hit.url = constructLink(hit, result.indexUid)
            hit.icon = constructIcon(result.indexUid)
            hit.hint = constructHint(hit, result.indexUid)
            hit.title = constructTitle(hit, result.indexUid)
        })
    })

    return a.results
}

function constructLink(hit: Hit, indexUid: string) {
    switch (indexUid) {
        case 'users':
            return route('tenant.members.index', { show: hit.id })
        case 'families':
            return route('tenant.families.show', hit.id)
        case 'orphans':
            return route('tenant.orphans.show', hit.id)
        case 'sponsors':
            return route('tenant.sponsors.show', hit.id)
        case 'needs':
            return route('tenant.needs.index', { show: hit.id })
        case 'inventory':
            return route('tenant.inventory.index', { show: hit.id })
        case 'schools':
            return route('tenant.schools.index', { show: hit.id })
        case 'zones':
            return route('tenant.zones.index', { show: hit.id })
        case 'branches':
            return route('tenant.branches.index', { show: hit.id })
        case 'finances':
            return route('tenant.financial.index', { show: hit.id })
        case 'babies':
            return route('tenant.orphans.show', hit.orphan.id)
        default:
            return ''
    }
}

const constructIcon = (indexUid: string): { icon: SVGType; color: string } => {
    switch (indexUid) {
        case 'users':
            return {
                icon: 'icon-users-gear',
                color: 'bg-success/20 text-success dark:bg-success/10'
            }
        case 'families':
            return {
                icon: 'icon-family',
                color: 'bg-pending/20 text-pending dark:bg-pending/10'
            }
        case 'orphans':
            return {
                icon: 'icon-children',
                color: 'bg-indigo-500/20 text-indigo-600 dark:bg-indigo-200/30 dark:text-indigo-900'
            }
        case 'sponsors':
            return {
                icon: 'icon-hands-holding-child',
                color: 'bg-danger/20 text-danger dark:bg-danger/10'
            }
        case 'needs':
            return {
                icon: 'icon-handshake-angle',
                color: 'bg-warning/30 text-white dark:bg-warning/10'
            }
        case 'inventory':
            return {
                icon: 'icon-shelves',
                color: 'bg-theme-1/20 text-theme-1 dark:bg-theme-1/10'
            }
        case 'schools':
            return {
                icon: 'icon-school-lock',
                color: 'bg-theme-2/20 text-theme-2 dark:bg-theme-2/10'
            }
        case 'zones':
            return {
                icon: 'icon-map-location-dot',
                color: 'bg-pending/20 text-pending dark:bg-pending/10'
            }
        case 'branches':
            return {
                icon: 'icon-branches',
                color: 'bg-pending/20 text-pending dark:bg-pending/10'
            }
        case 'finances':
            return {
                icon: 'icon-dollar-sign',
                color: 'bg-pending/20 text-pending dark:bg-pending/10'
            }
        case 'babies':
            return {
                icon: 'icon-dollar-sign',
                color: 'bg-pending/20 text-pending dark:bg-pending/10'
            }
        default:
            return {
                icon: 'icon-sort',
                color: 'bg-secondary/20 dark:bg-secondary/10'
            }
    }
}

const constructHint = (hit: Hit, indexUid: string) => {
    switch (indexUid) {
        case 'users':
            return hit.email
        case 'families':
            return hit.address.zone?.name
        case 'orphans':
            return formatDate(hit.readable_birth_date, 'long')
        case 'sponsors':
            return hit.phone_number
        case 'needs':
            return __(hit.status)
        case 'inventory':
            return formatNumber(hit.qty) + '(' + __(hit.unit) + ')'
        case 'schools':
            return n__('number_of_places', hit.quota, { value: hit.quota })
        case 'zones':
            return formatDate(hit.created_at, 'long')
        case 'branches':
            return formatDate(hit.created_at, 'long')
        case 'finances':
            return formatCurrency(hit.amount)
        case 'babies':
            return formatDate(hit.orphan.readable_birth_date, 'long')
        default:
            return null
    }
}

const constructTitle = (hit: Hit, indexUid: string) => {
    switch (indexUid) {
        case 'users':
            return hit.name
        case 'families':
            return hit.name
        case 'orphans':
            return hit.name
        case 'sponsors':
            return hit.name
        case 'needs':
            return hit.subject
        case 'inventory':
            return hit.name
        case 'schools':
            return hit.name
        case 'zones':
            return hit.name
        case 'branches':
            return hit.name
        case 'babies':
            return hit.orphan.name
        case 'finances':
            return hit.specification[getLocale()]
        default:
            return ''
    }
}
