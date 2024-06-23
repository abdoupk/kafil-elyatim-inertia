<script setup lang="ts">
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{ index: number }>()

const emit = defineEmits(['removeOrphan'])

const removeOrphan = (index: number) => {
    emit('removeOrphan', index)
}
</script>

<template>
    <div class="flex my-5">
        <p class="text-base font-medium">
            {{ $t('child no', { no: String(index + 1) }) }}
        </p>

        <button class="ms-auto me-2"></button>

        <a
            tabindex="-1"
            class="ms-2 inline-block"
            :class="{ 'cursor-not-allowed': index === 0 }"
            href="#"
            @click.prevent="removeOrphan(index)"
        >
            <svg-loader class="fill-danger" name="icon-trash-can"></svg-loader>
        </a>
    </div>

    <slot></slot>
</template>
