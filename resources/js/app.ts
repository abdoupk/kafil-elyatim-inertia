import '../css/app.css'
import './bootstrap'
import i18n from './utils/i18n'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createPinia } from 'pinia'
// import "vue-select/dist/vue-select.css";
import VCalendar from 'v-calendar'
import 'v-calendar/style.css'
import { type DefineComponent, createApp, h } from 'vue'
import vSelect from 'vue-select'
import { ZiggyVue } from 'ziggy-js'

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

        // app.component("v-select", vSelect);
        app.use(VCalendar, {})

        app.mount(el)

        // @ts-expect-error
        delete el.dataset.page
    },
    progress: {
        color: '#4B5563'
    }
}).then()
