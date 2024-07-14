<?php

namespace App\Http\Requests\V1\Sponsors;

use Illuminate\Foundation\Http\FormRequest;

class SponsorInfosUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'zone' => ['required', 'integer'],
            'number' => ['required', 'integer'],
            'start_date' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'sponsorship_type' => ['required'],
            'birth_date' => ['required'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'birth_certificate' => ['required'],
            'academic_level' => ['required'],
            'function' => ['required'],
            'health_status' => ['required'],
            'diploma' => ['nullable'],
            'tenant_id' => ['required', 'exists:tenants'],
            'created_by' => ['required', 'exists:users'],
            'deleted_by' => ['nullable'],
            'zone_id' => ['required'],
            'file_number' => ['required', 'integer'],
            'birth_certificate_number' => ['required'],
            'card_number' => ['nullable'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'sponsor_type' => ['required'],
            'ccp' => ['nullable'],
            'gender' => ['required'],
            'family_id' => ['required', 'exists:families'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
