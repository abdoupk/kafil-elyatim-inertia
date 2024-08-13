import type { AppearanceType, ColorSchemesType, ISettingState, LayoutsType, ThemesType } from '@/types/types'

import axios from 'axios'
import { defineStore } from 'pinia'


export const useSettingsStore = defineStore('settings', {
    state: (): ISettingState => ({
        appearance: 'light',
        colorScheme: 'theme-1',
        theme: 'tinker',
        layout: 'side-menu',
        hints: {
            ramadan_basket: true
        }
    }),
    getters: {},
    actions: {
        async toggleAppearance(value: AppearanceType) {
            if (this.appearance !== value) {
                this.appearance = value

                await axios.put('/settings', { appearance: value })
            }
        },

        async changeColorScheme(colorScheme: ColorSchemesType) {
            if (this.colorScheme !== colorScheme) {
                this.colorScheme = colorScheme

                await axios.put('/settings', { color_scheme: colorScheme })
            }
        },

        async changeTheme(theme: ThemesType) {
            if (this.theme !== theme) {
                this.theme = theme

                await axios.put('/settings', { theme })
            }
        },

        async changeLayout(layout: LayoutsType) {
            if (this.layout !== layout) {
                this.layout = layout

                await axios.put('/settings', { layout })
            }
        },

        setHintToHidden(hint: string) {
            this.hints[hint] = false
        }
    }
})
