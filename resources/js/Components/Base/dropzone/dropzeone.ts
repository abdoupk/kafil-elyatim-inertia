import { DropzoneElement } from './BaseDropZone.vue'

import Dropzone, { DropzoneOptions } from 'dropzone'

const init = (
    el: DropzoneElement,
    props: {
        options: DropzoneOptions
        refKey?: string
    }
) => {
    Dropzone.autoDiscover = false

    if (!el.dropzone) {
        el.dropzone = new Dropzone(el, props.options)
    }
}

export { init }
