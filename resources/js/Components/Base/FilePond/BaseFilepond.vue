<script setup lang="ts">
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js'
import 'filepond/dist/filepond.min.css'
import { ref } from 'vue'
import vueFilePond from 'vue-filepond'

const FilePond = vueFilePond(FilePondPluginFileValidateType)

const myFiles = ref([])

const pond = ref(null)

function handleFilePondInit() {
    console.log('FilePond has initialized')

    pond.value?.getFiles()
}
</script>

<template>
    <div id="app">
        <FilePond
            name="test"
            ref="pond"
            class-name="my-pond"
            allow-multiple="false"
            credits=""
            accepted-file-types="image/jpeg, image/png,image/jpg,image/svg"
            v-bind:files="myFiles"
            v-on:init="handleFilePondInit"
        />
    </div>
</template>
