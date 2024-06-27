<?php

namespace App\Http\Requests\V1\Branches;

use Illuminate\Foundation\Http\FormRequest;

class BranchCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
