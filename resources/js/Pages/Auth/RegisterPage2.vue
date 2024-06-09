<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3'
import CitySelector from '@/Components/Global/CitySelector.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const form = useForm({
    name: '',
    email: '',
    domain: '',
    password: '',
    association: '',
    password_confirmation: ''
})

const submit = () => {
    form.post(route('register'), {
        onSuccess: () => {
            form.reset('password', 'password_confirmation')
        }
    })
}

const blurDomainField = (event: Event) => {
    let str = (event.target as HTMLInputElement).value

    form.domain = str.endsWith('-') ? str.slice(0, -1) + '' : str
}

const updateDomainName = (event: Event) => {
    let str = (event.target as HTMLInputElement).value

    str = str.replace(/[^a-zA-Z0-9\s-]|^[0-9]+|([a-zA-Z-])[0-9]+(?=[a-zA-Z-\s])/g, '$1')

    str = str.replace(/\s+/g, '-')

    str = str.replace(/--+|^-+/g, '-')

    str = str.replace(/(-[0-9]+)+$/g, '$1')

    str = str.replace(/-(?=\d+)/g, '')

    form.domain = str
}
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="my-4">
                <city-selector></city-selector>
            </div>
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="association" value="Association" />

                <TextInput
                    id="association"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.association"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.association" />
            </div>

            <div class="mt-4">
                <InputLabel for="domain" value="domain" />

                <TextInput
                    @input="updateDomainName"
                    @blur="blurDomainField"
                    id="domain"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.domain"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.domain" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('tenant.login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
