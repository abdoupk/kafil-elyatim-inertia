import type {
    ColorSchemesType,
    CreateFamilyForm,
    CreateFamilyStepOneProps,
    CreateFamilyStepTwoProps,
    IPlacement,
    LayoutsType,
    RegisterForm,
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

export const registerFormAttributes: RegisterForm = {
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

export const createFamilyFormAttributes: CreateFamilyForm = {
    file_number: '',
    zone: '',
    address: '',
    start_date: '',
    sponsor: {
        first_name: '',
        last_name: '',
        phone_number: '',
        sponsorship_type: '',
        birth_date: '',
        father_name: '',
        mother_name: '',
        birth_certificate_number: '',
        academic_level: '',
        function: '',
        health_status: '',
        diploma: '',
        card_number: ''
    },
    incomes: {
        cnr: 0,
        cnas: 0,
        casnos: 0,
        pension: 0,
        account: 0,
        other_income: 0
    },
    second_sponsor: {
        first_name: '',
        last_name: '',
        phone_number: '',
        income: '',
        address: '',
        degree_of_kinship: ''
    },
    spouse: {
        first_name: '',
        last_name: '',
        income: 0,
        birth_date: '',
        death_date: ''
    },
    orphans: [
        {
            first_name: '',
            last_name: '',
            birth_date: '',
            family_status: '',
            health_status: '',
            academic_level: '',
            shoes_size: '',
            pants_size: '',
            shirt_size: '',
            note: ''
        }
    ],
    housing: [],
    furnishings: [],
    report: '',
    preview_date: '',
    inspectors_members: []
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

export const createFamilyStepsTitles = [
    'families.titles.association',
    'families.titles.supervisor',
    'families.titles.association_details',
    'families.titles.association_details',
    'families.titles.association_details',
    'families.titles.association_details'
]

export const createFamilyStepOneErrorProps: CreateFamilyStepOneProps[] = [
    'file_number',
    'address',
    'zone',
    'start_date'
]

export const createFamilyStepTwoErrorProps: CreateFamilyStepTwoProps = ['sponsor', 'second_sponsor', 'spouse']

export const createFamilyStepThreeErrorProps = ['orphans']

export const createFamilyStepFourErrorProps = ['housing', 'furnishings']

export const createFamilyStepFiveErrorProps = ['report', 'preview_date', 'inspectors_members']

export const createFamilyStepSixErrorProps = ['sponsorship']
