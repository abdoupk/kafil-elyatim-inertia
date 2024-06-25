<?php

namespace App\Http\Requests\V1\Families;

use Illuminate\Foundation\Http\FormRequest;

class CreateFamilyRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'orphans.*.first_name.required' => __('validation.required', ['attribute' => __('validation.attributes.first_name')]),
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'zone' => 'required|string|exists:App\Models\Zone,id',
            'file_number' => 'required|numeric',
            'start_date' => 'required|date|date_format:d-m-Y', //TODO change format to j M, Y
            'orphans.*.first_name' => 'required|string',
            'orphans.*.last_name' => 'required|string',
            'orphans.*.birth_date' => 'required|date|date_format:d-m-Y', //TODO change format to j M, Y
            'orphans.*.family_status' => 'required|string',
            'orphans.*.health_status' => 'required|string',
            'orphans.*.academic_level' => 'required|string',
            'orphans.*.shoes_size' => 'required|numeric',
            'orphans.*.shirt_size' => 'required|numeric',
            'orphans.*.pants_size' => 'required|numeric',
            'sponsor.first_name' => 'required|string',
            'sponsor.last_name' => 'required|string',
            'sponsor.phone_number' => 'required|string',
            //            'sponsor.sponsorship_type' => 'required|string', TODO:uncomment
            'sponsor.birth_date' => 'required|string',
            'sponsor.father_name' => 'required|string',
            'sponsor.mother_name' => 'required|string',
            'sponsor.birth_certificate_number' => 'required|string',
            'sponsor.academic_level' => 'required|string',
            'sponsor.function' => 'required|string',
            'sponsor.health_status' => 'required|string',
            'sponsor.diploma' => 'required|string',
            'sponsor.card_number' => 'required|string',
            'second_sponsor.first_name' => 'required|string',
            'second_sponsor.last_name' => 'required|string',
            'second_sponsor.phone_number' => 'required|string',
            'second_sponsor.degree_of_kinship' => 'required|string',
            'second_sponsor.address' => 'required|string',
            'second_sponsor.income' => 'required|numeric',
            'spouse.first_name' => 'required|string',
            'spouse.last_name' => 'required|string',
            'spouse.function' => 'required|string',
            'spouse.birth_date' => 'required|string',
            'spouse.death_date' => 'required|string',
            'spouse.income' => 'sometimes|nullable|numeric',
            'incomes.*' => 'sometimes|nullable|numeric',
            'housing.housing_type.value' => 'required',
            'housing.number_of_rooms' => 'required|numeric',
            'housing.housing_receipt_number' => 'required|string',
            'housing.other_properties' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
