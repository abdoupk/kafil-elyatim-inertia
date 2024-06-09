import { ref, type App } from 'vue'
import type { LangType } from '@/types/types'

const locale = ref('ar') // default locale

const langData = ref<Record<string, string>>({})

async function fetchLocale() {
    const response = await fetch(`locales/${locale.value}.json`)

    langData.value = await response.json()
}

function setLocale(newLocale: LangType) {
    locale.value = newLocale

    fetchLocale().then()
}

function __(key: string, replacements: Record<string, string> = {}) {
    let translation = langData.value[key] || key

    Object.keys(replacements).forEach((replacement) => {
        translation = translation.replace(`:${replacement}`, replacements[replacement])
    })

    return translation
}

function n__(key: string, number: number, replacements: Record<string, string> = {}) {
    const options = key.split('|')

    key = options[1]

    if (number === 1) {
        key = options[0]
    }

    return __(key, replacements)
}

export default {
    install(app: App) {
        app.config.globalProperties.__ = (key: string, replacements: Record<string, string> = {}) =>
            __(key, replacements)

        app.config.globalProperties.n__ = (key: string, number: number, replacements: Record<string, string> = {}) =>
            n__(key, number, replacements)

        app.provide('locale', locale)

        app.provide('langData', langData)

        fetchLocale().then()
    },
    setLocale
}
