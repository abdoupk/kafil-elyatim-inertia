import { MeiliSearch } from 'meilisearch'


// Initialize the Meilisearch client
const client = new MeiliSearch({
    host: 'http://127.0.0.1:7700',
    apiKey: 'masterKey'
})

// Function to get paginated documents from all indexes
export async function getPaginatedDocuments(page = 1, limit = 10) {
    const indexes = (await client.getIndexes()).results

    const allDocuments = []

    for (const index of indexes) {
        const documents = (await index.getDocuments({ offset: (page - 1) * limit, limit })).results

        allDocuments.push(...documents.map((doc) => ({ ...doc, index: index.uid })))
    }

    return allDocuments
}

// Example usage
getPaginatedDocuments(15, 3).then((documents) => {
    // Create a data table with the document values and their index
    const dataTable = documents.map((doc, i) => [
        i + 1,
        JSON.stringify(doc), // Document value
        doc.index // Document index
    ])

    console.table(dataTable)
})
