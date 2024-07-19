<template>
    <div class="flex justify-start">
        <div
            v-for="color in colors"
            :key="color"
            class="relative cursor-pointer gap-4 flex justify-center ms-2 first:ms-0"
        >
            <button
                :class="{ 'ring-2': selectedColor === color }"
                :style="{ backgroundColor: color }"
                class="w-8 h-8 transition-all rounded-full block ring-primary hover:ring-2 ring-offset-1 dark:ring-darkmode-200"
                type="button"
                @click="selectColor(color)"
            ></button>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue'

interface Props {
    modelValue: string
}

const props = defineProps<Props>()

const emit = defineEmits(['update:modelValue'])

const colors = ['#FF69B4',
'#33CC33',
'#6666CC',
'#CC0000',
'#87ceeb',
'#0099CC',
'#9900CC',
'#CCCCCC']

const selectedColor = ref(props.modelValue)

function selectColor(color: string) {
    selectedColor.value = color

    emit('update:modelValue', color)
}
</script>
