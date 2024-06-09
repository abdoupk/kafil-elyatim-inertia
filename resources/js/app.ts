import './bootstrap'
import '../css/app.css'

import { createApp, type DefineComponent, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from 'ziggy-js'
import i18n from './utils/i18n'
import { createPinia } from 'pinia'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(i18n)
            .use(plugin)
            .use(createPinia())
            .use(ZiggyVue)

        app.mount(el)

        // @ts-expect-error
        delete el.dataset.page
    },
    progress: {
        color: '#4B5563'
    }
}).then()
