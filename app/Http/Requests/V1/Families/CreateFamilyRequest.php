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
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
