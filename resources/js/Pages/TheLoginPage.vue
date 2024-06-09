<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import BaseButton from '@/Components/Base/button/BaseButton.vue'
import BaseFormCheckInput from '@/Components/Base/form/form-check/BaseFormCheckInput.vue'
import BaseFormInput from '@/Components/Base/form/BaseFormInput.vue'
import BaseInputError from '@/Components/Base/form/BaseInputError.vue'
import { twMerge } from 'tailwind-merge'

defineProps<{
    canResetPassword?: boolean
    status?: string
}>()

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    // eslint-disable-next-line no-undef
    form.post(route('tenant.login'), {
        onFinish: () => {
            form.reset('password')
        }
    })
}
</script>

<template>
    <Head title="Register" />
    <div
        :class="
            twMerge([
                'relative h-screen bg-primary p-3 dark:bg-darkmode-800 sm:px-8 lg:overflow-hidden xl:bg-white xl:dark:bg-darkmode-600',
                'before:absolute before:inset-y-0 before:start-0 before:-mb-[16%] before:-ms-[13%] before:-mt-[28%] before:hidden before:w-[57%] before:rotate-[-4.5deg] before:transform before:rounded-[100%] before:bg-primary/20 before:content-[\'\'] before:dark:bg-darkmode-400 before:xl:block',
                'after:absolute after:inset-y-0 after:start-0 after:-mb-[13%] after:-ms-[13%] after:-mt-[20%] after:hidden after:w-[57%] after:rotate-[-4.5deg] after:transform after:rounded-[100%] after:bg-primary after:content-[\'\'] after:dark:bg-darkmode-700 after:xl:block'
            ])
        "
    >
        <div class="container relative z-10 sm:px-10">
            <div class="block grid-cols-2 gap-4 xl:grid">
                <!-- BEGIN: Login Info -->
                <div class="hidden min-h-screen flex-col xl:flex">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Tinker Starter" class="w-6" src="/images/logo.svg" />
                        <span class="ms-3 text-lg text-white"> Tinker </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Tinker Starter" class="-intro-x -mt-16 w-1/2" src="/images/man-illustration.svg" />
                        <div
                            class="-intro-x mt-10 text-4xl font-medium leading-tight text-white"
                            v-html="__('auth.hints.leading')"
                        ></div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                            {{ __('auth.hints.second') }}
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->

                <!-- BEGIN: Login Form -->
                <form @submit.prevent="submit" class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                    <div
                        class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ms-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none"
                    >
                        <h2 class="intro-x text-center text-2xl font-bold xl:text-start xl:text-3xl">
                            {{ __('auth.Sign in') }}
                        </h2>
                        <div class="intro-x mt-2 text-center text-slate-400 xl:hidden">
                            {{ __('auth.hints.small') }}
                        </div>

                        <div class="intro-x mt-8">
                            <base-form-input
                                v-model="form.email"
                                type="text"
                                class="intro-x block min-w-full px-4 py-3 xl:min-w-[350px]"
                                :placeholder="__('validation.attributes.email')"
                                autofocus
                            />

                            <base-input-error class="mt-2" :message="form.errors.email"></base-input-error>

                            <base-form-input
                                v-model="form.password"
                                type="password"
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                :placeholder="__('validation.attributes.password')"
                            />
                            <base-input-error class="mt-2" :message="form.errors.password"></base-input-error>
                        </div>

                        <div class="intro-x mt-4 flex text-xs text-slate-600 dark:text-slate-500 sm:text-sm">
                            <div class="me-auto flex items-center">
                                <base-form-check-input id="remember-me" type="checkbox" class="me-2 border" />
                                <label class="cursor-pointer select-none" for="remember-me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>

                        <div class="intro-x mt-5 text-center xl:mt-8 xl:text-start">
                            <base-button variant="primary" class="w-full px-4 py-3 align-top xl:me-3 xl:w-32">
                                {{ __('auth.Login') }}
                            </base-button>
                        </div>
                    </div>
                </form>
                <!-- END: Login Form -->
            </div>
        </div>
    </div>
</template>
