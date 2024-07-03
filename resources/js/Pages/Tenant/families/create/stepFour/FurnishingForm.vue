<script setup lang="ts">
import type { FurnishingsType } from '@/types/types'

import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormTextArea from '@/Components/Base/form/BaseFormTextArea.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'

const emit = defineEmits(['update:furnishings'])

const items = ref<Record<FurnishingsType, boolean>>({
    television: false,
    refrigerator: false,
    fireplace: false,
    washing_machine: false,
    water_heater: false,
    oven: false,
    wardrobe: false,
    cupboard: false,
    covers: false,
    mattresses: false,
    other_furnishings: false
})

const television = defineModel('television')

const refrigerator = defineModel('refrigerator')

const fireplace = defineModel('fireplace')

const washingMachine = defineModel('washingMachine')

const waterHeater = defineModel('waterHeater')

const oven = defineModel('oven')

const wardrobe = defineModel('wardrobe')

const cupboard = defineModel('cupboard')

const covers = defineModel('covers')

const mattresses = defineModel('mattresses')

const toggle = (key: FurnishingsType) => {
    items.value[key] = !items.value[key]

    emit('update:furnishings', items.value)
}
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-6">
        <!-- Begin: Television -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('television')"
                            id="television"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="television">
                            {{ $t('furnishings.television') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.television"
                        class="w-full md:w-3/4"
                        v-model="television"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Television -->

        <!-- Begin: Refrigerator -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('refrigerator')"
                            id="refrigerator"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="refrigerator">
                            {{ $t('furnishings.refrigerator') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.refrigerator"
                        class="w-full md:w-3/4"
                        v-model="refrigerator"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Refrigerator -->

        <!-- Begin: Fireplace -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('fireplace')"
                            id="fireplace"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="fireplace">
                            {{ $t('furnishings.fireplace') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.fireplace"
                        class="w-full md:w-3/4"
                        v-model="fireplace"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Fireplace -->

        <!-- Begin: washing Machine -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('washing_machine')"
                            id="washing_machine"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="washing_machine">
                            {{ $t('furnishings.washing_machine') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.washing_machine"
                        class="w-full md:w-3/4"
                        v-model="washingMachine"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: washing Machine -->

        <!-- Begin: Water Heater -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('water_heater')"
                            id="water_heater"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="water_heater">
                            {{ $t('furnishings.water_heater') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.water_heater"
                        class="w-full md:w-3/4"
                        v-model="waterHeater"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Water Heater -->

        <!-- Begin: Oven -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('oven')"
                            id="oven"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="oven">
                            {{ $t('furnishings.oven') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.oven"
                        class="w-full md:w-3/4"
                        v-model="oven"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Oven -->

        <!-- Begin: Wardrobe -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('wardrobe')"
                            id="wardrobe"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="wardrobe">
                            {{ $t('furnishings.wardrobe') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.wardrobe"
                        class="w-full md:w-3/4"
                        v-model="wardrobe"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Wardrobe -->

        <!-- Begin: Cupboard -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('cupboard')"
                            id="cupboard"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="cupboard">
                            {{ $t('furnishings.cupboard') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.cupboard"
                        class="w-full md:w-3/4"
                        v-model="cupboard"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Cupboard -->

        <!-- Begin: Covers -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('covers')"
                            id="covers"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="covers">
                            {{ $t('furnishings.covers') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.covers"
                        class="w-full md:w-3/4"
                        v-model="covers"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Covers -->

        <!-- Begin: Mattresses -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('mattresses')"
                            id="mattresses"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="mattresses">
                            {{ $t('furnishings.mattresses') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>
                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-text-area
                        :disabled="!items.mattresses"
                        class="w-full md:w-3/4"
                        v-model="mattresses"
                        rows="4"
                        :placeholder="$t('notes')"
                    ></base-form-text-area>
                </div>
            </div>
        </div>
        <!-- End: Mattresses -->
    </div>
</template>
