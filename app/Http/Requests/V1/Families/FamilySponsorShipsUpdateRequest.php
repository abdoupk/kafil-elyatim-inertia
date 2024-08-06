<?php

namespace App\Http\Requests\V1\Families;

use Illuminate\Foundation\Http\FormRequest;

class FamilySponsorShipsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
