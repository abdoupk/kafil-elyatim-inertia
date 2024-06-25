import type { LitepickerElement, LitepickerEmit, LitepickerProps } from './BaseLitePicker.vue'

import dayjs from 'dayjs'
import Litepicker from 'litepicker'
// eslint-disable-next-line sort-imports
import 'litepicker/dist/plugins/keyboardnav'

import { capitalizeFirstLetter } from '@/utils/helper'
import { __ } from '@/utils/i18n'

interface Picker extends Litepicker {}

const getDateFormat = (format: string | undefined) => {
    return format !== undefined ? format : 'D MMM, YYYY'
}

const setValue = (props: LitepickerProps, emit: LitepickerEmit) => {
    const format = getDateFormat(props.options.format)

    if (!props.modelValue.length) {
        let date = dayjs().format(format)

        date +=
            !props.options.singleMode && props.options.singleMode !== undefined
                ? ' - ' + dayjs().add(1, 'month').format(format)
                : ''

        emit('update:modelValue', date)
    }
}

const init = (el: LitepickerElement, props: LitepickerProps, emit: LitepickerEmit) => {
    const format = getDateFormat(props.options.format)

    el.litePickerInstance = new Litepicker({
        ...props.options,
        autoApply: false,
        lang: 'ar', // TODO get locale from i18n
        showWeekNumbers: false,
        dropdowns: {
            minYear: 1990,
            maxYear: null,
            months: true,
            years: true
        },
        buttonText: {
            apply: capitalizeFirstLetter(__('apply')),
            cancel: capitalizeFirstLetter(__('cancel')),
            reset: capitalizeFirstLetter(__('reset'))
        },
        element: el,
        format: format,
        setup: (picker: Picker) => {
            if (picker.on) {
                picker.on('selected', (startDate, endDate) => {
                    let date = dayjs(startDate.dateInstance).format(format)

                    date +=
                        endDate !== undefined && endDate !== null
                            ? ' - ' + dayjs(endDate.dateInstance).format(format)
                            : ''

                    emit('update:modelValue', date)
                })
            }
        },
        plugins: ['keyboardnav']
    })
}

const reInit = (el: LitepickerElement, props: LitepickerProps, emit: LitepickerEmit) => {
    el.litePickerInstance.destroy()

    init(el, props, emit)
}

export { setValue, init, reInit }
