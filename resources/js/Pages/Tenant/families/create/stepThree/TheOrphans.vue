<script setup lang="ts">
import SvgLoader from '@/Components/SvgLoader.vue'

defineProps<{ index: number }>()

const emit = defineEmits(['removeOrphan'])

const removeOrphan = (index: number) => {
    emit('removeOrphan', index)
}
</script>

<template>
    <div class="my-5 flex">
        <p class="text-base font-medium">
            {{ $t('child no', { no: String(index + 1) }) }}
        </p>

        <button class="me-2 ms-auto"></button>

        <a
            class="ms-2 inline-block !outline-none focus-visible:!rounded-sm focus-visible:!outline-red-300/70"
            :class="{ hidden: index === 0 }"
            href="#"
            @click.prevent="removeOrphan(index)"
        >
            <svg-loader class="fill-danger" name="icon-trash-can"></svg-loader>
        </a>
    </div>

    <slot></slot>
</template>
