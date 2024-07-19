<?php

namespace App\Http\Requests\V1\Schools;

use Illuminate\Foundation\Http\FormRequest;

class SchoolUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'quota' => ['required', 'integer'],
            'tenant_id' => ['required', 'exists:tenants'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
