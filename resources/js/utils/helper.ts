import type { AppearanceType, ColorSchemesType, IndexParams } from '@/types/types'

import { usePage } from '@inertiajs/vue3'
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

const setColorSchemeClass = (colorScheme: ColorSchemesType, appearance: AppearanceType) => {
    const el = document.querySelectorAll('html')[0]

    el.setAttribute('class', colorScheme)

    appearance === 'dark' && el.classList.add('dark')
}

const isEmpty = (obj) => !Object.entries(obj || {}).length && !obj?.length && !obj?.size

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
    return new Intl.DateTimeFormat(`${getLocale()}-DZ`, {
        dateStyle
    }).format(new Date(date))
}

const formatCurrency = (amount) => {
    return new Intl.NumberFormat(`${getLocale()}-DZ`, { style: 'currency', currency: 'DZD' }).format(amount)
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

function jumpToPreviousItem(results, currentIndex) {
    const previousItemIndex = currentIndex.item - 1

    if (previousItemIndex >= 0) {
        // Jump to previous item in current group
        currentIndex.item = previousItemIndex
    } else {
        // Jump to last item in previous group
        const previousGroupIndex = currentIndex.group - 1

        if (previousGroupIndex >= 0) {
            const previousGroup = results[previousGroupIndex]

            currentIndex.group = previousGroupIndex

            currentIndex.item = previousGroup.length - 1
        }
    }
}

function jumpToNextItem(results, currentIndex) {
    const currentGroup = results[currentIndex.group]

    const nextItemIndex = currentIndex.item + 1

    if (nextItemIndex < currentGroup.length) {
        // Jump to next item in current group
        currentIndex.item = nextItemIndex
    } else {
        // Jump to first item in next group
        const nextGroupIndex = currentIndex.group + 1

        if (nextGroupIndex < results.length) {
            currentIndex.group = nextGroupIndex

            currentIndex.item = 0
        }
    }
}

export {
    isEqual,
    formatDate,
    formatNumber,
    jumpToNextItem,
    jumpToPreviousItem,
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
