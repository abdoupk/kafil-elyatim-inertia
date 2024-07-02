<script setup lang="ts">
import type { FamilySponsorship } from '@/types/types'

import { ref } from 'vue'

import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseFormSwitch from '@/Components/Base/form/form-switch/BaseFormSwitch.vue'
import BaseFormSwitchInput from '@/Components/Base/form/form-switch/BaseFormSwitchInput.vue'
import BaseFormSwitchLabel from '@/Components/Base/form/form-switch/BaseFormSwitchLabel.vue'

const emit = defineEmits(['update:familySponsorship'])

const items = ref<Record<FamilySponsorship, boolean>>({
    monthly_allowance: false,
    ramadan_basket: false,
    zakat: false,
    housing_assistance: false,
    eid_al_adha: false
})

const monthlyAllowance = defineModel('monthlyAllowance')

const ramadanBasket = defineModel('ramadanBasket')

const zakat = defineModel('zakat')

const housingAssistance = defineModel('housingAssistance')

const eidAlAdha = defineModel('eidAlAdha')

const toggle = (key: FamilySponsorship) => {
    items.value[key] = !items.value[key]

    emit('update:familySponsorship', items.value)
}
</script>

<template>
    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-6">
        <!-- Begin: monthly Allowance -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('monthly_allowance')"
                            id="monthly_allowance"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="monthly_allowance">
                            {{ $t('sponsorships.monthly_allowance') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>

                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-input
                        :disabled="!items.monthly_allowance"
                        class="w-full md:w-3/4"
                        v-model="monthlyAllowance"
                        type="text"
                        :placeholder="$t('notes')"
                    ></base-form-input>
                </div>
            </div>
        </div>
        <!-- End: monthly Allowance -->

        <!-- Begin: monthly Allowance -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('ramadan_basket')"
                            id="ramadan_basket"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="ramadan_basket">
                            {{ $t('sponsorships.ramadan_basket') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>

                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-input
                        :disabled="!items.ramadan_basket"
                        class="w-full md:w-3/4"
                        v-model="ramadanBasket"
                        type="text"
                        :placeholder="$t('notes')"
                    ></base-form-input>
                </div>
            </div>
        </div>
        <!-- End: monthly Allowance -->

        <!-- Begin: monthly Allowance -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('zakat')"
                            id="zakat"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="zakat">
                            {{ $t('sponsorships.zakat') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>

                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-input
                        :disabled="!items.zakat"
                        class="w-full md:w-3/4"
                        v-model="zakat"
                        type="text"
                        :placeholder="$t('notes')"
                    ></base-form-input>
                </div>
            </div>
        </div>
        <!-- End: monthly Allowance -->

        <!-- Begin: monthly Allowance -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('housing_assistance')"
                            id="housing_assistance"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="housing_assistance">
                            {{ $t('sponsorships.housing_assistance') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>

                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-input
                        :disabled="!items.housing_assistance"
                        class="w-full md:w-3/4"
                        v-model="housingAssistance"
                        type="text"
                        :placeholder="$t('notes')"
                    ></base-form-input>
                </div>
            </div>
        </div>
        <!-- End: monthly Allowance -->

        <!-- Begin: monthly Allowance -->
        <div class="intro-y col-span-12">
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <base-form-switch class="text-lg">
                        <base-form-switch-input
                            @change="toggle('eid_al_adha')"
                            id="eid_al_adha"
                            type="checkbox"
                        ></base-form-switch-input>

                        <base-form-switch-label htmlFor="eid_al_adha">
                            {{ $t('sponsorships.eid_al_adha') }}
                        </base-form-switch-label>
                    </base-form-switch>
                </div>

                <div class="col-span-12 lg:col-span-8 mt-2 lg:mt-0">
                    <base-form-input
                        :disabled="!items.eid_al_adha"
                        class="w-full md:w-3/4"
                        v-model="eidAlAdha"
                        type="text"
                        :placeholder="$t('notes')"
                    ></base-form-input>
                </div>
            </div>
        </div>
        <!-- End: monthly Allowance -->
    </div>
</template>
