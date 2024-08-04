<script lang="ts" setup>
import { type RoleType } from '@/types/types'

import { useRolesStore } from '@/stores/roles'
import { onMounted } from 'vue'

import BaseVueSelect from '@/Components/Base/vue-select/BaseVueSelect.vue'

const roles = defineModel<string[]>('roles')

const formattedRoles = defineModel('formattedRoles')

const handleUpdate = (value: RoleType[]) => {
    roles.value = value.map((role) => role.uuid)
}

const rolesStore = useRolesStore()

onMounted(async () => {
    await rolesStore.getRoles()
})
</script>

<template>
    <!--  @vue-ignore  -->
    <base-vue-select
        v-model="formattedRoles"
        :options="rolesStore.roles"
        label="name"
        multiple
        track-by="uuid"
        @update:value="handleUpdate"
    ></base-vue-select>
</template>
