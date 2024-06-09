import { PageProps as InertiaPageProps } from '@inertiajs/core'
import { AxiosInstance } from 'axios'
import { route as ziggyRoute } from 'ziggy-js'
import { PageProps as AppPageProps } from './'

declare global {
    interface Window {
        axios: AxiosInstance
    }

    var route: typeof ziggyRoute
}

declare module 'vue' {
    interface ComponentCustomProperties {
        route: typeof ziggyRoute
        __: (key: string, replacements?: Record<string, string>) => string
        n__: (key: string, number: number, replacements?: Record<string, string>) => string
    }
}

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}
