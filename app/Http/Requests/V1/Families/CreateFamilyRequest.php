<?php

namespace App\Http\Requests\V1\Families;

use Illuminate\Foundation\Http\FormRequest;

class CreateFamilyRequest extends FormRequest
{
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
            'sponsor.name' => 'required|string',
            'sponsor.phone_number' => 'required|string',
            'sponsor.sponsorship_type' => 'required|string',
            'sponsor.birth_date' => 'required|string',
            'sponsor.father_name' => 'required|string',
            'sponsor.mother_name' => 'required|string',
            'sponsor.birth_certificate_number' => 'required|string',
            'sponsor.academic_level' => 'required|string',
            'sponsor.function' => 'required|string',
            'sponsor.health_status' => 'required|string',
            'sponsor.diploma' => 'required|string',
            'sponsor.card_number' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
