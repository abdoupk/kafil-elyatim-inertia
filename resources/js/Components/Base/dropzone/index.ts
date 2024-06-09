import '@pqina/pintura/pintura.css'
import Dropzone, { type DropzoneFile } from 'dropzone'
import { createDefaultImageReader, openDefaultEditor } from '@pqina/pintura'
// @ts-expect-error
import useEditorWithDropzone from '@pqina/dropzone-pintura/dist/useEditorWithDropzone.js'

const init = (el: HTMLDivElement, emit: any, props: any) => {
    Dropzone.autoDiscover = false

    const options = {
        url: props.options?.url,

        maxFiles: props.options?.maxFiles,

        acceptedFiles: props.options?.acceptedFiles,

        maxFilesize: props.options?.maxFilesize,

        headers: {
            'X-CSRF-TOKEN': 'CSRF-TOKEN' //TODO get CSRF TOKEN from inertia
        },

        previewsContainer: '.preview',

        previewTemplate: `<div class='relative image-fit w-[120px] h-28 group'>
                                       <img class='group-hover:scale-[1.05] transition-transform duration-500 block mx-auto rounded-s-md rounded-ee-md thumb' data-dz-thumbnail  alt='' src=''/>
                                       <div data-dz-remove data-title='Remove this image?' class='hover:cursor-pointer z-50 w-5 h-5 dz-remove !flex items-center justify-center absolute rounded-full text-white bg-danger end-0 top-0 -me-2 -mt-2'>
                                          <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='!cursor-pointer w-4 h-4'>
                                             <line x1='18' y1='6' x2='6' y2='18'></line>
                                             <line x1='6' y1='6' x2='18' y2='18'></line>
                                          </svg>
                                       </div>
                                       <div data-title='edit this image?' class='dz-edit z-50 w-5 h-5 flex items-center justify-center absolute rounded-full stroke-white bg-emerald-700 end-0 top-8 -me-2 -mt-2'>
                                          <svg class='!cursor-pointer w-4 h-4' fill='none' height='24' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                           </svg>
                                       </div>
                                       <div class='dz-details'>
                                          <div class='dz-filename truncate'><span data-dz-name></span></div>
                                          <div class='dz-size' data-dz-size></div>
                                          <div class='dz-error-message'><span data-dz-errormessage></span></div>

                                          <div class='dz-error-mark'>
                                          <svg width="54px" height="54px" viewBox="0 0 54 54"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475"> <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"></path> </g> </g> </svg></div>
                                          <div class='dz-success-mark'>
                                          <svg width="54px" height="54px" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF"></path> </g> </svg>
                                          </div>
                                       </div>
                                       <div class='dz-progress'><span class='dz-upload' data-dz-uploadprogress></span></div>
                                    </div>`,

        renameFile: function (file: DropzoneFile): string {
            return `${new Date().getTime()}--------${file.name}`
        }
    }

    const initEd = {
        imageReader: createDefaultImageReader(),

        enableButtonClose: true,

        imageWriter: {
            store: async (state: any, option: any, onprogress: any) =>
                await new Promise((resolve) => {
                    const { dest } = state

                    el.dropzone.createThumbnail(
                        dest,
                        el.dropzone.options.thumbnailWidth,
                        el.dropzone.options.thumbnailHeight,
                        el.dropzone.options.thumbnailMethod,
                        true,
                        (thumb) => {
                            el.dropzone.emit('addedfile', dest)

                            el.dropzone.emit('thumbnail', dest, thumb)

                            const formData = new FormData()

                            formData.append('image', dest)

                            const request = new XMLHttpRequest()

                            request.responseType = 'json'

                            request.open('POST', props.url)

                            //TODO get CSRF-TOKEN
                            request.setRequestHeader('X-CSRF-TOKEN', 'X-CSRF-TOKEN')

                            request.upload.onprogress = onprogress

                            request.onload = async () => {
                                if (request.status >= 200 && request.status < 300) {
                                    state.store = request

                                    el.dropzone.emit('uploadprogress', dest, 100, dest.size)

                                    el.dropzone.emit('success', dest)

                                    emit('fileUploaded', request.response.file_name)
                                } else if (request.status === 422)
                                    el.dropzone.emit('error', dest, request.response?.data.errors[0])
                                else el.dropzone.emit('error', dest, `something went wrong ${request.status}`)

                                resolve(state)
                            }

                            request.send(formData)
                        }
                    )
                })
        }
    }

    Dropzone.options.pinturaDropzone = useEditorWithDropzone(
        openDefaultEditor,

        initEd,

        options
    )

    el.dropzone = new Dropzone(el, options)

    el.dropzone.on('error', (file: DropzoneFile) => {
        const editor = openDefaultEditor({
            src: file,

            ...initEd
        })

        editor.show()

        editor.on('process', () => {
            el.dropzone.removeFile(file)
        })
    })
}

export { init }
