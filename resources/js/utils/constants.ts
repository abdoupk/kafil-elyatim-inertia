import type {
    ColorSchemesType,
    CreateFamilyForm,
    CreateFamilyStepOneProps,
    CreateFamilyStepTwoProps,
    CreateMemberForm,
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

export const createMemberFormAttribute: CreateMemberForm = {
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    zone_id: '',
    qualification: '',
    gender: '',
    roles: [''],
    branch_id: '',
    password: '',
    password_confirmation: ''
}
export const createFamilyFormAttributes: CreateFamilyForm = {
    file_number: '00000',
    zone_id: '',
    inspectors_members: ['9c5f760c-7caa-4dc8-b7c3-5d833b2a647f'],
    address: '54545',
    start_date: new Date(),
    sponsor: {
        first_name: 'a',
        last_name: 'a',
        phone_number: '0664954817',
        birth_date: new Date(),
        father_name: 'aa',
        mother_name: 'bb',
        birth_certificate_number: '065',
        academic_level: '1000',
        function: '10065656',
        health_status: 'a',
        diploma: 'a',
        card_number: '05656',
        sponsor_type: 'a',
        gender: 'male',
        ccp: 'a'
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
        first_name: 'w',
        last_name: 'w',
        phone_number: 'w',
        income: '20233',
        address: 'w',
        degree_of_kinship: '111'
    },
    spouse: {
        first_name: 'a',
        last_name: 'a',
        income: 0,
        birth_date: '26-03-2000',
        death_date: '25-04-2022',
        function: 'a'
    },
    orphans: [
        {
            first_name: 'a',
            last_name: 'a',
            birth_date: '',
            family_status: 'a',
            health_status: 'a',
            academic_level: 'a',
            shoes_size: '',
            pants_size: '',
            shirt_size: '',
            baby_milk_quantity: '',
            baby_milk_type: '',
            diapers_quantity: '',
            diapers_type: '',
            note: '25',
            gender: 'male'
        }
    ],
    housing: {
        housing_type: {
            value: true,
            name: 'independent'
        },
        housing_receipt_number: '25',
        number_of_rooms: 3
    },
    furnishings: {
        television: true,
        refrigerator: true,
        fireplace: true,
        washing_machine: true,
        water_heater: true,
        oven: true,
        wardrobe: true,
        cupboard: true,
        covers: true,
        mattresses: true,
        other_furnishings: true
    },
    report: '22',
    preview_date: '',
    other_properties: '00000',
    branch_id: '',
    family_sponsorship: {
        monthly_allowance: null,
        ramadan_basket: null,
        zakat: null,
        housing_assistance: null,
        eid_al_adha: null
    },
    sponsor_sponsorship: {
        medical_sponsorship: null,
        literacy_lessons: null,
        direct_sponsorship: null,
        project_support: null
    },
    orphans_sponsorship: [
        {
            medical_sponsorship: false,
            university_scholarship: false,
            association_trips: false,
            summer_camp: false,
            eid_suit: false,
            private_lessons: false,
            school_bag: false
        }
    ]
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
