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
    file_number: '',
    zone_id: '',
    inspectors_members: [],
    address: '',
    start_date: new Date(),
    sponsor: {
        first_name: '',
        last_name: '',
        phone_number: '',
        birth_date: new Date(),
        father_name: '',
        mother_name: '',
        birth_certificate_number: '',
        academic_level: '',
        function: '',
        health_status: '',
        diploma: '',
        card_number: '',
        sponsor_type: '',
        gender: 'male',
        ccp: ''
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
        death_date: '',
        function: ''
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
            baby_milk_quantity: '',
            baby_milk_type: '',
            diapers_quantity: '',
            diapers_type: '',
            note: '',
            gender: 'male'
        }
    ],
    housing: {
        housing_type: {
            value: true,
            name: 'independent'
        },
        housing_receipt_number: '',
        number_of_rooms: 0
    },
    furnishings: {
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
    },
    report: '',
    preview_date: new Date(),
    other_properties: '',
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
    'families.create_family.stepOne',
    'families.create_family.stepTwo',
    'families.create_family.stepThree',
    'families.create_family.stepFour',
    'families.create_family.stepFive',
    'families.create_family.stepSix'
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

export const createFamilyStepSixErrorProps = ['report', 'preview_date', 'inspectors_members']

export const createFamilyStepFiveErrorProps = ['sponsorship']

export const academicLevels = [
    {
        phase: 'الطور الابتدائي',
        levels: ['الاولى ابتدائي', 'الثانية ابتدائي', 'الثالثة ابتدائي', 'الرابعة ابتدائي', 'الخامسة ابتدائي']
    },
    {
        phase: ' الطور المتوسط',
        levels: ['الاولى المتوسط', 'الثانية المتوسط', 'الثالثة المتوسط', 'الرابعة المتوسط']
    },
    {
        phase: ' الطور الثانوي',
        levels: [
            'الاولى ثانوي آداب',
            'الاولى ثانوي علوم',
            'الثانية ثانوي رياضيات',
            'الثانية ثانوي تقني رياضي',
            'الثانية ثانوي علوم تجريبية',
            'الثانية ثانوي تسيير و اقتصاد',
            'الثانية ثانوي أدب و فلسفة',
            'الثانية ثانوي لغات أجنبية',
            'الثالثة ثانوي رياضيات',
            'الثالثة ثانوي تقني رياضي',
            'الثالثة ثانوي علوم تجريبية',
            'الثالثة ثانوي ت و إقتصاد',
            'الثالثة ثانوي أدب و فلسفة',
            'الثالثة ثانوي لغات أجنبية'
        ]
    },
    {
        phase: ' الطور الجامعي',
        levels: [
            'الاولى ليسانس',
            'الثانية ليسانس',
            'الثالثة ليسانس',
            'الاولى ماستر',
            'الثانية ماستر',
            'الاولى دكتوراة',
            'الثانية دكتوراة',
            'الثالثة دكتوراة',
            'الرابعة دكتوراة',
            'الخامسة دكتوراة'
        ]
    }
]
