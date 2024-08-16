import type { AppearanceType, ColorSchemesType, IndexParams, ListBoxFilter } from '@/types/types'

import { router, usePage } from '@inertiajs/vue3'
import dayjs from 'dayjs'
import duration from 'dayjs/plugin/duration'
import type { Hit } from 'meilisearch'
import { parseColor } from 'tailwindcss/lib/util/color'
import { computed } from 'vue'

import { __, getLocale } from '@/utils/i18n'


dayjs.extend(duration)
const toRaw = (obj: object) => {
    return JSON.parse(JSON.stringify(obj))
}
const toRGB = (value: string) => {
    return parseColor(value).color.join(' ')
}

// noinspection JSUnusedLocalSymbols
const slideUp = (el: HTMLElement, duration = 300, callback = (el: HTMLElement) => {}) => {
    el.style.transitionProperty = 'height, margin, padding'

    el.style.transitionDuration = duration + 'ms'

    el.style.height = el.offsetHeight + 'px'

    el.offsetHeight

    setSlideProperties(el)

    window.setTimeout(() => {
        el.style.display = 'none'

        el.style.removeProperty('height')

        el.style.removeProperty('padding-top')

        el.style.removeProperty('padding-bottom')

        el.style.removeProperty('margin-top')

        el.style.removeProperty('margin-bottom')

        el.style.removeProperty('overflow')

        el.style.removeProperty('transition-duration')

        el.style.removeProperty('transition-property')

        callback(el)
    }, duration)
}

const setSlideProperties = (el: HTMLElement) => {
    el.style.overflow = 'hidden'

    el.style.height = '0'

    el.style.paddingTop = '0'

    el.style.paddingBottom = '0'

    el.style.marginTop = '0'

    el.style.marginBottom = '0'
}

// noinspection JSUnusedLocalSymbols
const slideDown = (el: HTMLElement, duration = 300, callback = (el: HTMLElement) => {}) => {
    el.style.removeProperty('display')

    let display = window.getComputedStyle(el).display

    if (display === 'none') display = 'block'

    el.style.display = display

    const height = el.offsetHeight

    setSlideProperties(el)

    el.offsetHeight

    el.style.transitionProperty = 'height, margin, padding'

    el.style.transitionDuration = duration + 'ms'

    el.style.height = height + 'px'

    el.style.removeProperty('padding-top')

    el.style.removeProperty('padding-bottom')

    el.style.removeProperty('margin-top')

    el.style.removeProperty('margin-bottom')

    window.setTimeout(() => {
        el.style.removeProperty('height')

        el.style.removeProperty('overflow')

        el.style.removeProperty('transition-duration')

        el.style.removeProperty('transition-property')

        callback(el)
    }, duration)
}

const setDarkModeClass = (appearance: AppearanceType) => {
    appearance === 'dark'
        ? document.documentElement.classList.add('dark')
        : document.documentElement.classList.remove('dark')
}

function getDateSuffix(date) {
    const options = { day: 'numeric', locale: 'en-US' }
    const formatter = new Intl.DateTimeFormat(`${getLocale()}-DZ`, options)
    const formattedDate = formatter.format(date)

    // Extract the date suffix from the formatted string
    return formattedDate.match(/\D+$/)[0]
}

const setColorSchemeClass = (colorScheme: ColorSchemesType, appearance: AppearanceType) => {
    const el = document.querySelectorAll('html')[0]

    el.setAttribute('class', colorScheme)

    appearance === 'dark' && el.classList.add('dark')
}

const isEmpty = (value) => {
    if (Array.isArray(value)) {
        return value.length === 0 || value.every((item) => isEmpty(item))
    } else if (typeof value === 'object' && value !== null) {
        return Object.keys(value).length === 0 || Object.values(value).every((item) => isEmpty(item))
    } else {
        return value === null || value === undefined || value === ''
    }
}

const getResultsSize = (results: Array<Hit>) => {
    return results?.reduce(
        (acc, innerArr) => acc + innerArr?.filter((obj: Hit) => obj?.hasOwnProperty('id'))?.length,
        0
    )
}
const omit = (obj: any, props: any): any => {
    obj = { ...obj }

    props.forEach((prop: any) => delete obj[prop])

    return obj
}

function isEqual(x: any, y: any): any {
    const ok = Object.keys,
        tx = typeof x,
        ty = typeof y

    return x && y && tx === 'object' && tx === ty
        ? ok(x).length === ok(y).length && ok(x).every((key) => isEqual(x[key], y[key]))
        : x === y
}

const allowOnlyNumbersOnKeyDown = (event: KeyboardEvent) => {
    // eslint-disable-next-line array-element-newline
    if (!['Backspace', 'Tab', 'Enter'].includes(event.key) && !/[0-9]/.test(event.key)) {
        event.preventDefault()
    }
}

const debounce = (func, delay, { leading } = {}) => {
    let timerId

    return (...args) => {
        if (!timerId && leading) {
            func(...args)
        }
        clearTimeout(timerId)

        timerId = setTimeout(() => func(...args), delay)
    }
}

const capitalizeFirstLetter = (string: string) => {
    return string.charAt(0).toUpperCase() + string.slice(1)
}

const checkErrors = (pattern: string, errors?: Record<string, string>) => {
    const regex = new RegExp(pattern)

    return (
        errors &&
        Object.keys(errors).some((error) => {
            if (regex.test(error)) return true
        })
    )
}

const handleSort = (field: string, params: IndexParams) => {
    params.fields = (params?.fields ?? []) || []

    params.directions = { ...params.directions }

    if (params.fields.includes(field)) {
        const idx = params.fields.indexOf(field)

        if (params.directions[field] === 'asc') {
            params.directions[field] = 'desc'
        } else {
            params.fields.splice(idx, 1)

            delete params.directions[field]
        }
    } else {
        params.fields.push(field)

        params.directions[field] = 'asc'
    }

    return params
}

const isAssociationNameLatin = computed(() => {
    return /^[a-z]+/i.test(usePage().props.association)
})

const formatDate = (date: string | Date, dateStyle: 'full' | 'long' | 'medium' | 'short' | undefined) => {
    try {
        return new Intl.DateTimeFormat(`${getLocale()}-DZ`, {
            dateStyle
        }).format(new Date(date))
    } catch ($e) {
        return ''
    }
}

const formatCurrency = (amount) => {
    try {
        return new Intl.NumberFormat(`${getLocale()}-DZ`, { style: 'currency', currency: 'DZD' }).format(amount)
    } catch ($e) {
        return ''
    }
}

const handleSponsorship = (sponsorshipValue: string) => {
    if (sponsorshipValue === '0') {
        return __('no')
    }

    if (sponsorshipValue === '1') {
        return __('yes')
    }

    const parsedValue = parseFloat(sponsorshipValue)

    if (!isNaN(parsedValue)) {
        return formatCurrency(parsedValue)
    } else {
        return sponsorshipValue
    }
}

const handleFurnishings = (sponsorshipValue) => {
    if (sponsorshipValue === '0') {
        return __('no')
    }

    if (sponsorshipValue === '1') {
        return __('yes')
    }

    return sponsorshipValue
}

const groupByKey = (arr, key) => {
    return arr.reduce((acc, current) => {
        ;(acc[current[key]] = acc[current[key]] || []).push(current)
        return acc
    }, {})
}

const formatNumber = (value: number) => {
    return new Intl.NumberFormat(`${getLocale()}-DZ`).format(value)
}

function setDateToCurrentTime(value: string | Date) {
    const currentTime = dayjs()

    return dayjs(value)
        .startOf('day')
        .add(currentTime.valueOf() - currentTime.startOf('day').valueOf(), 'millisecond')
}

const combineDateAndTime = (startDate: string | Date | undefined, theDate: string | Date) => {
    if (startDate && theDate) {
        const time = dayjs(startDate).format('HH:mm:ss')

        const date = dayjs(theDate).format('YYYY-MM-DD')

        return dayjs(`${date} ${time}`).toDate()
    }
}

function getAcademicLevelFromId(id, academicLevels) {
    if (!id) return ''
    else {
        return academicLevels.reduce((acc, curr) => {
            const level = curr.levels.find((level) => Number(level.id) === id)

            if (level) acc = level

            return acc
        }, {})
    }
}

function getVocationalTrainingSpecialityFromId(id, specialities) {
    if (!id) return ''
    else {
        return specialities.reduce((acc, curr) => {
            const speciality = curr.specialities.find((speciality) => Number(speciality.id) === id)

            if (speciality) acc = speciality

            return acc
        }, {})
    }
}

function handleFilterValue(filter: ListBoxFilter, value): string {
    if (filter.type === 'date') {
        const convertedDate = Date.parse(value) / 1000

        if (isNaN(convertedDate)) return ''

        return convertedDate.toString()
    } else if (filter.field === 'sponsorship') {
        if (value.value !== '') return true

        return ''
    } else if (filter.field === 'family_sponsorships' || filter.field === 'sponsorships') {
        if (value.value !== '') return true

        return ''
    } else if (filter.type === 'object') {
        if (value?.id !== undefined) return value.id
        else return value.value
    } else if (filter.type === 'number') {
        if (typeof value === 'object') return ''
    }
    return value
}

const handleFilterName = (field: ListBoxFilter, value: { value: string } | string): string => {
    const isSponsorship = ['family_sponsorships', 'sponsor_sponsorships'].includes(field.label)

    const isOrphanSponsorship = field.label === 'orphan_sponsorships'

    if (field.field === 'sponsorship' && typeof value !== 'string') {
        return `${value.value}`
    } else if (isSponsorship && typeof value !== 'string') {
        return `${field.label}.${value.value}`
    } else if (isOrphanSponsorship && typeof value !== 'string') {
        return `${field.field}.${value.value}`
    } else {
        return field.field || field
    }
}

const formatUrl = (url: string) => {
    const parsedUrl = new URL(url)

    const searchParams = parsedUrl.searchParams

    for (const [key, value] of searchParams.entries()) {
        if (value === '') {
            searchParams.delete(key)
        }
    }

    parsedUrl.search = searchParams.toString()

    return parsedUrl.toString()
}

const formatFilters = (filters) => {
    return {
        ...filters
            ?.map((filter) => {
                return {
                    field: handleFilterName(filter.field, filter.value),
                    operator: filter?.operator?.value ?? filter.operator,
                    value: handleFilterValue(filter.field, filter.value)
                }
            })
            .filter((filter) => filter?.operator && filter.operator !== '')
            .filter((filter) => filter?.value !== undefined && filter.value !== '')
            .filter((filter) => filter?.field)
    }
}

const getDataForIndexPages = (url: string, params: IndexParams, options: object) => {
    let data = { ...params }

    if (params.search === '' || params.search === undefined) {
        delete data.search
    }

    Object.keys(data).forEach((key) => {
        if (!data[key as keyof IndexParams]) delete data[key as keyof IndexParams]
    })

    data.filters = formatFilters(data.filters)

    router.get(url, data, options)
}

function hasPermission(permission) {
    if (typeof permission === 'string') {
        return (
            !usePage().props.auth.user.roles.includes('super_admin') ||
            usePage().props.auth.user.permissions.includes(permission.toString())
        )
    } else if (Array.isArray(permission)) {
        return (
            !usePage().props.auth.user.roles.includes('super_admin') ||
            usePage().props.auth.user.permissions.some((item) => permission.includes(item))
        )
    } else {
        return false
    }
}

export {
    isEqual,
    hasPermission,
    formatFilters,
    getDataForIndexPages,
    handleFilterValue,
    formatDate,
    formatUrl,
    combineDateAndTime,
    getAcademicLevelFromId,
    getVocationalTrainingSpecialityFromId,
    setDateToCurrentTime,
    formatNumber,
    getDateSuffix,
    isAssociationNameLatin,
    groupByKey,
    handleSponsorship,
    handleFurnishings,
    formatCurrency,
    handleSort,
    omit,
    toRaw,
    toRGB,
    slideUp,
    debounce,
    slideDown,
    setDarkModeClass,
    isEmpty,
    getResultsSize,
    setColorSchemeClass,
    allowOnlyNumbersOnKeyDown,
    capitalizeFirstLetter,
    checkErrors
}
