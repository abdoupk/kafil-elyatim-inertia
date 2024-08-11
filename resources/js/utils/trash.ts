import { usePage } from '@inertiajs/vue3'
import { MeiliSearch } from 'meilisearch'


// Initialize the Meilisearch client
const client = new MeiliSearch({
    host: 'http://127.0.0.1:7700',
    apiKey: 'masterKey'
})

// Function to get paginated documents from all indexes
export async function getPaginatedDocuments(page = 1, limit = 10) {
    const indexes = (await client.getIndexes()).results

    console.log(
        indexes.filter(
            (index) => !['previews', 'family_sponsorships', 'orphan_sponsorships', 'roles'].includes(index.uid)
        )
    )

    const allDocuments = []

    for (const index of indexes) {
        const documents = await index.getDocuments({
            offset: (page - 1) * limit,
            limit,
            filter: `tenant_id = ${usePage().props.auth.user.tenant_id} AND __soft_deleted = 0`,
            fields: ['id']
        })

        console.log('results', documents)

        allDocuments.push(...documents.results.map((doc) => ({ ...doc, index: index.uid })))
    }

    return allDocuments
}

// Example usage
getPaginatedDocuments(1, 5).then((documents) => {
    // Create a data table with the document values and their index
    return documents.map((doc, i) => [
        i + 1,
        JSON.stringify(doc), // Document value
        doc.index // Document index
    ])
})
