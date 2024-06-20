<script lang="ts" setup>
import BaseBreadCrumb from '@/Components/Base/Breadcrumb/BaseBreadcrumb.vue'
import BaseBreadCrumbLink from '@/Components/Base/Breadcrumb/BaseBreadcrumbLink.vue'
import { __ } from '@/utils/i18n'
import { computedEager } from '@vueuse/core'
import { usePage } from '@inertiajs/vue3'

const { light = false } = defineProps<{ light?: boolean }>()

const breadcrumbs = computedEager(() => {
    const pathArray = usePage().url.split('/').filter(Boolean)

    const breadCrumbs = []

    let href = ''

    let prevText = ''

    for (const path of pathArray) {
        href += `/${path}`

        const resolvedHref = href === '/' ? '/dashboard' : href

        // eslint-disable-next-line
        // const text = __(path, settingsStore.lang)

        if (prevText !== 'edit' && prevText !== 'create' && prevText !== 'show') {
            breadCrumbs.push({
                href: resolvedHref,
                active: path !== pathArray[pathArray.length - 1],
                text: __('breadcrumb.' + path.split(/[?#]/)[0])
            })
        } else {
            breadCrumbs[breadCrumbs.length - 1].active = false
        }

        prevText = path
    }

    return breadCrumbs
})
</script>

<template>
    <base-bread-crumb :light="light" class="-intro-x me-auto hidden sm:flex">
        <base-bread-crumb-link
            v-for="(breadcrumb, index) in breadcrumbs"
            :key="index"
            :active="breadcrumb.active"
            :index="index"
            :light="light"
            :href="breadcrumb.href"
        >
            {{ breadcrumb.text }}
        </base-bread-crumb-link>
    </base-bread-crumb>
</template>
