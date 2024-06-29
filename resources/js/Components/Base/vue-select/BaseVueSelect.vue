<template>
    <multiselect v-model="value" :options="options" :show-labels="false" multiple></multiselect>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    // OR register locally
    components: { Multiselect },
    data() {
        return {
            value: null,
            options: ['list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options', 'list', 'of', 'options']
        }
    }
}
</script>

<!-- TODO change vue-multiselect.ssr.css  -->
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style lang="postcss">
@import '/resources/css/vendors/vue-multiselect.css';
</style>
