import type {
    ColorSchemesType,
    IPlacement,
    LayoutsType,
    RegisterStepOneProps,
    RegisterStepThreeProps,
    RegisterStepTwoProps,
    ThemesType
} from '@/types/types'

export const placementClasses: Record<IPlacement['placement'], string> = {
    'top-start': 'start-0 bottom-[100%]',
    top: 'start-[50%] translate-x-[-50%] bottom-[100%]',
    'top-end': 'end-0 bottom-[100%]',
    'right-start': 'start-[100%] translate-y-[-50%]',
    right: 'start-[100%] top-[50%] translate-y-[-50%]',
    'right-end': 'start-[100%] bottom-0',
    'bottom-end': 'top-[100%] end-0',
    bottom: 'top-[100%] start-[50%] translate-x-[-50%]',
    'bottom-start': 'top-[100%] start-0',
    'left-start': 'end-[100%] translate-y-[-50%]',
    left: 'end-[100%] top-[50%] translate-y-[-50%]',
    'left-end': 'end-[100%] bottom-0'
}

// eslint-disable-next-line
export const colorSchemes: ColorSchemesType[] = ['default', 'theme_1', 'theme_2', 'theme_3', 'theme_4']

// eslint-disable-next-line
export const layouts: LayoutsType[] = ['side_menu', 'simple_menu', 'top_menu']

// eslint-disable-next-line
export const themes: ThemesType[] = ['enigma', 'icewall', 'tinker', 'rubick']

export const associationSocialMediaLinks: { [key: string]: string } = {
    facebook: '',
    instagram: '',
    twitter: ''
}

export const registerFormAttributes = {
    association: '',
    domain: '',
    address: '',
    city: '',
    first_name: '',
    last_name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
    association_email: '',
    landline: '',
    cpa: '',
    ccp: '',
    links: associationSocialMediaLinks,
    phones: ['']
}

// eslint-disable-next-line array-element-newline
export const registerStepOneErrorProps: RegisterStepOneProps[] = ['association', 'domain', 'address', 'city']

// eslint-disable-next-line array-element-newline
export const registerStepTwoErrorProps: RegisterStepTwoProps[] = [
    'email',
    'first_name',
    'last_name',
    'phone',
    'password_confirmation',
    'password'
]

// eslint-disable-next-line array-element-newline
export const registerStepThreeErrorProps: RegisterStepThreeProps[] = [
    'association_email',
    'landline',
    'phones.0',
    'cpa',
    'ccp',
    'links'
]
export const registerStepsTitles = [
    'auth.register.titles.association',
    'auth.register.titles.supervisor',
    'auth.register.titles.association_details'
]
