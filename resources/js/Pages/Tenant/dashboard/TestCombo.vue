<template>
    <div class="relative">
        <Combobox v-model="selectedOption">
            <div class="relative mt-1">
                <div
                    class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
                >
                    <ComboboxInput
                        :displayValue="(option) => option?.name"
                        class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                        @change="querySearch = $event.target.value"
                    />
                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2"> ddd</ComboboxButton>
                </div>
                <TransitionRoot
                    leave="transition ease-in duration-100"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
                    @after-leave="querySearch = ''"
                >
                    <ComboboxOptions
                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    >
                        <div
                            v-if="filteredOptions.length === 0 && querySearch !== ''"
                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                        >
                            Nothing found.
                        </div>
                        <template v-for="(group, groupName) in groupedOptions" :key="groupName">
                            <div
                                v-if="group.length > 0"
                                class="group-label bg-gray-100 px-4 py-2 text-sm font-medium text-gray-500"
                            >
                                {{ groupName }}
                            </div>
                            <ComboboxOption
                                v-for="option in group"
                                :key="option.id"
                                v-slot="{ active, selected }"
                                :value="option"
                            >
                                <div
                                    :class="[
                                        'relative cursor-default select-none py-2 pl-10 pr-4',
                                        {
                                            'bg-teal-600 text-white': active,
                                            'text-gray-900': !active
                                        }
                                    ]"
                                >
                                    <span
                                        :class="[
                                            'block truncate',
                                            { 'font-medium': selected, 'font-normal': !selected }
                                        ]"
                                    >
                                        {{ option.name }}
                                    </span>
                                    <span
                                        v-if="selected"
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-white"
                                    >
                                        xhe
                                    </span>
                                </div>
                            </ComboboxOption>
                        </template>
                    </ComboboxOptions>
                </TransitionRoot>
            </div>
        </Combobox>
    </div>
</template>

<script lang="ts" setup>
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxOption,
    ComboboxOptions,
    TransitionRoot
} from '@headlessui/vue'
import { computed, ref } from 'vue'

// Import { ChevronUpDownIcon, CheckIcon } from '@heroicons/vue/20/solid';

interface Option {
    id: string
    name: string
    group?: string
}

const options: Option[] = [
    { id: '1', name: 'Option 1', group: 'Group A' },
    { id: '2', name: 'Option 2', group: 'Group A' },
    { id: '3', name: 'Option 3', group: 'Group B' },
    { id: '4', name: 'Option 4', group: 'Group B' },
    { id: '5', name: 'Option 5', group: 'Group C' },
    { id: '6', name: 'Option 6', group: 'Group C' }
]

const selectedOption = ref<Option | null>(null)

const querySearch = ref('')

const groupedOptions = computed<{ [key: string]: Option[] }>(() => {
    return options.reduce(
        (acc, option) => {
            if (!acc[option.group || 'Ungrouped']) {
                acc[option.group || 'Ungrouped'] = []
            }

            acc[option.group || 'Ungrouped'].push(option)

            return acc
        },
        {} as { [key: string]: Option[] }
    )
})

const filteredOptions = computed(() => {
    const searchTerm = querySearch.value.toLowerCase()

    return Object.values(groupedOptions.value).flatMap((group) =>
        group.filter((option) => option.name.toLowerCase().includes(searchTerm))
    )
})
</script>
