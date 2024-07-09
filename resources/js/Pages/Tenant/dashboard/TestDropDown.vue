<script lang="ts" setup>
import type { SVGType } from '@/types/types'

import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { ref } from 'vue'

import SvgLoader from '@/Components/SvgLoader.vue'

const people: Array<{ field: string; icon: SVGType; operators: Array<string> }> = [
    {
        field: 'name',
        icon: 'icon-bell',
        operators: ['contains',
'not_contains',
'starts_with',
'ends_with']
    },
    {
        field: 'age',
        icon: 'icon-users-gear',
        operators: ['contains',
'not_contains',
'starts_with',
'ends_with']
    }
]

const selected = ref(people[0])
</script>

<template>
    <listbox v-model="selected" as="div">
        <div class="relative mt-2">
            <listbox-button
                class="relative w-full cursor-default rounded-md bg-white dark:bg-darkmode-800 py-1.5 ps-3 pe-10 text-start text-gray-900 dark:text-slate-300 shadow-sm focus:ring-4 focus:ring-primary focus:ring-opacity-20 border dark:focus:ring-slate-700 dark:focus:ring-opacity-50 sm:text-sm sm:leading-6"
            >
                <span class="flex items-center">
                    <svg-loader :name="selected.icon" class="h-5 w-5 flex-shrink-0 rounded-full" />
                    <span class="ms-3 block truncate">{{ selected.field }}</span>
                </span>

                <span class="pointer-events-none absolute inset-y-0 end-0 ms-3 flex items-center pe-2">
                    <svg-loader aria-hidden="true" class="h-5 w-5 text-gray-400" name="icon-angles-up-down" />
                </span>
            </listbox-button>

            <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <listbox-options
                    class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white dark:bg-darkmode-800 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                >
                    <listbox-option
                        v-for="person in people"
                        :key="person.field"
                        v-slot="{ active, selected }"
                        :value="person"
                        as="template"
                    >
                        <li
                            :class="[
                                active ? 'bg-primary text-white' : 'text-gray-900 dark:text-slate-300',
                                'relative cursor-default select-none py-2 ps-3 pe-9'
                            ]"
                        >
                            <div class="flex items-center">
                                <svg-loader :name="person.icon" class="h-5 w-5 flex-shrink-0 rounded-full" />
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ms-3 block truncate']">{{
                                    person.field
                                }}</span>
                            </div>

                            <span
                                v-if="selected"
                                :class="[
                                    active ? 'text-white' : 'text-primary',
                                    'absolute inset-y-0 end-0 flex items-center pe-4'
                                ]"
                            >
                            </span>
                        </li>
                    </listbox-option>
                </listbox-options>
            </transition>
        </div>
    </listbox>
</template>
