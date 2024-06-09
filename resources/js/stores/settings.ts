import type { AppearanceType, ColorSchemesType, ISettingState, LayoutsType, ThemesType } from '@/types/types'
import { defineStore } from 'pinia'

export const useSettingsStore = defineStore('settings', {
    state: (): ISettingState => ({
        appearance: 'light',
        colorScheme: 'theme-1',
        theme: 'tinker',
        layout: 'side-menu'
    }),
    getters: {},
    actions: {
        async toggleAppearance(value: AppearanceType) {
            if (this.appearance !== value) {
                this.appearance = value
            }

            //TODO send request with axios!!!
        },

        async changeColorScheme(colorScheme: ColorSchemesType) {
            if (this.colorScheme !== colorScheme) {
                this.colorScheme = colorScheme
            }

            //TODO send request with axios!!!
        },

        async changeTheme(theme: ThemesType) {
            if (this.theme !== theme) {
                this.theme = theme
            }
            //TODO send request with axios!!!
        },

        async changeLayout(layout: LayoutsType) {
            if (this.layout !== layout) {
                this.layout = layout
            }

            //TODO send request with axios!!!
        }
    }
})
