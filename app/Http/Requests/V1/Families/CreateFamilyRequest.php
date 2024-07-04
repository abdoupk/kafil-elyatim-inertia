<?php

namespace App\Http\Requests\V1\Families;

use Illuminate\Foundation\Http\FormRequest;

class CreateFamilyRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'orphans.*.first_name.required' => __('validation.required', ['attribute' => __('validation.attributes.first_name')]),
            'orphans.*.last_name.required' => __('validation.required', ['attribute' => __('validation.attributes.last_name')]),
            'orphans.*.birth_date.required' => __('validation.required', ['attribute' => __('validation.attributes.date_of_birth')]),
            'orphans.*.family_status.required' => __('validation.required', ['attribute' => __('family_status')]),
            'orphans.*.health_status.required' => __('validation.required', ['attribute' => __('health_status')]),
            'orphans.*.academic_level.required' => __('validation.required', ['attribute' => __('academic_level')]),
            'orphans.*.pants_size.required_without' => __('validation.required', ['attribute' => __('pants_size')]),
            'orphans.*.shoes_size.required_without' => __('validation.required', ['attribute' => __('shoes_size')]),
            'orphans.*.shirt_size.required_without' => __('validation.required', ['attribute' => __('shirt_size')]),
            'orphans.*.baby_milk_type.required_without' => __('validation.required', ['attribute' => __('baby_milk_type')]),
            'orphans.*.baby_milk_quantity.required_without' => __('validation.required', ['attribute' => __('baby_milk_quantity')]),
            'orphans.*.diapers_type.required_without' => __('validation.required', ['attribute' => __('diapers_type')]),
            'orphans.*.diapers_quantity.required_without' => __('validation.required', ['attribute' => __('diapers_quantity')]),
            'sponsor.ccp.required' => __('validation.required', ['attribute' => __('ccp')]),
        ];
    }

    public function rules(): array
    {
        return [
            'address' => 'required|string',
            'zone_id' => 'required|string|exists:App\Models\Zone,id',
            'file_number' => 'required|numeric',
            'start_date' => 'required|date',
            'orphans.*.first_name' => 'required|string',
            'orphans.*.last_name' => 'required|string',
            'orphans.*.birth_date' => 'required|date',
            'orphans.*.family_status' => 'required|string',
            'orphans.*.health_status' => 'required|string',
            'orphans.*.academic_level' => 'required|string',
            'orphans.*.gender' => 'required|in:male,female',
            'sponsor.first_name' => 'required|string',
            'sponsor.last_name' => 'required|string',
            'sponsor.phone_number' => 'required|string',
            'sponsor.sponsor_type' => 'required|string',
            'sponsor.gender' => 'required|in:male,female',
            'sponsor.birth_date' => 'required|string',
            'sponsor.father_name' => 'required|string',
            'sponsor.mother_name' => 'required|string',
            'sponsor.birth_certificate_number' => 'required|string',
            'sponsor.academic_level' => 'required|string',
            'sponsor.function' => 'required|string',
            'sponsor.health_status' => 'required|string',
            'sponsor.diploma' => 'required|string',
            'sponsor.card_number' => 'required|string|unique:App\Models\Sponsor,card_number',
            'sponsor.ccp' => 'required|string|unique:App\Models\Sponsor,ccp',
            'second_sponsor.first_name' => 'nullable|string',
            'second_sponsor.last_name' => 'nullable|string',
            'second_sponsor.phone_number' => 'nullable|string',
            'second_sponsor.degree_of_kinship' => 'nullable|string',
            'second_sponsor.address' => 'nullable|string',
            'second_sponsor.income' => 'nullable|numeric',
            'spouse.first_name' => 'required|string',
            'spouse.last_name' => 'required|string',
            'spouse.function' => 'required|string',
            'spouse.birth_date' => 'required|string',
            'spouse.death_date' => 'required|string',
            'spouse.income' => 'sometimes|nullable|numeric',
            'incomes.*' => 'sometimes|numeric',
            'housing.housing_type.value' => 'required',
            'housing.housing_type.name' => 'required',
            'housing.number_of_rooms' => 'required|numeric',
            'housing.housing_receipt_number' => 'nullable|string',
            'furnishings.*' => 'required',
            'other_properties' => 'nullable|string',
            'inspectors_members' => 'required|array|min:1',
            'preview_date' => 'required|date',
            'inspectors_members.*' => 'required|exists:App\Models\User,id',
            'report' => 'required|string',
            'branch_id' => 'required|exists:App\Models\Branch,id',

            'orphans.*.shoes_size' => 'required_with:orphans.*.shirt_size,orphans.*.pants_size |required_without:orphans.*.baby_milk_quantity,orphans.*.baby_milk_type,orphans.*.diapers_quantity,orphans.*.diapers_type',
            'orphans.*.shirt_size' => 'required_with:orphans.*.shirt_size,orphans.*.pants_size |required_without:orphans.*.baby_milk_quantity,orphans.*.baby_milk_type,orphans.*.diapers_quantity,orphans.*.diapers_type',
            'orphans.*.pants_size' => 'required_with:orphans.*.shirt_size,orphans.*.pants_size |required_without:orphans.*.baby_milk_quantity,orphans.*.baby_milk_type,orphans.*.diapers_quantity,orphans.*.diapers_type',
            'orphans.*.baby_milk_quantity' => 'required_with:baby_milk_type|required_without:orphans.*.shoes_size
,orphans.*.shirt_size,orphans.*.pants_size',
            'orphans.*.baby_milk_type' => 'required_with:baby_milk_type|required_without:orphans.*.shoes_size
,orphans.*.shirt_size,orphans.*.pants_size',
            'orphans.*.diapers_quantity' => 'required_with:baby_milk_type|required_without:orphans.*.shoes_size
,orphans.*.shirt_size,orphans.*.pants_size',
            'orphans.*.diapers_type' => 'required_with:baby_milk_type|required_without:orphans.*.shoes_size
,orphans.*.shirt_size,orphans.*.pants_size',
            'orphans_sponsorship.*.*' => 'present|nullable',
            'sponsor_sponsorship.*' => 'present|nullable',
            'family_sponsorship.*' => 'present|nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        ray($this->all());
        $this->merge(array_map(function ($value) {
            return $value === null ? false : ($value === '' ? true : $value);
        }, $this->only(['orphans_sponsorship', 'sponsor_sponsorship', 'family_sponsorship'])));
    }
}
