import '../css/app.css'
import './bootstrap'
import './echo'
import i18n from './utils/i18n'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createPinia } from 'pinia'
import { type DefineComponent, createApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'

import { usePersistStore } from '@/utils/pinia'


const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

const pinia = createPinia()

pinia.use(usePersistStore)

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : `${appName}`),
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(i18n)
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)

        app.mount(el)

        // @ts-expect-error
        delete el.dataset.page
    },
    progress: {
        color: '#4B5563'
    }
}).then()
