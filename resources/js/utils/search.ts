import type { SVGType } from '@/types/types'

import { usePage } from '@inertiajs/vue3'
import { type Hit, MeiliSearch } from 'meilisearch'

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
                limit: 25,
                sort: ['created_at:desc'],
                // filter: `tenant_id = ${usePage().props.auth.user.tenant_id}`,
                attributesToRetrieve: ['id', 'name', 'email'],
                attributesToSearchOn: ['name', 'email', 'phone', 'gender']
            },
            {
                indexUid: 'families',
                q,
                limit: 25,
                sort: ['created_at:desc'],
                // filter: `tenant_id = ${usePage().props.auth.user.tenant_id}`,
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
            return route('tenant.members.show', hit.id)
        case 'families':
            return route('tenant.families.show', hit.id)

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
        default:
            return ''
    }
}
