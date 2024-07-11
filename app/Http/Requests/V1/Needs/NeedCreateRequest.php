<?php

namespace App\Http\Requests\V1\Needs;

use Illuminate\Foundation\Http\FormRequest;

class NeedCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'demand' => ['required'],
            'subject' => ['required'],
            'needable_type' => ['required'],
            'needable_id' => ['required'],
            'tenant_id' => ['required', 'exists:tenants'],
            'note' => ['nullable'],
            'status' => ['required'],
            'deleted_at' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
