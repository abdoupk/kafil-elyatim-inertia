<?php

namespace App\Http\Requests\V1\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalculationWeightsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'association' => 'required|string|max:255',
            'super_admin' => 'required|uuid|exists:users,id',
            'city_id' => 'required|integer|exists:city,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
