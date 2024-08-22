<?php

namespace App\Http\Requests\V1\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteInfosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required'],
            'tenant_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
