<?php

namespace App\Http\Requests\V1\Financial;

use Illuminate\Foundation\Http\FormRequest;

class FinancialUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric'],
            'description' => ['nullable'],
            'date' => ['required', 'date'],
            'specification' => ['required'],
            'created_by' => ['required', 'exists:users'],
            'tenant_id' => ['required', 'exists:tenants'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
