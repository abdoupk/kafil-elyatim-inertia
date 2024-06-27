<?php

namespace App\Http\Requests\V1\Branches;

use Illuminate\Foundation\Http\FormRequest;

class BranchUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
